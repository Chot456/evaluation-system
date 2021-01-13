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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('department', 'App\Http\Controllers\DepartmentController');
Route::apiResource('questionaire', 'App\Http\Controllers\QuestionaireController');
Route::apiResource('questionaireCategory', 'App\Http\Controllers\QuestionaireCategoryController');
Route::get('questionaire/userType/{id}', 'App\Http\Controllers\QuestionaireController@getQuestionaireByUserType');

Route::get('getRecordsToEvaluate', 'App\Http\Controllers\StudentController@getRecordsToEvaluate');

Route::apiResource('student', 'App\Http\Controllers\StudentController');
Route::apiResource('user-type', 'App\Http\Controllers\UserTypeController');
Route::apiResource('subject', 'App\Http\Controllers\SubjectController');
Route::apiResource('course', 'App\Http\Controllers\CourseController');
Route::apiResource('question-category', 'App\Http\Controllers\questionaireCategoryController');
Route::apiResource('evaluation', 'App\Http\Controllers\EvaluationController');
Route::apiResource('evaluation-summary', 'App\Http\Controllers\EvaluationSummaryController');
Route::apiResource('year', 'App\Http\Controllers\YearController');
Route::apiResource('section', 'App\Http\Controllers\SectionController');

Route::apiResource('employee', 'App\Http\Controllers\EmployeeController');

Route::get('session', function() {
    
    // Get the currently authenticated user's ID...
    $id = Auth::id();

    // Get the currently authenticated user...
    return Auth::user();


});