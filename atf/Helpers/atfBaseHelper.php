<?php

#####################
## phpの関数のラッパー関数
#####################

if ( !function_exists('atfIsset') == True ){
        
    /**
     * オリジナルisset
     * @param  value $checkVal 値が存在するかを調べる値
     * @param  string $setValue 値が存在しない時の値
     * @return 成功：$checkValue 失敗：setValue
     */
    function atfIsset( $checkValue, $setValue="" ){
        if( isset( $checkValue ) ){
            if( !empty( $checkValue ) ){
                return $checkValue;
            }
        }
        return $setValue;
    }

}

if ( !function_exists('atfSetObjectParams') == True ){

    /**
     *  値を代入したいオブジェクトに、配列又は、オブジェクトの値を格納する
     * @param  object or array $paramVar オブジェクトのメンバ変数に代入するオブジェクト又は配列
     * @param  object &$setObject 値を代入するオブジェクト
     */
    function atfSetObjectParams( $paramVar, &$setObject=NULL ){
        // paramVar は配列か、オブジェクトで渡す。

        // セッションの値が空でない時に動作
        if( !empty( $paramVar ) == true && !is_null( $setObject ) == true ){
            // セッションの値を取得
            foreach( $paramVar as $key => $value ){
                // 代入先の変数があるか
                if( isset( $setObject->$key ) == true ){
                    // 代入する値が配列ではないか
                    if( !is_array( $value ) == true ){
                        $setObject->$key = atfIsset( $value, $setObject->$key );
                    }
                }
            }
        }
    }

}

if ( !function_exists('atfTrim') == True ){

    /**
     * 全角をスペースを半角スペースにする
     * @param  string $value
     * @param  string $typeFlg 未使用
     * @return 半角スペースにした値
     */
    function atfTrim( $value, $typeFlg="" ){
        $value = str_replace( '　', ' ', $value );
        $value = trim( $value );

        return $value;
    }

}

if ( !function_exists('atfPadding') == True ){

    /**
     * 指定された数のパディングを行う
     * @param  [type]  $value   [description]
     * @param  integer $padding [description]
     * @return [type]           [description]
     */
    function atfPadding( $value, $padding=8 ){
        //$param = '%0' . $padding . 'd'; // e は数値
        $param = '%0' . $padding . 's'; // s は文字列
        $value = sprintf( $param, $value );
        return $value;
    }

}

#####################
## 文字
#####################

if ( !function_exists('atfStrSplit') == True ){

    /**
     * 日本語対応の文字列分割関数
     * @param  [type]  $str       分割元文字列
     * @param  integer $split_len 文字数
     * @return [type]             分割した文字を格納した配列
     */
    function atfStrSplit($str, $split_len = 1) {

        mb_internal_encoding('UTF-8');
        mb_regex_encoding('UTF-8');

        if ($split_len <= 0) {
            $split_len = 1;
        }

        $strlen = mb_strlen($str, 'UTF-8');
        $ret    = array();

        for ($i = 0; $i < $strlen; $i += $split_len) {
            $ret[] = mb_substr($str, $i, $split_len);
        }
        return $ret;
    }

}

if ( !function_exists('atfShowTateText') == True ){

    /**
     * 文字を縦表示とする
     * @param  [type] $text [description]
     * @return [type]       [description]
     */
    function atfShowTateText( $text ){
        $num = mb_strlen( $text );
        for( $i=0; $i<$num; $i++ ) {
            echo mb_substr( $text, $i, 1, "UTF-8" ) . "<br>";
        }
    }

}

#####################
## 配列
#####################
    
if ( !function_exists('atfArrayTrim') == True ){

    /**
     * 指定された配列の中の不要なスペースを除去
     * @param  array $array [description]
     * @return array 不要なスペースを除去した配列
     */
    function atfArrayTrim( $array ) {
        $result = [];
        
        foreach( $array as $value ) {
            $result[] = trim( $value );
        }
        return $result;
    }

}

#####################
## 日付関連
#####################

if ( !function_exists('atfGetDayOfWeek') == True ){

    /**
     * 指定された日付の曜日を取得
     * @param  [type] $year   [description]
     * @param  [type] $month  [description]
     * @param  [type] $dayNum [description]
     * @return [type]         [description]
     */
    function atfGetDayOfWeek( $year=NULL, $month=NULL, $dayNum=NULL ){
        // 曜日の値を初期化
        $dayOfWeek = "";

        // 引数の値がからでないときに処理
        if( !empty( $year ) == True && !empty( $month ) == True && !empty( $dayNum ) == True ){
            // 曜日の値を格納
            $weekList = array( "日", "月", "火", "水", "木", "金", "土" );

            // 日付のオブジェクトを作成
            $datetime = new DateTime();
            // 特定の日付を指定
            $datetime->setDate( $year, $month, $dayNum );
            // 該当する曜日の値を数値で取得
            $weekNum = (int)$datetime->format('w');
            
            // 値が存在するときに曜日を取得
            if( isset( $weekList[$weekNum] ) == True ){
                $dayOfWeek = $weekList[$weekNum];
            }
        }

        return $dayOfWeek;
    }

}

if ( !function_exists('atfGetMonthDaysSum') == True ){

    /**
     * 指定された年月の日付の総数を取得
     * @param  [type] $year  [description]
     * @param  [type] $month [description]
     * @return [type]        [description]
     */
    function atfGetMonthDaysSum( $year=NULL, $month=NULL ){
        // 31日の日の月の時
        if( in_array( $month, ["1","3","5","7","8","10","12"] ) == True ){
            return 31;
        }

        // 30日の日の月の時
        if( in_array( $month, ["4","6","9","11"] ) == True ){
            return 30;
        }

        // うるう年判定
        if( in_array( $month, ["2"] ) == True ){
            if( $year % 4 == 0 ){
                if( $year % 100 == 0 ){
                    if( $year % 400 == 0 ){
                        return 29;
                    }else{
                        return 28;
                    }

                }else{
                    return 29;
                }

            }else{
                return 28;
            }

        }

        return 0;
    }

}

#####################
## メール関連
#####################

if ( !function_exists('atfSendMail') == True ){

    /**
     * メール送信用関数
     * @param  string $to         メールの宛先
     * @param  string $subject    メールのタイトル
     * @param  string $body       メールの本文
     * @param  string $from_email 送信用のメールアドレス
     * @param  string $from_name  送信者名
     * @return 成功： 失敗：false
     */
    function atfSendMail( $to, $subject, $body, $from_email, $from_name ){
        // 言語、文字コードを指定
        mb_language("Ja");
        mb_internal_encoding("UTF-8");
        
        // 差出人を日本語表示
        $mailfrom="From:" .mb_encode_mimeheader( $from_name ) ."<" . $from_email .">";
        
        // 送信先、件名、本文、差出人を日本語でメール送信実行
        $result = mb_send_mail( $to, $subject, $body, $mailfrom );
        
        return $result;
    }
    
}

if ( !function_exists('d') ){

    /**
     * 色をつけた文字の出力(デバッグ)
     * @return [type] [description]
     */
    function d(){
        echo '<pre style="background:#fff;color:#333;border:1px solid #ccc;margin:2px;padding:4px;font-family:monospace;font-size:12px">';
        foreach ( func_get_args() as $v ){
            var_dump( $v );
        }
        echo '</pre>';
    }

}
