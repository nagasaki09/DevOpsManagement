<?php

namespace App\Codes;

use Atf\Codes\Code;

class RowNumCode extends Code {

    private $codes = [
        '5'=>'5',
        '10'=>'10',
        '20' => '20',
        '30' => '30',
        '100'=>'100',
        '1000' => '1000'
    ];
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct( $this->codes );
    }

}
