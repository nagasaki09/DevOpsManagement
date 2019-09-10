<?php

namespace App\Commands\Home;

use Atf\Http\Requests\AtfSearchRequest;
use App\Models\Home;

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
    public function __construct( $id, AtfSearchRequest $requestObj ){
        $this->id = $id;
        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 指定されたidのオブジェクトを取得
        $homeMObj = Home::find( $this->id );

        // Homeオブジェクトがnullの時
        if( is_null( $homeMObj ) == True ){
            $homeMObj = new Home();
        }

        // 更新する値の配列を取得
        $setValues = $this->requestObj->all();
        
        // 更新を行うカラム名
        $colums = [
            'memo' // メモ
        ];
        
        foreach ( $colums as $colum ) {
            if( !empty( $this->requestObj->{$colum} ) == True ){
                $homeMObj->{$colum} = $this->requestObj->{$colum};
            }else{
                $homeMObj->{$colum} = NULL;
            }
        }
        
        // データの更新
        $homeMObj->save();
                
        return $homeMObj;
    }

}
