<?php

namespace App\Commands\Status;

use App\Models\Status;

/**
 * 年月の実績を取得するコマンド
 *
 * @author yhatsutori
 */
class ListCommand {

    /**
     * コンストラクタ
     * @param $requestObj 検索条件
     */
    public function __construct($requestObj) {
        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle() {
        // 値を初期化
        //$data = NULL;
        // 特定の値があるときにのみ、値を取得
        

        // 指定された担当者の年月の予定を取得
        $data = Status::getStatusInfo(
        $this->requestObj->names,
        $this->requestObj->image,
        $this->requestObj->created,
        $this->requestObj->updated_at,
        $this->requestObj->running_for,
        $this->requestObj->status,
        $this->requestObj->created_at
         );
        // $data .= Repository::getRepositoryInfo(
        //   );




        return $data;
    }

}
