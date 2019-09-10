<?php

namespace Atf\Observers;

use Auth;

/**
 * ORMでinsertやupdateする前後にフックして
 * 何かしらの処理を指定
 * creating　→　インサート前
 * created　→　インサート後
 * updating　→　アップデート前
 * updated　→　アップデート後
 * saving　→　インサート前及びアップデート前
 * saved　→　インサート後及びアップデート後
 * deleting　→　デリート前
 * deleted　→　デリート後
 * restoring　→　ソフトデリート復帰前
 * restored　→　ソフトデリート復帰後
 */
class AtfObserver {

    // インサート前の処理
    public function creating( $model ) {
        $this->setCaseCreating($model);
    }

    // インサート後の処理
    //public function created( $model ) {}

    // アップデート前の処理
    public function updating( $model ) {
        $this->setCaseUpdating($model);
    }

    // アップデート後の処理
    //public function updated( $model ) {}

    // インサート前及びアップデート前の処理
    public function saving( $model ) {
        $this->setCaseSaving($model);
    }

    private function setCaseCreating( $model ){
        // ログインしているユーザー情報を取得
        $loginAccountObj = Auth::user();

        // ユーザー情報がある時
        if( !empty( $loginAccountObj ) == True ){
            $model->created_by = $loginAccountObj->id;
            $model->updated_by = $loginAccountObj->id;

        } else {
            // seeder用
            $model->created_by = '1';
            $model->updated_by = '1';
        }
        
    }

    private function setCaseUpdating( $model ){
        // ログインしているユーザー情報を取得
        $loginAccountObj = Auth::user();
        
        // ユーザー情報がある時
        if( !empty( $loginAccountObj ) == True ){
            $model->updated_by = $loginAccountObj->id;

        } else {
            // seeder用
            $model->updated_by = '1';
        }

    }

    private function setCaseSaving( $model ){
        // ログインしているユーザー情報を取得
        $loginAccountObj = Auth::user();

        $user_id = '1';

        // ユーザー情報がある時
        if( !empty( $loginAccountObj ) == True ){
            $user_id = $loginAccountObj->id;
        }
        
        if( $model->exists == True ){
            $model->updated_by = $user_id;
            $model->updated_at = date( "Y-m-d H:i:s" );

        } else {
            $model->created_by = $user_id;
            $model->updated_by = $user_id;
            $model->created_at = date( "Y-m-d H:i:s" );
            $model->updated_at = date( "Y-m-d H:i:s" );

        }

    }
}
