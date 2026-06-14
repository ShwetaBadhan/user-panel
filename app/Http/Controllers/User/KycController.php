<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KycController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL', 'http://127.0.0.1:8001/api');
    }

    /**
     * Show KYC form and current KYC status
     */
    public function index()
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $kycData = null;

        try {
            $response = Http::timeout(10)->get("{$this->apiBaseUrl}/kyc/status", [
                'user_id' => $userId,
            ]);

            if ($response->successful()) {
                $body = $response->json();
                $kycData = $body['data'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('KYC Fetch Error: ' . $e->getMessage());
        }

        return view('pages.user.kyc', compact('kycData'));
    }

    /**
     * Submit KYC documents via AJAX
     */
    public function submit(Request $request)
    {
        $userId = session('user_id');

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Please login first.'], 401);
        }

        try {
            $multipart = [
                ['name' => 'user_id',              'contents' => (string) $userId],
                ['name' => 'pan_number',            'contents' => $request->input('pan_number', '')],
                ['name' => 'aadhaar_number',        'contents' => $request->input('aadhaar_number', '')],
                ['name' => 'account_holder_name',   'contents' => $request->input('account_holder_name', '')],
                ['name' => 'account_number',        'contents' => $request->input('account_number', '')],
                ['name' => 'ifsc_code',             'contents' => $request->input('ifsc_code', '')],
            ];

            // Attach image files if present
            $fileFields = ['pan_image', 'aadhaar_front_image', 'aadhaar_back_image', 'bank_document_image'];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $multipart[] = [
                        'name'     => $field,
                        'contents' => fopen($file->getRealPath(), 'r'),
                        'filename' => $file->getClientOriginalName(),
                    ];
                }
            }

            $response = Http::timeout(30)
                ->asMultipart()
                ->post("{$this->apiBaseUrl}/kyc/submit", $multipart);

            if ($response->successful()) {
                $body = $response->json();
                return response()->json([
                    'success' => true,
                    'message' => $body['message'] ?? 'KYC submitted successfully.',
                ]);
            }

            $body = $response->json();
            return response()->json([
                'success' => false,
                'message' => $body['message'] ?? 'Failed to submit KYC. Please try again.',
                'errors'  => $body['errors'] ?? [],
            ], $response->status());

        } catch (\Exception $e) {
            Log::error('KYC Submit Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
