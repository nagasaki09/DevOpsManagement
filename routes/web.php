<?php

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// login画面に画面遷移
Route::get( '/', function(){
    return redirect('auth/login');
});

// login画面に画面遷移
Route::get( '/auth', function(){
    return redirect('auth/login');
});

// デフォルトのルート階層でログイン処理の操作
//Auth::routes();

// ログイン認証階層
Route::group(['prefix' => 'auth'], function() {
    Route::get('login',   'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login',  'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    
});

// TODO: 適当なコメントを入れること
// ○○階層
Route::group(['middleware' => ['auth']], function() {
    // index
    //Route::get('/home', 'HomeController@index')->name('home');
    
    ##################
    ## ホーム階層
    ##################
    
    // ホーム階層
    Route::group(['prefix' => 'home'], function() {
        // index
        Route::get('/',  'HomeController@getIndex')->name('home');;

        // 詳細
        Route::get('detail', 'HomeController@getDetail');

        // 編集
        Route::get('edit',  'HomeController@getEdit');
        Route::post('edit', 'HomeController@postEdit');
        
    });

    ##################
    ## デプロイ階層
    ##################
    
    // デプロイ階層
    Route::group(['prefix' => 'deploy'], function() {
        // index
        Route::get('/',  'Deploy\DeployController@getIndex');
        
        // 一覧
        Route::get('search', 'Deploy\DeployController@getSearch')->name('deploy.deploy_list');
        
        //ソート
        Route::get('sort', 'Deploy\DeployController@getSort');
        
        Route::get('execution', 'Deploy\DeployController@postDeploy');
    });
    
     ##################
    ## imege一覧階層
    ##################
    
    // imege階層
    Route::group(['prefix' => 'image'], function() {
        // index
        Route::get('/',  'Image\ImageController@getIndex');
        
         //プロジェクト一覧
        Route::get('search', 'Image\ImageController@getSearch');
        
        //ソート
        Route::get('sort', 'Image\ImageController@getSort');
        
        //DB保存
        Route::get('update',  'Image\ImageController@getUpdate');
        
         // リポジトリ一覧
        Route::get('repository/{Pid?}', 'Image\ImageController@getRepositoryDetail');
        
         // イメージ一覧
        Route::get('repository/{Pid?}/{project_name?}/{repository_name?}', 'Image\ImageController@getImageDetail');
        
    });
    
     ##################
    ## テスト結果階層
    ##################
    
    // テスト結果階層
    Route::group(['prefix' => 'test'], function() {
        // index
        Route::get('/',  'Test\TestController@getIndex');
        
         // 一覧
        Route::get('search', 'Test\TestController@getSearch');
        
        //ソート
        Route::get('sort', 'Test\TestController@getSort');
       
    });
    
     ##################
    ## ステータス階層
    ##################
    
    // テスト結果階層
    Route::group(['prefix' => 'status'], function() {
        // index
        Route::get('/',  'Status\StatusController@getIndex');
        
         // 一覧
        Route::get('search', 'Status\StatusController@getSearch');
        
        //ソート
        Route::get('sort', 'Status\StatusController@getSort');
        
        //DB保存
       Route::get('update',  'Status\StatusController@getUpdate');
    });
    
    ##################
    ## アカウント一覧階層
    ##################
    
    // アカウント階層
    Route::group(['prefix' => 'account'], function() {
        // index
        Route::get('/',  'Account\AccountController@getIndex');

        // 一覧
        Route::get('search', 'Account\AccountController@getSearch');
        // 一覧(並び替え)
        Route::get('sort', 'Account\AccountController@getSort');
        // 一覧(ページング)
        Route::get('pager', 'Account\AccountController@getPager');

        // 詳細
        Route::get('detail/{id?}', 'Account\AccountController@getDetail');

        // 登録
        Route::get('create',  'Account\AccountController@getCreate');
        Route::post('create', 'Account\AccountController@postCreate');

        // 編集
        Route::get('edit/{id?}', 'Account\AccountController@getEdit');
        Route::post('edit', 'Account\AccountController@postEdit');
        
        // 削除
        Route::get('delete/{id?}', 'Account\AccountController@getDelete');
    });
   
	
    
});
