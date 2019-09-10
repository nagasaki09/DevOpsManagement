<?php

namespace App\Http\Controllers\Image;

use App\Http\Requests\ProjectRequest;
use App\Models\Image;
use App\Models\Repository;
use App\Models\Project;
use App\Commands\Image\UpdateCommandI;
use App\Commands\Project\UpdateCommandP;
use App\Commands\Repository\UpdateCommandR;

trait tImageEditController{

    ###################
    ## 詳細
    ###################
    
    /**
     * 詳細を取得
     * @param  [type] $Pid [description]
     * @return [type]     [description]
     */
    public function getRepositoryDetail($Pid ){
        
         $this->dispatch(
            new UpdateCommandR()
        );
        
       $repository = Repository::where('project_id',$Pid)->get();
        //dd($pid);
       
           return view(
                'image.repositoryList.index',
                compact(
                    'projectMObj',
                    'repository',
                    'Pid'
                )
           )
            ->with( "title", "リポジトリ一覧" )
            ->with( "displayObj", $this->displayObj );

    }
    
    public function getImageDetail($Pid, $project_name, $repository_name ){
       //URLに指定する変数内にスラッシュが使えないのでここで名前を結合
       $repository = $project_name.'/'.$repository_name;
       
        session_start();
         $_SESSION['repository'] = $repository;
        $this->dispatch(
            new UpdateCommandI()
        );
        
       $image = Image::where('repository_name',$repository)->get();
      
           return view(
                'image.imageList.index',
                compact(
                    'projectMObj',
                    'image',
                    'Pid',
                    'repository'
                )
           )
            ->with( "title", "イメージ一覧" )
            ->with( "displayObj", $this->displayObj );

    }

    ###################
    ## 登録
    ###################
    
    /**
     * 登録画面を開く
     * @return [type] [description]
     */
    public function getCreate(){
        // 担当者モデルを取得
        $projectMObj = new Project();

        return view(
            'project.input.input',
            compact(
                'projectMObj'
            )
        )
        ->with( "title", "プロジェクト登録" )
        ->with( "displayObj", $this->displayObj )
        ->with( "inputType", "create" );
    }

    
    /**
     * 登録処理を行う
     * @param  ProjectRequest $requestObj [description]
     * @return [type]                   [description]
     */
    public function getProjectUpdate(){
      
       
        $this->dispatch(
            new UpdateCommandP()
        );
       
        // 一覧画面にリダイレクト
        return redirect('image');
        
    }
    
    public function getRepositoryUpdate($Pid){
      
       
        $this->dispatch(
            new UpdateCommandR()
        );
   $repository = Repository::where('project_id',$Pid)->get();
        //dd($pid);
       
           return view(
                'image.repositoryList.index',
                compact(
                    'projectMObj',
                    'repository',
                    'Pid'
                )
           )
            ->with( "title", "リポジトリ一覧" )
            ->with( "displayObj", $this->displayObj );

    }
         
    
    
    public function getImageUpdate($Pid, $project_name, $repository_name){
         //URLに指定する変数内にスラッシュが使えないのでここで名前を結合
       $repository = $project_name.'/'.$repository_name;
        session_start();
         $_SESSION['repository'] = $repository;
        $this->dispatch(
            new UpdateCommandI()
        );
        $image = Image::where('repository_name',$repository)->get();
      
           return view(
                'image.imageList.index',
                compact(
                    'projectMObj',
                    'image',
                    'Pid',
                    'repository'
                )
           )
            ->with( "title", "イメージ一覧" )
            ->with( "displayObj", $this->displayObj );
     
    }

    ###################
    ## 編集
    ###################
    
    /**
     * 編集画面を開く
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getEdit( $id=NULL ){
        // idがからでないときに処理
        if( !empty( $id ) == True ){
            // 指定されたidのオブジェクトを取得
            $projectMObj = Project::findOrFail( $id );

            return view(
                'project.input.input',
                compact(
                    'projectMObj'
                )
            )
            ->with( "title", "プロジェクト編集" )
            ->with( "displayObj", $this->displayObj )
            ->with( "inputType", "edit" );

        }else{
            // 一覧画面にリダイレクト
            return redirect('project/search');
        }
    }

    /**
     * 編集処理を行う
     * @param  ProjectRequest $requestObj [description]
     * @return [type]                   [description]
     */
    public function postEdit( ProjectRequest $requestObj ){
        // idがからでないときに処理
        if( !empty( $requestObj->id ) == True ){
            // 指定されたidを削除
            $this->dispatch(
                new UpdateCommand(
                    $requestObj->id,
                    $requestObj
                )
            );
            
        }

        // 一覧画面にリダイレクト
        return redirect('project/search');
    }

    ###################
    ## 削除
    ###################
    
    /**
     * 指定されたidを削除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDelete( $id=NULL ){
        if( !empty( $id ) == True ){
            // 指定されたidを削除
            $this->dispatch(
                new DeleteCommand(
                    $id
                )
            );
        }

        // 一覧画面にリダイレクト
        return redirect('project/search');
    }

}
