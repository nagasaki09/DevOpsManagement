<?php

namespace Atf\Util;

use Session;

class AtfSessionUtil {
    
    ######################
    ## sort
    ######################

    /**
     * 並び順を登録(セッション)
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function putSort( $value ) {
        Session::put('sort', $value);
    }
    
    /**
     * 並び順を取得(セッション)
     * @return [type] [description]
     */
    public static function getSort() {
        return Session::get('sort');
    }

    /**
     * 並び順を削除(セッション)
     * @return [type] [description]
     */
    public static function removeSort() {
        Session::forget('sort');
    }

    ######################
    ## search
    ######################
    
    /**
     * 検索値を登録(セッション)
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function putSearch( $array ) {
        Session::put('search', $array);
    }

    /**
     * 検索値を取得(セッション)
     * @return [type] [description]
     */
    public static function getSearch() {
        return Session::get('search');
    }

    /**
     * 検索値を削除(セッション)
     * @return [type] [description]
     */
    public static function removeSearch() {
        Session::forget('search');
    }

    /**
     * 検索値のセッションを保持するかを調べる
     * @return boolean [description]
     */
    public static function hasSearch(){
        if ( Session::has('search') ) {
            return true;
        } else {
            return false;
        }
    }

    ######################
    ## remove
    ######################
    
    /**
     * 検索情報と並び替え情報を削除
     * @return [type] [description]
     */
    public static function removeSession() {
        // 検索情報を初期化
        Session::forget('search');
        // 並び替え情報を初期化
        Session::forget('sort');
    }

}
