<?php

namespace App\Util;

use Session;

class SessionUtil {

    ######################
    ## project
    ######################
    
    /**
     * プロジェクトのIDを登録(セッション)
     * @param  [type] $Pid [description]
     * @return [type]     [description]
     */
    public static function putProject( $Pid ) {
        Session::put('project', $Pid);
    }

    /**
     * プロジェクトのIDを取得(セッション)
     * @return [type] [description]
     */
    public static function getProject() {
        return Session::get('project');
    }

    /**
     * プロジェクトのIDを削除(セッション)
     * @return [type] [description]
     */
    public static function removeProject() {
        Session::forget('project');
    }

    /**
     * プロジェクトのIDのセッションを保持するかを調べる
     * @return boolean [description]
     */
    public static function hasProject(){
        if ( Session::has('project') ) {
            return true;
        } else {
            return false;
        }
    }

}
