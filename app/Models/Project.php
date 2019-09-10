<?php

namespace App\Models;

use Atf\Models\AtfModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;

/**
 * プロジェクトモデル
 *
 * @author yhatsutori
 *
 */
class Project extends AtfModel{
    
    public $incrementing = false;
    protected $primaryKey = 'project_id';
    
    use SoftDeletes;
    
    // テーブル名
    protected $table = 'project';

    // 変更可能なカラム
    protected $fillable = [
        

        'project_id', // プロジェクトID
        'owner_id', // 
        'name', // プロジェクト名
        'create_time', // 
        
        'update_time', // 
        'deleted', // 
        'owner_name', // 
        'togglable', // 

        'current_user_role_id', // 
        'repo_count', // 
        
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    ###########################
    ## スコープメソッド(Join文)
    ###########################
    
    /**
     * v_new_newcar_infoとJoinするスコープメソッド
     *
     * @param unknown $query
     */
    public function scopeJoinProject( $query ){
        //
        $query = $query->leftJoin(
                    'project',
                    function( $join ){
                        $join->on( 'task.project_id', '=', 'project.id' );
                    }
                );

        //dd( $query->toSql() );
        return $query;
    }

    ###########################
    ## User List Commands
    ###########################
    
    /**
     * 検索条件を指定するメソッド
     * @param  [type] $query      [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function scopeWhereRequest( $query, $requestObj ){
        // 検索条件を指定
        $query = $query
            // グループ名
            ->whereMatch( 'project.group_id', $requestObj->group_id )
            // プロジェクト名
            ->whereMatch( 'project_id', $requestObj->project_id )

            // 題名
            ->whereLike( 'daimei', $requestObj->daimei )
            // 説明
            ->whereLike( 'description', $requestObj->description )
            
            // ステータス
            ->whereLike( 'status', $requestObj->status )
            // 優先度
            ->whereLike( 'priority', $requestObj->priority )
            // 大変さ
            ->whereLike( 'serious', $requestObj->serious )

            // 依頼者
            ->whereLike( 'order_user_name', $requestObj->order_user_name )
            // 担当者
            ->whereMatch( 'tantou_id', $requestObj->tantou_id )
            // 作業確認者
            ->whereMatch( 'tantou_commit_id', $requestObj->tantou_commit_id )

            // 開始日
            ->wherePeriodNormal( 'start_date', $requestObj->start_date_start, $requestObj->start_date_end )
            
            // 完了日
            ->wherePeriodNormal( 'end_date', $requestObj->end_date_start, $requestObj->end_date_end );

        // 未完了のタスクだけを表示
        if( $requestObj->kanryo_flg != "" ){
            $query = $query->where( 'status', '!=', '2' );
        }

        return $query;
    }
    
    /**
     * ガントチャートのリストを取得
     * @param  string $project_id [description]
     * @param  string $start_date [description]
     * @param  string $end_date   [description]
     * @return [type]             [description]
     */
    public static function getGanttList( $project_id="", $start_date="", $end_date="" ){
        // テーブル名
        $tableName = 'task';
        
        // 主なSQL
        $sql = "    SELECT
                        task_category,
                        daimei,
                        description,
        
                        status,
                        priority,
                        serious,
                        progress,

                        order_user_name,
                        tantou_id,
                        tantou_commit_id,

                        start_date,
                        end_date,
                        kousu_h_kibou,
                        kousu_h

                    FROM
                        {$tableName}

                    WHERE
                        project_id = ? ";

        if( !empty( $start_date ) ) {
            // 処理が速くなるので、同じ値の時は一つにする
            if( $start_date == $end_date ){
                $sql .= " AND start_date =  start_date = " . $start_date;

            }else{
                if( !empty( $start_date ) ) {
                    $timestamp = strtotime( $start_date.'01' );
                    $start_date = date( 'Y-m-d', $timestamp );
                }

                if( !empty( $end_date ) ) {
                    $timestamp = strtotime( $end_date.'01' );
                    $end_date = date( 'Y-m-t', $timestamp );
                }

                if( !empty( $start_date ) && !empty( $end_date ) ) {
                    $query->whereBetween( $key, [$start_date, $end_date] );
                    $sql .= " AND start_date between ' " . $start_date . "' AND '" . $start_date . "'";
                    
                }elseif( !empty( $start_date ) ) {
                    $sql .= " AND start_date = start_date >='" . $start_date . "'";
                
                }elseif( !empty( $end_date ) ) {
                    $sql .= " AND start_date = start_date <='" . $end_date . "'";
                
                }
            }
        }

        // データの取得
        $showData = DB::select(
            $sql,
            [
                $project_id
            ]
        );

        return $showData;
    }

    /**
     * ガントチャートのリストを取得
     * @param  string $project_id [description]
     * @param  string $start_date [description]
     * @param  string $end_date   [description]
     * @return [type]             [description]
     */
    /*
    public static function getOwnCompCollect( $project_id="", $start_date="", $end_date="" ){
        // テーブル名
        $tableName = 'task';
        
        $whereSql = "";

        // 主なSQL
        $sql = "
                    SELECT
                        end_date,
                        count(*)
                    FROM
                       {$tableName}
                    WHERE
                       status = 2
                       {$whereSql}

                    GROUP BY
                       end_date

                    WHERE
                        project_id = ? ";

        if( !empty( $start_date ) ) {
            // 処理が速くなるので、同じ値の時は一つにする
            if( $start_date == $end_date ){
                $sql .= " AND start_date =  start_date = " . $start_date;

            }else{
                if( !empty( $start_date ) ) {
                    $timestamp = strtotime( $start_date.'01' );
                    $start_date = date( 'Y-m-d', $timestamp );
                }

                if( !empty( $end_date ) ) {
                    $timestamp = strtotime( $end_date.'01' );
                    $end_date = date( 'Y-m-t', $timestamp );
                }

                if( !empty( $start_date ) && !empty( $end_date ) ) {
                    $query->whereBetween( $key, [$start_date, $end_date] );
                    $sql .= " AND start_date between ' " . $start_date . "' AND '" . $start_date . "'";
                    
                }elseif( !empty( $start_date ) ) {
                    $sql .= " AND start_date = start_date >='" . $start_date . "'";
                
                }elseif( !empty( $end_date ) ) {
                    $sql .= " AND start_date = start_date <='" . $end_date . "'";
                
                }
            }
        }

        // データの取得
        $showData = DB::select(
            $sql,
            [
                $project_id
            ]
        );

        return $showData;
    }
    */
public static function getProjectInfo( $project_id="", $name="" ){
        // テーブル名
        $tableName = 'project';
        
        // 主なSQL
        $sql = "    SELECT
                        project_id,
                        name,
                        creation_time,
                        update_time,
                        repo_count
                        
                        
                    FROM
                        {$tableName}

                   
                        ";

        // データの取得
        $showData = DB::select(
            $sql,
            [
                
            ]
        );

        return $showData;
    }

}
