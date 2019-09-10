<?php

namespace App\Http\Controllers\Image;

use Atf\Http\Requests\AtfSearchRequest;
use Atf\Http\Controllers\AtfController;
use App\Http\Controllers\Image\tImageEditController;
use App\Http\Controllers\Image\tImageController;
use App\Commands\Image\UpdateCommand;
use App\Commands\Project\ListCommandP;
use App\Commands\Project\UpdateCommandP;
use App\Commands\Repository\ListCommandR;
use App\Commands\Image\ListCommandI;
use App\Util\SessionUtil;

/**
 * イメージ一覧を管理するコントローラー
 */
class ImageController extends AtfController
{
    use tImageController, tImageEditController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        // 表示部分で使うオブジェクトを作成
        $this->initDisplayObj();
    }

    #######################
    ## initalize
    #######################

    /**
     * 表示部分で使うオブジェクトを作成
     * @return [type] [description]
     */
    public function initDisplayObj(){
        // 表示部分で使うオブジェクトを作成
        $this->displayObj = app('stdClass');
        // カテゴリー名
        $this->displayObj->category = "image";
        // 画面名
        $this->displayObj->page = "projectList";
        // 基本のテンプレート
        $this->displayObj->tpl = $this->displayObj->category . "." . $this->displayObj->page;
        // コントローラー名
        $this->displayObj->ctl = "Image\ImageController";
        // 出力するcsvファイル名
        $this->displayObj->csvFileName = 'account_list.csv';
    }

    /**
     * 一覧に表示する値を取得する
     * @param  [type] $search     [description]
     * @param  [type] $sort       [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    
    public function getUpdate(){
        // 指定されたidを削除
        $this->dispatch(
            new UpdateCommand(
                
            )
        );

        // 一覧画面にリダイレクト
        return redirect('image');
    }
    
   

    /**
     * 一覧に表示する値を取得する
     * @param  [type] $search     [description]
     * @param  [type] $sort       [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function showListData( $search, $sort, $requestObj ){
        
        //最新のプロジェクト一覧に更新
        $this->dispatch(
            new UpdateCommandP()
        );
       
        // そもそも取得できないので引数はnullにしている
       $showDataP = $this->dispatch(
            new ListCommandP(
                $requestObj
            )
        );
       
       $showDataR = $this->dispatch(
            new ListCommandR(
                $requestObj
            )
        );
       
       $showDataI = $this->dispatch(
            new ListCommandI(
                $requestObj
            )
        );
        
       
      
        return view(
            'image.projectList.index',
            compact(
                'requestObj',
                'search',
                'showDataP',
                'showDataR',
                'showDataI',
                'sortTypes',
                'projectId'
            )
        )
        ->with( "title", "イメージ一覧" )
        ->with( "displayObj", $this->displayObj )
        ->with( "sortUrl", action( $this->displayObj->ctl . '@getSort' ) );
    }

}
