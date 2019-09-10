<?php

namespace App\Http\Controllers\Account;

use Atf\Util\AtfSessionUtil;
use Atf\Http\Requests\AtfSearchRequest;
use Atf\Http\Controllers\AtfController;
use App\Http\Requests\UsersRequest;
use App\Models\Users;
use App\Commands\Account\ListCommand;
use App\Commands\Account\CreateCommand;
use App\Commands\Account\UpdateCommand;
use App\Commands\Account\DeleteCommand;

class AccountController extends AtfController
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
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
        $this->displayObj->category = "account";
        // 画面名
        $this->displayObj->page = "list";
        // 基本のテンプレート
        $this->displayObj->tpl = $this->displayObj->category . "." . $this->displayObj->page;
        // コントローラー名
        $this->displayObj->ctl = "Account\AccountController";
        // 出力するcsvファイル名
        $this->displayObj->csvFileName = 'account_list.csv';
    }

    #######################
    ## 検索・並び替え
    #######################

    /**
     * 並び替え部分のデフォルト値を指定
     * @return [type] [description]
     */
    public function extendSortParams() {
        // 複数テーブルにあるidが重複するため明示的にエイリアス指定
        $sort = [
            'email' => 'asc'
        ];
        
        return $sort;
    }

    /**
     * 一覧に表示する値を取得する
     * @param  [type] $search     [description]
     * @param  [type] $sort       [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function showListData( $search, $sort, $requestObj ){
        // そもそも取得できないので引数はnullにしている
        $showData = $this->dispatch(
            new ListCommand(
                $requestObj,
                $sort
            )
        );
        
        // 表示用に、並び替え情報を取得
        if( isset( $sort['sort'] ) == True && !empty( $sort['sort'] ) == True ){
            foreach ( $sort['sort'] as $key => $value ) {
                // 並び替え情報を格納
                $sortTypes = [
                    'sort_key' => $key,
                    "sort_by" => $value
                ];
            }
        }

        return view(
            $this->displayObj->tpl . '.index',
            compact(
                'requestObj',
                'search',
                'showData',
                'sortTypes'
            )
        )
        ->with( "title", "アカウントリスト" )
        ->with( "displayObj", $this->displayObj )
        ->with( "sortUrl", action( $this->displayObj->ctl . '@getSort' ) );
    }

    ###################
    ## 詳細
    ###################
    
    /**
     * 詳細を取得
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDetail( $id=NULL ){
        // idがからでないときに処理
        if( !empty( $id ) == True ){
            // 指定されたidのオブジェクトを取得
            $usersMObj = Users::findOrFail( $id );

            return view(
                $this->displayObj->tpl . '.detail',
                compact(
                    'usersMObj'
                )
            )
            ->with( "title", "アカウント詳細" )
            ->with( "displayObj", $this->displayObj );

        }else{
            // 一覧画面にリダイレクト
            return redirect('account/list');
        }
    }

    ###################
    ## 登録
    ###################
    
    /**
     * 登録画面を開く
     * @return [type] [description]
     */
    public function getCreate(){
        // 担当者モデルを取得
        $usersMObj = new Users();

        return view(
            $this->displayObj->tpl . '.input',
            compact(
                'usersMObj'
            )
        )
        ->with( "title", "アカウント登録" )
        ->with( "displayObj", $this->displayObj )
        ->with( "inputType", "create" );
    }

    /**
     * 登録処理を行う
     * @param  UsersRequest $requestObj [description]
     * @return [type]                   [description]
     */
    public function postCreate( UsersRequest $requestObj ){
        // 指定されたidを削除
        $this->dispatch(
            new CreateCommand(
                $requestObj
            )
        );

        // 一覧画面にリダイレクト
        return redirect('account/list');
    }

    ###################
    ## 編集
    ###################
    
    /**
     * 編集画面を開く
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getEdit( $id=NULL ){
        // idがからでないときに処理
        if( !empty( $id ) == True ){
            // 指定されたidのオブジェクトを取得
            $usersMObj = Users::findOrFail( $id );

            return view(
                $this->displayObj->tpl . '.input',
                compact(
                    'usersMObj'
                )
            )
            ->with( "title", "アカウント編集" )
            ->with( "displayObj", $this->displayObj )
            ->with( "inputType", "edit" );

        }else{
            // 一覧画面にリダイレクト
            return redirect('account/list');
        }
    }

    /**
     * 編集処理を行う
     * @param  UsersRequest $requestObj [description]
     * @return [type]                   [description]
     */
    public function postEdit( UsersRequest $requestObj ){
        // idがからでないときに処理
        if( !empty( $requestObj->id ) == True ){
            // 指定されたidを削除
            $this->dispatch(
                new UpdateCommand(
                    $requestObj->id,
                    $requestObj
                )
            );
            
        }

        // 一覧画面にリダイレクト
        return redirect('account/list');
    }

    ###################
    ## 削除
    ###################
    
    /**
     * 指定されたidを削除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDelete( $id=NULL ){
        if( !empty( $id ) == True ){
            // 指定されたidを削除
            $this->dispatch(
                new DeleteCommand(
                    $id
                )
            );
        }

        // 一覧画面にリダイレクト
        return redirect('account/list');
    }

}
