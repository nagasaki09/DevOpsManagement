<?php

namespace Atf\Codes;

class Code {

    private $values;

    /**
     * コンストラクタ
     * @param [type] $codes [description]
     */
    public function __construct($codes) {
        $this->values = collect($codes);
    }

    /**
     * 値の取得
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function getValue($code) {
        return $this->values->get($code);
    }

    /**
     * 値の一覧を取得
     * @return [type] [description]
     */
    public function getVaues() {
        return $this->values;
    }

    /**
     * 値の一覧を配列で取得
     * @return [type] [description]
     */
    public function getOptions() {
        return $this->getVaues()->toArray();
    }

    /**
     * キー指定の値の一覧を配列で取得
     * @return [type] [description]
     */
    public function getKeyOptions( $keyName="" ) {
        $list = array();

        
        // 値が空でないとき　かつ　配列の時
        if( !empty( $this->values ) == True ){
            
            // 値を取り出すループ
            foreach( $this->values as $key => $val ){
                
                $list[$key] = $val[$keyName];
                
            }   
        }        
        
        return $list;
    }

    /**
     * キーの一覧を配列で取得
     * @return [type] [description]
     */
    public function getCodes() {
        $filter = array("[", "\"", "]");
        $keys = str_replace($filter, "", $this->values->keys());
        return explode(',', $keys);
    }

    /**
     * 使ってない？
     * @return [type] [description]
     */
    public static function getDefault() {
        return null;
    }
    
    /**
     * 使ってない？
     * @return boolean [description]
     */
    public static function isLastValue() {
        return true;
    }
    
}
