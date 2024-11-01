<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationDataController;
use App\Http\Controllers\Admin\ComplaintSuggestionController;
use App\Http\Controllers\Admin\ContactDetailsController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\HeaderImageController;
use App\Http\Controllers\Admin\AboutImageController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\PricingPackageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordManager;


// Admin Login Routes
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('/admin/profile/password/update', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.password.update');

});

use App\Http\Controllers\LanguageController;

Route::get('/set-language/{locale}', [LanguageController::class, 'setLanguage'])->name('set.language');



Route::get('/forget-password', [ForgotPasswordManager::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [ForgotPasswordManager::class, 'forgetPasswordPost'])->name('forget.password.post');

Route::get('/reset-password/{token}', [ForgotPasswordManager::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [ForgotPasswordManager::class, 'resetPasswordPost'])->name('reset.password.post');


// Admin Panel (Middleware ile korunuyor)
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/reservation.data', [ReservationDataController::class, 'index'])->name('admin.reservation');

// Admin Blog Routes
Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
Route::post('/admin/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
Route::get('/admin/blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
Route::put('/admin/blogs/{blog}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
Route::delete('/admin/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');

Route::post('/reservations/{id}/accept', [ReservationDataController::class, 'accept'])->name('reservations.accept');
Route::post('/reservations/{id}/reject', [ReservationDataController::class, 'reject'])->name('reservations.reject');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('comments', AdminCommentController::class)->only(['index', 'destroy']);
});


// More Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.home');
    Route::get('/reservation.data', [ReservationDataController::class, 'index'])->name('admin.reservation');
});
//Header Route
Route::resource('header_images', HeaderImageController::class);

//About Route
Route::resource('about_images', AboutImageController::class);

Route::get('/admin/pages/contact-details', [ContactDetailsController::class, 'index'])->name('admin.contact-details.index');
Route::put('/admin/pages/contact-details', [ContactDetailsController::class, 'update'])->name('admin.contact-details.update');// Frontend Routes
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');


Route::post('/contact', [ContactController::class, 'storeContactForm'])->name('contact.store');
Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{id}/blog_comment', [BlogController::class, 'store'])->name('comment.store');



// Frontend Contact Details View
Route::get('/front/contact-details', [ContactController::class, 'contact'])->name('contact.details');

// Admin Contact Details Routes
Route::prefix('admin')->group(function () {
    Route::get('/contact-details', [ContactDetailsController::class, 'index'])->name('admin.contact-details.index');
    Route::put('/contact-details', [ContactDetailsController::class, 'update'])->name('admin.contact-details.update');
    Route::get('/contact', [ComplaintSuggestionController::class, 'showMessages'])->name('admin.contact.show');
    Route::post('/contact/store', [ComplaintSuggestionController::class, 'storeContactForm'])->name('admin.contact.store');
    Route::delete('contact/{id}/delete', [ComplaintSuggestionController::class, 'destroy'])->name('admin.contact.delete');
});
Route::prefix('admin')->group(function () {
    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('/gallery/create', [AdminGalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('/gallery/{id}/edit', [AdminGalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::put('/gallery/{id}', [AdminGalleryController::class, 'update'])->name('admin.gallery.update');  // Add this line
    Route::delete('/gallery/{id}', [AdminGalleryController::class, 'destroy'])->name('admin.gallery.destroy');
});

//Slider Routes
Route::prefix('admin')->group(function () {
    Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::get('sliders/create', [SliderController::class, 'create'])->name('sliders.create');
    Route::post('sliders', [SliderController::class, 'store'])->name('sliders.store');
    Route::get('sliders/{slider}', [SliderController::class, 'show'])->name('sliders.show');
    Route::get('sliders/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
    Route::put('sliders/{slider}', [SliderController::class, 'update'])->name('sliders.update');
    Route::delete('sliders/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
});










Route::prefix('admin/pricing')->name('pricing.')->group(function() {
    Route::get('/', [PricingPackageController::class, 'index'])->name('index');
    Route::get('/create', [PricingPackageController::class, 'create'])->name('create');
    Route::post('/store', [PricingPackageController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PricingPackageController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PricingPackageController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PricingPackageController::class, 'destroy'])->name('destroy');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('services', ServiceController::class);
});


Route::get('/chatbot', [ChatBotController::class, 'index']);


Route::post('/reservations', [ReservationDataController::class, 'storeReservation'])->name('reservation.store');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



