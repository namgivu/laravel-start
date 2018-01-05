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
use Illuminate\Http\Request;


//region auth

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    //return view('welcome');
    return redirect('/home');
});

//endregion auth


////region Tasks

//region /tasks handlers

/*
 * read GET /tasks
 */
Route::get('/tasks', function (Request $request) {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('tasks', [
        'tasks' => $tasks
    ]);
});


/*
 * create POST /tasks
 */
Route::post('/tasks', function (Request $request) {
    //params validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    if ($validator->fails()) {
        return redirect('/tasks')
            ->withInput()
            ->withErrors($validator);
    }

    //create The Task
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/tasks');
});


/*
 * delete DELETE /tasks/{id}
 */
Route::delete('/tasks/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/tasks');
});

//endregion /tasks handlers


//region /breakdown-tasks handlers

/*
 * GET /breakdown-tasks
 */
Route::get('/breakdown-tasks', function (Request $request) {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('breakdown-tasks', ['tasks' => $tasks]);
});


/*
 * POST /breakdown-tasks
 */
Route::post('/breakdown-tasks', function (Request $request) {
    //params validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    if ($validator->fails()) {
        return redirect('/breakdown-tasks')
            ->withInput()
            ->withErrors($validator);
    }

    //create The Task
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/breakdown-tasks');
});


/*
 * DELETE /breakdown-tasks/{id}
 */
Route::delete('/breakdown-tasks/{id}', function ($id) {
    Task::findOrFail($id)->delete();
    return redirect('/breakdown-tasks');
});

//endregion /breakdown-tasks handlers

////endregion Tasks
