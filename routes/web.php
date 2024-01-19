<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Master\AdvertiseCostController;
use App\Http\Controllers\Master\BannerSizeController;
use App\Http\Controllers\Master\BudgetProvisionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\DepartmentController;
use App\Http\Controllers\Master\FinancialYearController;
use App\Http\Controllers\Master\LanguageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master\NewsPaperController;
use App\Http\Controllers\Master\NewsPaperTypeController;
use App\Http\Controllers\Master\PrintTypeController;
use App\Http\Controllers\Master\PublicationTypeController;
use App\Http\Controllers\Master\SignatureController;
use App\Http\Controllers\Master\CostController;
use App\Http\Controllers\AdvertiseController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Master\AccountDetailController;
use App\Http\Controllers\ExpandetureController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'login'])->name('admin.login');

Route::group(['middleware' => ['auth', 'prevent-back-history']], function() {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // start of master route
    Route::resource('advertise-cost', AdvertiseCostController::class);
    Route::resource('banner-size', BannerSizeController::class);
    Route::resource('budget-provision', BudgetProvisionController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('financial-year', FinancialYearController::class);
    Route::resource('language', LanguageController::class);
    Route::resource('news-paper', NewsPaperController::class);
    Route::resource('news-paper-type', NewsPaperTypeController::class);
    Route::resource('print-type', PrintTypeController::class);
    Route::resource('publication-type', PublicationTypeController::class);
    Route::resource('signature', SignatureController::class);
    Route::resource('cost', CostController::class);
    Route::resource('account-details', AccountDetailController::class);
    // end of master route


    // route for advertise
    Route::get('advertise', [AdvertiseController::class, 'index'])->name('advertise.index');
    Route::get('advertise/create', [AdvertiseController::class, 'create'])->name('advertise.create');
    Route::post('advertise/store', [AdvertiseController::class, 'store'])->name('advertise.store');
    Route::get('advertise/mail/{id}', [SendMailController::class, 'index'])->name('send-mail.index');
    Route::post('advertise/send-mail', [SendMailController::class, 'sendEmail'])->name('send-mail.send');
    Route::post('advertise/mail/cancel', [SendMailController::class, 'cancelMail'])->name('mail.cancel');
    Route::get('advertise/pdf', [AdvertiseController::class, 'generatePdf'])->name('advertise.pdf');
    // Route::get('advertise/pdf/{id}', [AdvertiseController::class, 'pdf'])->name('advertise.gpdf');
    // end of route for advertise


    Route::resource('billing', BillingController::class);

    // ajax route
    Route::get('/get-news-paper-type', [AjaxController::class, 'getNewsPaperType'])->name('get-newspaper-type');

    Route::get('/get-not-jahir-news-paper-type', [AjaxController::class, 'getNotJahirNewsPaperType'])->name('get-not-jahir-newspaper-type');

    Route::get('/get-work-order-details', [AjaxController::class, 'getWorkOrderDetails'])->name('get-work-order-details');

    Route::get('/get-work-order-number', [AjaxController::class, 'getWorkOrderNumber'])->name('get-work-order-number');

    Route::get('/check-duplicate-bill-number', [AjaxController::class, 'checkDuplicateBillNumber'])->name('check-duplicate-bill-number');

    Route::get('/check-duplicate-work-order-number', [AjaxController::class, 'checkDuplicateWorkOrderNumber'])->name('check-duplicate-work-order-number');

    Route::get('/get-work-order-by-department', [AjaxController::class, 'getWorkOrderNumberByDepartment'])->name('get-work-order-by-department');

    Route::get('/get-news-papers-by-advertise', [AjaxController::class, 'getNewsPaperByAdvertise'])->name('get-news-papers-by-advertise');

    Route::get('/get-news-papers-account-number', [AjaxController::class, 'getNewsPaperAccountNumber'])->name('get-news-papers-account-number');

    Route::get('/get-news-papers-account-details', [AjaxController::class, 'getNewsPaperAccountDetails'])->name('get-news-papers-account-details');
    // end of ajax route

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');

    Route::resource('expandeture', ExpandetureController::class);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
