<?php

namespace App\Commands\Repository;

use App\Models\Repository;

/**
 * 年月の実績を取得するコマンド
 *
 * @author yhatsutori
 */
class ListCommandR {
    
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
                $data = Repository::getRepositoryInfo(
                    $this->requestObj->project_id,
                    $this->requestObj->project_name,
                    $this->requestObj->pull_count,
                    $this->requestObj->repository_name,
                    $this->requestObj->tags_count
                    
                   
                );
                
               // $data .= Repository::getRepositoryInfo(
                    
                 //   );
                
            
        
        
        return $data;
    }
    
    
    
}
