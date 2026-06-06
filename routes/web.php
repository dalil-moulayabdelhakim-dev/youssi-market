<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TicketMessages;
use Illuminate\Support\Facades\Route;


// Home page route
Route::get('/', [MainController::class, 'index'])->name('/');

// Language switch route (English / Arabic)
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400); // Invalid locale
    }

    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');

// Product details page
Route::get('/p/details/{id}', [MainController::class, 'productDetail'])->name('products.details');

// Routes that require authentication + email verification
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'active',
])->group(function () {

    // Dashboard accessible only by Admin or Seller
    Route::middleware(['active', 'adminOrSeller'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'redirect'])->name('dashboard');
    });

    // ================= Admin Routes ================= //
    Route::middleware('role:admin')->group(function () {
        Route::group([
            'prefix' => 'a',
            'as' => 'admin-',
        ], function () {
            Route::get('/sb/requests', [AdminController::class, 'subscriptionRequestView'])->name('subscription-request'); // View subscription requests
            Route::get('u/view', [AdminController::class, 'usersView'])->name('users.view'); // View all users
            Route::get('/payment-requests/{id}', [AdminController::class, 'subscriptionDetails'])->name('subscription-details'); // View payment request details
            Route::get('/users/{id}/store', [AdminController::class, 'userStore'])->name('users.store'); // View user’s store
            Route::post('/payment-requests/approve', [AdminController::class, 'approve'])->name('payment_requests.approve'); // Approve payment
            Route::post('/payment-requests/reject', [AdminController::class, 'reject'])->name('payment_requests.reject'); // Reject payment
            Route::post('/u/add', [AdminController::class, 'addUser'])->name('user.add'); // Add new user
            Route::post('/u/update/{id}/status', [AdminController::class, 'updateUserStatus'])->name('users.status');
            Route::get('/admin/profits', [AdminController::class, 'profitsPage'])->name('admin.profits'); // View profits

            Route::get('/tickets', [AdminController::class, 'ticketsView'])->name('tickets.view');

            // تغيير حالة التذكرة (open, in_progress, closed)
            Route::post('/tickets/{ticket}/status', [AdminController::class, 'updateTicketStatus'])->name('tickets.status');

            // إعدادات المتجر والخطط
            Route::get('/settings', [AdminController::class, 'settingsView'])->name('settings.view');
            Route::post('/settings/commission', [AdminController::class, 'updateCommission'])->name('settings.update-commission');
            Route::post('/settings/plans', [AdminController::class, 'updatePlans'])->name('settings.update-plans');

            // إدارة طلبات السحب للآدمين
            Route::get('/payouts', [AdminController::class, 'payoutsView'])->name('payouts.view');
            Route::post('/payouts/{payout}/action', [AdminController::class, 'processPayoutAction'])->name('payouts.action');
        });
    });

    // ================= Seller Routes ================= //
    Route::middleware('role:seller')->group(function () {
        // Subscription related routes
        Route::get('/subscribe', [SubscriptionController::class, 'subscribeView'])->name('subscribe-view'); // Show subscription page
        Route::post('/subscribe/p', [SubscriptionController::class, 'submitPaymentProof'])->name('payment-proof'); // Submit payment proof
        Route::get('/subscribe/f/{id}', [SubscriptionController::class, 'subscribeFormView'])->name('subscribe-form-view'); // Subscription form

        // طلبات السحب للبائع
        Route::get('/payouts', [OwnerController::class, 'payoutsView'])->name('owner-payouts.view');
        Route::post('/payouts', [OwnerController::class, 'storePayoutRequest'])->name('owner-payouts.store');

        // Routes that require active subscription
        Route::middleware('subscription')->group(function () {
            // Product management
            Route::group([
                'prefix' => 'p',
                'as' => 'products.',
            ], function () {
                Route::post('add', [OwnerController::class, 'addProduct'])->name('add'); // Add new product
                Route::post('update', [OwnerController::class, 'updateProduct'])->name('update'); // Update product
                Route::get('add/view', [OwnerController::class, 'addProductView'])->name('add-view'); // Product form page
                Route::get('view', [OwnerController::class, 'viewProduct'])->name('view'); // View all products
            });

            // Delivery/Wilaya management
            Route::group([
                'prefix' => 'd',
                'as' => 'wilaya.',
            ], function () {
                Route::post('add', [OwnerController::class, 'addWilaya'])->name('add'); // Add delivery region (wilaya)
                Route::get('add/view', [OwnerController::class, 'addWilayaView'])->name('add-view'); // Form to add delivery region
                Route::get('get/cost', [OwnerController::class, 'getDeliveryCost'])->name('get-cost'); // Get delivery cost
                Route::put('/stores/{store}/delivery', [OwnerController::class, 'updateDelivery'])->name('stores.updateDelivery'); // Update delivery settings
            });

            // Orders management
            Route::group([
                'prefix' => 'o',
                'as' => 'order.',
            ], function () {
                Route::get('/orders', [OwnerController::class, 'viewOrders'])->name('view'); // View orders
                Route::put('/orders/{id}/status', [OwnerController::class, 'updateOrderStatus'])->name('updateStatus'); // Update order status
            });

            // Category management
            Route::group([
                'prefix' => 'c',
                'as' => 'category.',
            ], function () {
                Route::get('/', [OwnerController::class, 'categoryView'])->name('view'); // View categories
                Route::post('/', [OwnerController::class, 'addCategory'])->name('add'); // Add category
            });
        });
    });

    // ================= User Profile ================= //
    Route::get('/profile', [MainController::class, 'profile'])->name('profile'); // User profile
    Route::put('/profile/personal', [MainController::class, 'updatePersonal'])->name('profile.updatePersonal'); // Update personal info
    Route::put('/profile/password', [MainController::class, 'updatePassword'])->name('profile.updatePassword'); // Update password
    Route::put('/profile/store', [MainController::class, 'updateStore'])->name('profile.updateStore'); // Update store info

    // ================= Cart Routes ================= //
    Route::group([
        'prefix' => 'cart',
        'as' => 'cart-',
    ], function () {
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout'); // Checkout
        Route::get('/', [CartController::class, 'cartView'])->name('view'); // View cart
        Route::post('/add', [CartController::class, 'store'])->name('add'); // Add to cart
    });

    Route::group([
        'prefix' => 'contact',
        'as' => 'contact.',
    ], function () {
        Route::get('view', [MainController::class, 'viewContact'])->name('view');
        Route::post('/tickets', [TicketMessages::class, 'addTicket'])->name('tickets.store');
        Route::post('/tickets/{ticket}/reply', [TicketMessages::class, 'reply'])->name('tickets.reply');
    });

});



Route::get('api/product/edit/{id}', [OwnerController::class, 'editProduct']);
