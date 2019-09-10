<?php

namespace App\Commands\Common;

use App\Models\Schedule;
use App\Models\Users;

/**
 * 担当者の一覧を取得
 *
 * @author y-hatsutori
 */
class UsersListCommand {
    
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
        // 検索部分で表示されるスタッフ名を取得
        $usersData = Users::getFullhUsers();
        
        return $usersData;
    }
    
}
