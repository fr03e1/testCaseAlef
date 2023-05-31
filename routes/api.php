<?php

declare(strict_types=1);

use App\Http\Controllers\Api\v1\GroupController;
use App\Http\Controllers\Api\v1\LectureController;
use App\Http\Controllers\Api\v1\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'v1'],function () {
    Route::controller(StudentController::class)->group(function () {
        Route::get('/students','index');
        Route::get('/students/{student}','show');
        Route::post('/students','store');
        Route::patch('/students/{student}','update');
        Route::delete('/students/{student}','delete');
    });

    Route::controller(GroupController::class)->group(function () {
        Route::get('/groups','index');
        Route::get('/groups/{group}','show');
        Route::post('/groups','store');
        Route::get('/groups/lectures/{groups}','lectures');
        Route::post('/groups/lectures','storeStudyPlan');
        Route::patch('/groups/{group}','update');
        Route::delete('/groups/{group}','delete');
    });

    Route::controller(LectureController::class)->group(function () {
        Route::get('/lectures','index');
        Route::get('/lectures/{lecture}','show');
        Route::post('/lectures','store');
        Route::patch('/lectures/{lecture}','update');
        Route::delete('/lectures/{lecture}','delete');
    });
});
