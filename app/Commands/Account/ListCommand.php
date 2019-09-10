<?php

namespace App\Commands\Account;

use App\Models\Users;

/**
 * 取り込みデータの実績一覧を取得するコマンド
 *
 * @author yhatsutori
 */
class ListCommand {

    /**
     * コンストラクタ
     * @param array $sort 並び順
     * @param $requestObj 検索条件
     */
    public function __construct( $requestObj, $sort ){
        $this->requestObj = $requestObj;
        $this->sort = $sort;

        // カラムとヘッダーの値を取得
        $csvParams = $this->getCsvParams();
        // カラムを取得
        $this->columns = array_keys( $csvParams );
        // ヘッダーを取得
        $this->headers = array_values( $csvParams );
    }

    /**
     * カラムとヘッダーの値を取得
     * @return array
     */
    private function getCsvParams(){
        return [
            'id' => 'id',
            'name' => 'アカウント名',
            'name_short' => 'アカウント名(苗字)',
            'email' => 'ID',
            'password' => 'パスワード',
            'role' => '権限',
            'syain_flg' => '社員',
            'post' => '所属',
            'hour_start' => '開始時刻',
            'hour_end' => '終了時刻',
            'cost_trance' => '交通費',
            'trance' => '行程',
            'key_flg' => '鍵フラグ',
            'card_flg' => 'カードフラグ',
            'remember_token' => 'トークン',
            'created_at' => '作成日時',
            'updated_at' => '更新日時'
        ];
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 検索条件を指定
        $builderObj = Users::whereRequest( $this->requestObj );

        // 並び替えの処理
        $builderObj = $builderObj->orderBys( $this->sort['sort'] );
        
        // ペジネートの処理
        $data = $builderObj
                    ->paginate( $this->requestObj->row_num, $this->columns )
                    // 表示URLをpagerに指定
                    ->setPath('pager');
        
        return $data;
    }

}
