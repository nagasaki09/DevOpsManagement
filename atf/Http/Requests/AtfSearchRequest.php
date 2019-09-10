<?php

namespace Atf\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 入力値の取得とエラーチェック
 * @author y-hatsutori
 */
class AtfSearchRequest extends FormRequest {
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    ###################
    ## エラー関係
    ###################
    
    /**
     * エラーチェックの条件を格納
     * @return array
     */
    public function rules()
    {
        return [];
    }
    
    /**
     * エラーメッセージの表示を格納
     * @return [type] [description]
     */
    public function messages()
    {
        // エントリーフォームの入力値確認
        $messages = [];
        
        return $messages;
    }
    
    ###################
    ## 入力値関係
    ###################
    
    /**
     * 指定された配列の値を格納した、検索オブジェクトを取得
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public static function getInstance( $array=null ) {
        $requestObj = static::setCommonCondition();
        
        if( !empty( $array ) ) {
            foreach ( $array as $key => $value ) {
                $requestObj->{$key} = $value;
            }
        }
        
        return $requestObj;
    }
    
    /**
     * 初期状態のクエリー情報を扱う検索オブジェクトを作成
     */
    private static function setCommonCondition() {
        
        $requestObj = new AtfSearchRequest();
        $requestObj->row_num = 20;
        
        return $requestObj;
    }
    
}
