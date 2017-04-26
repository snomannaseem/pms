<?php 
// Login Routes

//dd(Request::path());

Route::group(['middleware' => 'auth.ui'], function () {
	Route::get('/', 'DashboardCont@index');
	Route::get('/testauth', 'TestCont@index');
	Route::get('/dashboard', 'DashboardCont@index');
	
	//Route::get('/teams', 'TeamCont@index');
	//Route::match(['get', 'post'], '/teams/search', ['uses' => 'TeamCont@search']);  it must be before /teams
	Route::match(['get', 'post'], '/teams', ['uses' => 'TeamCont@index']);
	Route::match(['get', 'post'], '/teams/{id}', ['uses' => 'TeamCont@addedit']);
	Route::match(['get', 'post'], '/teams/delete/{id}', ['uses' => 'TeamCont@delete']);
		
});

Route::match(['get', 'post'], '/api/login', ['uses' => 'Auth\UIAuthController@getMagicLogin', 'as' => 'magiclogin']);
Route::get('/login', 'Auth\UIAuthController@getLogin');
Route::post('/login', 'Auth\UIAuthController@postLogin');
Route::get('/logout', 'Auth\UIAuthController@getLogout');
#Route::get('/api/stafflogout', 'UI\Auth\UIAuthController@getStaffLogout');

//Route::get('/users', 'UserCont@index');
Route::match(['get', 'post'], '/users/search', ['uses' => 'UserCont@search']);   // it must be before /users path
Route::match(['get', 'post'], '/users', ['uses' => 'UserCont@index']);
Route::match(['get', 'post'], '/users/{id}', ['uses' => 'UserCont@addedit']);
Route::match(['get', 'post'], '/users/delete/{id}', ['uses' => 'UserCont@delete']);



/*****************************PROJECT ROUTES************************************/
Route::match(['get', 'post'], '/projects', ['uses' => 'ProjectCont@index']);
Route::match(['get', 'post'], '/project/add', ['uses' => 'ProjectCont@add']);
Route::match(['get', 'post'], '/project/{id}', ['uses' => 'ProjectCont@edit']);
Route::match(['get', 'post'], '/projects/create', ['uses' => 'ProjectCont@create']);
Route::match(['get', 'post'], '/project/delete/{id}', ['uses' => 'ProjectCont@delete']);
Route::match(['get', 'post'], '/projects/resources/{id}/add', ['uses' => 'ResourcesCont@addedit']);
Route::match(['get', 'post'], '/projects/resources/{id}', ['uses' => 'ResourcesCont@index']);



/***************************CATEGORIES ROUTE*************************************/
Route::match(['get', 'post'], '/categories', ['uses' => 'CategoriesCont@index']);
Route::match(['get', 'post'], '/categories/{id}', ['uses' => 'CategoriesCont@addedit']);
Route::match(['get', 'post'], '/categories/delete/{id}', ['uses' => 'CategoriesCont@delete']);



/*********************ISSUES ROUTES**************************************************************/
Route::match(['get', 'post'], '/issues', ['uses' => 'IssueCont@index']);
Route::match(['get', 'post'], '/issue/add', ['uses' => 'IssueCont@add']);
Route::match(['get', 'post'], '/issue/{id}', ['uses' => 'IssueCont@edit']);
Route::match(['get', 'post'], '/issues/create', ['uses' => 'IssueCont@create']);
Route::match(['get', 'post'], '/issue/delete/{id}', ['uses' => 'IssueCont@delete']);
Route::match(['get', 'post'], '/getproject_assignee', ['uses' => 'IssueCont@getProjectAssignee']);
Route::match(['get', 'post'], '/get_parent_issue_list', ['uses' => 'IssueCont@getParentIssueLists']);
Route::match(['get', 'post'], '/issue/view/{id}', ['uses' => 'IssueCont@view']);

/*************************COMMENTS*****************************************************************/
Route::match(['get', 'post'], '/get_comments', ['uses' => 'CommentCont@getComments']);
Route::match(['get', 'post'], '/comment/add_comment', ['uses' => 'CommentCont@addComment']);
Route::match(['get', 'post'], '/comment/update_comment', ['uses' => 'CommentCont@addComment']);
Route::match(['get', 'post'], '/comment/delete_comment', ['uses' => 'CommentCont@deleteComment']);


/*************************History*****************************************************************/
Route::match(['get', 'post'], '/get_history', ['uses' => 'HistoryCont@getHistory']);

/*************************Subtask*****************************************************************/
Route::match(['get', 'post'], '/get_subtask', ['uses' => 'IssueCont@getSubTask']);




?>