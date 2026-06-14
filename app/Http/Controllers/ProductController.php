<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function buyNow()
    {
        $userId = Session::get('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $maxProducts = 40;

        $totalPurchased = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->sum('order_items.quantity');

        $remainingProducts = $maxProducts - $totalPurchased;

        // Wallet Balance - wallet_id = 1 (Fund Wallet) ke liye
        $walletBalance = DB::table('wallet_balances')
            ->where('user_id', $userId)
            ->where('wallet_id', 1)
            ->value('balance');
            // dd($walletBalance);

        $walletBalance = $walletBalance ?? 0;

        $products = DB::table('products')
            ->where('status', 1)
            ->where('in_stock', 1)
            ->where('stock', '>', 0)
            ->get();

        return view('pages.buy-now', compact(
            'products',
            'totalPurchased',
            'maxProducts',
            'remainingProducts',
            'walletBalance'
        ));
    }

   public function purchase(Request $request)
{
    $userId = Session::get('user_id');
    
    $validator = Validator::make($request->all(), [
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');

    $product = DB::table('products')->where('id', $productId)->first();

    if (!$product || $product->stock < $quantity) {
        return back()->with('error', 'Product not available or insufficient stock');
    }

    // Lifetime Limit Check
    $totalPurchased = DB::table('order_items')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.user_id', $userId)
        ->sum('order_items.quantity');

    $maxProducts = 40;
    
    if (($totalPurchased + $quantity) > $maxProducts) {
        return back()->with('error', "You can only purchase maximum {$maxProducts} products. Already purchased: {$totalPurchased}. Remaining: " . ($maxProducts - $totalPurchased));
    }

    // Wallet Balance Check
    $walletBalance = DB::table('wallet_balances')
        ->where('user_id', $userId)
        ->where('wallet_id', 1)
        ->value('balance');
    
    $walletBalance = $walletBalance ?? 0;
    $totalAmount = $product->price * $quantity;

    if ($walletBalance < $totalAmount) {
        return back()->with('error', "Insufficient wallet balance. Required: ₹{$totalAmount}, Available: ₹{$walletBalance}");
    }

    DB::beginTransaction();

    try {
        // Order create karna - package_id ko NULL set karo
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $userId,
            'package_id' => NULL, // NULL set karo kyunki yeh product order hai
            'order_date' => now(),
            'total_amount' => $totalAmount,
            'total_cc_points' => ($product->cc_points ?? 0) * $quantity,
            'status' => 'COMPLETED',
            'order_type' => 'SELF',
            'payment_mode' => 'WALLET',
            'note' => "Purchased {$quantity}x {$product->name}",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Order Item create karna
        DB::table('order_items')->insert([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $product->price,
            'cc_points' => ($product->cc_points ?? 0) * $quantity,
            'status' => 'COMPLETED',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Product stock update
        DB::table('products')
            ->where('id', $productId)
            ->update(['stock' => $product->stock - $quantity]);

        // Wallet se paise katna
        DB::table('wallet_balances')
            ->where('user_id', $userId)
            ->where('wallet_id', 1)
            ->update([
                'balance' => $walletBalance - $totalAmount,
                'total_withdrawn' => DB::raw('total_withdrawn + ' . $totalAmount),
                'updated_at' => now()
            ]);

        // MLM Tree update
        $ccPoints = ($product->cc_points ?? 0) * $quantity;
        DB::table('mlm_trees')
            ->where('mlm_user_id', $userId)
            ->update([
                'business_volume' => DB::raw('business_volume + ' . $ccPoints),
                'earned_amount' => DB::raw('earned_amount + ' . $totalAmount),
                'updated_at' => now()
            ]);

        DB::commit();

        return redirect()->route('buy-now')->with('success', 'Order placed successfully! Order ID: ' . $orderId);

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error placing order: ' . $e->getMessage());
    }
}
}