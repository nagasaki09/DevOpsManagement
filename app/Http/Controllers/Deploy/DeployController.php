<?php

namespace App\Http\Controllers\Deploy;

use Atf\Http\Requests\AtfSearchRequest;
use Atf\Http\Controllers\AtfController;
use App\Http\Controllers\Task\tTaskController;
use App\Commands\Deploy\DeployCommand;

/**
 * デプロイ処理を管理するコントローラー
 */
class DeployController extends AtfController {

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
        $this->displayObj->category = "deploy";
        // 画面名
        $this->displayObj->page = "list";
        // 基本のテンプレート
        $this->displayObj->tpl = $this->displayObj->category . "." . $this->displayObj->page;
        // コントローラー名
        $this->displayObj->ctl = "Deploy\DeployController";
        // 出力するcsvファイル名
        $this->displayObj->csvFileName = 'account_list.csv';
    }

    /**
     * 一覧に表示する値を取得する
     * @param  [type] $search     [description]
     * @param  [type] $sort       [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function showListData($search, $sort, $requestObj) {


        // そもそも取得できないので引数はnullにしている
        $showData = [];

        // 表示用に、並び替え情報を取得
        if (isset($sort['sort']) == True && !empty($sort['sort']) == True) {
            foreach ($sort['sort'] as $key => $value) {
                // 並び替え情報を格納
                $sortTypes = [
                    'sort_key' => $key,
                    "sort_by" => $value
                ];
            }
        }

        return view(
                    'deploy.index', compact(
                        'requestObj',
                        'search',
                        'showData',
                        'sortTypes',
                        'projectId'
                    )
                )
                ->with( "title", "デプロイ" )
                ->with( "displayObj", $this->displayObj )
                ->with( "sortUrl", action($this->displayObj->ctl . '@getSort') );
    }

    /**
     * [postDeploy description]
     * @return [type] [description]
     */
    public function postDeploy() {
        shell_exec('curl --request POST --globoff --cacert /Users/nagasakireon/gl.do.vcx.jp.crt --header "PRIVATE-TOKEN: WYm4n-bXxX9s2bhvsJc_" "https://gl.do.vcx.jp/api/v4/projects/30/pipeline?ref=master"');
        
        // 172.165.16.95サーバ用
        //shell_exec('curl --request POST --globoff --cacert /home/ubuntu/gl.do.vcx.jp.crt --header "PRIVATE-TOKEN: WYm4n-bXxX9s2bhvsJc_" "https://gl.do.vcx.jp/api/v4/projects/30/pipeline?ref=master"');

        return redirect()->route('deploy.deploy_list');
    }

}
