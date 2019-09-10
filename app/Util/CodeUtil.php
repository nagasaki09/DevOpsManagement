<?php

namespace App\Util;

// 共通
use App\Models\Users;
use App\Codes\RowNumCode; // 表示件数

// アカウント
use App\Codes\RoleCode; // 権限
use App\Codes\SyainCode; // 社員
use App\Codes\PostCode; // 所属

// プロジェクト
use App\Models\Customer;

// タスク
use App\Models\Project;
use App\Models\Status;
use App\Models\Priority;
use App\Models\Serious;

/**
 * プルダウンで使う関数をまとめたクラス
 * （共通項目）
 */
class CodeUtil {

    #####################
    ## 共通
    #####################

    /**
     * アカウントの一覧を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getUsersList(){
        // 管理者以外のアカウントの一覧を取得
        $usersList = Users::getSearchUsers();

        $codes = [];
        
        // アカウントの一覧から、シンプルなアカウントの配列を作成
        foreach( $usersList as $key => $value ){
            $codes[$value->id] = $value->name;
        }

        return $codes;
    }

    /**
     * アカウントの一覧を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getUsersFullList(){
        // 管理者以外のアカウントの一覧を取得
        $usersList = Users::getSearchFullUsers();

        $codes = [];
        
        // アカウントの一覧から、シンプルなアカウントの配列を作成
        foreach( $usersList as $key => $value ){
            $codes[$value->id] = $value->name;
        }

        return $codes;
    }

    /**
     * アカウントの名前を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getUsersName( $num ){
        //
        $codes = self::getUsersFullList();
        if( isset( $codes[$num] ) == True ){
            return $codes[$num];
        }else{
            return "";
        }
    }
    
    /**
     * 表示件数一覧を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getRowNumList(){
        $codes = ( new RowNumCode() )->getOptions();
        
        return $codes;
    }

    /**
     * 表示件数を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getRowNumName( $num ){
        //
        $codes = self::getRoleList();
        if( isset( $codes[$num] ) == True ){
            return $codes[$num];
        }else{
            return "";
        }
    }

    #####################
    ## アカウント
    #####################

    /**
     * アカウントの権限一覧を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getRoleList(){
        $codes = ( new RoleCode() )->getOptions();
        
        return $codes;
    }

    /**
     * アカウントの権限を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getRoleName( $num ){
        //
        $codes = self::getRoleList();
        if( isset( $codes[$num] ) == True ){
            return $codes[$num];
        }else{
            return "";
        }
    }

    /**
     * アカウントの社員かどうかの一覧を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getSyainList(){
        $codes = ( new SyainCode() )->getOptions();
        
        return $codes;
    }

    /**
     * アカウントの社員かどうかを取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getSyainName( $num ){
        //
        $codes = self::getSyainList();
        if( isset( $codes[$num] ) == True ){
            return $codes[$num];
        }else{
            return "";
        }
    }

    /**
     * アカウントの所属一覧を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getPostList(){
        $codes = ( new PostCode() )->getOptions();
        
        return $codes;
    }

    /**
     * アカウントの所属を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getPostName( $num ){
        //
        $codes = self::getPostList();
        if( isset( $codes[$num] ) == True ){
            return $codes[$num];
        }else{
            return "";
        }
    }
    
    #####################
    ## タスク
    #####################

    /**
     * プロジェクトの一覧を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getProjectList(){
        // 顧客の一覧を取得
        $projectList = Project::orderBys( ['group_id' => 'asc', 'customer_id' => 'asc'] )
                               ->pluck( 'project_name', 'id' );

        $codes = [];
        
        // アカウントの一覧から、シンプルなアカウントの配列を作成
        foreach( $projectList as $key => $value ){
            $codes[$key] = $value;
        }

        return $codes;

    }

    /**
     * プロジェクトの名前を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getProjectName( $num ){
        //
        $codes = self::getProjectList();
        if( isset( $codes[$num] ) == True ){
            return $codes[$num];
        }else{
            return "";
        }
    }

}
