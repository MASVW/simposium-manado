
<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlastEmailsController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\EventDashboardController;
use App\Http\Controllers\ExcelExport;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FormControll;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\Navigation;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PricesDashboardController;
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
Route::get('/home', [Navigation::class, 'home'])
    ->name('home');
    
Route::post('/feedback', [Navigation::class, 'feedbackForm'])
    ->name('navigation.feedBack');

//admin

Route::middleware(['isAdmin'])->group(function (){

    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/dashboard/view-event', [AdminController::class, 'eventView']);

    Route::get('/dashboard/manage-event', [AdminController::class, 'eventManage'])
        ->name('manage-event');

    Route::get('/dashboard/manage-event/addEvent', [EventDashboardController::class,'create']);
    Route::post('/dashboard/manage-event/addEvent', [EventDashboardController::class,'store']);

    Route::get('/dashboard/manage-event/tag={events:slug}', [EventDashboardController::class,'index']);
    Route::put('/dashboard/manage-event/tag={events:id}', [EventDashboardController::class,'update']);
    Route::delete('/dashboard/manage-event/tag={events:id}/delete', [EventDashboardController::class,'destroy']);

    Route::get('/dashboard/manage-event/slug', [EventDashboardController::class,'checkSlug']);

    Route::put('/dashboard/manage-event/tag={events:slug}/pricePut', [PricesDashboardController::class,'update']);
    Route::post('/dashboard/manage-event/tag={events:slug}/Addprice', [PricesDashboardController::class,'create']);
    // delete
    Route::post('/dashboard/manage-event/tag={events:slug}/priceDelete', [PricesDashboardController::class,'destroy']);

    Route::get('/dashboard/manage-payment', [AdminController::class, 'viewPayment']);

    Route::get('/dashboard/manage-about', [AboutController::class, 'index']);
    Route::put('/dashboard/manage-about', [AboutController::class, 'update']);

    //Feed Back
    Route::get('/dashboard/feedBack', [FeedbackController::class, 'index']);
    Route::get('/dashboard/feedBack/detail={item:id}', [FeedbackController::class, 'show']);

    //Emails
    Route::get('dashboard/blast-email', [BlastEmailsController::class, 'index'])->name('admin.blastEmail');
    Route::get('dashboard/blast-email/showFormat', [BlastEmailsController::class, 'show'])->name('admin.blastEmail.show');

    //Excel
    Route::get('dashboard/export-excel', [ExcelExport::class, 'exportUser'])
        ->name('excelExportAll');
    
    Route::post('dashboard/export-excel/participant', [ExcelExport::class, 'exportParticipant'])
        ->name('excelExportParticipant');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/history', [Navigation::class, 'history']);
    
    Route::get('/profile', [Navigation::class, 'profile']);

    Route::get('/profile/edit', [Navigation::class, 'editProfile']);
    Route::post('/profile/edit', [Navigation::class, 'editing'])
        ->name('editProfile');

    Route::get('/profile/edit/pass', [Navigation::class, 'editingPass']);
    Route::post('/profile/edit/pass', [Navigation::class, 'editPass']);

    Route::post('/logout', [LoginController::class,'logout']);

    
    Route::get('/checkout', [CheckOutController::class, 'index']);
    
    Route::get('/checkout={payments:id}', [PaymentController::class, 'index']);

    Route::post('/checkout/payment/{payments:id}', [PaymentController::class, 'update']);

    Route::post('/checkout/delete', [CheckOutController::class, 'delete'])
        ->name('delete_item');

    Route::post('/checkout/payment', [PaymentController::class, 'create'])
        ->name('payment');


    Route::get('/invoice/{payments:id}', [PaymentController::class, 'invoice'])
        ->name('invoice');

    Route::get('/{payments:id}/viewForm', [FormControll::class, 'index'])
        ->name('viewForm');

    Route::get('/{payments:id}/fillForm', [FormControll::class, 'index'])
        ->name('form');

    Route::post('/{payments:id}/fillForm', [FormControll::class, 'store']);

    Route::put('/{payments:id}/fillForm', [FormControll::class, 'update']);

    Route::post('/addtoBucket/tag={event:slug}', [BucketController::class, 'create']);

    Route::post('/bucket/delete', [BucketController::class, 'delete']);

});

Route::middleware(['guest'])->group(function (){
    Route::get('/about-us', [Navigation::class,'about']);

    Route::get('/logout', [Navigation::class, 'home']);

    Route::get('/auth/google', [LoginController::class,'redirectToGoogle'])
        ->name('google.login');

    Route::get('/auth/google/callback', [LoginController::class,'googleCallback'])
        ->name('google.callback');

    Route::get('/tag={event:slug}', [Navigation::class, 'withId']);

    Route::post('/tag={event:slug}/price', [Navigation::class, 'homePrice']);
});

  Route::resource('/dashboard/emails', 'EmailController');