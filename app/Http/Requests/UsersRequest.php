<?php

namespace App\Http\Requests;

use Atf\Http\Requests\AtfSearchRequest;
use App\Models\Users;

/**
 * 担当者モデルの入力値の取得とエラーチェック
 * @author y-hatsutori 
 */
class UsersRequest extends AtfSearchRequest {

    /**
     * エラーチェックの条件を格納
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required', // アカウント名
            'name_short' => 'required', // アカウント名(苗字)
            'password_show' => 'required', // パスワード
            'role' => 'required', // 権限
            'post' => 'required', // 所属
            'cost_trance' => 'numeric', // 交通費(往復)
        ];
        
        // 入力された値を取得
        $search = $this->all();
        
        // 指定されたEメールアドレスが0かどうかを調べる
        $count = Users::where( 'email', '=', $search["email"] )->count();
        
        // 実際の値を取得
        $data = Users::where( 'email', '=', $search["email"] )->get();

        // カウントが1以上の時はエラー
        if( $count > 0 && $data[0]->id != $search["id"] ){
            $rules['email'] = 'required|regex:/^[-+.\\w]+@[-a-z0-9]+(\\.[-a-z0-9]+)*\\.[a-z]{2,6}$/i|unique:users,email'; // ID
        }else{
            $rules['email'] = 'required|regex:/^[-+.\\w]+@[-a-z0-9]+(\\.[-a-z0-9]+)*\\.[a-z]{2,6}$/i';
        }

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
            'name.required' => 'アカウント名を入力してください。',
            'name_short.required' => 'アカウント名(苗字)を入力してください。',
            'email.required' => 'IDを入力してください。',
            'email.regex' => 'IDはメールアドレスの形式で入力してください。',
            'email.unique' => '入力されたIDは既に登録されています。',
            'password_show.required' => 'パスワードを入力してください。',
            'role.required' => '権限を選択してください。',
            'post.required' => '所属を選択してください。',
            'cost_trance.numeric' => '交通費(往復)を数値で入力してください。',
        ];
        
        return $messages;
    }
    
}
