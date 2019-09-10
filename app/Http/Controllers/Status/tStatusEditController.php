<?php

namespace App\Http\Controllers\Status;

//use App\Http\Requests\ProjectRequest;
use App\Models\Status;
use App\Commands\Status\UpdateCommand;

trait tStatusEditController{

    ###################
    ## 詳細
    ###################
    
    /**
     * 詳細を取得
     * @param  [type] $Pid [description]
     * @return [type]     [description]
     */
    public function getRepositoryDetail( $Pid=NULL ){
        
         // プロジェクトIDを取得
        $projectId = $this->getProjectId( [] );
        
        // idがからでないときに処理
        if( !empty( $Pid ) == True ){
            // 指定されたidのオブジェクトを取得
            $projectMObj = Project::findOrFail( $Pid );

           return view(
                'image.repositoryList.index',
                compact(
                    'projectMObj'
                )
           )
            ->with( "title", "リポジトリ一覧" )
            ->with( "displayObj", $this->displayObj )
            ->with( "projectId", $projectId );

        }else{
            // 一覧画面にリダイレクト
            return redirect('image');
        }
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
    public function getUpdate(){
        // 指定されたidを削除
        $this->dispatch(
            new UpdateCommand(
                
            )
        );

        // 一覧画面にリダイレクト
        return redirect('Status');
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
