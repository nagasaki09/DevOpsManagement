<?php

namespace App\Codes;

use Atf\Codes\Code;

class PostCode extends Code {

    private $codes = [
        '1' => 'テクニカルサポートG',
        '2' => 'ITソリューションG',
        '3' => 'ビジネスイノベーションG',
    ];
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct( $this->codes );
    }

}
