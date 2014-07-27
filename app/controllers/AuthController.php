<?php

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function getLogin()
	{
		return View::make('auth/login');
	}

	public function postLogin()
	{
		$credentials = Input::only('email', 'password');
	    
	    if (Auth::attempt($credentials, $remember = true)) {
	        return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
	    }
	    else {
	        return Redirect::to('auth/login')->with('flash_message', 'Log in failed; please try again.');
	    }
	    
	    return Redirect::to('auth/login');
	}

}
