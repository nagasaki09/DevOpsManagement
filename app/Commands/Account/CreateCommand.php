<?php

namespace App\Commands\Account;

use App\Http\Requests\UsersRequest;
use App\Models\Users;

/**
 * アカウント情報を論理削除するコマンド
 *
 * @author yhatsutori
 */
class CreateCommand {

    /**
     * コンストラクタ
     * @param [type] $requestObj [description]
     */
    public function __construct( UsersRequest $requestObj ){
        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 指定されたidのオブジェクトを取得
        $usersMObj = new Users();

        // 更新する値の配列を取得
        $setValues = $this->requestObj->all();
        
        // 更新を行うカラム名
        $colums = [
            'name', // アカウント名
            'name_short', // 苗字

            'staff_id', // 作業者ID(ATFユーザーID)
            'contact_ran', // 連絡先
            'contact_ran_oya', // 連絡先(親)
            'tokki_jikou', // 特記事項
            'kouza_number', // 口座番号
            
            'email', // ID(E-mail)
            'password_show', // パスワード
            'role', // 権限
            'syain_flg', // 社員
            'post', // 所属
            'hour_start', // 開始時刻
            'hour_end', // 終了時刻
            'cost_trance', // 交通費
            'trance', // 行程
            'key_flg', // 鍵フラグ
            'card_flg' // カードフラグ
        ];
        
        foreach ( $colums as $colum ) {
            if( !empty( $this->requestObj->{$colum} ) == True ){
                $usersMObj->{$colum} = $this->requestObj->{$colum};
            }else{
                $usersMObj->{$colum} = NULL;
            }
        }
        
        // 交通費は数値で保持
        if( empty( $usersMObj->cost_trance ) == True ){
            $usersMObj->cost_trance = 0;
        }

        // パスワードはハッシュ化
        $usersMObj->password = \Hash::make($usersMObj->password_show);

        // データの更新
        $usersMObj->save();
                
        return $usersMObj;
    }

}
