<?php

namespace App\Commands\Deploy;

use App\Models\Deploy;

/**
 * 年月の実績を取得するコマンド
 *
 * @author yhatsutori
 */
class DeployCommand {
    /**
     * メインの処理
     * @return [type] [description]
     */
    public function postDeploy(){
      
        shell_exec('sudo curl --request POST --globoff --cacert "');
        
        return view( 'deploy.index');
    }  
    
}
