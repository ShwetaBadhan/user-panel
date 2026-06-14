<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FundSummaryController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL');
    }

    public function index(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        try {
            $queryParams = [
                'user_id' => $userId,
                'type' => $request->type ?? '',
                'date_from' => $request->date_from ?? '',
                'date_to' => $request->date_to ?? '',
            ];

            $response = Http::timeout(10)->get("{$this->apiBaseUrl}/fund-summary", $queryParams);

            if ($response->successful()) {
                $data = $response->json();
                $fundSummaries = collect($data['data'] ?? [])->map(fn($item) => (object) $item);
                $totals = (object) ($data['totals'] ?? ['credit' => 0, 'debit' => 0]);


                return view('pages.user.fund-summary', compact('fundSummaries', 'totals'));
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load fund summary');
        }

        return view('pages.user.fund-summary', [
            'fundSummaries' => collect(),
            'totals' => (object)['credit' => 0, 'debit' => 0]
        ]);
    }
}