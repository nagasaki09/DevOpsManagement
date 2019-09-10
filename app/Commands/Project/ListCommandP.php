<?php

namespace App\Commands\Project;

use App\Models\Project;

/**
 * 年月の実績を取得するコマンド
 *
 * @author yhatsutori
 */
class ListCommandP {
    
    /**
     * コンストラクタ
     * @param $requestObj 検索条件
     */
    public function __construct( $requestObj ){
        $this->requestObj = $requestObj;
    }
    
    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 値を初期化
        //$data = NULL;
        
        // 特定の値があるときにのみ、値を取得
       
            
                // 指定された担当者の年月の予定を取得
                $data = Project::getProjectInfo(
                    $this->requestObj->project_id,
                    $this->requestObj->name,
                    $this->requestObj->creation_time,
                    $this->requestObj->update_time,
                    $this->requestObj->repo_count
                   
                );
                
               // $data .= Repository::getRepositoryInfo(
                    
                 //   );
                
            
        
        
        return $data;
    }
    
}
