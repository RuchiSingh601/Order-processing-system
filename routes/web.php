<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShadeController;
use App\Http\Controllers\PatternController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\EmbroideryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderItemController;

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');


// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

// Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
// Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
// Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');


// authentication
Route::get('/login', [LoginBasic::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginBasic::class, 'login'])->name('login.perform');

// Route::middleware(['auth', 'is_admin'])->group(function () {
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');


Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

Route::get('/logout', [LoginBasic::class, 'logout'])->name('logout');

Route::get('/', [LoginBasic::class, 'show'])->middleware('auth')->name('/');

// Dashboard route
Route::get('/dashboard', [Analytics::class, 'index'])->middleware('auth')->name('dashboard-analytics');
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
Route::get('/warehouse/dashboard', [WarehouseController::class, 'index'])->name('warehouse.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    
});


Route::get('/shades', [ShadeController::class, 'index'])->name('shades.index');
Route::get('shades/create', [ShadeController::class, 'create'])->name('shades.create');
Route::post('shades', [ShadeController::class, 'store'])->name('shades.store');
Route::resource('shades', ShadeController::class);

Route::get('/Patterns', [PatternController::class, 'index'])->name('Patterns.index');
Route::get('Patterns/create', [PatternController::class, 'create'])->name('Patterns.create');
Route::post('Patterns', [PatternController::class, 'store'])->name('Patterns.store');
Route::resource('Patterns', PatternController::class);

 Route::get('/Sizes', [SizeController::class, 'index'])->name('Sizes.index');
 Route::get('Sizes/create', [SizeController::class, 'create'])->name('Sizes.create');
 Route::post('Sizes', [SizeController::class, 'store'])->name('Sizes.store');
 Route::resource('Sizes', SizeController::class);

 Route::get('/embroideries', [EmbroideryController::class, 'index'])->name('embroideries.index');
 Route::get('embroideries/create', [EmbroideryController::class, 'create'])->name('embroideries.create');
 Route::post('embroideries', [EmbroideryController::class, 'store'])->name('embroideries.store');
 Route::resource('embroideries', EmbroideryController::class);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::resource('products', ProductController::class);

Route::resource('items', ItemController::class);
Route::get('/items', [OrderItemController::class, 'index']);

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/order', [OrderController::class, 'create'])->name('order.create');     
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::resource('order', OrderController::class);

Route::get('/items', [OrderItemController::class, 'index']);

Route::resource('warehouses', WarehouseController::class);