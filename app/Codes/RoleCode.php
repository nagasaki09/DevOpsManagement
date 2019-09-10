<?php

namespace App\Codes;

use Atf\Codes\Code;
use Auth;

class RoleCode extends Code {

    private $codes = [
        '1' => '管理者',
        '2' => 'マネージャー',
        '3' => 'ユーザー'
    ];
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        // 設定する値
        $setCodes = [];

        // ユーザー情報を取得
        $loginAccountObj = Auth::user();
        
        // デフォルトの権限の中身を確認
        foreach( $this->codes as $key => $value ){
            // 自分の権限以下の権限を選択可能
            if( $loginAccountObj->getLoginUserRole() <= $key ){
                $setCodes[$key] = $value;
            }

        }

        parent::__construct( $setCodes );
    }

}
