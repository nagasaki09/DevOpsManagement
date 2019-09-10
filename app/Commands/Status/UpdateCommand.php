<?php

namespace App\Commands\Status;

use Atf\Http\Requests\AtfSearchRequest;
use App\Models\Status;
use DateTime;

/**
 * ホームのメモを更新するコマンド
 *
 * @author yhatsutori
 */
class UpdateCommand {

    /**
     * コンストラクタ
     * @param [type] $requestObj [description]
     */
    public function __construct() {
        
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle() {


       $status_list_raw = "";
            $connection = ssh2_connect('172.16.1.84');
            ssh2_auth_password($connection, 'atfworks', 'yoikuuki');
            $stream = ssh2_exec($connection, 'docker ps --format "{{.Names}}::{{.Image}}::{{.CreatedAt}}::{{.RunningFor}}::{{.Status}}::"');
            stream_set_blocking($stream, true);
            while (!feof($stream)) {
                $status_list_raw .= fread($stream, 8192);
            }
            fclose($stream);
            
            //取得したデータを配列に変換
            $status_list = explode("::", $status_list_raw);

            $statusNum_raw = count($status_list) - 1;
            
            //配列に変換した際の不要な値を削除
            unset($status_list[$statusNum_raw]);
            
            //配列に含まれる改行を削除
            $status_list1 = str_replace(array("\r", "\n"), '', $status_list);
            
            $status_list2 = [];

            $statusNum = (count($status_list) / 5) - 1;
            
            //取得する項目数を代入
            $typeNum = 5;

            //配列から連想配列を生成
            for ($i = 0; $i <= $statusNum; $i++) {
                
                $status_list2[$i]['name'] = $status_list1[$i*$typeNum];
                $status_list2[$i]['image'] = $status_list1[$i*$typeNum+1];
                $status_list2[$i]['created'] = new DateTime($status_list1[$i*$typeNum+2]);
                $status_list2[$i]['running_for'] = $status_list1[$i*$typeNum+3];
                $status_list2[$i]['status'] = $status_list1[$i*$typeNum+4];
                
            }
            
        $requestObj = $status_list2;

        $this->requestObj = $requestObj;

        // 更新する値の配列を取得
        $setValues = $this->requestObj;

        foreach ($setValues as $setValues2) {

            // 指定されたidのオブジェクトを取得
            $statusMObj = new Status();

            ##################
            ## データを格納
            ##################
            // 更新を行うカラム名
            $colums = [
                'name', // 
                'image', // 
                'created', // 
                'running_for', // 
                'status', // 
            ];

            //foreach ($colums as $colum) {
            //  if (!empty($this->requestObj->{$colum}) == True) {
            //    $imageMObj->{$colum} = $this->requestObj->{$colum};
            //  } else {
            //    $imageMObj->{$colum} = NULL;
            // }
            // }

            foreach ($colums as $colum) {
                if (!empty($setValues2[$colum]) == True) {
                    $statusMObj->{$colum} = $setValues2[$colum];
                } else {
                    $statusMObj->{$colum} = NULL;
                }
            }

            // データの更新
            $statusMObj->save();
        }
        return $statusMObj;
    }

}
