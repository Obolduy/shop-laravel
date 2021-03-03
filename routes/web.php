<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUsersManageController;
use App\Http\Controllers\AdminShopsManageController;
use App\Http\Controllers\AdminLotsManageController;
use App\Http\Controllers\AdminReviewsManageController;

Route::get('/', [MainController::class, 'main']);

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');

Route::match(['get', 'post'], '/registration', [RegistrationController::class, 'registration'])->name('registration');

Route::match(['get', 'post'], '/registration/state', [RegistrationController::class, 'registrationstate'])->name('registration.state');

Route::match(['get', 'post'], '/registration/city', [RegistrationController::class, 'registrationcity'])->name('registration.city');

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::match(['get', 'post'], '/reset-password', [PasswordResetController::class, 'resetrequest'])->name('password.request');

Route::match(['get', 'post'], '/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');

Route::get('/email/verify', function () {
    return view('verifyemail');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/catalog/all', [CategoryController::class, 'showall']);

Route::get('/catalog/{category_id}', [CategoryController::class, 'showcategory']);

Route::get('/catalog/{category_id}/{subcategory_id}', [CategoryController::class, 'showsubcategory']);

Route::get('/catalog/{category_id}/{subcategory_id}/{lot_id}', [LotController::class, 'showlot']);

Route::middleware(['auth', 'emailcheck'])->group(function () {
    Route::post('/add_review/{lot_id}', [ReviewController::class, 'addreview']);

    Route::get('/cart', [CartController::class, 'showcart']);

    Route::get('/cart/add/{lot_id}', [CartController::class, 'addtocart']);

    Route::get('/cart/delete/{lot_id}', [CartController::class, 'deletefromcart']);

    Route::match(['get', 'post'], '/cart/buy/payment', [CartController::class, 'payform']);

    Route::get('/cart/buy/payment/success', [CartController::class, 'paymentsuccess']);

    Route::get('/profile', [UserController::class, 'showprofile']);

    Route::match(['get', 'post'], '/profile/change', [UserController::class, 'changeprofile']);

    Route::match(['get', 'post'], '/profile/delete', [UserController::class, 'deleteprofile']);

    Route::get('/profile/my_shop', [UserController::class, 'showusershop']);

    Route::get('/profile/my_reviews', [UserController::class, 'showuserreviews']);

    Route::match(['get', 'post'], '/create-shop', [ShopController::class, 'createshop']);

    Route::match(['get', 'post'], '/myshop/{shop}/change', [ShopController::class, 'changeshop']);

    Route::match(['get', 'post'], '/myshop/{shop}/manage_lots/{lot_id}', [LotController::class, 'editlot']);

    Route::match(['get', 'post'], '/myshop/{shop}/delete', [ShopController::class, 'deleteshop']);
});

Route::get('/shops/{shop_name}', [ShopController::class, 'showothershop']);

Route::match(['get', 'post'], '/admin/login', [AdminController::class, 'login'])->name('adminlogin');

Route::middleware(['admincheck', 'adminauth'])->group(function () {
    Route::get('/admin', function () {
        return view('adminmain');
    })->name('adminmain');

    Route::get('/admin/users', [AdminController::class, 'showusers']);

    Route::get('/admin/shops', [AdminController::class, 'showshops']);

    Route::get('/admin/lots', [AdminController::class, 'showlots']);

    Route::get('/admin/reviews', [AdminController::class, 'showreviews']);

    Route::match(['get', 'post'], '/admin/change/user/{id}', [AdminUsersManageController::class, 'changeuser']);

    Route::match(['get', 'post'], '/admin/change/shop/{id}', [AdminShopsManageController::class, 'changeshop']);

    Route::match(['get', 'post'], '/admin/change/lot/{id}', [AdminLotsManageController::class, 'changelot']);

    Route::match(['get', 'post'], '/admin/change/review/{id}', [AdminReviewsManageController::class, 'changereview']);

    Route::get('/admin/delete/user/{id}', [AdminUsersManageController::class, 'deleteuser']);

    Route::get('/admin/delete/shop/{id}', [AdminShopsManageController::class, 'deleteshop']);

    Route::get('/admin/delete/lot/{id}', [AdminLotsManageController::class, 'deletelot']);

    Route::get('/admin/delete/review/{id}', [AdminReviewsManageController::class, 'deletereview']);
});