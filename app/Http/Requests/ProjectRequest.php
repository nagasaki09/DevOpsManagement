<?php

namespace App\Http\Requests;

use Atf\Http\Requests\AtfSearchRequest;
use App\Models\Users;

/**
 * 担当者モデルの入力値の取得とエラーチェック
 * @author y-hatsutori 
 */
class ProjectRequest extends AtfSearchRequest {

    /**
     * エラーチェックの条件を格納
     * @return array
     */
    public function rules()
    {
        $rules = [
            'customer_id' => 'required', // 顧客名
            'project_name' => 'required' // プロジェクト名
        ];
        
        // 入力された値を取得
        $search = $this->all();

        return $rules;
    }
    
    /**
     * エラーメッセージの表示を格納
     * @return [type] [description]
     */
    public function messages()
    {
        // エントリーフォームの入力値確認
        $messages = [
            'customer_id.required' => '顧客名を入力してください。',
            'project_name.required' => 'プロジェクト名を入力してください。'
        ];
        
        return $messages;
    }
    
}
