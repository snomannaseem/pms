<?php 
// Login Routes

//dd(Request::path());

Route::group(['middleware' => 'web'], function () {
	//Route::get('/teamlogin/{id?}', ['uses' => 'TestCont@teamLogin', 'as' => 'teamlogin']);
	//Route::match(['get', 'post'], '/teams', ['uses' => 'TeamCont@index']);
	
});



Route::group(['middleware' => 'auth.team'], function () {
	//Route::get('/teams', 'TeamCont@index');
	//Route::match(['get', 'post'], '/teams/search', ['uses' => 'TeamCont@search']);  it must be before /teams
	Route::get('/teamlogin/{id?}', ['uses' => 'TestCont@teamLogin', 'as' => 'teamlogin']);
	Route::match(['get', 'post'], '/teams', ['uses' => 'TeamCont@index']);
	Route::get('/', ['uses' => 'DashboardCont@index', 'as' => 'root']);
	Route::get('/dashboard/{id?}', ['uses' => 'DashboardCont@index', 'as' => 'dashboard']);
	//Route::match(['get', 'post'], '/teams', ['uses' => 'TeamCont@index']);
	Route::match(['get', 'post'], '/teams/add', ['uses' => 'TeamCont@add']);
	Route::match(['get', 'post'], '/teams/edit/{id}', ['uses' => 'TeamCont@edit']);
	Route::match(['get', 'post'], '/teams/delete/{id}', ['uses' => 'TeamCont@delete']);
	
	/*****************************PROJECT ROUTES************************************/
	Route::match(['get', 'post'], '/users', ['uses' => 'UserCont@index']);
	//Route::get('/users', 'UserCont@index');
	Route::match(['get', 'post'], '/users/search', ['uses' => 'UserCont@search']);   // it must be before /users path
	//Route::match(['get', 'post'], '/users', ['uses' => 'UserCont@index']);
	Route::match(['get', 'post'], '/users/add', ['uses' => 'UserCont@add']);
	Route::match(['get', 'post'], '/users/edit/{id}', ['uses' => 'UserCont@edit']);
	Route::match(['get', 'post'], '/users/delete/{id}', ['uses' => 'UserCont@delete']);


	//Route::match(['get', 'post'], '/projects', ['uses' => 'ProjectCont@index']);




	



	
	
	
	
	
	

});

/***************************CATEGORIES ROUTE*************************************/
	Route::match(['get', 'post'], '/categories', ['uses' => 'CategoriesCont@index']);
	Route::match(['get', 'post'], '/categories/{id}', ['uses' => 'CategoriesCont@addedit']);
	Route::match(['get', 'post'], '/categories/delete/{id}', ['uses' => 'CategoriesCont@delete']);
	
	Route::match(['get', 'post'], '/projects', ['uses' => 'ProjectCont@index']);
	Route::match(['get', 'post'], '/project/add', ['uses' => 'ProjectCont@add']);
	Route::match(['get', 'post'], '/project/{id}', ['uses' => 'ProjectCont@edit']);
	Route::match(['get', 'post'], '/projects/create', ['uses' => 'ProjectCont@create']);
	Route::match(['get', 'post'], '/project/delete/{id}', ['uses' => 'ProjectCont@delete']);
	Route::match(['get', 'post'], '/project/view/{id}', ['uses' => 'ProjectCont@view']);
	Route::match(['get', 'post'], '/projects/resources/{id}/add', ['uses' => 'ResourcesCont@addedit']);
	Route::match(['get', 'post'], '/projects/resources/{id}', ['uses' => 'ResourcesCont@index']);

/*****************************File UPLOADER************************************/
Route::match(['get', 'post'], '/file_upload', ['uses' => 'FileCont@upload']);
Route::match(['get', 'post'], '/get_files', ['uses' => 'FileCont@getFiles']);
Route::match(['get', 'post'], '/download_files/{id}', ['uses' => 'FileCont@downloadFiles']);
Route::match(['get', 'post'], '/delete_files/{id}', ['uses' => 'FileCont@deleteFiles']);





/*********************ISSUES ROUTES**************************************************************/
	Route::match(['get', 'post'], '/issues', ['uses' => 'IssueCont@index']);
	Route::match(['get', 'post'], '/issue/add', ['uses' => 'IssueCont@add']);
	Route::match(['get', 'post'], '/issue/{id}', ['uses' => 'IssueCont@edit']);
	Route::match(['get', 'post'], '/issues/create', ['uses' => 'IssueCont@create']);
	Route::match(['get', 'post'], '/issue/delete/{id}', ['uses' => 'IssueCont@delete']);
	Route::match(['get', 'post'], '/getproject_assignee', ['uses' => 'IssueCont@getProjectAssignee']);
	Route::match(['get', 'post'], '/get_parent_issue_list', ['uses' => 'IssueCont@getParentIssueLists']);
	Route::match(['get', 'post'], '/issue/view/{id}', ['uses' => 'IssueCont@view']);
			/**************PLAY/PAUSE**************************/
	Route::match(['get', 'post'], '/issues/timespent', ['uses' => 'IssueCont@timeSpents']);
			

	/*************************COMMENTS*****************************************************************/
	Route::match(['get', 'post'], '/get_comments', ['uses' => 'CommentCont@getComments']);
	Route::match(['get', 'post'], '/comment/add_comment', ['uses' => 'CommentCont@addComment']);
	Route::match(['get', 'post'], '/comment/update_comment', ['uses' => 'CommentCont@addComment']);
	Route::match(['get', 'post'], '/comment/delete_comment', ['uses' => 'CommentCont@deleteComment']);


	/*************************History*****************************************************************/
	Route::match(['get', 'post'], '/get_history', ['uses' => 'HistoryCont@getHistory']);

	/*************************Subtask*****************************************************************/
	Route::match(['get', 'post'], '/get_subtask', ['uses' => 'IssueCont@getSubTask']);
	
	

Route::match(['get', 'post'], 'register', ['uses' => 'Register@index', 'as' => 'register']);
Route::match(['get', 'post'], '/api/login', ['uses' => 'Auth\UIAuthController@getMagicLogin', 'as' => 'magiclogin']);
Route::match(['post'], '/login', ['uses' => 'Auth\UIAuthController@postLogin', 'as' => 'login_post']);
Route::match(['get'], '/login', ['uses' => 'Auth\UIAuthController@getLogin', 'as' => 'login_get']);


Route::get('/logout', 'Auth\UIAuthController@getLogout');
#Route::get('/api/stafflogout', 'UI\Auth\UIAuthController@getStaffLogout');

// Adnan Abbasi
/*********************ISSUES ROUTES**************************************************************/
Route::match(['get', 'post'], '/module', ['uses' => 'ModuleCont@index']);
Route::match(['get', 'post'], '/module/add', ['uses' => 'ModuleCont@addModule']);
Route::match(['get', 'post'], '/module/create', ['uses' => 'ModuleCont@create']);
Route::match(['get', 'post'], '/module/edit/{id}', ['uses' => 'ModuleCont@editModule']);
Route::match(['get', 'post'], '/module/delete/{id}', ['uses' => 'ModuleCont@deleteModule']);


// Adnan Abbasi
/*********************ISSUES ROUTES**************************************************************/
Route::match(['get', 'post'], '/actions', ['uses' => 'ActionsCont@index']);
Route::match(['get', 'post'], '/actions/add', ['uses' => 'ActionsCont@addActions']);
Route::match(['get', 'post'], '/actions/create', ['uses' => 'ActionsCont@create']);
Route::match(['get', 'post'], '/actions/edit/{id}', ['uses' => 'ActionsCont@editActions']);
Route::match(['get', 'post'], '/actions/delete/{id}', ['uses' => 'ActionsCont@deleteActions']);


// Adnan Abbasi
/*********************ISSUES ROUTES**************************************************************/
Route::match(['get', 'post'], '/module_actions', ['uses' => 'ModuleActionsCont@index']);
Route::match(['get', 'post'], '/module_actions/add', ['uses' => 'ModuleActionsCont@addModuleActions']);
Route::match(['get', 'post'], '/module_actions/create', ['uses' => 'ModuleActionsCont@create']);
Route::match(['get', 'post'], '/module_actions/edit/{id}', ['uses' => 'ModuleActionsCont@editModuleActions']);
Route::match(['get', 'post'], '/module_actions/delete/{id}', ['uses' => 'ModuleActionsCont@deleteModuleActions']);
Route::match(['get', 'post'], '/404', function(){
	return response()->view('ui.common.no_permission');
});

?>