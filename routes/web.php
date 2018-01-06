<?php

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

use App\Task;
use App\BasicTask;
use Illuminate\Http\Request;


//region auth

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    //return view('welcome');
    return redirect('/home');
});

//endregion auth


////region Basic Tasks

//region /basic-tasks handlers

/*
 * read GET /basic-tasks
 */
Route::get('/basic-tasks', function (Request $request) {
    $tasks = BasicTask::orderBy('created_at', 'asc')->get();
    return view('basic-tasks.tasks', [
        'tasks' => $tasks
    ]);
});


/*
 * create POST /basic-tasks
 */
Route::post('/basic-tasks', function (Request $request) {
    //params validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    if ($validator->fails()) {
        return redirect('/basic-tasks')
            ->withInput()
            ->withErrors($validator);
    }

    //create The Task
    $task = new BasicTask;
    $task->name = $request->name;
    $task->save();

    return redirect('/basic-tasks');
});


/*
 * delete DELETE /basic-tasks/{id}
 */
Route::delete('/basic-tasks/{id}', function ($id) {
    BasicTask::findOrFail($id)->delete();
    return redirect('/basic-tasks');
});

//endregion /basic-tasks handlers


//region /breakdown-tasks handlers

/*
 * GET /breakdown-tasks
 */
Route::get('/basic-tasks-breakdown', function (Request $request) {
    $tasks = BasicTask::orderBy('created_at', 'asc')->get();
    return view('basic-tasks.breakdown-tasks', [
        'tasks' => $tasks
    ]);
});


/*
 * POST /basic-tasks-breakdown
 */
Route::post('/basic-tasks-breakdown', function (Request $request) {
    //params validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    if ($validator->fails()) {
        return redirect('/basic-tasks-breakdown')
            ->withInput()
            ->withErrors($validator);
    }

    //create The Task
    $task = new BasicTask;
    $task->name = $request->name;
    $task->save();

    return redirect('/basic-tasks-breakdown');
});


/*
 * DELETE /basic-tasks-breakdown/{id}
 */
Route::delete('/basic-tasks-breakdown/{id}', function ($id) {
    BasicTask::findOrFail($id)->delete();
    return redirect('/basic-tasks-breakdown');
});

//endregion /basic-tasks-breakdown handlers

////endregion Tasks
