<?php

namespace App\Http\ViewComposers;

use App\Util\CodeUtil;
use App\Util\AppUtil;
use Illuminate\Contracts\View\View;
use Auth;

/**
 * Utilクラスを使う為の
 * ビューコンポーサー用のクラス
 */
class UtilComposer{
    
    protected $loginAccountObj;

    /**
     * Utilクラスのオブジェクトを取得
     */
    public function __construct(){
    }
    
    public function compose( View $view ){
        $view->with( 'CodeUtil', new CodeUtil() );
        $view->with( 'AppUtil', new AppUtil() );
    }

}