<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return view('base')->with('title', 'DOH CAR LOGISTICS')->with('content', view('login'));
});

$router->post('/login', 'LoginController@initLogin');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/items/search/{term}','APIController@itemSearch');
    $router->get('/reference/unit','APIController@unit');
    $router->get('/reference/wfp','APIController@wfp');

    $router->get('/twg/requests', 'APIController@pendingTWG');
    $router->get('/twg/{id}', 'APIController@showTWG');
    $router->post('/twg/create', 'APIController@twg');
    $router->post('/twg/update/{id}', 'APIController@updateTWG');


    $router->post('/wfp/update/{id}', 'APIController@updateWFP');
    $router->post('/wfp/create', 'APIController@createWFP');

    $router->get('/reference/branches', 'LibraryBranchController@all');
    $router->get('/reference/categories', 'LibraryCategoryController@all');
    $router->get('/reference/{id}', 'LibraryBranchController@branch');

    $router->get('/library/items', 'LibraryItemController@all');
    $router->get('/library/items/{branch}', 'LibraryItemController@itemByBranch');
    $router->get('/library/dm', 'LibraryDMController@all');

    $router->get('/library/branches', 'LibraryBranchController@all');
    $router->get('/library/units', 'LibraryUnitController@all');
    $router->get('/library/categories', 'LibraryCategoryController@all');
    $router->get('/library/routes', 'LibraryRouteController@all');
    $router->get('/library/forms', 'LibraryFormController@all');
    $router->get('/library/drugsAndMeds', 'LibraryDMController@all');
    $router->get('/library/types', 'LibraryTypeController@all');

    $router->get('/inventory/{category}', 'InventoryController@inventory');
    $router->get('/inventory/stock/{type}/{id}', 'InventoryController@getStock');
    $router->post('/inventory/stock/update/{type}/{id}', 'InventoryController@updateStock');

    $router->post('/library/item/update/{id}', 'LibraryItemController@update');
    $router->post('/reference/create', 'LibraryBranchController@create');
    $router->post('/reference/{id}', 'LibraryBranchController@update');
    $router->post('/library/item/create', 'LibraryItemController@create');
    $router->post('/library/unit/create', 'LibraryUnitController@create');
    $router->post('/library/unit/{id}', 'LibraryUnitController@update');
    $router->post('/library/branch/create', 'LibraryBranchController@create');
    $router->post('/library/branch/{id}', 'LibraryBranchController@update');
    $router->post('/library/category/create', 'LibraryCategoryController@create');
    $router->post('/library/category/{id}', 'LibraryCategoryController@update');
    $router->post('/library/route/create', 'LibraryRouteController@create');
    $router->post('/library/route/{id}', 'LibraryRouteController@update');
    $router->post('/library/form/create', 'LibraryFormController@create');
    $router->post('/library/drugsAndMeds/create', 'LibraryDMController@create');
    $router->post('/library/drugsAndMeds/update/{id}', 'LibraryDMController@update');
    $router->post('/library/program/create', 'LibraryProgramController@create');

//    $router->post('/inventory/equipment/create', 'InventoryController@create');
    $router->post('/inventory/create', 'InventoryController@create');


});
$router->group(['middleware' => 'admin'], function () use ($router) {
    $router->get('/dashboard', 'frontend\PageController@index');
    $router->get('/library','frontend\LibraryController@index');
    $router->get('/library/','frontend\LibraryController@index');
    $router->get('/library/items','frontend\LibraryController@items');
    $router->get('/library/items/{branch}','frontend\LibraryController@itemsByBranch');
    $router->get('/library/item/{id}','frontend\LibraryController@item');
    $router->get('/library/item/update/{id}','frontend\LibraryController@item');
    $router->get('/library/units','frontend\LibraryController@units');
    $router->get('/library/branch','frontend\LibraryController@branch');
    $router->get('/library/categories','frontend\LibraryController@categories');
    $router->get('/library/drugsAndMeds','frontend\LibraryController@drugsAndMeds');
    $router->get('/library/drugsAndMeds/routes', 'frontend\LibraryController@routes');
    $router->get('/library/drugsAndMeds/forms', 'frontend\LibraryController@forms');
    $router->get('/library/drugsAndMeds/dm', 'frontend\LibraryController@DM');
    $router->get('/library/drugsAndMeds/{id}', 'frontend\LibraryController@dmShow');
    $router->get('/library/programs', 'frontend\LibraryController@programs');

    $router->get('/inventory/equipments', 'frontend\InventoryController@equipments');
    $router->get('/inventory/supplies', 'frontend\InventoryController@supplies');
    $router->get('/inventory/drugsAndMeds', 'frontend\InventoryController@drugsAndMeds');
    $router->get('/inventory/details/{origin}/{id}', 'frontend\InventoryController@details');

    $router->get('/twg', 'frontend\TWGController@index');
    $router->get('/twg/members', 'frontend\TWGController@members');
    $router->get('/twg/wfp', 'frontend\TWGController@wfp');
    $router->get('/twg/requests/approved', 'frontend\TWGController@requestsApproved');
    $router->get('/twg/requests/pending', 'frontend\TWGController@requestsPending');
    $router->get('/twg/requests/declined', 'frontend\TWGController@requestsDeclined');
    $router->get('/twg/wfp/delete/{id}', 'frontend\TWGController@twgDelete');
    $router->post('/twg/update/{id}', 'TWGController@updateTWG');
//    $router->get('/twg/approve/{id}', 'frontend\TWGController@requestsDeclined');
    $router->get('/twg/wfp', 'frontend\TWGController@wfp');
//    $router->get('/twg/wfp/{filter}', 'frontend\TWGController@wfpWithFilter');
    $router->get('/twg/wfp/{id}', 'frontend\TWGController@wfpShow');

});
//$router->group(['middleware' => 'twg'], function () use ($router) {
//    $router->get('/twg', 'frontend\TWGController@index');
//    $router->get('/twg/members', 'frontend\TWGController@members');
//    $router->get('/twg/wfp', 'frontend\TWGController@wfp');
//    $router->get('/twg/requests/approved', 'frontend\TWGController@requestsApproved');
//    $router->get('/twg/requests/pending', 'frontend\TWGController@requestsPending');
//    $router->get('/twg/requests/declined', 'frontend\TWGController@requestsDeclined');
////    $router->get('/twg/approve/{id}', 'frontend\TWGController@requestsDeclined');
//    $router->get('/twg/wfp', 'frontend\TWGController@wfp');
//});
$router->get('/hash', function () {
    return password_hash('ilovelogistics', PASSWORD_BCRYPT);
});
