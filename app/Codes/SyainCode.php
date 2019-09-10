<?php

namespace App\Codes;

use Atf\Codes\Code;

class SyainCode extends Code {

    private $codes = [
        '1' => '社員',
    ];
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct( $this->codes );
    }

}
