<?php

namespace Atf\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;

/**
 * ログインしているユーザー情報を取得する
 * ビューコンポーサー用のクラス
 */
class AtfLoginAccountComposer{
    
    protected $loginAccountObj;

    /**
     * ログイン情報の取得
     */
    public function __construct(){
        // ユーザー情報を取得
        $loginAccountObj = Auth::user();
        
        if ( !empty( $loginAccountObj ) ) {
            $this->loginAccountObj = $loginAccountObj;
        } else {
            $this->loginAccountObj = null;
        }
    }

    public function compose( View $view ){
        $view->with( 'loginAccountObj', $this->loginAccountObj );
    }

}