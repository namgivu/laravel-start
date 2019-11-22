we base on Task guide ref. https://github.com/laravel/quickstart-basic
                      ref. https://laravel.com/docs/5.2/quickstart 
to study MVC in Laravel.


MVC model   `app/Task.php`

MVC view    `resources/views/tasks.blade.php`
            all views defined under folder `resources/views/`
            path under `resources/views/vvv.blade.php` is default to route handler method to render view `return view('vvv');`
            
MVC controller  `quickstart/app/Http/Controllers/TaskController.php`
                create the controller `php artisan make:controller TaskController`


# MVC controller & routes

## without controller
sample map `/` to a handler in `quickstart/routes/web.php`
```
Route::get('/', function () {
    return view('tasks');
});
```

## with controller
create the controller `php artisan make:controller TaskController`

map endpoint to handlers with controller
```
Route::get(     '/tasks',        'TaskController@index'   );
Route::post(    '/tasks',        'TaskController@store'   );
Route::delete(  '/tasks/{task}', 'TaskController@destroy' );
```


# MVC view syntax note
* `master template` aka `layout` defined at file `resources/views/layouts/MM.blade.php` - MM aka master-template
within the template, render the child/inheritor by 
```
@yield('content')
@yield('content2')
```


use/extend a template from a view
```
@extends('layouts.MM')

@section('content')
<!--child's content goes here-->
@endsection

@section('content2')
<!--child's content 2 goes here-->
@endsection
```


# ORM class for a db table**

## 00 `table tasks` mapped as `model class Task` 
let's say we have table :products in mysql/mariadb database
then we create the model class with below command - the model file will be created at `app/Product.php`
```
php artisan make:model Product
```


## 01 `table products` mapped as `model class SanPham` 
first call `php artisan make:model SanPham` 
then edit `app/Product.php` to add to the class this field to map the table name to the class
```
protected $table = "tasks";
```


# MVC model syntax note
**create**
$task = new Task;
$task->name = $request->name;
$task->save();

**read**
load the model
$tasks = Task::orderBy('created_at', 'asc')->get();
$tasks = Task::get();

pass model $tasks to the view
```
return view('tasks', [
    'tasks' => $tasks
]);
```

that model $tasks in Blade view 
```
@foreach ($tasks as $t)
    <div>{{ $t->name }}</div>
@endforeach
```
