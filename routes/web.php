<?php

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\MandatoryReset;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
setlocale(LC_TIME, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');


// Route::group(['middleware' => ['XSS']], function () {
    Auth::routes();
    Route::post('/password/mandatory', [MandatoryReset::class, 'password'])->name("mandatory.reset")->middleware(['auth']);
// });

/* MAIN */
Route::group(['middleware' => ['auth', 'validity.password', 'app.menu.items']], function () {

    Route::get('/', 'AppController@index');

    Route::get('/home', 'AppController@index')->name('home');

    Route::prefix('app')->name('app.')->group(function () {
        Route::get('/settings', 'AppController@settings')->name('settings');
    });

    Route::prefix('profile')->name('profile.')->namespace('Profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'password'])->name('password');
    });
});

Route::group(['middleware' => ['auth', 'validity.password', 'app.menu.items', 'app.profile.associate']], function () {    

    Route::prefix('toManager')->name('toManager.')->group(function () {
        Route::get('/', 'ToManager\AppCustomerSysController@dashboard');

        Route::get('/dashboard', 'ToManager\AppCustomerSysController@dashboard')->name('dashboard');
        Route::post('/dashboard', 'ToManager\AppCustomerSysController@dashboardFilter')->name('dashboard');

        /* PEDIDOS */
        Route::get('/order', 'ToManager\Order\OrderController@index')->name('order.index');
        Route::post('/order', 'ToManager\Order\OrderController@search')->name('order.index');

        Route::get('/order/{order}', 'ToManager\Order\OrderController@show')->name('order.show');

        /* PEDIDOS ITENS */
        Route::get('/orderItem', 'ToManager\Order\OrderItemController@index')->name('orderItem.index');
        Route::post('/orderItem', 'ToManager\Order\OrderItemController@search')->name('orderItem.index');

        Route::get('/orderItem/{itemNum}', 'ToManager\Order\OrderItemController@show')->name('orderItem.show');

        /* PARA ADMINISTRACAO DO SISTEMA */
        Route::resource('/SystemAdmin', 'ToManager\SystemAdminController');

        Route::resource('/UserCustomerSys', 'ToManager\UserCustomerSysController');

        Route::put('/UserCustomerSys/{UserCustomerSys}/pwd', 'ToManager\UserCustomerSysController@updatePwd')->name('UserCustomerSys.updatePwd');

        /* PARA SERVIÇOS */
        Route::resource('/service', 'ToManager\ServiceController');

        Route::resource('/serviceType', 'ToManager\ServiceTypeController');

        Route::resource('/serviceVariation', 'ToManager\ServiceVariationController');

        Route::resource('/servicePreResponse', 'ToManager\ServicePreResponsesController');

        Route::resource('/serviceCategory', 'ToManager\ServiceCategoryController');

        /* PARA CLIENTES */
        Route::resource('/customer', 'ToManager\CustomerController');

        Route::post('/customerImage/remove/{customerSlug}', 'ToManager\CustomerImageController@remove')->name('customerimage.remove');

        Route::resource('/customerUser', 'ToManager\UserCustomerController');

        Route::put('/customerUser/{customerUser}/pwd', 'ToManager\UserCustomerController@updatePwd')->name('customerUser.updatePwd');

        Route::resource('/customerContract', 'ToManager\ContractCustomerController');

        Route::resource('/customerContractCusService', 'ToManager\ContractCusServiceController');

        Route::get('/customerContractCusCycle/{contractNum}/generate', 'ToManager\ContractCusCycleController@generate')->name('customerContractCusCycle.generate');

        Route::get('/customerContractCusCycle/{contractNum}/reconciliation', 'ToManager\ContractCusCycleController@reconciliation')->name('customerContractCusCycle.reconciliation');

        Route::resource('/customerContractCusCycle', 'ToManager\ContractCusCycleController');

        /* PARA FORNECEDORES */
        Route::resource('/provider', 'ToManager\ProviderController');

        Route::post('/providerImage/remove/{providerSlug}', 'ToManager\ProviderImageController@remove')->name('providerImage.remove');

        Route::put('/provider/{provider}/pwd', 'ToManager\UserProviderController@updatePwd')->name('provider.updatePwd');

        Route::resource('/providerContract', 'ToManager\ContractProviderController');

        Route::resource('/providerContractPvdService', 'ToManager\ContractPvdServiceController');

        Route::resource('/providerType', 'ToManager\ProviderTypeController');

        Route::resource('/providerSpecialty', 'ToManager\ProviderSpecialtyController');

        /* PARA FINANCEIRO */
        Route::get('/financial', 'ToManager\FinancialController@index')->name('financial');

        Route::post('/financial', 'ToManager\FinancialController@show')->name('financial');

        Route::get('/access', 'ToManager\AccessController@index')->name('log');

        Route::post('/access', 'ToManager\AccessController@show')->name('log');
    });

    Route::prefix('toCustomer')->name('toCustomer.')->group(function () {
        Route::get('/', 'ToCustomer\AppCustomerController@dashboard');

        /* PARA ADMINISTRACAO DO SISTEMA */
        Route::resource('/MySystem', 'ToCustomer\MySystemController');

        Route::get('/dashboard', 'ToCustomer\AppCustomerController@dashboard')->name('dashboard');
        Route::post('/dashboard', 'ToCustomer\AppCustomerController@dashboardFilter')->name('dashboard');

        Route::get('/orderItem/file/show/{orderNum}/{orderItem}/{fileId}', 'ToCustomer\AppCustomerController@showFile')->name('app.showFile');

        /* PEDIDOS */
        Route::resource('/order', 'ToCustomer\Order\OrderController');
        Route::post('/order/search', 'ToCustomer\Order\OrderController@search')->name('order.search');

        Route::post('/order/{orderNum}/confirm', 'ToCustomer\Order\OrderController@confirm')->name('order.confirm');

        /* PEDIDOS ITENS */
        Route::get('/orderItem', 'ToCustomer\Order\OrderItemController@index')->name('orderItem.index');
        Route::post('/orderItem', 'ToCustomer\Order\OrderItemController@search')->name('orderItem.index');

        Route::post('/orderItem/{orderNum}/create', 'ToCustomer\Order\OrderItemController@create')->name('orderItem.create');

        Route::get('/orderItem/{orderNum}/{orderItem}', 'ToCustomer\Order\OrderItemController@show')->name('orderItem.show');

        Route::post('/orderItem/{orderNum}/store', 'ToCustomer\Order\OrderItemController@store')->name('orderItem.store');

        Route::post('/orderItem/{orderNum}/{orderItem}/finalizeRegistration', 'ToCustomer\Order\OrderItemController@finalizeRegistration')->name('orderItem.finalizeRegistration');

        Route::post('/orderItem/{orderNum}/{orderItem}/finalizeCompleteReturn', 'ToCustomer\Order\OrderItemController@finalizeCompleteReturn')->name('orderItem.finalizeCompleteReturn');

        Route::put('/orderItem/{orderNum}/destroy', 'ToCustomer\Order\OrderItemController@destroy')->name('orderItem.destroy');

        /* PEDIDOS ITENS ARQUIVOS */
        Route::resource('/orderItemFile', 'ToCustomer\Order\OrderItemsFileController');

        /* PACIENTES */
        Route::resource('/patient', 'ToCustomer\Patient\PatientController');

        Route::post('/patient/cpf', 'ToCustomer\Patient\PatientController@search')->name('patient.showByCPF');

        Route::get('/patient/{docType}/{docNum}', 'ToCustomer\Patient\PatientController@showByDoc')->name('patient.showByDoc');

        /* FINANCEIRO */
        Route::get('/financial', 'ToCustomer\FinancialController@index')->name('financial');

        Route::post('/financial', 'ToCustomer\FinancialController@show')->name('financial');
    });

    Route::prefix('toProvider')->name('toProvider.')->group(function () {
        Route::get('/', 'ToProvider\AppProviderController@dashboard');

        /* PARA ADMINISTRACAO DO SISTEMA */
        Route::resource('/MySystem', 'ToProvider\MySystemController');

        Route::get('/dashboard', 'ToProvider\AppProviderController@dashboard')->name('dashboard');

        Route::get('/orderItem/file/show/{orderNum}/{orderItem}/{fileId}', 'ToProvider\AppProviderController@showFile')->name('app.showFile');

        Route::get('/orderItem/fileMedico/show/{orderNum}/{orderItem}/{fileId}', 'ToProvider\AppProviderController@showFileMedico')->name('app.showFileMedico');

        Route::get('/orderItem/report/show/{orderNum}/{orderItem}', 'ToProvider\AppProviderController@showFileReport')->name('app.showFileReport');

        /* PEDIDOS ITENS */
        Route::get('/myItems', 'ToProvider\Order\OrderItemController@index')->name('orderItem.index');

        Route::get('/myItems/{orderItemNum}-{reportId}/report', 'ToProvider\Order\OrderItemController@show')->name('orderItem.show');

        Route::get('/orderItem/answer/{serviceSlug?}', 'ToProvider\Order\OrderItemController@answer')->name('orderItem.answer');

        Route::post('/orderItem/answer/{orderItemNum}/reopen', 'ToProvider\Order\OrderItemController@reopen')->name('orderItem.report.reopen');

        Route::get('/orderItem/answer/{orderItemNum}/report', 'ToProvider\Order\ReportController@process')->name('orderItem.report.process');

        Route::post('/orderItem/answer/{orderItemNum}/report/conclusion', 'ToProvider\Order\ReportController@conclusion')->name('orderItem.report.conclusion');

        Route::post('/orderItem/answer/{orderItemNum}/report/conclusion/file-upload', 'ToProvider\Order\ReportController@fileUpload')->name('orderItem.report.conclusion.fileUpload');

        Route::post('/orderItem/answer/{orderItemNum}/report/conclusion/file-remove/{fileId}', 'ToProvider\Order\ReportController@fileRemove')->name('orderItem.report.conclusion.fileRemove');

        //Route::get('/orderItem/answer/{orderItemNum}/report/sign', 'ToProvider\Order\ReportController@sign')->name('orderItem.report.sign');
        Route::match(['get', 'post'], '/orderItem/answer/{orderItemNum}/report/sign', 'ToProvider\Order\ReportController@sign')->name('orderItem.report.sign');

        Route::get('/orderItem/answer/{orderItemNum}/report/cancel', 'ToProvider\Order\ReportController@cancel')->name('orderItem.report.cancel');

        Route::post('/orderItem/answer/{orderItemNum}/report/return', 'ToProvider\Order\ReportController@return')->name('orderItem.report.return');

        Route::get('/orderItem/answer/{orderItemNum}/report/review', 'ToProvider\Order\ReportController@process')->name('orderItem.report.review');

        /* PARA FINANCEIRO */
        Route::get('/financial', 'ToProvider\FinancialController@index')->name('financial');

        Route::post('/financial', 'ToProvider\FinancialController@show')->name('financial');
    });
});

//Route::get('/customer/teste', 'Customer\CustomerController@list');

