<?php

namespace App\Http\Controllers\Status;

use App\Util\SessionUtil;

trait tStatusController{

    ###################
    ## 便利メソッド
    ###################

    /**
     * Project IDを取得する
     * @return [type] [description]
     */
    public function getProjectId( $search ){
        // プロジェクトIDを初期化
        $projectId = 0;
        
        
        
        $search["project_id"] = 9;
        // プロジェクトが選択された時
        if( isset( $search["project_id"] ) == True && !empty( $search["project_id"] ) == True ){
            // プロジェクトIDをセッションに登録
            SessionUtil::putProject( $search["project_id"] );

            // プロジェクトIDの取得
            $projectId = $search["project_id"];

        }elseif( SessionUtil::hasProject() == True ){
            // セッションにプロジェクトIDが指定されている時
            // プロジェクトIDの取得
            $projectId = SessionUtil::getProject();

        }

        return $projectId;
    }

}
