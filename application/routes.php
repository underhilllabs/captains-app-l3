<?php

Route::get('/', function() {
	return View::make('home.index');
  #return "Why not, Zoidbergr?";
});

Route::get('api/captains', function() {
  $callback = Input::get("callback");
  return $callback . '(' .Response::eloquent(Captain::all()).')';
});

Route::get('api/captain/(:num)', function($id) {
  return Response::eloquent(Captain::find($id));
});

Route::post('api/captain', function() {
  $data = Input::json();
  $cap = new Captain;
  $dname=$data->name;
  $cap->name = $data->name;
  $cap->source = $data->source;
  $cap->imgUrl = $data->imgUrl;
  $cap->idx =  $data->idx;
  $cap->votes = 1;
  $cap->save();
  return "Why not, Zoidberg? Well, " . $data->name;
  #return Response::eloquent(Captain::find($cap->id));
});
#Route::post('api/captain', 'CaptainController@createCaptain');

Route::put('api/captain/(:num)', function($id) {
  // js id starts at 0, db starts at 1.
  $id += 1;
  $c = Captain::find($id);
  $data = Input::json();
  $c->votes = $data->votes;
  $c->save();
  var_dump($data);
  return "Why not, Zoidberg? Well, " . $c->name . " he's got votes: " .$data->votes;
});
#Route::put('api/captain/(:num)', 'CaptainController@updateCaptain');

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
