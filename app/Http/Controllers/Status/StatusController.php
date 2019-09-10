<?php

namespace App\Http\Controllers\Status;

use Atf\Http\Requests\AtfSearchRequest;
use Atf\Http\Controllers\AtfController;
use App\Http\Controllers\Status\tStatusEditController;
use App\Http\Controllers\Status\tStatusController;
use App\Commands\Status\UpdateCommand;
use App\Commands\Status\ListCommand;

//use App\Commands\Status\ListCommand;

/**
 * ステータスを管理するコントローラー
 */
class StatusController extends AtfController {

    use tStatusController,
        tStatusEditController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
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
    public function initDisplayObj() {
        // 表示部分で使うオブジェクトを作成
        $this->displayObj = app('stdClass');
        // カテゴリー名
        $this->displayObj->category = "status";
        // 画面名
        $this->displayObj->page = "list";
        // 基本のテンプレート
        $this->displayObj->tpl = $this->displayObj->category . "." . $this->displayObj->page;
        // コントローラー名
        $this->displayObj->ctl = "Status\StatusController";
        // 出力するcsvファイル名
        $this->displayObj->csvFileName = 'account_list.csv';
    }

    public function getUpdate() {
        // 指定されたidを削除
        $this->dispatch(
                new UpdateCommand(
            )
        );

        // 一覧画面にリダイレクト
        return redirect('status');
    }

    /**
     * 一覧に表示する値を取得する
     * @param  [type] $search     [description]
     * @param  [type] $sort       [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function showListData( $search, $sort, $requestObj ){

       $showData = $this->dispatch(
            new ListCommand(
                $requestObj
            )
        );
        return view(
            'status.list.index', compact(
                'requestObj',
                'search',
                'showData',
                'sortTypes',
                'projectId'
            )
        )
        ->with( "title", "ステータス" )
        ->with( "displayObj", $this->displayObj )
        ->with( "sortUrl", action($this->displayObj->ctl . '@getSort') );
    }

}
