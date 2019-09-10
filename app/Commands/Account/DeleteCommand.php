<?php

namespace App\Commands\Account;

use App\Models\Users;

/**
 * アカウント情報を論理削除するコマンド
 *
 * @author yhatsutori
 */
class DeleteCommand {

    /**
     * コンストラクタ
     * @param [type] $requestObj [description]
     */
    public function __construct( $id ){
        $this->id = $id;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 指定されたidのオブジェクトを取得
        $usersMObj = Users::findOrFail( $this->id );
        // ソフトデリート
        $usersMObj->delete();
    }

}
