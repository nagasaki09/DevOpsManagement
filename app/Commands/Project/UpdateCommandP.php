<?php

namespace App\Commands\Project;

use Atf\Http\Requests\AtfSearchRequest;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * ホームのメモを更新するコマンド
 *
 * @author yhatsutori
 */
class UpdateCommandP {

    /**
     * コンストラクタ
     * @param [type] $requestObj [description]
     */
    public function __construct() {

       
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle() {
         $projects = shell_exec('curl -u atfworks:Green4Yoikuuki! -k https://vss206.intra.atf.co.jp:8888/api/projects');

        $requestObj = json_decode($projects);


        $this->requestObj = $requestObj;

        // 更新する値の配列を取得
        $setValues = $this->requestObj;

        $setValues2 = json_decode(json_encode($setValues), true);

        
        
        foreach ($setValues2 as $setValues3) {
            
            // 指定されたidのオブジェクトを取得
            try{
            $projectMObj = Project::findOrFail( $setValues3["project_id"] );
            } catch (ModelNotFoundException $e){
                $projectMObj = new Project();
            }
            
            
            ##################
            ## データを格納
            ##################
            // 更新を行うカラム名
            $colums = [
                'project_id',
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
                if (isset($setValues3[$colum]) == True && !empty($setValues3[$colum]) == True) {
                    $projectMObj->{$colum} = $setValues3[$colum];
                     //
                } else {
                    $projectMObj->{$colum} = NULL;
                }
 
            
                // データの更新
                $projectMObj->save();
           
            }
       
        }
        
    
        
    }

}
