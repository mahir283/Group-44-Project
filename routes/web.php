<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\AdminOrderListController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\CustomerListController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PreviousOrdersController;  // Import the new controller
use App\Http\Controllers\CarReviewsController;
use App\Http\Controllers\WebReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\http\Controllers\SavedCarController;
use App\http\Controllers\AdminDashboardController;
use App\http\Controllers\OrderDetailsAdminController;
use App\http\Controllers\CustomerAmendmentController;



// Home route
Route::get('/', [CarController::class, 'displayRandom'])->name('home');

// About Us route
Route::get('/aboutUs', function () {
    return view('aboutUs');
});



// Contact Page route
Route::get('/contact', function () {
    return view('ContactPage');
});

// Customer List route
Route::get('/customerList', function () {
    return view('CustomerList');
});


// Products List Admin route
Route::get('/productsListAdmin',[ProductsController::class,'loadProducts'])->middleware('auth');
Route::post('/deleteCar',[ProductsController::class,'deleteCar'])->middleware('auth')->name('deleteCar');
Route::post('/adminEditCar', [ProductsController::class,'adminEditCar'])->middleware('auth')->name('adminEditCar');
Route::post('/submitEditCar', [ProductsController::class,'submitEditCar'])->middleware('auth')->name('submitEditCar');
Route::get('/addCar',[ProductsController::class,'addCar'])->middleware('auth')->name('addCar');
Route::post('/submitAddCar',[ProductsController::class,'submitAddCar'])->middleware('auth')->name('submitAddCar');
// Products Page route
Route::get('/products', [ProductsController::class, 'index']);

// Car Details Page
Route::get('/carDetails/{car_id}', [ProductsController::class, 'show']);

// User Registration
Route::get('/userRegister', [RegisterController::class, 'show']);
Route::post('/userRegister', [RegisterController::class, 'register'])->name('userRegister');


// User Login
Route::get('/userLogin', [LoginController::class, 'show'])->name('userLogin');
Route::post('/userLogin', [LoginController::class, 'login'])->name('userLogin');
Route::post('/userLogout', [LoginController::class, 'logout'])->name('userLogout');


// User Dashboard (Protected)
Route::get('/dashboard', function () {
    return view('UserDashboard');
})->middleware('auth')->name('user.dashboard');

// Previous Orders Page (Updated to use the controller)
Route::get('/previous-orders', [PreviousOrdersController::class, 'show'])->middleware('auth')->name('previous.orders');
Route::get('/order-details/{order_id}', [PreviousOrdersController::class, 'details'])->middleware('auth')->name('order.details');
Route::get('/returnOne/{item_id}', [PreviousOrdersController::class, 'returnOne'])->middleware('auth')->name('returnOne');
Route::get('/returnAll/{item_id}', [PreviousOrdersController::class, 'returnAll'])->middleware('auth')->name('returnAll');
// Show Basket Page
Route::get('/basketPage', function () {
    if (!Auth::check()) {
        return redirect()->route('userLogin')->with('message', 'Please log in to access the basket page.');
    }
    return app(BasketController::class)->showBasket();
})->name('basket.show');

// Add Item to Basket
Route::post('/basketPage', [BasketController::class, 'addToBasket'])
    ->name('basket.add')
    ->middleware('auth');

// Update Basket Item Quantity
Route::put('/basket/update/{basketId}', [BasketController::class, 'updateQuantity'])
    ->name('basket.updateQuantity')
    ->middleware('auth');

// Remove Item from Basket
Route::delete('/basket/remove/{basketId}', [BasketController::class, 'removeFromBasket'])
    ->name('basket.remove')
    ->middleware('auth');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');

// Contact Form
Route::get('form', [FormController::class, 'showForm']);
Route::post('form', [FormController::class, 'submitForm']);
Route::post('/contact-submit', [FormController::class, 'formValidation'])->name('contact.submit');

// Login & Register Views
Route::view('/loginUser', 'loginUser')->name('login');
Route::view('/registerUser', 'registerUser');


// Route to view car details
Route::get('/car/{id}', [CarController::class, 'show'])->name('car.details');

// Route to add car to the basket
Route::post('/add-to-basket/{id}', [BasketController::class, 'addToBasket'])->name('addToBasket');

// Route to add car to basket (Reorder functionality)
Route::post('/add-to-basket', [BasketController::class, 'addToBasket'])->name('addToBasket');

// Car Reviews
Route::post('/car/{car_id}/review', [CarReviewsController::class, 'store'])
    ->middleware('auth')
    ->name('car.review.store');

Route::post('/saveCar', [SavedCarController::class, 'toggleSave'])->middleware('auth');
Route::get('/savedCars', [SavedCarController::class, 'getSavedCars'])->name('saved.cars');


Route::get('/nextPage', [PreviousOrdersController::class, 'nextPage'])->name('nextPage');
//Replace the controller here with the relevant controller for the order details page

//Route to access the admin dashboard
Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/settings', [AccountSettingsController::class, 'show'])->name('account.settings');
    Route::put('/settings/update-details', [AccountSettingsController::class, 'updateDetails'])->name('account.update.details');
    Route::put('/settings/update-password', [AccountSettingsController::class, 'updatePassword'])->name('account.update.password');

    Route::post('/saveCar', [SavedCarController::class, 'toggleSave'])->middleware('auth');
    Route::get('/savedCars', [SavedCarController::class, 'getSavedCars'])->name('saved.cars');

    Route::get('/nextPage', [PreviousOrdersController::class, 'nextPage'])->name('nextPage');
//Replace the controller here with the relevant controller for the order details page

    Route::get('/comparePage', [CompareController::class, 'index'])->name('comparePage');
    Route::post('/submit-review', [WebReviewController::class, 'store'])->name('review.submit');
});


// Edit Profile Button
Route::get('/edit-profile', [AccountSettingsController::class, 'show'])->name('edit.profile');


// Order Details View
Route::get('/admin/orders/view/{orderId}', [OrderDetailsAdminController::class, 'index'])->name('admin.order.details');
Route::put('/admin/orders/update/{orderId}', [OrderDetailsAdminController::class, 'updateOrderStatus'])->name('updateOrderStatus');
Route::delete('/admin/orders/remove/{orderId}', [OrderDetailsAdminController::class, 'removeOrder'])->name('removeOrder');


// Admin Order Details
Route::get('/admin/orders', [AdminOrderListController::class, 'index'])->name('admin.orders');
Route::post('/admin/orders/update-status', [AdminOrderListController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::delete('/admin/orders/delete', [AdminOrderListController::class, 'deleteOrder'])->name('admin.orders.delete');

Route::get('customerList', [CustomerListController::class, 'index'])->name('customerList');
Route::delete('/customerList/delete/{id}', [CustomerListController::class, 'deleteUser'])->name('user.delete');

// Customer Amendment
Route::get('/customer/amendments/{id}', [CustomerAmendmentController::class, 'show'])->name('customer.amendments.show');
Route::put('/customer/amendments/{id}', [CustomerAmendmentController::class, 'update'])->name('customer.amendments.update');
