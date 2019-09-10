<?php

namespace App\Commands\Project;

use Atf\Http\Requests\AtfSearchRequest;
use App\Models\Project;

/**
 * ホームのメモを更新するコマンド
 *
 * @author yhatsutori
 */
class PUpdateCommand {

    /**
     * コンストラクタ
     * @param [type] $requestObj [description]
     */
    public function __construct() {

        $projects = shell_exec('curl -u atfworks:Green4Yoikuuki! -k https://vss206.intra.atf.co.jp:8888/api/projects');

        $requestObj = json_decode($projects);


        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle() {

        // 更新する値の配列を取得
        $setValues = $this->requestObj;

        $setValues2 = json_decode(json_encode($setValues), true);

        foreach ($setValues2 as $setValues3) {

            // 指定されたidのオブジェクトを取得
            $projectMObj = Project::where('project_id',$setValues3["project_id"])->first();

            ##################
            ## データを格納
            ##################
            // 更新を行うカラム名
            $colums = [
                'owner_id', // 
                'name', // プロジェクト名
                'creation_time', // 
                'update_time', // 
                'deleted', // 
                'owner_name', // 
                'togglable', // 
                'current_user_role_id', // 
                'repo_count', // 
            ];

            //foreach ($colums as $colum) {
            //  if (!empty($this->requestObj->{$colum}) == True) {
            //    $imageMObj->{$colum} = $this->requestObj->{$colum};
            //  } else {
            //    $imageMObj->{$colum} = NULL;
            // }
            // }

           

            foreach ($colums as $colum) {
                if (!empty($setValues3[$colum]) == True) {
                    $projectMObj->{$colum} = $setValues3[$colum];
                } else {
                    $projectMObj->{$colum} = NULL;
                }


                // データの更新
                $projectMObj->save();
            }
        }
            return $projectMObj;
        
    }

}
