<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('check', function () {
        return 'team-data is OK';
    });

    Route::group(['prefix' => 'employees', 'namespace' => 'Employee'], function () {
        Route::get('/', [
            'uses' => 'EmployeeController@findEmployees',
            'as' => 'api.employees.find'
        ]);
    });

    Route::group(['prefix' => 'grades', 'namespace' => 'Grade'], function () {
        Route::get('/', [
            'uses' => 'GradeController@findGrades',
            'as' => 'api.grades.find'
        ]);
    });

    Route::group(['prefix' => 'positions', 'namespace' => 'Position'], function () {
        Route::get('/', [
            'uses' => 'PositionController@findPositions',
            'as' => 'api.positions.find'
        ]);
    });
});
