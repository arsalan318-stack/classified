<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Livewire\User\Navbar;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ContentLoader;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\AddCategory;
use App\Livewire\Admin\EditCategory;
use App\Livewire\Admin\ManageCategory;
use App\Livewire\Admin\Subcategory\AddSubcategory;
use App\Livewire\Admin\Subcategory\EditSubcategory;
use App\Livewire\Admin\Subcategory\ManageSubcategory;
use App\Http\Controllers\StripeWebhookController;
use App\Livewire\Admin\ManageProduct;
use App\Livewire\Chat\ChatInbox;
use App\Livewire\User\PostAd;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Http\Controllers\GoogleController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
// Route::get('/dashboard', function () {
//             return view('dashboard');
//          })->name('dashboard');

Route::get('nav',function(){
    return view('test');
});


Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);


//User
Route::get('/',[UserController::class,'index']);
Route::get('/post_ad', PostAd::class)->name('post_ad')->middleware('auth');
Route::get('get_product_details/{id}',[UserController::class, 'get_product_details'])->name('get_product_details');
Route::get('product_with_category/{id}',[UserController::class,'product_with_category'])->name('product_with_category');
Route::get('product_with_subcategory/{id}',[UserController::class,'product_with_subcategory'])->name('product_with_subcategory');
Route::get('search', [UserController::class, 'search'])->name('search');
Route::get('/get_products/{id}', [UserController::class,'get_products'])->name('get_products');
Route::get('/sort_asc/{id}', [UserController::class,'sort_asc'])->name('sort_asc');
Route::get('/sort_dsc/{id}', [UserController::class,'sort_dsc'])->name('sort_dsc');
Route::get('/my_ads', [UserController::class,'my_ads'])->middleware('auth')->name('my_ads');
Route::middleware('auth')->group(function () {
    Route::post('/favorites/toggle/{product}', [UserController::class,'toggle'])->name('favorites.toggle');
    Route::get('favorites_ad',[UserController::class,'favorites_ad'])->name('favorites_ad');
    Route::post('report_abuse',[UserController::class,'report_abuse'])->name('report_abuse');
});
//chat
Route::get('/start_chat/{productId}/{receiverId}', [UserController::class,'start_chat'])->name('start_chat')->middleware('auth','web');
 Route::get('/chat/{conversationId?}', function ($conversationId = null) {
    return view('user.chat.chat_inbox', compact('conversationId'));
 })->name('chat')->middleware('auth');
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle']);
// Route::get('/payment/success', function () {
//     return redirect()->back()->with('success', 'Payment successful! Your ad will be upgraded shortly.');
// })->name('payment.success');
Route::get('/payment/success/{product}', function ($productId, \Illuminate\Http\Request $request) {
    Stripe::setApiKey(config('services.stripe.secret'));

    // Get session_id from query string
    $sessionId = $request->get('session_id');

    if (!$sessionId) {
        return "Missing session_id!";
    }

    // Fetch checkout session from Stripe
    $session = StripeSession::retrieve($sessionId);

    // Check payment status
    if ($session->payment_status === 'paid') {
        $product = Product::findOrFail($productId);

        // Optionally update here (webhook is better for reliability)
        $product->is_premium = 1;
        $product->save();

        //return "✅ Payment successful, product {$product->id} is premium now!";
          dd($product->is_premium);
    } else {
        return "❌ Payment not completed!";
    }
})->name('payment.success');


Route::get('/payment/cancel', function () {
    return redirect()->back()->with('error', 'Payment cancelled.');
})->name('payment.cancel');

//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', ContentLoader::class)->name('admin');
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    //category
Route::get('/admin/add-category', AddCategory::class)->name('admin.add-category');
Route::get('/admin/manage-category', ManageCategory::class)->name('admin.manage-category');
Route::get('/admin/edit-category/{id}', EditCategory::class)->name('admin.edit-category');
//subcategory
Route::get('/admin/add-subcategory', AddSubcategory::class)->name('admin.add-subcategory');
Route::get('/admin/manage-subcategory', ManageSubcategory::class)->name('admin.manage-subcategory');
Route::get('/admin/edit-subcategory/{id}',EditSubcategory::class)->name('admin.edit-subcategory');
//product
Route::get('/admin/manage-product', ManageProduct::class)->name('admin.manage-product');
});

