<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ApprovalController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Media\MediaController;



        Route::group(
            [
                'prefix' => 'gallery',
                'as' => 'media.',
            ],
            function () {
                Route::get('/', [MediaController::class, 'index'])->name('index');
            }
        );

//        Route::group(
//            [
//                'prefix' => 'users',
//                'as' => 'users.',
//            ],
//            function () {
//                Route::get('/list', [UserController::class, 'list'])->name('list');
//                Route::get('/users', [UserController::class, 'users'])->name('users');
//                Route::get('/view/{id}', [UserController::class, 'view'])->name('view');
//                Route::get('/add', [UserController::class, 'add'])->name('add');
//                Route::post('/save', [UserController::class, 'save'])->name('save');
//
//                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
//                Route::get('/leaves/{id}', [UserController::class, 'leaves'])->name('leaves');
//                Route::get('/attendance/{id}', [UserController::class, 'attendance'])->name('attendance');
//                Route::get('/evaluation/{id}', [UserController::class, 'evaluation'])->name('evaluation');
//                Route::get('/salaries/{id}', [UserController::class, 'salaries'])->name('salaries');
//
//                Route::get('/security', [UserController::class, 'security'])->name('security');
//                Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
//
//
//
//                Route::group(
//                    [
//                        'prefix' => 'approvals',
//                        'as' => 'approvals.',
//                    ],
//                    function () {
//                        Route::get('/', [ApprovalController::class, 'index'])->name('index');
//                        Route::get('/create', [ApprovalController::class, 'create'])->name('create');
//                        Route::get('/view/{id}', [ApprovalController::class, 'view'])->name('view');
//                        Route::post('/save', [ApprovalController::class, 'save'])->name('save');
//                    }
//                );
//            }
//        );
