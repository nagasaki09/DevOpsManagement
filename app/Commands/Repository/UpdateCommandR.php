<?php

namespace App\Commands\Repository;

use Atf\Http\Requests\AtfSearchRequest;
use App\Models\Repository;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * ホームのメモを更新するコマンド
 *
 * @author yhatsutori
 */
class UpdateCommandR {

    /**
     * コンストラクタ
     * @param [type] $requestObj [description]
     */
    public function __construct() {

        $repositories = shell_exec('');

        $requestObj = json_decode($repositories);


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


         $setValues3 = $setValues2['repository'];

        foreach ($setValues3 as $setValues4) {
               $repositoryMObj = Repository::where('project_id', '=', $setValues4["project_id"])
                           ->where('repository_name', '=', $setValues4["repository_name"])
                           ->first();

            if (!empty($repositoryMObj) == True) {
            } else {
             //指定されたidのオブジェクトを取得
              $repositoryMObj = new Repository();
            }
            ##################
            ## データを格納
            ##################
            // 更新を行うカラム名
            $colums = [
                'project_id',
                'project_name', // 
                'project_public', // プロジェクト名
                'pull_count', // 
                'repository_name', // 
                'tags_count', // 
                'updated_at', //
                'created_at'
            ];

            //foreach ($colums as $colum) {
            //  if (!empty($this->requestObj->{$colum}) == True) {
            //    $imageMObj->{$colum} = $this->requestObj->{$colum};
            //  } else {
            //    $imageMObj->{$colum} = NULL;
            // }
            // }


            foreach ($colums as $colum) {
                if (isset($setValues4[$colum]) == True && !empty($setValues4[$colum]) == True) {
                    $repositoryMObj->{$colum} = $setValues4[$colum];
                } else {
                    $repositoryMObj->{$colum} = NULL;
                }
                

                // データの更新
                $repositoryMObj->save();
            }
        }
    }
} 