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
      
        shell_exec('sudo curl --request POST --globoff --cacert /etc/gitlab-runner/certs/gl.do.vcx.jp.crt --header "PRIVATE-TOKEN: WYm4n-bXxX9s2bhvsJc_" "https://gl.do.vcx.jp/api/v4/projects/30/pipeline?ref=master"');
        
        return view( 'deploy.index');
    }  
    
}
