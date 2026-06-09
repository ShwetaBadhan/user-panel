<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\MlmUser;

class UserController extends Controller
{
    // Profile edit page
    public function editProfile()
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = MlmUser::find($userId);

        if (!$user) {
            Session::flush();
            return redirect()->route('login')->with('error', 'User not found.');
        }

        return view('pages.edit-my-profile', compact('user'));
    }

    // Profile update
    public function updateProfile(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = MlmUser::find($userId);

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->profile_update_count >= 1) {
            return back()->with('error', 'Aap sirf 1 baar update kar sakte hain. Admin se contact karein.');
        }

        $validated = $request->validate([
            'father_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'sex' => 'nullable|in:Male,Female,Other',
            'address' => 'nullable|string|max:500',
            'pincode' => 'nullable|string|max:10',
            'gstin' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'bank_name' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'account_type' => 'nullable|string|max:50',
            'account_number' => 'nullable|string|max:50',
            'account_holder_name' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:20',
            'nominee_name' => 'nullable|string|max:255',
            'nominee_relation' => 'nullable|string|max:100',
        ]);

        $user->update($validated);
        $user->increment('profile_update_count');

        return back()->with('success', 'Profile updated successfully!');
    }

    // Profile image edit page
    public function editProfileImage()
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = MlmUser::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        return view('pages.profile-image-edit', compact('user'));
    }

    // Profile image upload
    public function uploadProfileImage(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = MlmUser::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        // ✅ Validation - Ab yeh kaam karega
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Purani image delete karo
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // New image upload karo
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile-photos', $filename, 'public');

            $user->update([
                'profile_photo_path' => $path,
            ]);

            return redirect()->route('user.profile.image')
                ->with('success', 'Profile image updated successfully!');
        }

        return back()->with('error', 'No file uploaded.');
    }
      public function showChangePasswordForm()
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = MlmUser::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        return view('pages.change-password', compact('user'));
    }

    // Password change karna
    public function changePassword(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = MlmUser::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ], [
            'old_password.required' => 'Old password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 6 characters.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Old password check karo
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.'])
                ->withInput();
        }

        // New password same toh nahi hai na?
        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'New password must be different from old password.'])
                ->withInput();
        }

        // Password update karo
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('user.change-password')
            ->with('success', 'Password changed successfully! Please login again.');
    }
      // Change Transaction Password Form
    public function showChangeTransactionPasswordForm()
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = MlmUser::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        return view('pages.change-transaction-password', compact('user'));
    }

    // Change Transaction Password
    public function changeTransactionPassword(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = MlmUser::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'old_transaction_password' => 'required|string',
            'new_transaction_password' => 'required|string|min:6|confirmed',
        ], [
            'old_transaction_password.required' => 'Old transaction password is required.',
            'new_transaction_password.required' => 'New transaction password is required.',
            'new_transaction_password.min' => 'New transaction password must be at least 6 characters.',
            'new_transaction_password.confirmed' => 'New transaction password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Old transaction password check (agar set hai toh)
        if ($user->transaction_password) {
            if (!Hash::check($request->old_transaction_password, $user->transaction_password)) {
                return back()->withErrors(['old_transaction_password' => 'Old transaction password is incorrect.'])
                    ->withInput();
            }
        } else {
            // Agar pehle se transaction password nahi hai, toh old password login password se match karo
            if (!Hash::check($request->old_transaction_password, $user->password)) {
                return back()->withErrors(['old_transaction_password' => 'Old transaction password is incorrect.'])
                    ->withInput();
            }
        }

        // New password same toh nahi hai na?
        if (Hash::check($request->new_transaction_password, $user->transaction_password ?? '')) {
            return back()->withErrors(['new_transaction_password' => 'New transaction password must be different from old password.'])
                ->withInput();
        }

        // Transaction password update karo
        $user->update([
            'transaction_password' => Hash::make($request->new_transaction_password),
        ]);

        return redirect()->route('user.change-transaction-password')
            ->with('success', 'Transaction password changed successfully!');
    }

    // Forgot Transaction Password Form
   public function showForgotTransactionPasswordForm()
{
    $userId = Session::get('user_id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    $user = MlmUser::find($userId);

    if (!$user) {
        return redirect()->route('login')->with('error', 'User not found.');
    }

   
    return view('pages.forgot-transaction-password', compact('user'));
}

    // Forgot Transaction Password Submit
    public function forgotTransactionPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // User dhundo
        $user = MlmUser::where('user_name', $request->username)
            ->where('first_name', 'like', '%' . $request->name . '%')
            ->where('email', $request->email)
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->first();

        if (!$user) {
            return back()->withErrors(['username' => 'User not found with provided details.'])
                ->withInput();
        }

        // Naya random transaction password generate karo
        $newTransactionPassword = Str::random(8);

        // Update karo
        $user->update([
            'transaction_password' => Hash::make($newTransactionPassword),
        ]);

        // Yahan aap email bhi bhej sakte ho
        // Mail::to($user->email)->send(new TransactionPasswordResetMail($newTransactionPassword));

        return redirect()->route('user.forgot-transaction-password')
            ->with('success', 'New transaction password generated successfully!')
            ->with('new_password', $newTransactionPassword);
    }
    public function welcomeLetter()
{
    $userId = Session::get('user_id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    $user = MlmUser::with(['sponsor'])->find($userId);

    if (!$user) {
        return redirect()->route('login')->with('error', 'User not found.');
    }

    return view('pages.welcome-letter', compact('user'));
}
public function visitingCard()
{
    $userId = Session::get('user_id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    $user = MlmUser::find($userId);

    if (!$user) {
        return redirect()->route('login')->with('error', 'User not found.');
    }

    return view('pages.visiting-card', compact('user'));
}

// Visiting Card download karna
public function downloadVisitingCard(Request $request)
{
    $userId = Session::get('user_id');
    $user = MlmUser::find($userId);

    if (!$user) {
        return redirect()->route('login')->with('error', 'User not found.');
    }

    // HTML content ko capture karo
    $html = view('pages.visiting-card-download', compact('user'))->render();
    
    // PDF generate karne ke liye (agar snappy/pdf library use kar rahe ho)
    // Ya fir screenshot download ka option de sakte ho
    
    return response()->streamDownload(function () use ($html) {
        echo $html;
    }, 'visiting-card-'.$user->user_name.'.html');
}
public function signupAcknowledgement()
{
    $userId = Session::get('user_id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    $user = MlmUser::with(['sponsor'])->find($userId);

    if (!$user) {
        return redirect()->route('login')->with('error', 'User not found.');
    }

    return view('pages.signup-acknowledgement', compact('user'));
}
}
