<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::group(['as' => 'schedules.', 'prefix' => 'schedules'], function () {
//     Route::get('/', [App\Http\Controllers\SchedulesController::class, 'index'])->name('index');
//     Route::get('/{line}', [App\Http\Controllers\SchedulesController::class, 'busstops'])->name('busstops');
//     Route::get('/{line}/{busstops}', [App\Http\Controllers\SchedulesController::class, 'busstops'])->name('busstops');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); //strona główna panelu
    Route::group(['as' => 'manager.', 'prefix' => 'manager'], function () {
        // Route::get('/', [App\Http\Controllers\Manager\ManagerController::class, 'index'])->name('index');
        // Route::get('/admin', [App\Http\Controllers\Manager\ManagerController::class, 'admin'])->name('admin');
        // Route::get('/transport-department', [App\Http\Controllers\Manager\ManagerController::class, 'carriage'])->name('transport-department');
        // Route::get('/hr', [App\Http\Controllers\Manager\ManagerController::class, 'staff'])->name('staff');
        // Route::get('/traffic-supervision', [App\Http\Controllers\Manager\ManagerController::class, 'supervision'])->name('traffic-supervision');
        // Route::get('/control-room', [App\Http\Controllers\Manager\ManagerController::class, 'controlroom'])->name('control-room');
        // Route::get('/workshop', [App\Http\Controllers\Manager\ManagerController::class, 'workshop'])->name('workshop');

        // //Role Management
        // Route::group(['namespace' => 'Role', 'as' => 'roles.'], function () {
        //     Route::get('roles', [App\Http\Controllers\RoleController::class, 'index'])->name('index');
        //     Route::get('roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('create');
        //     Route::post('roles', [App\Http\Controllers\RoleController::class, 'store'])->name('store');

        //     Route::group(['prefix' => 'role/{role}'], function () {
        //         Route::get('edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('edit');
        //         Route::put('/', [App\Http\Controllers\RoleController::class, 'update'])->name('update');
        //         Route::delete('/', [App\Http\Controllers\RoleController::class, 'destroy'])->name('destroy');
        //     });
        // });


        // // Permission Management
        // Route::group(['namespace' => 'Permission', 'as' => 'perms.'], function () {
        //     //Route::resource('permission', App\Http\Controllers\PermissionsController::class);
        //     Route::get('permissions', [App\Http\Controllers\PermissionsController::class, 'index'])->name('index');
        //     Route::get('permissions/create', [App\Http\Controllers\PermissionsController::class, 'create'])->name('create');
        //     Route::post('permissions', [App\Http\Controllers\PermissionsController::class, 'store'])->name('store');

        //     Route::group(['prefix' => 'permissions/{permission}'], function () {
        //         Route::get('edit', [App\Http\Controllers\PermissionsController::class, 'edit'])->name('edit');
        //         Route::patch('/', [App\Http\Controllers\PermissionsController::class, 'update'])->name('update');
        //         Route::delete('/', [App\Http\Controllers\PermissionsController::class, 'destroy'])->name('destroy');
        //     });

        //     Route::group(['prefix' => 'permissions/', 'as' => 'module.'], function () {
        //         //Route::resource('permission', App\Http\Controllers\PermissionsController::class);
        //         Route::get('module', [App\Http\Controllers\PermissionModuleController::class, 'index'])->name('index');
        //         Route::get('module/create', [App\Http\Controllers\PermissionModuleController::class, 'create'])->name('create');
        //         Route::post('module', [App\Http\Controllers\PermissionModuleController::class, 'store'])->name('store');

        //         Route::group(['prefix' => 'permissions/module/{module}'], function () {
        //             Route::get('edit', [App\Http\Controllers\PermissionModuleController::class, 'edit'])->name('edit');
        //             Route::patch('/', [App\Http\Controllers\PermissionModuleController::class, 'update'])->name('update');
        //         });
        //     });
        // });

        // Routes
        Route::group(['prefix'=>'admin', 'as' => 'users.'], function () {
            Route::group(['prefix' => 'users', 'controller' => 'App\Http\Controllers\Backend\Auth\User\UserController'], function () {
                Route::get('/', 'index')->name('list');
                Route::get('card', 'card')->name('card');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
            });
            // log in as
            Route::get('user/switch/start/{id}', [App\Http\Controllers\Backend\Auth\User\UserAccessController::class, 'user_switch_start'])->name('admin.user.switch-start');
            Route::get('user/switch/stop', [App\Http\Controllers\Backend\Auth\User\UserAccessController::class, 'user_switch_stop'])->name('admin.user.switch-stop');
            
            Route::group(['prefix' => 'user/{user}'], function () {
                // User
                Route::controller(App\Http\Controllers\Backend\Auth\User\UserController::class)->group(function() {
                    Route::get('/', 'show')->name('user.show');
                    Route::get('edit', 'edit')->name('user.edit');
                    Route::patch('/', 'update')->name('user.update');
                    Route::delete('/', 'destroy')->name('user.destroy');
                });
                // // Account
                // Route::get('account/confirm/resend', [UserConfirmationController::class, 'sendConfirmationEmail'])->name('user.account.confirm.resend');
                // // Status
                // Route::get('mark/{status}', [UserStatusController::class, 'mark'])->name('user.mark')->where(['status' => '[0,1]']);              
                // // Confirmation
                // Route::get('confirm', [UserConfirmationController::class, 'confirm'])->name('user.confirm');
                // Route::get('unconfirm', [UserConfirmationController::class, 'unconfirm'])->name('user.unconfirm');                
                // // Password
                // Route::get('password/change', [UserPasswordController::class, 'edit'])->name('user.change-password');
                // Route::patch('password/change', [UserPasswordController::class, 'update'])->name('user.change-password.post');                
                // // log in as
                // Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');                
                // // Session
                // Route::get('clear-session', [UserSessionController::class, 'clearSession'])->name('user.clear-session');                
                // // Deleted
                // Route::delete('delete-permanently', [UserStatusController::class, 'delete'])->name('user.delete-permanently');
                // Route::post('restore', [UserStatusController::class, 'restore'])->name('user.restore');
            });
        });
    });
});