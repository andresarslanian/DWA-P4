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

	public function getLogin()
	{
		return View::make('auth/login');
	}

	public function postLogin()
	{
		$credentials = Input::only('email', 'password');
	    
	    if (Auth::attempt($credentials, $remember = true)) {
	    	if (Auth::user()->enabled){
	        	return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
	    	}
	        else{
	        	Auth::logout();
	        	return Redirect::to('/login')->with('flash_message', 'Log in failed; account suspended. Contact site administrator for re-enabling it.');
	        }
	    }
	    else {
	        return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
	    }
	    
	    return Redirect::to('auth/login');
	}
	public function getLogout(){
	    # Log out
	    Auth::logout();
	    
	    # Send them to the homepage
	    return Redirect::to('/');
	}

}
