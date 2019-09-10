<?php

namespace App\Models;

use Atf\Models\AtfModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;

/**
 * イメージモデル
 *
 * @author yhatsutori
 *
 */
class Status extends AtfModel {

    use SoftDeletes;

    // テーブル名
    protected $table = 'status';
    // 変更可能なカラム
    protected $fillable = [
        'id',
        'name', // プロジェクトID
        'image', // 
        'created', // プロジェクト名
        'updated_at', // 
        'running_for', // 
        'status', // 
        'created_at', // 
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
    public function scopeJoinProject($query) {
        //
        $query = $query->leftJoin(
            'project', function( $join ) {
            $join->on('task.project_id', '=', 'project.id');
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

    /**
     * ガントチャートのリストを取得
     * @param  string $project_id [description]
     * @param  string $start_date [description]
     * @param  string $end_date   [description]
     * @return [type]             [description]
     */
    public static function getStatusInfo() {
        // テーブル名
        $tableName = 'status';

        // 主なSQL
        $sql = "    SELECT
                        name,
                        image, 
                        created, 
                        updated_at,
        
                        running_for,
                        status, 
                        created_at 

                    FROM
                        {$tableName}

                     ";



        // データの取得
        $showData = DB::select(
                $sql, [
               
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
}
