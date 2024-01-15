
<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\EventDashboardController;
use App\Http\Controllers\ExcelExport;
use App\Http\Controllers\FormControll;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\Navigation;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PricesDashboardController;
use App\Http\Controllers\SignUpController;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Navigation::class, 'home']);
Route::get('/home', [Navigation::class, 'home'])->name('home');
Route::post('/tag={event:slug}/price', [Navigation::class, 'homePrice']);
Route::get('/tag={event:slug}', [Navigation::class, 'withId']);

Route::get('/profile', [Navigation::class, 'profile']);
Route::get('/history', [Navigation::class, 'history']);

Route::get('/profile/edit', [Navigation::class, 'editProfile'])->middleware('auth');
Route::post('/profile/edit', [Navigation::class, 'editing'])->middleware('auth');

// Route::get('/forgot-password', [ChangePass::class, 'index'])->middleware('guest')->name('password.request');

// Route::post('/forgot-password', [ChangePass::class, 'forgetPassword'])
//     ->middleware('guest')
//     ->name('password.email');
// Route::post('/forgot-password', [ChangePass::class, 'forgetPassword'])
//     ->middleware('guest')
//     ->name('password.email');
// Route::get('/reset-password/{token}', [ChangePass::class, 'showResetForm'])
//     ->name('password.reset');
// Route::put('/reset-password', [ChangePass::class, 'reset'])
//     ->name('password.update');

Route::get('/profile/edit/pass', [Navigation::class, 'editingPass'])->middleware('auth');
Route::post('/profile/edit/pass', [Navigation::class, 'editPass'])->middleware('auth');

Route::get('/about-us', [Navigation::class,'about']);

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('isAdmin');


Route::get('/checkout', [CheckOutController::class, 'index'])->middleware('auth');
Route::get('/checkout={payments:id}', [PaymentController::class, 'index'])->middleware('auth');

Route::post('/checkout/delete', [CheckOutController::class, 'delete'])->name('delete_item')->middleware('auth');

Route::post('/checkout/payment', [PaymentController::class, 'create'])->name('payment')->middleware('auth');
Route::post('/checkout/payment/{payments:id}', [PaymentController::class, 'update'])->middleware('auth');

Route::get('/invoice/{payments:id}', [PaymentController::class, 'invoice'])->name('invoice')->middleware('auth');

Route::get('/{payments:id}/viewForm', [FormControll::class, 'index'])->name('viewForm')->middleware('auth');

Route::get('/{payments:id}/fillForm', [FormControll::class, 'index'])->name('form')->middleware('auth');
Route::post('/{payments:id}/fillForm', [FormControll::class, 'store'])->middleware('auth');

Route::post('/addtoBucket/tag={event:slug}', [BucketController::class, 'create'])->middleware('auth');
Route::post('/bucket/delete', [BucketController::class, 'delete'])->middleware('auth');

Route::get('/dashboard/view-event', [AdminController::class, 'eventView'])->middleware('isAdmin');

Route::get('/dashboard/manage-event', [AdminController::class, 'eventManage'])->name('manage-event')->middleware('isAdmin');

Route::get('/dashboard/manage-event/addEvent', [EventDashboardController::class,'create'])->middleware('isAdmin');
Route::post('/dashboard/manage-event/addEvent', [EventDashboardController::class,'store'])->middleware('isAdmin');

Route::get('/dashboard/manage-event/tag={events:slug}', [EventDashboardController::class,'index'])->middleware('isAdmin');
Route::put('/dashboard/manage-event/tag={events:id}', [EventDashboardController::class,'update'])->middleware('isAdmin');
Route::delete('/dashboard/manage-event/tag={events:id}/delete', [EventDashboardController::class,'destroy'])->middleware('isAdmin');

Route::get('/dashboard/manage-event/slug', [EventDashboardController::class,'checkSlug'])->middleware('isAdmin');

Route::put('/dashboard/manage-event/tag={events:slug}/pricePut', [PricesDashboardController::class,'update'])->middleware('isAdmin');
Route::post('/dashboard/manage-event/tag={events:slug}/Addprice', [PricesDashboardController::class,'create'])->middleware();
// delete
Route::post('/dashboard/manage-event/tag={events:slug}/priceDelete', [PricesDashboardController::class,'destroy']);

Route::get('/dashboard/manage-payment', [AdminController::class, 'viewPayment'])->middleware('isAdmin');

Route::get('/dashboard/manage-about', [AboutController::class, 'index'])->middleware('isAdmin');
Route::put('/dashboard/manage-about', [AboutController::class, 'update'])->middleware('isAdmin');

Route::get('/login', [LoginController::class,'index'])->name('loginForm')->middleware('guest');
Route::post('/login', [LoginController::class,'authenticate'])->middleware('guest');



Route::get('/auth/google', [LoginController::class,'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class,'googleCallback'])->name('google.callback');




// Route::get('/signup', [SignUpController::class,'index'])->middleware('guest')->name('register');
Route::post('/signup', [SignUpController::class,'store'] );

Route::get('/logout', [Navigation::class, 'home']);
Route::post('/logout', [LoginController::class,'logout'])->middleware('auth');

//Exporting Excel

Route::get('dashboard/export-excel', [ExcelExport::class, 'exportUser'])
    ->name('excelExportAll')
    ->middleware('isAdmin');
    
Route::post('dashboard/export-excel/participant', [ExcelExport::class, 'exportParticipant'])
    ->name('excelExportParticipant')
    ->middleware('isAdmin');