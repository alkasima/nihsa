<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\FloodDataController;
use App\Http\Controllers\ZonalOfficeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DataRequestController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FloodForecastDashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ReportsController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Language switching route
Route::get('/lang/{locale}', function ($locale) {
    if (array_key_exists($locale, config('app.available_locales', []))) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch')->middleware(\App\Http\Middleware\LocaleMiddleware::class);

// Redirect /home to admin dashboard
Route::redirect('/home', '/admin/dashboard');

// Search Route
Route::get('/search', [HomeController::class, 'search'])->name('search');

// About Routes
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about/functions', [AboutController::class, 'functions'])->name('about.functions');
Route::get('/about/management', [AboutController::class, 'management'])->name('about.management');
Route::get('/about/structure', [AboutController::class, 'structure'])->name('about.structure');
Route::get('/about/offices', [AboutController::class, 'offices'])->name('about.offices');
Route::get('/about/history', [AboutController::class, 'history'])->name('about.history');

// News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// Publications Routes
Route::get('/publications', [PublicationController::class, 'index'])->name('publications.index');
Route::get('/publications/{publication}', [PublicationController::class, 'show'])->name('publications.show');
Route::get('/publications/download/{publication}', [PublicationController::class, 'download'])->name('publications.download');

// Flood Forecast Dashboard
Route::get('/flood-forecast-dashboard', [FloodForecastDashboardController::class, 'index'])->name('flood-forecast-dashboard');
Route::get('/flood-forecast-dashboard/api/data', [FloodForecastDashboardController::class, 'apiData'])->name('flood-forecast-dashboard.api.data');
Route::get('/flood-forecast-dashboard/export', [FloodForecastDashboardController::class, 'export'])->name('flood-forecast-dashboard.export');

// Interactive map page
Route::get('/map', function () {
    return view('map-test');
})->name('map');
Route::get('/flood-data', [FloodDataController::class, 'index'])->name('flood-data.index');
Route::get('/flood-data/{year}', [FloodDataController::class, 'byYear'])->name('flood-data.by-year');
Route::get('/flood-data/{year}/{state}', [FloodDataController::class, 'byState'])->name('flood-data.by-state');

// Zonal Offices
Route::get('/zonal-offices', [ZonalOfficeController::class, 'index'])->name('zonal-offices.index');
Route::get('/zonal-offices/{zonalOffice}', [ZonalOfficeController::class, 'show'])->name('zonal-offices.show');

// Partners
Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Products Routes
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');

// Services Routes
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServicesController::class, 'show'])->name('services.show');

// Data Request
Route::get('/data-request', [DataRequestController::class, 'create'])->name('data-request.create');
Route::post('/data-request', [DataRequestController::class, 'store'])->name('data-request.store');
Route::get('/data-request/success', [DataRequestController::class, 'success'])->name('data-request.success');

// Authentication Routes
Auth::routes();

// Admin Routes (Protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Admin News Management
    Route::get('news', [NewsController::class, 'adminIndex'])->name('news.index');
    Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('news', [NewsController::class, 'store'])->name('news.store');
    Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    // Admin Publications Management
    Route::get('publications', [PublicationController::class, 'adminIndex'])->name('publications.index');
    Route::get('publications/create', [PublicationController::class, 'create'])->name('publications.create');
    Route::post('publications', [PublicationController::class, 'store'])->name('publications.store');
    Route::get('publications/{publication}/edit', [PublicationController::class, 'edit'])->name('publications.edit');
    Route::put('publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');
    Route::delete('publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');

    // Admin Flood Data Management
    Route::resource('flood-data', FloodDataController::class)->except(['show']);

    // Admin Zonal Offices Management
    Route::resource('zonal-offices', ZonalOfficeController::class)->except(['show']);

    // Admin Partners Management
    Route::resource('partners', PartnerController::class)->except(['show']);

    // Admin Data Requests Management
    Route::resource('data-requests', DataRequestController::class)->except(['create', 'store']);
    Route::post('/data-requests/{dataRequest}/approve', [DataRequestController::class, 'approve'])->name('data-requests.approve');
    Route::post('/data-requests/{dataRequest}/reject', [DataRequestController::class, 'reject'])->name('data-requests.reject');

    // Admin User Management
    Route::resource('users', UserController::class);

    // Admin Settings Management
    Route::get('/settings/general', [SettingsController::class, 'general'])->name('settings.general');
    Route::post('/settings/general', [SettingsController::class, 'updateGeneral'])->name('settings.general.update');
    Route::get('/settings/appearance', [SettingsController::class, 'appearance'])->name('settings.appearance');
    Route::post('/settings/appearance', [SettingsController::class, 'updateAppearance'])->name('settings.appearance.update');
    Route::get('/settings/email', [SettingsController::class, 'email'])->name('settings.email');
    Route::post('/settings/email', [SettingsController::class, 'updateEmail'])->name('settings.email.update');
    Route::get('/settings/email/template/{id}', [SettingsController::class, 'editEmailTemplate'])->name('settings.email.template.edit');
    Route::post('/settings/email/template/{id}', [SettingsController::class, 'updateEmailTemplate'])->name('settings.email.template.update');
    Route::get('/settings/system', [SettingsController::class, 'system'])->name('settings.system');
    Route::post('/settings/system', [SettingsController::class, 'updateSystem'])->name('settings.system.update');

    // Admin Reports Management
    Route::get('/reports/analytics', [ReportsController::class, 'analytics'])->name('reports.analytics');
    Route::get('/reports/flood-data', [ReportsController::class, 'floodData'])->name('reports.flood-data');
    Route::get('/reports/downloads', [ReportsController::class, 'downloads'])->name('reports.downloads');
    Route::post('/reports/generate', [ReportsController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/download/{id}', [ReportsController::class, 'download'])->name('reports.download');
});
