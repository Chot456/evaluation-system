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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('department', 'App\Http\Controllers\DepartmentController');
Route::apiResource('questionaire', 'App\Http\Controllers\QuestionaireController');
Route::apiResource('questionaireCategory', 'App\Http\Controllers\QuestionaireCategoryController');
Route::get('questionaire/userType/{id}', 'App\Http\Controllers\QuestionaireController@getQuestionaireByUserType');

Route::get('getRecordsToEvaluate/{studentId}', 'App\Http\Controllers\StudentController@getRecordsToEvaluate');

Route::get('student/transaction/{id}/{subjCode}', 'App\Http\Controllers\StudentController@studentTransaction');

Route::apiResource('student', 'App\Http\Controllers\StudentController');
Route::apiResource('user-type', 'App\Http\Controllers\UserTypeController');
Route::apiResource('subject', 'App\Http\Controllers\SubjectController');
Route::apiResource('course', 'App\Http\Controllers\CourseController');
Route::apiResource('question-category', 'App\Http\Controllers\questionaireCategoryController');
Route::apiResource('evaluation', 'App\Http\Controllers\EvaluationController');
Route::apiResource('evaluation-summary', 'App\Http\Controllers\EvaluationSummaryController');
Route::apiResource('year', 'App\Http\Controllers\YearController');
Route::apiResource('section', 'App\Http\Controllers\SectionController');
Route::apiResource('faculty', 'App\Http\Controllers\FacultyController');

Route::apiResource('employee', 'App\Http\Controllers\EmployeeController');
Route::get('employee/userType/{user_type_id}', 'App\Http\Controllers\EmployeeController@getEmployeeByUserType');
Route::get('employee/userType/{id}/{user_type_id}', 'App\Http\Controllers\EmployeeController@getEmployeeByIdUserType');
Route::get('employee/number/{empN}', 'App\Http\Controllers\EmployeeController@getEmployeeByEmpNumber');


Route::get('user', 'App\Http\Controllers\UserController@getUser');
Route::get('user/{id}', 'App\Http\Controllers\UserController@getUserById');
Route::get('getUserByRole/{role}', 'App\Http\Controllers\UserController@getUserByRole');
Route::post('createUser', 'App\Http\Controllers\UserController@createUser');
Route::put('updateUser/{id}', 'App\Http\Controllers\UserController@updateUser');

<<<<<<< HEAD
Route::get('Session', 'App\Http\Controllers\UserController@getSession');
Route::get('logout', 'App\Http\Controllers\UserController@logout');

Route::get('getSession', function() {
=======

Route::get('getSession', 'App\Http\Controllers\UserController@getSession');

Route::get('session', function() {
>>>>>>> fe6b6db0e9009f8e5b5f29c4dee3ea17e35a5f0e
    
    if(session()->has('LoggedUser')) {
        return session('LoggedUser');
    }
   
    // Get the currently authenticated user's ID...
    // $id = Auth::id();

    // // Get the currently authenticated user...
    // return Auth::user();
});