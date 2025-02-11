<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAuth;
use Illuminate\Support\Facades\Route;

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

Route::controller(UserController::class)
    ->group(function () {
        Route::get('/', 'login')->name('login.landing');
        Route::post('/', 'loginStore')->name('login.store');
        Route::get('/kayitol', 'register')->name('registe.landing');
        Route::post('/kayitol', 'registerStore')->name('registe.store');
        Route::get('cikisyap', 'logout')->name('user.logout');

    });

Route::controller(TaskController::class)
    ->middleware(isAuth::class)
    ->group(function () {
        Route::get('yapilacaklar', 'allTasks')->name('task.landing');
        Route::get('yapilacaklar/ekle', 'taskCreate')->name('task.create');
        Route::post('yapilacaklar/ekle', 'taskCreateStore')->name('task.create.store');
        Route::get('yapilacaklar/sil/{id}', 'taskDelete')->name('task.delete');
        Route::get('yapilacaklar/düzenle/{id}', 'taskEdit')->name('task.edit.landing');
        Route::post('yapilacaklar/düzenle', 'taskEditStore')->name('task.edit.store');
        Route::get('yapilacaklar/tamamla/{id}', 'taskComplate')->name('task.complate');
    }); 