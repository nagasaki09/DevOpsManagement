<?php

namespace App\Commands\Image;

use App\Models\Image;

/**
 * 年月の実績を取得するコマンド
 *
 * @author yhatsutori
 */
class ListCommandI {
    
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
        
       
            
               
                $data = Image::getImageInfo(
                    $this->requestObj->digest,
                    $this->requestObj->name,
                    $this->requestObj->size,
                    $this->requestObj->architecture,
                    $this->requestObj->os,
                    $this->requestObj->docker_version,
                    $this->requestObj->created
                   
                );
                
               // $data .= Repository::getRepositoryInfo(
                    
                 //   );
                
            
        
        
        return $data;
    }
    
}
