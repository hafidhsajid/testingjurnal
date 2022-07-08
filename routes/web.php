<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductGalleryController as AdminProductGalleryController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\UserBaruController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\WithdrawController as AdminWithdrawController;
use App\Http\Controllers\API\testcontroller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListProductController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardWithdrawController;
use App\Http\Controllers\DashboardRefundController;
use App\Http\Controllers\Portofolio\BiodataController;
use App\Http\Controllers\Portofolio\KepanitiaanController;
use App\Http\Controllers\Portofolio\OrganisasiController;
use App\Http\Controllers\Portofolio\PendidikanController;
use App\Http\Controllers\Portofolio\ExperiencesController;
use App\Http\Controllers\Portofolio\ProjectsController;
use App\Http\Controllers\Portofolio\SkillController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/listproduct', [ListProductController::class, 'index'])->name('listproduct');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/{product}', [DetailController::class, 'add'])->name('detail-add');

Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');

Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [CartController::class, 'success'])->name('success');

Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');



Route::group(['middleware' => ['auth']], function(){

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::patch('/cart/{cart}', [CartController::class, 'updateQuantity'])->name('cart-update-quantity');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');

    Route::get('ongkir/{regencies_id}', [CartController::class, 'cekOngkir'])->name('api-cek-ongkir');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])->name('dashboard-product');
    Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])->name('dashboard-product-create');
    Route::post('/dashboard/products', [DashboardProductController::class, 'store'])->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', [DashboardProductController::class, 'details'])->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', [DashboardProductController::class, 'update'])->name('dashboard-product-update');
    Route::get('/dashboard/products/delete/{id}', [DashboardProductController::class, 'delete'])->name('dashboard-product-delete');

    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/setting', [DashboardSettingController::class, 'store'])->name('dashboard-setting-store');
    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-setting-account');
    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-setting-redirect');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'update'])->name('dashboard-transaction-update');


    Route::get('/dashboard/withdraw', [DashboardWithdrawController::class, 'index'])->name('dashboard-withdraw');
    Route::get('/dashboard/withdraw/create', [DashboardWithdrawController::class, 'create'])->name('dashboard-withdraw-create');
    Route::get('/dashboard/withdraw/edit/{id}', [DashboardWithdrawController::class, 'edit'])->name('dashboard-withdraw-edit');
    Route::post('/dashboard/withdraw', [DashboardWithdrawController::class, 'store'])->name('dashboard-withdraw-store');


    Route::get('/dashboard/refund', [DashboardRefundController::class, 'index'])->name('dashboard-refund');
    Route::get('/dashboard/refund/create', [DashboardRefundController::class, 'create'])->name('dashboard-refund-create');
    Route::get('/dashboard/refund/edit/{id}', [DashboardRefundController::class, 'edit'])->name('dashboard-refund-edit');
    Route::post('/dashboard/refund', [DashboardRefundController::class, 'store'])->name('dashboard-refund-store');

    Route::get('/portofolio/biodata/create', [BiodataController::class, 'create'])->name('portofolio-biodata-create');
    Route::post('portofolio/biodata', [BiodataController::class, 'store'])->name('portofolio-biodata-store');
    Route::get('/portfolio/biodata', [BiodataController::class, 'index'])->name('portfolio-biodata');

    Route::get('portofolio/kepanitiaan', [KepanitiaanController::class, 'index'])->name('portofolio-kepanitiaan');
    Route::get('/portofolio/kepanitiaan/create', [KepanitiaanController::class, 'create'])->name('portofolio-kepanitiaan-create');
    Route::post('portofolio/kepanitiaan', [KepanitiaanController::class, 'store'])->name('portofolio-kepanitiaan-store');
    Route::get('/portofolio/kepanitiaan/edit/{id}', [KepanitiaanController::class, 'edit'])->name('portofolio-kepanitiaan-edit');
    Route::post('/portofolio/kepanitiaan/{id}', [KepanitiaanController::class, 'update'])->name('portofolio-kepanitiaan-update');
    Route::post('/portofolio/kepanitiaan/delete/{id}', [KepanitiaanController::class, 'destroy'])->name('portofolio-kepanitiaan-delete');

    Route::get('/portofolio/organisasi/create', [OrganisasiController::class, 'create'])->name('portofolio-organisasi-create');
    Route::post('portofolio/organisasi', [OrganisasiController::class, 'store'])->name('portofolio-organisasi-store');
    Route::get('/portofolio/organisasi/edit/{id}', [OrganisasiController::class, 'edit'])->name('portofolio-organisasi-edit');
    Route::post('/portofolio/organisasi/{id}', [OrganisasiController::class, 'update'])->name('portofolio-organisasi-update');
    Route::post('/portofolio/organisasi/delete/{id}', [OrganisasiController::class, 'destroy'])->name('portofolio-organisasi-delete');

    Route::get('/portofolio/pendidikan/create', [PendidikanController::class, 'create'])->name('portofolio-pendidikan-create');
    Route::post('portofolio/pendidikan', [PendidikanController::class, 'store'])->name('portofolio-pendidikan-store');
    Route::get('/portofolio/pendidikan/edit/{id}', [PendidikanController::class, 'edit'])->name('portofolio-pendidikan-edit');
    Route::post('/portofolio/pendidikan/{id}', [PendidikanController::class, 'update'])->name('portofolio-pendidikan-update');
    Route::post('/portofolio/pendidikan/delete/{id}', [PendidikanController::class, 'destroy'])->name('portofolio-pendidikan-delete');

    Route::get('/portofolio/experiences/create', [ExperiencesController::class, 'create'])->name('portofolio-experiences-create');
    Route::post('portofolio/experiences', [ExperiencesController::class, 'store'])->name('portofolio-experiences-store');
    Route::get('/dashboard/experiences', [ExperiencesController::class, 'index'])->name('dashboard-experiences');
    Route::get('/dashboard/experiences/detail', [ExperiencesController::class, 'detail'])->name('dashboard-experience-details');
    Route::get('/portofolio/experiences/edit/{id}', [ExperiencesController::class, 'edit'])->name('portofolio-experiences-edit');
    Route::post('/portofolio/experiences/{id}', [ExperiencesController::class, 'update'])->name('portofolio-experiences-update');

    Route::get('/portofolio/projects/create', [ProjectsController::class, 'create'])->name('portofolio-projects-create');
    Route::post('portofolio/projects', [ProjectsController::class, 'store'])->name('portofolio-projects-store');
    Route::get('/portofolio/project/edit/{id}', [ProjectsController::class, 'edit'])->name('portofolio-project-edit');
    Route::post('/portofolio/project/{id}', [ProjectsController::class, 'update'])->name('portofolio-project-update');
    Route::post('/portofolio/project/delete/{id}', [ProjectsController::class, 'destroy'])->name('portofolio-project-delete');

    Route::get('/portofolio/skill/create', [SkillController::class, 'create'])->name('portofolio-skill-create');
    Route::post('portofolio/skill', [SkillController::class, 'store'])->name('portofolio-skill-store');

});


Route::prefix('admin')
    ->namespace('')
    ->middleware(['auth', 'admin'])
    ->group(function(){
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', AdminCategoryController::class);
        Route::resource('slider', AdminSliderController::class);
        Route::resource('user', AdminUserController::class);
        Route::resource('slider', AdminSliderController::class);
        Route::resource('product', AdminProductController::class);
        Route::resource('product-gallery', AdminProductGalleryController::class);
        Route::resource('transaction', AdminTransactionController::class);
        Route::resource('withdraw', AdminWithdrawController::class);

        //user baru
        Route::resource('user-baru', UserBaruController::class);
        Route::get('/user-baru/status/{id}/{status_code}', [UserBaruController::class, 'updateStatus'])->name('update-status-baru');
    });



Auth::routes();
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/test', [testcontroller::class, 'login']);
