we base on Task guide ref. https://github.com/laravel/quickstart-basic
                      ref. https://laravel.com/docs/5.2/quickstart 
to study MVC in Laravel.


MVC model   `app/Task.php`

MVC view    `resources/views/tasks.blade.php`
            all views defined under folder `resources/views/`
            path under `resources/views/vvv.blade.php` is default to route handler method to render view `return view('vvv');`

# MVC controller & routes
without controller
sample map `/` to a handler in `quickstart/routes/web.php`
```
Route::get('/', function () {
    return view('tasks');
});
```

with controller
create the controller
`php artisan make:controller TaskController`
map endpoint to handlers with controller
```
Route::get(     '/tasks',       'TaskController@index'   );
Route::post(    '/task',        'TaskController@store'   );
Route::delete(  '/task/{task}', 'TaskController@destroy' );
```

# view syntax note
* define `master template` aka `layout`
defined at file `resources/views/layouts/MMM.blade.php` - MMM aka master-template-MMM
within the template, render the child/inheritor by 
`@yield('content')`


use/extend a template from a view
```
@extends('layouts.MMM')

@section('content')
<!--child's content goes here-->
@endsection
```

# model syntax note
**create**
$task = new Task;
$task->name = $request->name;
$task->save();

**read**
load the model
$tasks = Task::orderBy('created_at', 'asc')->get();
$tasks = Task->get();

pass model $tasks to the view
```
return view('tasks', [
    'tasks' => $tasks
]);
```

that model $tasks in Blade view 
```
@foreach ($tasks as $task)
    <div>{{ $task->name }}</div>
@endforeach
```
