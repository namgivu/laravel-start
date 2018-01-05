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

Route::get('/', function () {
    return view('welcome');
});


//region /task handlers

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

//endregion /task handlers
