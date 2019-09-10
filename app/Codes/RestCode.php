<?php

namespace App\Codes;

use Atf\Codes\Code;

class RestCode extends Code {

    private $codes = [
        '0.15' => '15分',
        '0.30' => '30分',
        '0.45' => '45分',
        '1.0' => '1時間',

        '1.15' => '1時間15分',
        '1.30' => '1時間30分',
        '1.45' => '1時間45分',
        '2.0' => '2時間'
    ];
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct( $this->codes );
    }

}
