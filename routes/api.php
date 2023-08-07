<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Api\TransactionDefinition\TransactionDefinitionController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Bank\BankController;
use App\Http\Controllers\Biller\BillerController;
use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Calendar\DaysController;
use App\Http\Controllers\CID\DownCentralController;
use App\Http\Controllers\Correction\CorrectionController;
use App\Http\Controllers\ExcludePartner\ExcludePartnerController;
use App\Http\Controllers\Feature\FeatureController;
use App\Http\Controllers\Feature\RoleFeatureController;
use App\Http\Controllers\FormulaTransfer\FormulaTransferController;
use App\Http\Controllers\GroupBiller\GroupBillerController;
use App\Http\Controllers\GroupTransferFunds\GtfController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Modul\ModulController;
use App\Http\Controllers\Module\ModuleController;
use App\Http\Controllers\Partner\PartnerController;
use App\Http\Controllers\Product\ProductV2Controller;
use App\Http\Controllers\ProfileFee\ProfileFeeController;
use App\Http\Controllers\ReconDana\ReconDanaController;
use App\Http\Controllers\ReconData\ReconDataController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Role\UserRoleController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//  *** AUTHENTICATION AREA ***
Route::controller(AuthenticationController::class)->group(function () {
    Route::post('/auth/login', 'login');

    Route::post('/auth/logout', 'logout')
    ->middleware('auth:sanctum');

    Route::get('/auth/check-user-login', 'index')
    ->middleware('auth:sanctum', 'checkUserRole:auth-profile');

    Route::post('/auth/view-profile', 'show')
    ->middleware('auth:sanctum');

    Route::put('/auth/update-profile/{id}', 'update')
    ->middleware('auth:sanctum');

    Route::post('/auth/change-password/{token}', 'forgetPassword');

    Route::post('/auth/reset-password', 'resetPassword')
    ->middleware('auth:sanctum');

    Route::post('/auth/forget-password/send-email', 'forgetMail');
});

// *** USER AREA ***
Route::controller(UserController::class)->group(function () {
    // API User List
    Route::get('/user/list-user/{config}', 'list')
    ->middleware('auth:sanctum', 'checkUserRole:user-list-config');

    // Api Add User
    Route::post('/user/add', 'add');

    // Api Get User
    Route::post('/user/get-data/', 'show')
    ->middleware('auth:sanctum', 'checkUserRole:user-get-data');

    // Api Update User
    Route::put('/user/update/{id}', 'update')
    ->middleware('auth:sanctum', 'checkUserRole:user-update-id');

    // Api Delete User
    Route::delete('/user/delete/{id}', 'delete')
    ->middleware('auth:sanctum', 'checkUserRole:user-delete-id');

    // Api Filter User
    Route::get('/user/filter', 'filter')
    ->middleware('auth:sanctum', 'checkUserRole:user-filter');
});

// *** ROLE AREA ***
Route::controller(RoleController::class)->middleware('auth:sanctum')->group(function () {
    // API Role List
    Route::get('/role/list/{config}', 'list')
    ->middleware('auth:sanctum', 'checkUserRole:role-list-config');

    // API Role Add
    Route::post('/role/add', 'add')
    ->middleware('auth:sanctum', 'checkUserRole:role-add');

    // Api Get Role
    Route::post('/role/get-data/', 'show')
    ->middleware('auth:sanctum', 'checkUserRole:role-get-data');

    // Api Update Role
    Route::put('/role/update/{id}', 'update')
    ->middleware('auth:sanctum', 'checkUserRole:role-update-id');

    // Api Delete Role
    Route::delete('/role/delete/{id}', 'delete')
    ->middleware('auth:sanctum', 'checkUserRole:role-delete-id');

    // Api Filter Role
    Route::get('/role/filter', 'filter')
    ->middleware('auth:sanctum', 'checkUserRole:role-filter');
});

// *** USER ROLE AREA ***
Route::controller(UserRoleController::class)->middleware('auth:sanctum')->group(function () {
    // API Role User List
    Route::get('/role/list-user/', 'list')
    ->middleware('auth:sanctum', 'checkUserRole:user-role-list-config');

    // API Role User Add
    Route::post('/role/add-user', 'add')
    ->middleware('auth:sanctum', 'checkUserRole:user-role-add');

    // Api Delete User Role
    Route::delete('/role/delete-user/{id}', 'delete')
    ->middleware('auth:sanctum', 'checkUserRole:user-role-delete-id');

    // Api Filter User Role
    Route::get('/role/filter-user', 'filter')
    ->middleware('auth:sanctum', 'checkUserRole:user-role-filter-user');
});

// *** FEATURE AREA ***
Route::controller(FeatureController::class)->middleware('auth:sanctum')->group(function () {
    // Get List Feature
    Route::get('/feature/list/{config}', 'list')
    ->middleware('checkUserRole:feature-list-config');

    // Add Feature
    Route::post('/feature/add', 'add')
    ->middleware('checkUserRole:feature-add');

    // Get Data Feature
    Route::post('/feature/get-data', 'show')
    ->middleware('checkUserRole:feature-get-data');

    // Update Feature
    Route::put('/feature/update/{id}', 'update')
    ->middleware('checkUserRole:feature-update-id');

    // Delete Feature
    Route::delete('/feature/delete/{id}', 'delete')
    ->middleware('checkUserRole:feature-delete-id');

    // Api Filter Feature
    Route::get('/feature/filter', 'filter')
    ->middleware('auth:sanctum', 'checkUserRole:feature-filter');
});

// *** ROLE FEATURE AREA ***
Route::controller(RoleFeatureController::class)->middleware('auth:sanctum')->group(function () {
    // Api Get List Role Feature
    Route::get('/role/list-feature', 'list')
    ->middleware('checkUserRole:role-list-feature');

    // Api Add Role Feature
    Route::post('/role/add-feature', 'add')
    ->middleware('checkUserRole:role-add-feature');

    // Api Delete Role Feature
    Route::delete('/role/delete-feature/{id}', 'delete')
    ->middleware('checkUserRole:role-delete-feature');

    // Api Filter Role Feature
    Route::get('/role/filter-feature', 'filter')
    ->middleware('checkUserRole:role-filter-feature');
});

// *** MODUL AREA ***
Route::controller(ModulController::class)->middleware('auth:sanctum')->group(function () {
    // Api Modul Get List
    Route::get('/modul/list/{config}', 'list')
    ->middleware('checkUserRole:modul-list-config');

    // Api Modul Add
    Route::post('/modul/add', 'add')
    ->middleware('checkUserRole:modul-add');

    // Api Get Data Modul
    Route::post('/modul/get-data/', 'show')
    ->middleware('checkUserRole:modul-get-data');

    // Api Update Modul
    Route::put('/modul/update/{id}', 'update')
    ->middleware('checkUserRole:modul-update-id');

    // Api Delete Modul
    Route::delete('/modul/delete/{id}', 'delete')
    ->middleware('checkUserRole:modul-delete-id');

    // Api Modul filter
    Route::get('/modul/filter', 'filter')
    ->middleware('checkUserRole:modul-filter');
});

// *** MENU AREA ***
Route::controller(MenuController::class)->middleware('auth:sanctum')->group(function () {
    // Api Menu Get List
    Route::get('/menu/list/{config}', 'list')
    ->middleware('checkUserRole:menu-list-config');

    // Api Menu add
    Route::post('/menu/add', 'add')
    ->middleware('checkUserRole:menu-add');

    // Api Menu get data
    Route::post('/menu/get-data', 'show')
    ->middleware('checkUserRole:menu-show');

    // Api Menu update
    Route::put('/menu/update/{id}', 'update')
    ->middleware('checkUserRole:menu-update-id');

    // Api Menu delete
    Route::delete('/menu/delete/{id}', 'delete')
    ->middleware('checkUserRole:menu-delete-id');

    // Api Menu filter
    Route::get('/menu/filter', 'filter')
    ->middleware('checkUserRole:menu-filter');
});

//  *** TRANSACTION DEFINITION ***
// Route::controller(TransactionDefinitionController::class)->middleware('auth:sanctum')->group(function () {
//     // API No 28 List Prodct Area
//     Route::get('/product/list/{config}', 'index')->middleware('checkUserRole:product-list-config');

//     // API No 29 Add Prodct Area
//     Route::post('/product/add', 'addNewProduct')->middleware('checkUserRole:product-add');

//     // API No 30 Get Prodct Area
//     Route::post('/product/get-data', 'getDataProduct')->middleware('checkUserRole:product-get-data');

//     // API No 31 Update Prodct Area
//     Route::put('/product/update/{name}', 'updateProduct')->middleware('checkUserRole:product-update-name');

//     // API No 32 Delete Prodct Area
//     Route::put('/product/delete/{id}', 'deleteProduct')->middleware('checkUserRole:product-delete-id');

//     // API No 33 Get Count Prodct Area
//     Route::get('/product/get-count', 'getCountProduct')->middleware('checkUserRole:product-get-count');

//     // API No 34 Get List Column
//     Route::post('/product/data-column', 'listColumnProduct')->middleware('checkUserRole:product-data-column');

//     // API No 35 Product Test Data
//     Route::post('/product/test-data', 'testDataProduct')->middleware('checkUserRole:product-test-data');

//     // API No 36 Filter Prodct Area
//     Route::get('/product/filter', 'filterProduct')->middleware('checkUserRole:product-filter');

//     // Api Get Data Trash Product Area
//     Route::get('/product/trash/', 'trash')->middleware('checkUserRole:product-trash');
// });

//  *** PRODUCT V2 ***
Route::controller(ProductV2Controller::class)->middleware('auth:sanctum')->group(function () {
    // API No 28 List Prodct Area
    Route::get('/product/list/{config}', 'index')
    ->middleware('checkUserRole:product-list-config');

    // API No 29 Add Prodct Area
    Route::post('/product/add', 'store')
    ->middleware('checkUserRole:product-add');

    // API No 30 Get Prodct Area
    Route::post('/product/get-data', 'show')
    ->middleware('checkUserRole:product-get-data');

    // API No 31 Update Prodct Area
    Route::put('/product/update/', 'update')
    ->middleware('checkUserRole:product-update-name');

    // API No 32 Delete Prodct Area
    Route::put('/product/delete/', 'destroy')
    ->middleware('checkUserRole:product-delete-id');

    // API No 33 Get Count Prodct Area
    Route::get('/product/get-count', 'getCount')
    ->middleware('checkUserRole:product-get-count');

    // API No 36 Filter Prodct Area
    Route::get('/product/filter', 'filter')
    ->middleware('checkUserRole:product-filter');

    // Api Get Data Trash Product Area
    Route::get('/product/trash/', 'trash')
    ->middleware('checkUserRole:product-trash');

    // API Product/Area Restore Trash Data
    Route::post('/product/restore/', 'restore')
    ->middleware('checkUserRole:product-restore');

    // API Product/Area Delete Permanent
    Route::delete('/product/delete/', 'deleteData')
    ->middleware('checkUserRole:delete-permanent');
});


// *** DOWN CENTRAL ***
Route::controller(DownCentralController::class)->middleware('auth:sanctum')->group(function () {
    // API No 37 Get List CID
    Route::get('/cid/list/{config}', 'getListDownCentral')
    ->middleware('checkUserRole:cid-list-config');

    // API No 38 Add New CID
    Route::post('/cid/add', 'addNewDownCentral')
    ->middleware('checkUserRole:cid-add');

    // API No 39 Get Data CID
    Route::post('/cid/get-data', 'getDataDownCentral')
    ->middleware('checkUserRole:cid-get-data');

    // API No 40 Update CID
    Route::put('/cid/update/{id}', 'updateDownCentral')
    ->middleware('checkUserRole:cid-update-id');

    // API No 41 Delete CID
    Route::put('/cid/delete/{id}', 'deleteDownCentral')
    ->middleware('checkUserRole:cid-delete-id');

    // API No 42 Get Data Profile CID
    Route::post('/cid/data-profile', 'getProfileDownCentral')
    ->middleware('checkUserRole:cid-data-profile');

    // API No 43 Get Unmapping CID
    Route::get('/cid/unmapping-profile', 'getUnmappingDownCentral')
    ->middleware('checkUserRole:cid-list-unmapping-profile');

    // API No 44 Update Profile CID
    Route::put('/cid/update-profile/{cid}', 'updateProfileDownCentral')
    ->middleware('checkUserRole:cid-update-profile-id');

    // API No 45 Update Profile Many CID
    Route::put('/cid/many-update-profile', 'updateManyProfileDownCentral')
    ->middleware('checkUserRole:cid-many-update-profile');

    // API No 46 Filter Data CID
    Route::get('/cid/filter', 'filterDownCentral')
    ->middleware('checkUserRole:cid-filter');

    // Api Get Data Trash CID
    Route::get('/cid/trash/', 'trash')
    ->middleware('checkUserRole:cid-trash');

    // API Product/Area Restore Trash Data
    Route::post('/cid/restore/', 'restore')
    ->middleware('checkUserRole:cid-restore');
});

// *** CORE BILLER ***
Route::controller(BillerController::class)->middleware('auth:sanctum')->group(function () {
    // API NO 47 Get List Biller
    Route::get('/biller/list/{config}', 'getListBiller')
    ->middleware('checkUserRole:biller-list-config');

    // API NO 48 Get List GOP
    Route::get('/biller/list-gop', 'getGopBiller')
    ->middleware('checkUserRole:biller-list-gop');

    // API No 49 Add New Biller
    Route::post('/biller/add', 'addNewBiller')
    ->middleware('checkUserRole:biller-add');

    // API No 50 Get Data Biller
    Route::post('/biller/get-data', 'getDataBiller')
    ->middleware('checkUserRole:biller-get-data');

    // API No 51 Update Data Biller
    Route::put('/biller/update/{id}', 'updateBiller')
    ->middleware('checkUserRole:biller-update-id');

    // API No 52 Delete Data Biller
    Route::put('/biller/delete/{id}', 'deleteBiller')
    ->middleware('checkUserRole:biller-delete-id');

    // API No 53 List Account Biller
    Route::post('/biller/list-account', 'listAccountBiller')
    ->middleware('checkUserRole:biller-list-account');

    // API No 54 Get Account Biller
    Route::post('/biller/data-account', 'dataAccountBiller')
    ->middleware('checkUserRole:biller-data-account');

    // API No 55 Add Account Biller
    Route::post('/biller/add-account', 'addAccountBiller')
    ->middleware('checkUserRole:biller-add-account');

    // API No 56 Delete Account Biller
    Route::delete('/biller/delete-account/{id}', 'deleteAccountBiller')
    ->middleware('checkUserRole:biller-delete-account-id');

    // API Biller Restore Trash Data
    Route::post('/biller/restore/', 'restore')
    ->middleware('checkUserRole:biller-restore');

    // API No 57 List Product Biller
    Route::post('/biller/list-product', 'listProductBiller')
    ->middleware('checkUserRole:biller-list-product');

    // API No 58 List Add Product Biller
    Route::post('/biller/list-add-product', 'listAddProductBiller')
    ->middleware('checkUserRole:biller-list-add-product');

    // API No 59 Add Product Biller
    Route::post('/biller/add-product', 'addProductBiller')
    ->middleware('checkUserRole:biller-product-add');

    // API No 60 Delete Product Biller
    Route::delete('/biller/delete-product/{id}', 'deleteProductBiller')
    ->middleware('checkUserRole:biller-delete-product-id');

    // API No 61 List Product Biller
    Route::post('/biller/list-calendar', 'listCalendarBiller')
    ->middleware('checkUserRole:biller-list-calendar');

    // API No 62 Data Calendar Biller
    Route::post('/biller/data-calendar', 'dataCalendarBiller')
    ->middleware('checkUserRole:biller-data-calendar');

    // API No 63 Add Calendar Biller
    Route::post('/biller/add-calendar', 'addCalendarBiller')
    ->middleware('checkUserRole:biller-add-calendar');

    // API No 65 Delete Calendar Biller
    Route::delete('/biller/delete-calendar/{id}', 'deleteCalendarBiller')
    ->middleware('checkUserRole:biller-delete-calendar');

    // API NO 66 Filter Data Biller
    Route::get('/biller/filter', 'filterDataBiller')
    ->middleware('checkUserRole:biller-filter');

    // API (Tambahan) List Biller By GOP
    Route::post('/biller/by-gop', 'listByGop');

    // Api (Tambahan) List Biller By GOP
    Route::get('/biller/list-modul/{config}', 'billerListModul');

    // Api (Tambahan) List Biller List Add Account
    Route::get('/biller/list-add-account', 'listAddAccount')
    ->middleware('checkUserRole:biller-list-add-account');

    // Api Get Data Trash Biller
    Route::get('/biller/trash', 'trash')
    ->middleware('checkUserRole:biller-trash');

    // Api Biller Unmapping Profile
    Route::get('/biller/unmapping-profile', 'unmappingProfile')
    ->middleware('checkUserRole:biller-unmapping-profile');

    // Api Biller Update Data Profile
    Route::put('/biller/update-profile/{biller_id}', 'updateProfile')
    ->middleware('checkUserRole:biller-update-profile');
});

// *** CORE PARTNER ***
Route::controller(PartnerController::class)->middleware('auth:sanctum')->group(function () {
    // API No 67 Get List Partner
    Route::get('/partner/list/{config}', 'getListPartner')
    ->middleware('checkUserRole:partner-list-config');

    // API No 68 Add Partner
    Route::post('/partner/add', 'addNewPartner')
    ->middleware('checkUserRole:partner-add');

    // API No 69 Get Data Partner
    Route::post('/partner/get-data', 'getDataPartner')
    ->middleware('checkUserRole:partner-get-data');

    // API No 70 Update Partner
    Route::put('/partner/update/{id}', 'updatePartner')
    ->middleware('checkUserRole:partner-update-id');

    // API No 71 Delete Partner
    Route::put('/partner/delete/{id}', 'deletePartner')
    ->middleware('checkUserRole:partner-delete-id');

    // API No 72 List CID Partner
    Route::post('/partner/list-cid', 'listCidPartner')
    ->middleware('checkUserRole:partner-list-cid');

    // API No 73 Add CID Partner
    Route::post('/partner/add-cid', 'addCidPartner')
    ->middleware('checkUserRole:partner-add-cid');

    // API No 74 Delete CID Partner
    Route::delete('/partner/delete-cid/{id}', 'deleteCidPartner')
    ->middleware('checkUserRole:partner-delete-cid-id');

    // API No 75 List Unmapping Cid Partner
    Route::get('/partner/unmapping-cid', 'unmappingCidPartner')
    ->middleware('checkUserRole:partner-unmapping-cid');

    // API No 76 Add Unmappping CID Partner
    Route::post('/partner/add-unmapping-cid', 'addUnmappingPartner')
    ->middleware('checkUserRole:partner-update-unmapping-cid');

    // API No 77 Filter Partner
    Route::get('/partner/filter', 'filterPartner')
    ->middleware('checkUserRole:partner-filter');

    // Api Get Data Trash Partner
    Route::get('/partner/trash', 'trash')
    ->middleware('checkUserRole:partner-trash');

    // API Partner Restore Trash Data
    Route::post('/partner/restore/', 'restore')
    ->middleware('checkUserRole:partner-restore');
});

// *** CORE BANK ***
Route::controller(BankController::class)->middleware('auth:sanctum')->group(function () {
    // API No 78 Get List Bank
    Route::get('/bank/list/{config}', 'getListBank')
    ->middleware('checkUserRole:bank-list-config');

    // API No 79 Add Bank
    Route::post('/bank/add', 'addNewBank')
    ->middleware('checkUserRole:bank-add');

    // API No 80 Get Data Bank
    Route::post('/bank/get-data', 'getDataBank')
    ->middleware('checkUserRole:bank-get-data');

    // API No 81 Update Bank
    Route::put('/bank/update/{id}', 'updateBank')
    ->middleware('checkUserRole:bank-update-id');

    // API No 82 Delete Bank
    Route::put('/bank/delete/{id}', 'deleteBank')
    ->middleware('checkUserRole:bank-delete-id');

    // API Bank Restore Trash Data
    Route::post('/bank/restore/', 'restore')
    ->middleware('checkUserRole:bank-restore');

    // API No 83 Filter Bank
    Route::get('/bank/filter', 'filterBank')
    ->middleware('checkUserRole:bank-filter');

    // Api Get Data Trash Bank
    Route::get('/bank/trash', 'trash')
    ->middleware('checkUserRole:bank-trash');
});

// *** CORE ACCOUNT ***
Route::controller(AccountController::class)->middleware('auth:sanctum')->group(function () {
    // API No 84 Get List Account
    Route::get('/account/list/{config}', 'getListAccount')
    ->middleware('checkUserRole:account-list-config');

    // API No 85 Add Account
    Route::post('/account/add', 'addNewAccount')
    ->middleware('checkUserRole:account-add');

    // API No 86 Get Data Account
    Route::post('/account/get-data', 'getDataAccount')
    ->middleware('checkUserRole:account-get-data');

    // API No 87 Update Account
    Route::put('/account/update/{id}', 'updateAccount')
    ->middleware('checkUserRole:account-update-id');

    // API No 88 Delete Account
    Route::put('/account/delete/{id}', 'deleteAccount')
    ->middleware('checkUserRole:account-delete-id');

    // API No 89 Filter Account
    Route::get('/account/filter', 'filterAccount')
    ->middleware('checkUserRole:account-filter');

    // API Tambahan Account Delete Permanent Account
    Route::delete('/account/delete/{id}', 'deleteData')
    ->middleware('checkUserRole:delete-data');

    // Api Get Data Trash Account
    Route::get('/account/trash', 'trash')
    ->middleware('checkUserRole:account-trash');

    // API Account Restore Trash Data
    Route::post('/account/restore/', 'restore')
    ->middleware('checkUserRole:account-restore');
});

// *** CORE GROUP BILLER ***
Route::controller(GroupBillerController::class)->middleware('auth:sanctum')->group(function () {
    // API No 90 Get List Group-Biller
    Route::get('/group-biller/list/{config}', 'getListGb')
    ->middleware('checkUserRole:group-biller-list-config');

    // API No 91 Add Group-Biller
    Route::post('/group-biller/add', 'addNewGb')
    ->middleware('checkUserRole:group-biller-add');

    // API No 92 Get Data Group-Biller
    Route::post('/group-biller/get-data', 'getDataGb')
    ->middleware('checkUserRole:group-biller-get-data');

    // API No 93 Update Group-Biller
    Route::put('/group-biller/update/{id}', 'updateGb')
    ->middleware('checkUserRole:group-biller-update-id');

    // API No 94 Delete Group-Biller
    Route::put('/group-biller/delete/{id}', 'deleteGb')
    ->middleware('checkUserRole:group-biller-delete-id');

    // API No 95 Get Data Group-Biller Biller
    Route::post('/group-biller/list-biller', 'getBillerGb')
    ->middleware('checkUserRole:group-biller-list-biller');

    // API No 96 Get List Add Group-Biller Biller
    Route::post('/group-biller/list-add-biller/{config}', 'listAddGb')
    ->middleware('checkUserRole:group-biller-list-add-biller');

    // API No 97 Add Group-Biller Biller
    Route::post('/group-biller/add-biller', 'addBillerGb')
    ->middleware('checkUserRole:group-biller-add-biller');

    // API No 98 Delete Biller Group-Biller
    Route::delete('/group-biller/delete-biller/{id}', 'deleteBillerGb')
    ->middleware('checkUserRole:group-biller-delete-biller');

    // API No 99 Filter Group-Biller
    Route::get('/group-biller/filter', 'filterGb')
    ->middleware('checkUserRole:group-biller-filter');

    // API Delete Group Biller (Permanent)
    Route::delete('/group-biller/delete-data/{id}', 'deleteData')
    ->middleware('checkUserRole:group-biller-delete-data');

    // API Get Data Trash Group Biller
    Route::get('/group-biller/trash', 'trash')
    ->middleware('checkUserRole:group-biller-trash');

    // API Group Biller Restore Trash Data
    Route::post('/group-biller/restore/', 'restore')
    ->middleware('checkUserRole:group-biller-restore');
});

// *** GROUP TRANSFER FUNDS ***
Route::controller(GtfController::class)->middleware('auth:sanctum')->group(function () {
    // API No 100 Get List Group Transfer Funds
    Route::get('/group-funds/list/{config}', 'getListGtf')
    ->middleware('checkUserRole:group-funds-list-config');

    // API No 101 Add Group Transfer Funds
    Route::post('/group-funds/add', 'addNewGtf')
    ->middleware('checkUserRole:group-funds-add');

    // API No 102 Get Data Group Transfer Funds
    Route::post('/group-funds/get-data', 'getDataGtf')
    ->middleware('checkUserRole:group-funds-get-data');

    // API No 103 Update Group Transfer Funds
    Route::put('/group-funds/update/{id}', 'updateGtf')
    ->middleware('checkUserRole:group-funds-update-id');

    // API No 104 Delete Group Transfer Funds
    Route::put('/group-funds/delete/{id}', 'deleteGtf')
    ->middleware('checkUserRole:group-funds-delete-id');

    // API No 105 Get List Product Group Transfer Funds
    Route::post('/group-funds/list-product', 'listProductGtf')
    ->middleware('checkUserRole:group-list-product');

    // API No 106 Get List Add Product Group Transfer Funds
    Route::post('/group-funds/list-add-product/{config}', 'listAddProductGtf')
    ->middleware('checkUserRole:group-list-add-product');

    // API No 107 Add Product Group Transfer Funds
    Route::post('/group-funds/add-product', 'addProductGtf')
    ->middleware('checkUserRole:group-add-product');

    // API No 108 Delete Product Group Transfer Funds
    Route::delete('/group-funds/delete-product/{id}', 'deleteProductGtf')
    ->middleware('checkUserRole:group-delete-product');

    // API No 109 Filter Group Transfer Funds
    Route::get('/group-funds/filter', 'filterGtf')
    ->middleware('checkUserRole:group-funds-filter');

    // Api Tambahan Group Transfer Funds By Biller
    Route::post('/group-funds/by-biller', 'byBiller');

    // Api Tambahan Group Transfer Funds Get Amount
    Route::post('/group-funds/get-amount', 'getAmount')
    ->middleware('checkUserRole:group-funds-get-amount');

    // API Get Data Trash Group Transfer Funds
    Route::get('/group-funds/trash', 'trash')
    ->middleware('checkUserRole:group-funds-trash');

    // API Group Transfer Funds Restore Trash Data
    Route::post('/group-funds/restore/', 'restore')
    ->middleware('checkUserRole:group-funds-restore');
});

// *** EXCLUDE PARTNER ***
Route::controller(ExcludePartnerController::class)->middleware('auth:sanctum')->group(function () {
    // API No 110 List Exclude Partner
    Route::get('/exclude-partner/list/{config}', 'getListEp')
    ->middleware('checkUserRole:exclude-partner-list-config');

    // API No 111 Add Exclude Partner
    Route::post('/exclude-partner/add', 'addNewEp')
    ->middleware('checkUserRole:exclude-partner-add');

    // API No 112 Delete Exclude Partner
    Route::delete('/exclude-partner/delete/{id}', 'deleteEp')
    ->middleware('checkUserRole:exclude-partner-delete-id');

    // API No 113 Filter Exclude Partner
    Route::get('/exclude-partner/filter', 'filterEp')
    ->middleware('checkUserRole:exclude-partner-filter');
});

// *** CORE CALENDAR ***
Route::controller(CalendarController::class)->middleware('auth:sanctum')->group(function () {
    // API No 64 View Detail Calendar
    Route::post('/calendar/view', 'viewDetailCalendar')
    ->middleware('checkUserRole:calendar-calendar-view');

    // API No 114 Get List Calendar
    Route::get('/calendar/list/{config}', 'getListCalendar')
    ->middleware('checkUserRole:calendar-list-config');

    // API No 115 Add Calendar
    Route::post('/calendar/add', 'addNewCalendar')
    ->middleware('checkUserRole:calendar-add');

    // API No 116 Get Data Calendar
    Route::post('/calendar/get-data', 'getDataCalendar')
    ->middleware('checkUserRole:calendar-get-data');

    // API No 117 Update Calendar
    Route::put('/calendar/update/{id}', 'updateCalendar')
    ->middleware('checkUserRole:calendar-update-id');

    // API No 118 Set Default Calendar
    Route::put('/calendar/set-default/{id}', 'setDefaultCalendar')
    ->middleware('checkUserRole:calendar-set-default-id');

    // API No 119 Get All Data Copy Calendar
    Route::post('/calendar/get-data-copy', 'getAllCopyCalendar')
    ->middleware('checkUserRole:calendar-get-data-copy');

    // API No 120 Copy Calendar
    Route::post('/calendar/copy', 'addCopyCalendar')
    ->middleware('checkUserRole:calendar-copy');

    // API No 121 Delete calendar
    Route::put('/calendar/delete/{id}', 'deleteCalendar')
    ->middleware('checkUserRole:calendar-delete-id');

    // API No 127 Filter Calendar
    Route::get('/calendar/filter', 'filterCalendar')
    ->middleware('checkUserRole:calendar-filter');

    // API Get Data Trash Calendar
    Route::get('/calendar/trash', 'trash')
    ->middleware('checkUserRole:calendar-trash');

    // API Calendar Restore Trash Data
    Route::post('/calendar/restore/', 'restore')
    ->middleware('checkUserRole:calendar-restore');
});

// *** CALENDAR DAYS ***
Route::controller(DaysController::class)->middleware('auth:sanctum')->group(function () {
    // API No 122 Get Calendar Days
    Route::post('/calendar/list-day', 'getCalendarDays')
    ->middleware('checkUserRole:calendar-list-day');

    // API No 123 Add Calendar Days
    Route::post('/calendar/add-day', 'addCalendarDays')
    ->middleware('checkUserRole:calendar-add-day');

    // API No 124 Get Data CalendarDay
    Route::post('/calendar/get-data-day', 'getDataDays')
    ->middleware('checkUserRole:calendar-get-data-day');

    // API No 125 Update Calendar Day
    Route::put('/calendar/update-day/{id}', 'updateDays')
    ->middleware('checkUserRole:calendar-update-day');

    // API No 126 Delete Calendar Day
    Route::delete('/calendar/delete-day/{id}', 'deleteDays')
    ->middleware('checkUserRole:calendar-delete-day');
});

// *** PROFILE FEE ***
Route::controller(ProfileFeeController::class)->middleware('auth:sanctum')->group(function () {
    // API No 128 Get Count Product Profile-Fee
    Route::post('/profile/get-count-product', 'getCountProfile')
    ->middleware('checkUserRole:profile-get-count-product');

    // API No 129 Get List Profile Fee
    Route::get('/profile/list/{config}', 'getListProfile')
    ->middleware('checkUserRole:profile-list-config');

    // API No 130 Add Profile
    Route::post('/profile/add', 'addNewProfile')
    ->middleware('checkUserRole:profile-add');

    // API No 131 Get Data Profile-Fee
    Route::post('/profile/get-data', 'getDataProfile')
    ->middleware('checkUserRole:profile-get-data');

    // API No 132 Update Profile
    Route::put('/profile/update/{id}', 'updateProfile')
    ->middleware('checkUserRole:profile-update-id');

    // API No 133 Set Default Profile
    Route::put('/profile/set-default/{id}', 'setDefaultProfile')
    ->middleware('checkUserRole:profile-set-default-id');

    // API No 134 Get All Data Copy Profile-Fee
    Route::post('/profile/get-data-copy', 'getDataCopyProfile')
    ->middleware('checkUserRole:profile-get-data-copy');

    // API No 135 Copy Profile
    Route::post('/profile/copy', 'copyProfile')
    ->middleware('checkUserRole:profile-copy');

    // API No 136 Delete Profile
    Route::put('/profile/delete/{id}', 'deleteProfile')
    ->middleware('checkUserRole:profile-delete-id');

    // API Profile Fee Restore Trash Data
    Route::post('/profile/restore/', 'restore')
    ->middleware('checkUserRole:profile-restore');

    // API No 137 Get List Product Profile-Fee
    Route::post('/profile/list-product', 'listProductProfile')
    ->middleware('checkUserRole:profile-list-product');

    // API No 138 Add Product Profile
    Route::post('/profile/add-product', 'addProductProfile')
    ->middleware('checkUserRole:profile-add-product');

    // API No 139 Get Data Product Profile-Fee
    Route::post('/profile/get-data-product', 'getDataProductProfile')
    ->middleware('checkUserRole:profile-get-data-product');

    // API No 140 Update Product Profile
    Route::put('/profile/update-product/{id}', 'updateProductProfile')
    ->middleware('checkUserRole:profile-update-product-id');

    // API No 141 Delete Product Profile
    Route::delete('/profile/delete-product/{id}', 'deleteProductProfile')
    ->middleware('checkUserRole:profile-delete-product-id');

    // API No 142 Filter Profile
    Route::get('/profile/filter', 'filterProfile')
    ->middleware('checkUserRole:profile-filter');

    // Api Tambahan Product Not Existing
    Route::get('profile/list-product-unexists', 'productUnexists')
    ->middleware('checkUserRole:profile-list-product-unexists');

    // API Get Data Trash Profile
    Route::get('/profile/trash', 'trash')
    ->middleware('checkUserRole:profile-trash');
});

// *** CORRECTION ***
Route::controller(CorrectionController::class)->middleware('auth:sanctum')->group(function () {
    // API No 143 Get List Correction
    Route::get('/correction/list/{config}', 'getList')
    ->middleware('checkUserRole:correction-list-config');

    // API No 144 Add Correction
    Route::post('/correction/add', 'add')
    ->middleware('checkUserRole:correction-add');

    // API No 145 Get Data Correction
    Route::post('/correction/get-data', 'getData')
    ->middleware('checkUserRole:correction-get-data');

    // API No 146 Update Correction
    Route::put('/correction/update/{id}', 'update')
    ->middleware('checkUserRole:correction-update-id');

    // API No 147 Delete Correction
    Route::put('/correction/delete/{id}', 'delete')
    ->middleware('checkUserRole:correction-delete-id');

    // API No 148 Filter Correction
    Route::get('/correction/filter', 'filter')
    ->middleware('checkUserRole:correction-filter');

    // API Get Data Trash Correction
    Route::get('/correction/trash', 'trash')
    ->middleware('checkUserRole:correction-trash');

    // API Correction Restore Trash Data
    Route::post('/correction/restore/', 'restore')
    ->middleware('checkUserRole:correction-restore');
});

// *** CORE RECON DATA
Route::controller(ReconDataController::class)->middleware('auth:sanctum')->group(function () {
    // API 123 List Recon Data
    Route::get('/recon-data/list', 'list')
    ->middleware('checkUserRole:recon-data-list');

    // Recon Data Filter
    Route::get('/recon-data/filter', 'filter')
    ->middleware('checkUserRole:recon-data-filter');

    // API 124 SETLED RECON DATA
    Route::post('/recon-data/settled', 'settledProduct')
    ->middleware('checkUserRole:recon-data-settled');

    // API 125 Get List Suspect Recon data
    Route::post('/recon-data/list-suspect', 'listSuspect')
    ->middleware('checkUserRole:recon-data-list-suspect');

    // API 126 Get List By Product Recon Data
    Route::post('/recon-data/by-product', 'listByProduct')
    ->middleware('checkUserRole:recon-data-by-product');

    // Recon Data List By CID
    Route::post('/recon-data/by-cid', 'listByCid')
    ->middleware('checkUserRole:recon-data-by-cid');

    // Recon Data Get Data History
    Route::post('/recon-data/history', 'listByHistory')
    ->middleware('checkUserRole:recon-data-history');

    // Recon Data Export
    Route::post('/recon-data/export', 'export')
    ->middleware('checkUserRole:recon-data-export');

    // Recon Data Download
    Route::get('/recon-data/export-download/{id}', 'download')
    ->middleware('checkUserRole:recon-data-download');
});

// *** RECON DANA
Route::controller(ReconDanaController::class)->middleware('auth:sanctum')->group(function () {
    // API Get Unmapping Biller
    Route::get('/recon-dana/unmapping-biller', 'unmappingBiller')
    ->middleware('checkUserRole:recon-dana-unmapping-biller');

    // API Get Unmapping Product
    Route::get('/recon-dana/unmapping-product', 'unmappingProduct')
    ->middleware('checkUserRole:recon-dana-unmapping-product');

    // API Add Biller Recon Dana
    Route::post('recon-dana/add-biller', 'addBiller')
    ->middleware('checkUserRole:recon-dana-add-biller');

    // API Add Product Funds Recon Dana
    Route::post('recon-dana/add-product', 'addProduct')
    ->middleware('checkUserRole:recon-dana-add-product');

    // API Process Recon Dana
    Route::post('recon-dana/process', 'process')
    ->middleware('checkUserRole:recon-dana-process');

    // Api Get List Correction Settled
    Route::post('recon-dana/list-correction-process', 'listCorrectionProcess')
    ->middleware('checkUserRole:recon-dana-list-correction');

    // Api Update Correction Settled
    Route::put('recon-dana/update-correction-process', 'updateCorrectionProcess')
    ->middleware('checkUserRole:recon-dana-update-correction');

    // Api Recon Dana Get List Suspect Recon Dana
    Route::post('recon-dana/list-suspect-process', 'listSuspectProcess')
    ->middleware('checkUserRole:recon-dana-list-suspect');

    // Api Recon Dana Update Data Suspect Settled
    Route::put('recon-dana/update-suspect-process', 'updateSuspect')
    ->middleware('checkUserRole:recon-dana-update-suspect');

    // API Recon Dana List Summary
    Route::get('recon-dana/list-summary', 'listSummary')
    ->middleware('checkUserRole:recon-dana-list-summary');

    // API Recon Dana List Recon
    Route::get('recon-dana/list', 'list')
    ->middleware('checkUserRole:recon-dana-list');

    // API Recon Dana Filter Data
    Route::get('recon-dana/filter', 'filter')
    ->middleware('checkUserRole:recon-dana-filter');

    // Api Reccon Dana List Correction
    Route::post('recon-dana/list-correction', 'listCorrection')
    ->middleware('checkUserRole:recon-dana-list-correction');

    // Api Recon Dana List Suspect
    Route::post('recon-dana/list-suspect', 'listSuspect')
    ->middleware('checkUserRole:recon-dana-list-suspect');

    // Api Recon Dana Get List By ID
    Route::post('recon-dana/by-id', 'byId')
    ->middleware('checkUserRole:recon-dana-list-by-id');

    // Api Recon Dana By Id Suspect
    Route::post('recon-dana/by-id-suspect', 'byIdSuspect')
    ->middleware('checkUserRole:recon-dana-list-by-id-suspect');

    // Api Recon Dana Get Suspect By Product
    Route::post('recon-dana/list-suspect-product', 'listSuspectProduct')
    ->middleware('checkUserRole:recon-dana-list-suspect-product');

    // Api Recon Dana Get List By Product
    Route::post('recon-dana/by-product', 'byProduct')
    ->middleware('checkUserRole:recon-dana-list-by-product');

    // Api Recon Dana Get List By CID
    Route::post('recon-dana/by-cid', 'listByCid')
    ->middleware('checkUserRole:recon-dana-list-by-cid');

    // API Recon Dana Get List History
    Route::post('recon-dana/history', 'history')
    ->middleware('checkUserRole:recon-dana-history');

    // API Recon Dana Different Transfer
    Route::post('recon-dana/get-diff-transfer', 'diffTransfer')
    ->middleware('checkUserRole:recon-diff-transfer');

    // API Recon Dana Add Different Transfer
    Route::post('recon-dana/add-diff-transfer', 'addDiffTransfer')
    ->middleware('checkUserRole:recon-add-diff-transfer');

    // API Recon Dana Get Additional Transfer
    Route::post('recon-dana/get-transfer', 'getTransfer')
    ->middleware('checkUserRole:recon-get-transfer');

    // API Recon Dana Add Additional Transfer
    Route::post('recon-dana/add-transfer', 'addTransfer')
    ->middleware('checkUserRole:recon-add-transfer');

    // Recon Dana Check Status
    Route::post('recon-dana/check-status', 'checkStatus')
    ->middleware('checkUserRole:recon-dana-check-status');

    // Recon Dana Check Mutation
    Route::post('recon-dana/check-mutation', 'checkMutation')
    ->middleware('checkUserRole:recon-dana-check-mutation');
});

//  *** Formula Transfer
Route::controller(FormulaTransferController::class)->middleware('auth:sanctum')->group(function () {
    // API Tambahan Formula Transfer Get List Config
    Route::get('/formula-transfer/list/{config}/', 'getList')
    ->middleware('checkUserRole:formula-transfer-list-config');

    // API Tambahan Formula Transfer Get Data
    Route::post('/formula-transfer/get-data', 'getData')
    ->middleware('checkUserRole:formula-transfer-get-data');

    // API Tambahan Formula Transfer Add Data
    Route::post('/formula-transfer/add', 'add')
    ->middleware('checkUserRole:formula-transfer-add');

    // Api Tambahan Formula Transfer Update Data
    Route::put('/formula-transfer/update/{id}', 'updateData')
    ->middleware('checkUserRole:formula-transfer-update-id');

    // Api Tambahan Formula Transfer Delete Data
    Route::put('/formula-transfer/delete/{id}', 'deleteData')
    ->middleware('checkUserRole:formula-transfer-delete-id');

    // Api Tambahan Formula Transfer Filter Data
    Route::get('/formula-transfer/filter/', 'filterData')
    ->middleware('checkUserRole:formula-transfer-filter');

    // API Get Data Trash Formula Transfer
    Route::get('/formula-transfer/trash/', 'trash')
    ->middleware('checkUserRole:formula-transfer-trash');

    // API Restore Data Formula Transfer
    Route::post('/formula-transfer/restore', 'restore')
    ->middleware('checkUserRole:formula-transfer-restore');
});

// *** MODULE DEFINITION
Route::controller(ModuleController::class)->middleware(('auth:sanctum'))->group(function () {
    // API Module Definition Get List Config
    Route::get('product-module/list/{config}', 'index')
    ->middleware('checkUserRole:module-definition-list-config');

    // API Module Definition Add Data
    Route::post('product-module/add', 'store')
    ->middleware('checkUserRole:module-definition-add');

    // API Module Definition Get Data
    Route::post('product-module/get-data', 'show')
    ->middleware('checkUserRole:module-definition-get-data');

    // API Module Definition Update
    Route::put('product-module/update/{groupname}', 'update')
    ->middleware('checkUserRole:module-definition-update');

    // API Module Definition Update
    Route::put('product-module/delete/{groupname}', 'destroy')
    ->middleware('checkUserRole:module-delete');

    // API Module Definition Data Column
    Route::post('product-module/data-column', 'dataColumn')
    ->middleware('checkUserRole:module-data-column');

    // API Module Definition Test Data
    Route::post('product-module/test-data', 'testData')
    ->middleware('checkUserRole:module-test-data');

    // API Module Definition Filter
    Route::get('product-module/filter', 'filter')
    ->middleware('checkUserRole:module-filter');

    // API Module Definition Get Trash Data
    Route::get('/product-module/trash/', 'trash')
    ->middleware('checkUserRole:product-trash');

    // API Module Definition Restore Trash Data
    Route::post('/product-module/restore/', 'restore')
    ->middleware('checkUserRole:product-restore');

    // API Module Definition Delete Permanent
    Route::delete('/product-module/delete/{name}', 'deleteData')
    ->middleware('checkUserRole:delete-permanent');
});
