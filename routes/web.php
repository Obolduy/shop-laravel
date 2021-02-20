<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'main']);

Route::get('/login', [LoginController::class, 'login']);

Route::get('/registration', [RegistrationController::class, 'registration']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/reset-password', [PasswordResetController::class, 'resetrequest']);

Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset']);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    
    $request->fulfill();

    return redirect('/');

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/catalog/all', [CategoryController::class, 'showall']);

Route::get('/catalog/{id}', [CategoryController::class, 'showcategory']);

Route::get('/catalog/{category-id}/{subcategory-id}', [CategoryController::class, 'showsubcategory']);

Route::get('/catalog/{category-id}/{subcategory-id}/{lot-id}', [LotController::class, 'showlot']);

Route::get('/cart', [CartController::class, 'showcart']);

Route::get('/cart/add', [CartController::class, 'addtocart']);

Route::get('/cart/delete', [CartController::class, 'deletefromcart']);

Route::get('/cart/buy', [CartController::class, 'buy']);

Route::get('/cart/buy/payment', [CartController::class, 'payform']);

Route::get('/cart/buy/payment/success', [CartController::class, 'showcart']);

Route::get('/profile', [UserController::class, 'showprofile']);

Route::get('/profile/change', [UserController::class, 'changeprofile']);

Route::get('/profile/delete', [UserController::class, 'deleteprofile']);

Route::get('/profile/my-shops', [UserController::class, 'showusershops']);

Route::get('/profile/my-lots', [UserController::class, 'showuserlots']);

Route::get('/create-shop', [ShopController::class, 'createshop']);

Route::get('/{shop}', [ShopController::class, 'showshop']);

Route::get('/{shop}/change', [ShopController::class, 'changeshop']);

Route::get('/{shop}/manage-lots', [ShopController::class, 'manageshoplots']);

Route::get('/{shop}/delete', [ShopController::class, 'deleteshop']);

Route::get('/shops/{shop-name}', [ShopController::class, 'showothershop']);

Route::get('/{shop}/catalog', [CategoryController::class, 'showshoplots']);

Route::get('/{shop}', [ShopController::class, 'showshop']);