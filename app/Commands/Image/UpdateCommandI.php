<?php

namespace App\Commands\Image;

use Atf\Http\Requests\AtfSearchRequest;
use App\Models\Image;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * ホームのメモを更新するコマンド
 *
 * @author yhatsutori
 */
class UpdateCommandI {

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
        
        $repository_name = $_SESSION['repository'];
       
        $images = shell_exec('curl -u atfworks:Green4Yoikuuki! -k https://vss206.intra.atf.co.jp:8888/api/repositories/' . $repository_name . '/tags');

        $requestObj = json_decode($images);

        $this->requestObj = $requestObj;
        
         // 更新する値の配列を取得
            $setValues = $this->requestObj;

            $setValues2 = json_decode(json_encode($setValues), true);

        foreach ($setValues2 as $setValues3) {
            
            $setValues3["repository_name"] = $repository_name;
            
             $imageMObj = Image::where('digest', '=', $setValues3["digest"])
                           ->first();
            
            if (!empty($imageMObj) == True) {
            } else {
             //指定されたidのオブジェクトを取得
              $imageMObj = new Image();
            }
            ##################
            ## データを格納
            ##################
            // 更新を行うカラム名
            $colums = [
                'digest',
                'name', // 
                'size', // 
                'architecture', // 
                'os', // 
                'docker_version', // 
                'author', // 
                'created',
                'repository_name'// 
            ];

            //foreach ($colums as $colum) {
            //  if (!empty($this->requestObj->{$colum}) == True) {
            //    $imageMObj->{$colum} = $this->requestObj->{$colum};
            //  } else {
            //    $imageMObj->{$colum} = NULL;
            // }
            // }

            foreach ($colums as $colum) {
                if (!empty($setValues3[$colum]) == True) {
                    $imageMObj->{$colum} = $setValues3[$colum];
                } else {
                    $imageMObj->{$colum} = NULL;
                }
            }
            
            // データの更新
            $imageMObj->save();
        }
        return $imageMObj;
        }
    }


