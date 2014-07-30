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
       return Redirect::to('/list-incidents');
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

Route::controller('password', 'RemindersController');


/*--------------------------------------*\

                INCIDENTS

\*--------------------------------------*/
# Get Create
Route::get('/create-incident', array('before' => 'auth', "uses" => "IncidentController@getCreate"));//function() {//array( 'before' => 'guest',function() {

# Post Create
Route::post('/create-incident', array('before' => 'auth', 'before' => 'csrf', "uses" => "IncidentController@postCreate"));

# View an Incident
Route::get('show-incident/{id?}', array('as' => 'incident.show', 'before' => 'auth', "uses" => "IncidentController@show"));

# Edit an Incident
Route::get('edit-incident/{id?}', array('as' => 'incident.edit', 'before' => 'auth', "uses" => "IncidentController@edit"));


Route::get('list-incidents/', array('as' => 'incident.list', 'before' => 'auth', 'uses' => 'IncidentController@index'));
Route::post('list-incidents/', array('as' => 'incident.list', 'before' => 'auth', 'before' => 'csrf', 'uses' => 'IncidentController@index'));


Route::post('update-incident/', array('as' => 'incident.update', 'before' => 'auth', 'before' => 'csrf', 'uses' => 'IncidentController@update'));


/*--------------------------------------*\

                REPLACEMENTS

\*--------------------------------------*/

# Get Create
Route::get('/create-replacement', array('before' => 'auth', "uses" => "ReplacementController@create"));
Route::post('/create-replacement', array('before' => 'auth', "uses" => "ReplacementController@create"));


# Post Create
Route::post('/store-replacement', array('before' => 'auth', 'before' => 'csrf', "uses" => "ReplacementController@store"));


# List
Route::get('list-replacements/', array('as' => 'replacement.list', 'before' => 'auth', 'uses' => 'ReplacementController@index'));
Route::post('list-replacements/', array('as' => 'replacement.list', 'before' => 'auth', 'before' => 'csrf', 'uses' => 'ReplacementController@index'));



/*--------------------------------------*\

                LAMPS

\*--------------------------------------*/

# Create a Lamp
Route::get('create-lamp/', array('before' => 'auth', function() {


}));

# View a Lamp
Route::get('view-lamp', array('before' => 'auth', function() {


}));

Route::get('list-lamps/', array('as' => 'lamp.list', 'before' => 'auth', 'uses' => 'LampController@index'));
Route::post('list-lamps/', array('as' => 'lamp.list', 'before' => 'auth', 'before' => 'csrf', 'uses' => 'LampController@index'));


/*--------------------------------------*\

                USERS

\*--------------------------------------*/

# Get Create
Route::get('/create-user', array('before' => 'auth', "uses" => "UserController@getCreate"));//function() {//array( 'before' => 'guest',function() {

# Post Create
Route::post('/create-user', array('before' => 'auth','before' => 'csrf', "uses" => "UserController@postCreate"));

# View an Incident
Route::get('show-user/{id?}', array('as' => 'user.show', 'before' => 'auth', "uses" => "UserController@show"));


# List users
Route::get('list-users/', array('as' => 'user.list', 'before' => 'auth', 'uses' => 'UserController@index'));
Route::post('list-users/', array('as' => 'user.list', 'before' => 'auth', 'before' => 'csrf', 'uses' => 'UserController@index'));

/*--------------------------------------*\

                COMPANY

\*--------------------------------------*/

# Get Create
Route::get('/create-company', array('before' => 'auth', "uses" => "CompanyController@create"));//function() {//array( 'before' => 'guest',function() {

# Post Create
Route::post('/create-company', array('before' => 'auth','before' => 'csrf', "uses" => "CompanyController@store"));


# List users
Route::get('list-companies/', array('as' => 'company.list', 'before' => 'auth', 'uses' => 'CompanyController@index'));
Route::post('list-companies/', array('as' => 'company.list', 'before' => 'auth', 'before' => 'csrf', 'uses' => 'CompanyController@index'));



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