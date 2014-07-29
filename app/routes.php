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
    if (Auth::check())
       return Redirect::to('/list-users');
    else
	   return View::make('auth/login');
});


/*--------------------------------------*\

                AUTH

\*--------------------------------------*/

# Get Log In
Route::get('/login', array('before' => 'guest', 'uses' => 'AuthController@getLogin'));

# Post Log In
Route::post('/login', array('before' => 'csrf', 'uses' => 'AuthController@postLogin'));

# Logout
Route::get('/logout', 'AuthController@getLogout');




/*--------------------------------------*\

                INCIDENTS

\*--------------------------------------*/
# Get Create
Route::get('/create-incident', "IncidentController@getCreate");//function() {//array( 'before' => 'guest',function() {

# Post Create
Route::post('/create-incident', array('before' => 'csrf', "uses" => "IncidentController@postCreate"));

# View an Incident
Route::get('view-incident', array('before' => 'auth', function() {


}));

Route::get('list-incidents/', array('as' => 'incident.list', 'before' => 'auth', 'uses' => 'IncidentController@index'));
Route::post('list-incidents/', array('as' => 'incident.list', 'before' => 'auth', 'before' => 'csrf', 'uses' => 'IncidentController@index'));


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

# Get Create
Route::get('/create-user', "UserController@getCreate");//function() {//array( 'before' => 'guest',function() {

# Post Create
Route::post('/create-user', array('before' => 'csrf', "uses" => "UserController@postCreate"));


# List users
Route::get('list-users/', array('as' => 'user.list', 'before' => 'auth', 'uses' => 'UserController@index'));
Route::post('list-users/', array('as' => 'user.list', 'before' => 'auth', 'before' => 'csrf', 'uses' => 'UserController@index'));



/*--------------------------------------*\

                DEBUG

\*--------------------------------------*/

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

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