<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\UserMLMController;
use App\Http\Controllers\User\UserBankDetailController;
use App\Http\Controllers\User\FundSummaryController;
use App\Http\Controllers\User\FundRequestController;
use App\Http\Controllers\User\FundRequestStatusController;
use App\Http\Controllers\User\FundTransferController;
use App\Http\Controllers\User\FundHistoryController;
    use App\Http\Controllers\User\WalletController;
    use App\Http\Controllers\User\DirectIncomeController;
    use App\Http\Controllers\User\MatchingIncomeController;
    use App\Http\Controllers\User\CashBonusRequestController;
use App\Http\Controllers\User\ClaimCashRequestController;
use App\Http\Controllers\User\CashBonusHistoryController;
use App\Http\Controllers\User\GenerationIncomeController;
use App\Http\Controllers\User\AwardsRewardsController;
use App\Http\Controllers\User\DownlineRankController;
use App\Http\Controllers\User\WeeklyPayoutController;
use App\Http\Controllers\User\RetreatToursController;

use App\Http\Controllers\User\OrderHistoryController;
use App\Http\Controllers\User\ByHandDeliveryController;
use App\Http\Controllers\User\CourierDeliveryController;
use App\Http\Controllers\User\ByHandAwardController;
use App\Http\Controllers\User\ByCourierAwardController;
use App\Http\Controllers\User\OtherProductsController;
use App\Http\Controllers\User\GrievanceController;

// 1. Login routes (GET shows form, POST processes login)
Route::match(['get', 'post'], '/', [LoginController::class, 'handleLogin'])->name('login');

// Dashboard (protected)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// 3. Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Buy Now Routes
Route::get('/buy-now', [ProductController::class, 'buyNow'])->name('buy-now');
Route::post('/purchase', [ProductController::class, 'purchase'])->name('purchase');




Route::get('/my-profile', [UserController::class, 'editProfile'])->name('user.profile');
Route::post('/my-profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');

 Route::get('/profile-image', [UserController::class, 'editProfileImage'])->name('user.profile.image');
    Route::post('/profile-image/upload', [UserController::class, 'uploadProfileImage'])->name('user.profile.image.upload');

    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.change-password');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change-password.update');

      // Change transaction password
    Route::get('/change-transaction-password', [UserController::class, 'showChangeTransactionPasswordForm'])->name('user.change-transaction-password');
    Route::post('/change-transaction-password', [UserController::class, 'changeTransactionPassword'])->name('user.change-transaction-password.update');
    
    // Forgot transaction password
    Route::get('/forgot-transaction-password', [UserController::class, 'showForgotTransactionPasswordForm'])->name('user.forgot-transaction-password');
    Route::post('/forgot-transaction-password', [UserController::class, 'forgotTransactionPassword'])->name('user.forgot-transaction-password.submit');


     Route::get('/welcome-letter', [UserController::class, 'welcomeLetter'])->name('user.welcome-letter');

      Route::get('/visiting-card', [UserController::class, 'visitingCard'])->name('user.visiting-card');
    Route::post('/visiting-card/download', [UserController::class, 'downloadVisitingCard'])->name('user.visiting-card.download');
     Route::get('/signup-acknowledgement', [UserController::class, 'signupAcknowledgement'])->name('user.signup-acknowledgement');

Route::get('/direct-business', [UserMLMController::class, 'directBusiness'])
    ->name('user.direct-business');

Route::get('/downline-business', [UserMLMController::class, 'downlineBusiness'])
    ->name('user.downline-business');

Route::get('/genealogy', [UserMLMController::class, 'genealogy'])
    ->name('user.genealogy');

   
 Route::get('/user-profile/{userId}/modal', [UserMLMController::class, 'getUserProfileModal'])
        ->name('user.profile.modal');

        Route::get('/user-tree/{userId}/html', [UserMLMController::class, 'getUserTreeHtml'])
    ->name('user.tree.html');

    Route::get('/admin-bank-detail', [UserBankDetailController::class, 'index'])
    ->name('user.admin-bank-detail');

    Route::get('/fund-summary', [FundSummaryController::class, 'index'])
    ->name('user.fund-summary');

    
Route::get('/fund-request', [FundRequestController::class, 'index'])
    ->name('user.fund-request');

Route::get('/api/fund-request/bank-details', [FundRequestController::class, 'getBankDetails'])
    ->name('user.fund-request.bank-details');

Route::post('/fund-request/submit', [FundRequestController::class, 'submit'])
    ->name('user.fund-request.submit');
    // Fund Request Status
Route::get('/fund-request-status', [FundRequestStatusController::class, 'index'])
    ->name('user.fund-request-status');

// Fund Transfer
Route::get('/fund-transfer', [FundTransferController::class, 'index'])
    ->name('user.fund-transfer');
Route::post('/fund-transfer/transfer', [FundTransferController::class, 'transfer'])
    ->name('user.fund-transfer.transfer');
Route::get('/fund-list', [FundTransferController::class, 'getSentTransfers'])
    ->name('user.fund-list');
Route::get('/fund-receive-list', [FundTransferController::class, 'getReceivedTransfers'])
    ->name('user.fund-receive-list');
Route::get('/api/wallet-balance', [FundTransferController::class, 'getWalletBalance'])
    ->name('user.wallet-balance');

// Fund History
Route::get('/fund-history', [FundHistoryController::class, 'index'])
    ->name('user.fund-history');



// Wallet Routes
Route::get('/wallets', [WalletController::class, 'index'])->name('user.wallets');
Route::get('/wallet/transactions', [WalletController::class, 'getTransactions'])->name('user.wallet.transactions');

Route::get('/account-summary', [WalletController::class, 'accountSummary'])
    ->name('user.account.summary');
Route::get('/account-summary/data', [WalletController::class, 'getAccountSummaryData'])
    ->name('user.account.summary.data');


    // Direct Income Routes
Route::get('/direct-income', [DirectIncomeController::class, 'index'])
    ->name('user.direct-income');
Route::get('/direct-income/data', [DirectIncomeController::class, 'getDirectIncomeData'])
    ->name('user.direct-income.data');

    Route::get('/matching-income', [MatchingIncomeController::class, 'index'])
    ->name('user.matching-income');
Route::get('/matching-income/data', [MatchingIncomeController::class, 'getMatchingIncomeData'])
    ->name('user.matching-income.data');
    // Cash Bonus Routes
Route::get('/cash-bonus-request', [CashBonusRequestController::class, 'index'])->name('user.cash-bonus-request');
Route::get('/cash-bonus-request/data', [CashBonusRequestController::class, 'getCashBonusData'])->name('user.cash-bonus-request.data');

Route::get('/claim-cash-request', [ClaimCashRequestController::class, 'index'])->name('user.claim-cash-request');
Route::get('/claim-cash-request/data', [ClaimCashRequestController::class, 'getClaimData'])->name('user.claim-cash-request.data');

Route::get('/cash-bonus-history', [CashBonusHistoryController::class, 'index'])->name('user.cash-bonus-history');
Route::get('/cash-bonus-history/data', [CashBonusHistoryController::class, 'getHistoryData'])->name('user.cash-bonus-history.data');

Route::get('/generation-income', [GenerationIncomeController::class, 'index'])->name('user.generation-income');
Route::get('/generation-income/data', [GenerationIncomeController::class, 'getGenerationIncomeData'])->name('user.generation-income.data');

Route::get('/awards-rewards', [AwardsRewardsController::class, 'index'])->name('user.awards-rewards');
Route::get('/awards-rewards/data', [AwardsRewardsController::class, 'getAwardsData'])->name('user.awards-rewards.data');

// Downline Rank
Route::get('/downline-rank', [DownlineRankController::class, 'index'])->name('user.downline-rank');
Route::get('/downline-rank/data', [DownlineRankController::class, 'getDownlineRankData'])->name('user.downline-rank.data');

// Weekly Payout
Route::get('/weekly-payout', [WeeklyPayoutController::class, 'index'])->name('user.weekly-payout');
Route::get('/weekly-payout/data', [WeeklyPayoutController::class, 'getPayoutData'])->name('user.weekly-payout.data');

// Retreat Tours
Route::get('/retreat-tours', [RetreatToursController::class, 'index'])->name('user.retreat-tours');
Route::get('/retreat-tours/data', [RetreatToursController::class, 'getToursData'])->name('user.retreat-tours.data');

// Order History
Route::get('/order-history', [OrderHistoryController::class, 'index'])
    ->name('user.order-history');
    
// By Hand Delivery
Route::get('/by-hand-delivery', [ByHandDeliveryController::class, 'index'])->name('user.by-hand-delivery');
Route::get('/by-hand-delivery/data', [ByHandDeliveryController::class, 'getDeliveryData'])->name('user.by-hand-delivery.data');

// Courier Delivery
Route::get('/courier-delivery', [CourierDeliveryController::class, 'index'])->name('user.courier-delivery');
Route::get('/courier-delivery/data', [CourierDeliveryController::class, 'getCourierData'])->name('user.courier-delivery.data');

// By Hand Award
Route::get('/by-hand-award', [ByHandAwardController::class, 'index'])->name('user.by-hand-award');
Route::get('/by-hand-award/data', [ByHandAwardController::class, 'getAwardData'])->name('user.by-hand-award.data');

// By Courier Award
Route::get('/by-courier-award', [ByCourierAwardController::class, 'index'])->name('user.by-courier-award');
Route::get('/by-courier-award/data', [ByCourierAwardController::class, 'getCourierAwardData'])->name('user.by-courier-award.data');

// Other Products
Route::get('/other-products', [OtherProductsController::class, 'index'])->name('user.other-products');
Route::get('/other-products/data', [OtherProductsController::class, 'getOtherProductsData'])->name('user.other-products.data');

// Grievance Cell
Route::get('/grievance/raise-ticket', [GrievanceController::class, 'raiseTicket'])->name('user.grievance.raise-ticket');
Route::post('/grievance/submit', [GrievanceController::class, 'submitTicket'])->name('user.grievance.submit');
Route::get('/grievance/outbox', [GrievanceController::class, 'outbox'])->name('user.grievance.outbox');
Route::get('/grievance/outbox/data', [GrievanceController::class, 'getOutboxData'])->name('user.grievance.outbox.data');
Route::get('/grievance/inbox', [GrievanceController::class, 'inbox'])->name('user.grievance.inbox');
Route::get('/grievance/inbox/data', [GrievanceController::class, 'getInboxData'])->name('user.grievance.inbox.data');