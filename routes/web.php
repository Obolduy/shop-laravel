<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/test', [MainController::class, 'test']);

Route::get('/', [MainController::class, 'main']);

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');

Route::match(['get', 'post'], '/registration', [RegistrationController::class, 'registration'])->name('registration');

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/reset-password', [PasswordResetController::class, 'resetrequest']);

Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset']);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/catalog/all', [CategoryController::class, 'showall']);

Route::get('/catalog/{category_id}', [CategoryController::class, 'showcategory']);

Route::get('/catalog/{category_id}/{subcategory_id}', [CategoryController::class, 'showsubcategory']);

Route::get('/catalog/{category_id}/{subcategory_id}/{lot_id}', [LotController::class, 'showlot']);

Route::post('/catalog/{category_id}/{subcategory_id}/{lot_id}/add_review/{review_id}', [ReviewController::class, 'addreview']);

Route::get('/cart', [CartController::class, 'showcart']);

Route::get('/cart/add/{lot_id}', [CartController::class, 'addtocart']);

Route::get('/cart/delete/{lot_id}', [CartController::class, 'deletefromcart']);

Route::get('/cart/buy/payment', [CartController::class, 'payform']);

Route::get('/cart/buy/payment/success', [CartController::class, 'paymentsuccess']);

Route::get('/profile', [UserController::class, 'showprofile']);

Route::get('/profile/change', [UserController::class, 'changeprofile']);

Route::get('/profile/delete', [UserController::class, 'deleteprofile']);

Route::get('/profile/my_shop', [UserController::class, 'showusershop']);

Route::get('/profile/my_reviews', [UserController::class, 'showuserreviews']);

Route::get('/create-shop', [ShopController::class, 'createshop']);

Route::get('/{shop}', [ShopController::class, 'showshop']);

Route::get('/{shop}/change', [ShopController::class, 'changeshop']);

Route::get('/{shop}/manage_lots', [ShopController::class, 'manageshoplots']);

Route::get('/{shop}/manage_lots/{lot_id}', [LotController::class, 'editlot']);

Route::get('/{shop}/delete', [ShopController::class, 'deleteshop']);

Route::get('/shops/{shop_name}', [ShopController::class, 'showothershop']);

Route::get('/{shop}/catalog', [CategoryController::class, 'showshoplots']);

Route::get('/admin', function () {
    return view('adminmain');
})->name('adminmain');

Route::get('/admin/login', [AdminController::class, 'login']);

Route::get('/admin/users', [AdminController::class, 'showusers']);

Route::get('/admin/shops', [AdminController::class, 'showshops']);

Route::get('/admin/lots', [AdminController::class, 'showlots']);

Route::get('/admin/reviews', [AdminController::class, 'showreviews']);

Route::get('/admin/change/user/{id}', [AdminUsersManageController::class, 'changeuser']);

Route::get('/admin/change/shop/{id}', [AdminShopsManageController::class, 'changeshop']);

Route::get('/admin/change/lot/{id}', [AdminLotsManageController::class, 'changelot']);

Route::get('/admin/change/review/{id}', [AdminReviewsManageController::class, 'changereview']);

Route::get('/admin/delete/user/{id}', [AdminUsersManageController::class, 'deleteuser']);

Route::get('/admin/delete/shop/{id}', [AdminShopsManageController::class, 'deleteshop']);

Route::get('/admin/delete/lot/{id}', [AdminLotsManageController::class, 'deletelot']);

Route::get('/admin/delete/review/{id}', [AdminReviewsManageController::class, 'deletereview']);