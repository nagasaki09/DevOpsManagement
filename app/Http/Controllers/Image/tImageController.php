<?php

namespace App\Http\Controllers\Image;

use App\Util\SessionUtil;

trait tImageController{

    ###################
    ## 便利メソッド
    ###################

    /**
     * Project IDを取得する
     * @return [type] [description]
     */
    public function getProjectId( $showDataP ){
        // プロジェクトIDを初期化
        $projectId = 0;
        
        
        
        $showDataP["project_id"] = 3;
        // プロジェクトが選択された時
        if( isset( $showDataP["project_id"] ) == True && !empty( $showDataP["project_id"] ) == True ){
            // プロジェクトIDをセッションに登録
            SessionUtil::putProject( $showDataP["project_id"] );

            // プロジェクトIDの取得
            $projectId = $showDataP["project_id"];

        }elseif( SessionUtil::hasProject() == True ){
            // セッションにプロジェクトIDが指定されている時
            // プロジェクトIDの取得
            $projectId = SessionUtil::getProject();

        }

        return $projectId;
    }

}
