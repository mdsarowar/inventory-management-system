<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\Product\BrandController;
use App\Http\Controllers\Admin\Product\CategoryController;
use App\Http\Controllers\Admin\Product\SubCategoryController;
use App\Http\Controllers\Admin\Product\ChildCategoryController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ColorController;
use App\Http\Controllers\Admin\Product\SizeController;
use App\Http\Controllers\Admin\Product\UnitController;
use App\Http\Controllers\Admin\Product\ManufactureController;
use App\Http\Controllers\Admin\People\CustomerController;
use App\Http\Controllers\Admin\People\SupplierController;
use App\Http\Controllers\Admin\Employee\DepartmentController;
use App\Http\Controllers\Admin\Employee\DesignationController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Account\ClassController;
use App\Http\Controllers\Admin\Account\GroupController;
use App\Http\Controllers\Admin\Account\SubGroupController;
use App\Http\Controllers\Admin\Account\LedgerController;
use App\Http\Controllers\Admin\Account\PaymentController;
use App\Http\Controllers\Admin\Account\ReceiveController;
use App\Http\Controllers\Admin\Account\JournalController;
use App\Http\Controllers\Admin\Account\BankTransactionController;
use App\Http\Controllers\Admin\Account\ExpenseDetailsController;
use App\Http\Controllers\Admin\Account\TransactionDetailsController;
use App\Http\Controllers\Admin\Bank\BankController;
use App\Http\Controllers\Admin\Bank\BankAccountController;
use App\Http\Controllers\Admin\Bank\BankMobileController;
use App\Http\Controllers\Admin\Bank\BankTransactionsController;
use App\Http\Controllers\Admin\Bank\BankTransferController;
use App\Http\Controllers\Admin\Bank\BankChequeController;
use App\Http\Controllers\Admin\Purchas\PurchasController;
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

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/change_lang/{val}',function ($val){
//    app()->setLocale($val);
    session()->put('local',$val);
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::group(['middleware' => ['admin_access']], function() {
//Route::group(['middleware' => ['role:super-admin|admin|user']], function() {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);


    Route::resource('admins', App\Http\Controllers\UserController::class);
    Route::get('users/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user_delete');

    //company
    Route::resource('company',CompanyController::class);
//    Route::get('company/delete/{id}', [CompanyController::class, 'destroy'])->name('company_delete');

    //Branch
    Route::resource('branch',BranchController::class);
//    Route::get('branch/delete/{id}', [BranchController::class, 'destroy'])->name('branch_delete');

    //Branch
    Route::resource('store',StoreController::class);

    //Brand
    Route::resource('brand',BrandController::class);

    //category
    Route::resource('category',CategoryController::class);

    //sub category
    Route::resource('sub_category',SubCategoryController::class);

    //sub category
    Route::resource('child_category',ChildCategoryController::class);
//================================================ Product module start=================================================
    // product
    Route::resource('product', ProductController::class);

    Route::get('get_sub_cat/{id}',[ProductController::class,'get_sub_cat'])->name('get_sub_cat');
    Route::get('get_child_cat/{id}',[ProductController::class,'get_child_cat'])->name('get_child_cat');
    Route::get('get_product/{id}',[ProductController::class,'get_product'])->name('get_product');

    Route::get('select_product',[ProductController::class,'select_product'])->name('select_product');
    Route::delete('delete_select_product/{id}',[ProductController::class,'delete_select_product'])->name('delete_select_product');
    Route::get('pro_qty_change/{id}',[ProductController::class,'pro_qty_change'])->name('pro_qty_change');

    // color
    Route::resource('color', ColorController::class);

    // size
    Route::resource('size', SizeController::class);

    // unit
    Route::resource('unit', UnitController::class);

    // manufacture
    Route::resource('manufacture', ManufactureController::class);

//================================================ Product module end===================================================

//================================================ People module start=================================================
    //Customer
    Route::resource('customers',CustomerController::class);
    //Supplier
    Route::resource('suppliers',SupplierController::class);
//================================================ People module end===================================================

//================================================ Employee module start=================================================
    //department
    Route::resource('department',DepartmentController::class);
    //designation
    Route::resource('designation',DesignationController::class);
    //employee
    Route::resource('employee',EmployeeController::class);
//================================================ Employee module end===================================================

//================================================ Account module start=================================================
    // class
    Route::resource('class', ClassController::class);

    // group
    Route::resource('group', GroupController::class);

    // sub-group
    Route::resource('sub_group', SubGroupController::class);

    // ledger
    Route::resource('ledger', LedgerController::class);

    // payment voucher
    Route::resource('account_payment', PaymentController::class);

    // receive voucher
    Route::resource('account_receive', ReceiveController::class);

    // journal
    Route::resource('journal', JournalController::class);

    // bank transaction
    Route::resource('transaction', BankTransactionController::class);

    // expense details
    Route::resource('expense_details', ExpenseDetailsController::class);

    // transaction details
    Route::resource('transaction_details', TransactionDetailsController::class);

    //================================================ Account module end===================================================

    //================================================ Bank module start=================================================
    // banks
    Route::resource('banks', BankController::class);

    // bank accounts
    Route::resource('bank_account', BankAccountController::class);

    // bank mobile
    Route::resource('bank_mobile', BankMobileController::class);

    // bank transaction
    Route::resource('bank_transaction', BankTransactionsController::class);

    // bank transfer
    Route::resource('bank_transfer', BankTransferController::class);

    // bank cheque
    Route::resource('bank_cheque', BankChequeController::class);

//================================================ Bank module end===================================================

    //================================================ Purchas module start=================================================
    Route::resource('purchases',PurchasController::class);
    Route::get('/purchas_return/{id}',[PurchasController::class,'purchas_return'])->name('purchas_return');

    Route::get('/purchasOrderCreate',[PurchasController::class,'purchasOrderCreate'])->name('purchasOrderCreate');
    Route::post('/product/pur_filter_products',[PurchasController::class,'filter_products'])->name('pur_filter_products');
    Route::post('/product/get_product_data',[PurchasController::class,'get_product_data'])->name('get_product_data');
    Route::post('/product/delete_product_data',[PurchasController::class,'delete_product_data'])->name('delete_product_data');
    Route::post('/product/update_quantity',[PurchasController::class,'update_quantity'])->name('update_quantity');
    Route::post('/product/update_product_price',[PurchasController::class,'update_product_price'])->name('pur_update_product_price');
    Route::post('/product/update_pdata',[PurchasController::class,'update_pdata'])->name('pur_update_pdata');
    Route::post('/product/fetch_pdata',[PurchasController::class,'fetch_product_data'])->name('pur_fetch_product_data');
    Route::post('/product/walkin_search_api',[PurchasController::class, 'walkin_search_api'])->name('walkin_search_api');
    Route::post('/product/store-walkin-id', [PurchasController::class, 'store_walkin_into_session'])->name('store_walkin_into_session');
    Route::post('/product/calculate_summary',[PurchasController::class,'calculate_summary'])->name('pur_calculate_summary');
    Route::post('/product/update_summary',[PurchasController::class,'update_summary'])->name('pur_update_summary');

    Route::post('/product/update_serial_method',[PurchasController::class,'update_serial_method'])->name('pur_update_serial_method');

    Route::post('/product/clear_all',[PurchasController::class,'product_clear_all'])->name('product_clear_all');
    Route::post('/product/destroy_all_ssn',[PurchasController::class,'destroy_all_ssn'])->name('pur_destroy_all_ssn');

    Route::delete('delete_select_product/{id}',[PurchasController::class,'delete_select_product'])->name('delete_select_product');
    Route::get('pro_qty_change/{id}',[PurchasController::class,'pro_qty_change'])->name('pro_qty_change');

    Route::get('/get_vendor/{str}',[PurchasController::class,'get_vendor'])->name('get_vendor');
    Route::get('/bank_type/{str}',[PurchasController::class,'bank_type'])->name('bank_type');
    Route::post('get_bank_details',[PurchasController::class,'get_bank_details'])->name('get_bank_details');
    Route::post('submit_bank_amount',[PurchasController::class,'submit_bank_amount'])->name('submit_bank_amount');

    Route::post('/product/update_serial_method',[PurchasController::class,'update_serial_method'])->name('pur_update_serial_method');
    Route::post('/product/store_product_serials', [PurchasController::class, 'store_serials'])->name('pur_store_product_serials');


//================================================ Purchas module end===================================================



});

require __DIR__.'/auth.php';
