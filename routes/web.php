<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ProcurementController;
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
use App\Http\Controllers\Admin\ContactController as AdminContactController;

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

// Procurements Routes
Route::get('/procurements', [ProcurementController::class, 'index'])->name('procurements.index');
Route::get('/procurements/{procurement}', [ProcurementController::class, 'show'])->name('procurements.show');
Route::get('/procurements/download/{procurement}', [ProcurementController::class, 'download'])->name('procurements.download');

// Flood Forecast Dashboard
Route::get('/flood-forecast-dashboard', [FloodForecastDashboardController::class, 'index'])->name('flood-forecast-dashboard');
Route::get('/flood-forecast-dashboard/api/data', [FloodForecastDashboardController::class, 'apiData'])->name('flood-forecast-dashboard.api.data');
Route::get('/flood-forecast-dashboard/export', [FloodForecastDashboardController::class, 'export'])->name('flood-forecast-dashboard.export');

// Interactive map page
Route::get('/map', function () {
    return view('map-test');
})->name('map');

// Redirect old flood-data route to admin
Route::redirect('/flood-data', '/admin/flood-data');

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

    // Admin Procurements Management
    Route::get('procurements', [ProcurementController::class, 'adminIndex'])->name('procurements.index');
    Route::get('procurements/create', [ProcurementController::class, 'create'])->name('procurements.create');
    Route::post('procurements', [ProcurementController::class, 'store'])->name('procurements.store');
    Route::get('procurements/{procurement}/edit', [ProcurementController::class, 'edit'])->name('procurements.edit');
    Route::put('procurements/{procurement}', [ProcurementController::class, 'update'])->name('procurements.update');
    Route::delete('procurements/{procurement}', [ProcurementController::class, 'destroy'])->name('procurements.destroy');

    // Admin Flood Data Management
    Route::get('/flood-data', [FloodDataController::class, 'index'])->name('flood-data.index');
    Route::get('/flood-data/{year}', [FloodDataController::class, 'byYear'])->name('flood-data.by-year');
    Route::get('/flood-data/{year}/{state}', [FloodDataController::class, 'byState'])->name('flood-data.by-state');
    Route::resource('flood-data', FloodDataController::class)->except(['show', 'index']);

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

    // Admin Contact Messages Management
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::post('/contacts/{contact}/mark-read', [AdminContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::post('/contacts/{contact}/mark-unread', [AdminContactController::class, 'markAsUnread'])->name('contacts.mark-unread');
    Route::post('/contacts/bulk-mark-read', [AdminContactController::class, 'bulkMarkAsRead'])->name('contacts.bulk-mark-read');
    Route::post('/contacts/bulk-mark-unread', [AdminContactController::class, 'bulkMarkAsUnread'])->name('contacts.bulk-mark-unread');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts/bulk-delete', [AdminContactController::class, 'bulkDestroy'])->name('contacts.bulk-delete');
});

// Debug route to check publications
Route::get('/debug-publications', function() {
    $publications = App\Models\Publication::all();
    return response()->json([
        'count' => $publications->count(),
        'publications' => $publications->map(function($pub) {
            return [
                'id' => $pub->id,
                'title' => $pub->title,
                'type' => $pub->type,
                'year' => $pub->year,
                'is_featured' => $pub->is_featured,
                'publication_date' => $pub->publication_date
            ];
        })
    ]);
});
