<?php

/*
|--------------------------------------------------------------------------
|  Login routes
|--------------------------------------------------------------------------*/

Route::get('/', array(
    'as'    =>  'home',
    'uses'  =>  'index@index'));
Route::get('/register', array(
    'as'    =>  'register',
    'uses'  =>  'login@register'
));
Route::post('/register', array(
    'uses'  =>  'login@register'
));

Route::post('/login', array(
    'uses'  =>  'login@login'
));

/*
|--------------------------------------------------------------------------
|  Project routes
|--------------------------------------------------------------------------*/
Route::get('/projects', array(
    'as'    =>  'projects',
    'uses'  =>  'project.main@index'
));

Route::get('/projects/single/project', array(
    'as'    =>  'single_project',
    'uses'  =>  'project.main@single'
));

Route::get('/projects/add_project', array(
    'as'    =>  'add_project',
    'uses'  =>  'project.main@addProject'
));

Route::get('/projects/remove_project', array(
    'as'    =>  'remove_project',
    'uses'  =>  'project.main@removeProject'
));

Route::post ('/projects/task_remove', array(
    'as'    =>  'remove_task',
    'uses'  =>  'project.task@removeTask'
));

Route::post('/projects/update', array(
    'uses'  =>  'project.main@updateProject'
));

Route::post('/projects/task_update', array(
    'uses'  =>  'project.task@updateTask'

));


Route::get('/projects/single/task', array(
    'as'    =>  'single_task',
    'uses'  =>  'project.task@single'
));

Route::post('/projects/task_tick', array(
    'uses'  =>  'project.task@tick'
));
/*
|--------------------------------------------------------------------------
|  Personal Cab routes
|--------------------------------------------------------------------------*/
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});