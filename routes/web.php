<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin,x-xsrf-token, Authorization');
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

Route::get('/', function () {
    return view('welcome');
});


Route::any('server', function () {
    ini_set( "soap.wsdl_cache_enabled", 0 );
    ini_set( 'soap.wsdl_cache_ttl', 0 );
    function login( $login, $password )
    {
        $credentials = [
            'email' => $login,
            'password' => $password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('Test')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    $server = new \SoapServer( "http://ti-api.esntechnologies.com/dialsactivity.wsdl" );
    $server->addFunction( "login" );
    $server->handle();
});

Route::get('client', function() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $client = new \SoapClient("http://ti-api.esntechnologies.com/dialsactivity.wsdl", array('cache_wsdl' => WSDL_CACHE_NONE));
    return $client->login('userb@test.com', 'userb@test.com'); // call login() from .wsdl
});


