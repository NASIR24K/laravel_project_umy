<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
//////category route////////////////
Route::get('/category/all', [CategoryController::class, 'allcat'])->name('all.category');
Route::post('category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'editdata']);
Route::post('/category/update/{id}', [CategoryController::class, 'updatedata']);

Route::get('/category/delete/{id}', [CategoryController::class, 'deletedata'])->name('category.delete');;
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreData']);

Route::get('/category/pdelete/{id}', [CategoryController::class, 'pdeleteData']);
/////////////////////brand route/////////
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('brand.store');
Route::get('/brand/edit/{id}', [BrandController::class, 'brandEdit']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
//////////////////end brand/////////
////////////multi image///////////
Route::get('/multi/image', [BrandController::class, 'MultiImage'])->name('multi.image');
Route::post('/store/image', [BrandController::class, 'StoreImage'])->name('store.image');


/////////////////////////////////end///
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

       //$user=user::all();
       
       //$user=DB::table('users')->get();
     
        return view('admin.index');
    })->name('dashboard');
});
Route::get('/admin/logout', [BrandController::class, 'logout'])->name('admin.logout');
