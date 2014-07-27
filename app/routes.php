<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});


/*--------------------------------------*\

                AUTH

\*--------------------------------------*/

# Get Log In
Route::get('/login',
    array(
        'before' => 'guest',
        function() {
            return View::make('auth/login');
        }
    )
);

# Post Log In
Route::post('/login', array('before' => 'csrf', function() {
    
    $credentials = Input::only('username', 'password');
    
    if (Auth::attempt($credentials, $remember = true)) {
        return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
    }
    else {
        return Redirect::to('auth/login')->with('flash_message', 'Log in failed; please try again.');
    }
    
    return Redirect::to('auth/login');
    
}));

# Logout
Route::get('/logout', function() {
    
    # Log out
    Auth::logout();
    
    # Send them to the homepage
    return Redirect::to('/');
    
});

# Get Signup
Route::get('/signup', array( 'before' => 'guest',function() {
    $companies = [];
    foreach (Company::all() as $company) {
        $companies[$company->id] = $company->name;
    }
    return View::make('auth/signup')->with("companies",$companies);
}));

# Post Signup
Route::post('/signup', array('before' => 'csrf', function() {

    $user = new User;
    $user->email        = Input::get('email');
    $user->password     = Hash::make(Input::get('password'));
    $user->firstname    = Input::get('firstname');
    $user->lastname     = Input::get('lastname');
    $user->phone        = Input::get('phone');
    $user->company_id   = Input::get('company_id');    
    
    try {
        $user->save();
        $user_role = new UserRole;
        $user_role->user_id =  $user->id;      
        $user_role->role_id = Role::where('role', '=', 'user')->first();
        $user_role->save();
    }
    catch (Exception $e) {
        return Redirect::to('auth/signup')
            ->with('flash_message', 'Sign up failed; please try again.')
            ->withInput();
    }
    
    # Log in
    Auth::login($user);
    
    return Redirect::to('/')->with('flash_message', 'Welcome to Foobooks!');
    
}));



/*--------------------------------------*\

                INCIDENTS

\*--------------------------------------*/
# Create an Incident
Route::get('create-incident/{id?}', array('uses' => 'IncidentController@show'));

# View an Incident
Route::get('view-incident', array('before' => 'auth', function() {


}));

# List all incidents
Route::get('list-incidents', array('before' => 'auth', function() {


}));

# Modify an Incident
Route::get('modify-incident', array('before' => 'auth', function() {


}));

/*--------------------------------------*\

                REPLACEMENTS

\*--------------------------------------*/

# Create a Replacement
Route::get('create-replacement/', array('before' => 'auth', function() {


}));

# View a Replacement
Route::get('view-replacement', array('before' => 'auth', function() {


}));

# List all Replacements
Route::get('list-replacements', array('before' => 'auth', function() {


}));

# Modify a Replacement
Route::get('modify-replacement', array('before' => 'auth', function() {


}));

/*--------------------------------------*\

                LAMPS

\*--------------------------------------*/

# Create a Lamp
Route::get('create-lamp/', array('before' => 'auth', function() {


}));

# View a Lamp
Route::get('view-lamp', array('before' => 'auth', function() {


}));

# List all Lamps
Route::get('list-lamps', array('before' => 'auth', function() {


}));

/*--------------------------------------*\

                USERS

\*--------------------------------------*/

# Create a User
Route::get('create-user/', function() {


});

# View a Lamp
Route::get('view-user', array('before' => 'auth', function() {


}));



/*--------------------------------------*\

                DEBUG

\*--------------------------------------*/


Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});


Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});