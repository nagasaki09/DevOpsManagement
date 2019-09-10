<?php

namespace App\Http\Controllers;

use Atf\Util\AtfSessionUtil;
use Atf\Http\Requests\AtfSearchRequest;
use Atf\Http\Controllers\AtfController;
use App\Models\Home;
use App\Commands\Home\UpdateCommand;

class HomeController extends AtfController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');

        // 表示部分で使うオブジェクトを作成
        $this->initDisplayObj();
    }

    #######################
    ## initalize
    #######################

    /**
     * 表示部分で使うオブジェクトを作成
     * @return [type] [description]
     */
    public function initDisplayObj(){
        // 表示部分で使うオブジェクトを作成
        $this->displayObj = app('stdClass');
        // カテゴリー名
        $this->displayObj->category = "home";
        // 画面名
        $this->displayObj->page = "";
        // 基本のテンプレート
        //$this->displayObj->tpl = $this->displayObj->category . "." . $this->displayObj->page;
        $this->displayObj->tpl = $this->displayObj->category;
        // コントローラー名
        $this->displayObj->ctl = "HomeController";
        // 出力するcsvファイル名
        $this->displayObj->csvFileName = 'account_list.csv';
    }

    /**
    * Index
    * @return デフォルト画面に画面遷移
    */
    public function getIndex() {
        // 検索情報と並び替え情報を削除
        AtfSessionUtil::removeSession();

        // search画面に画面遷移
        return redirect( action( $this->displayObj->ctl . '@getDetail' ) );
    }

    ###################
    ## 詳細
    ###################
    
    /**
     * 編集画面を開く
     * @return [type] [description]
     */
    public function getDetail(){
        // 指定されたidのオブジェクトを取得
        $homeMObj = Home::find( 1 );
        
        return view(
            $this->displayObj->tpl . '.detail',
            compact(
                'homeMObj'
            )
        )
        ->with( "title", "Home" )
        ->with( "displayObj", $this->displayObj );
               
    }

    ###################
    ## 編集
    ###################
    
    /**
     * 編集画面を開く
     * @return [type] [description]
     */
    public function getEdit(){
        // 指定されたidのオブジェクトを取得
        $homeMObj = Home::find( 1 );

        return view(
            $this->displayObj->tpl . '.input',
            compact(
                'homeMObj'
            )
        )
        ->with( "title", "Home編集" )
        ->with( "displayObj", $this->displayObj )
        ->with( "inputType", "edit" );
                
    }

    /**
     * 編集処理を行う
     * @param  AtfSearchRequest $requestObj [description]
     * @return [type]                   [description]
     */
    public function postEdit( AtfSearchRequest $requestObj ){
        // 指定されたidを削除
        $this->dispatch(
            new UpdateCommand(
                1,
                $requestObj
            )
        );

        // 一覧画面にリダイレクト
        return redirect('home/detail');
    }

}
