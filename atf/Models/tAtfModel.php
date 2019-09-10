<?php

namespace Atf\Models;

/**
 * Modelクラスの便利メソッド
 * 他のモデルクラスは、基本的にこのトレイトを利用する
 * @author y-hatsutori
 */
trait tAtfModel{

    /**
     * サブクラスで使用するテーブル名を取得する
     * @return サブクラスのテーブル名
     */
    public static function getTableName() {
        return ( new static )->getTable();
    }
    
    ###########################
    ## スコープメソッド(条件式)
    ###########################
    
    /**
     * 値が合致するかの条件文を追加
     * @param  [type] $query [description]
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function scopeWhereMatch( $query, $key, $value ){
        if( !empty( $value ) ) {
            $query->where( $key, $value );
        }
        return $query;
    }

    /**
     * Likeの条件文を追加
     * @param  [type] $query [description]
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function scopeWhereLike( $query, $key, $value ){
        if( !empty( $value ) ) {
            $query->where( $key, 'like', '%'.$value.'%' );
        }
        return $query;
    }

    /**
     * 期間の条件文を追加
     * 年月の値を変更する
     * @param  [type] $query [description]
     * @param  [type] $key   [description]
     * @param  [type] $from  [description]
     * @param  [type] $to    [description]
     * @return [type]        [description]
     */
    public function scopeWherePeriodYm( $query, $key, $from, $to ){
        if( !empty( $from ) ) {
            // 処理が速くなるので、同じ値の時は一つにする
            if( $from == $to ){
                $query = $query->where( $key, '=', $from );

            }else{
                if( !empty( $from ) ) {
                    $timestamp = strtotime( $from.'01' );
                    $from = date( 'Y-m-d', $timestamp );
                }

                if( !empty( $to ) ) {
                    $timestamp = strtotime( $to.'01' );
                    $to = date( 'Y-m-t', $timestamp );
                }

                if( !empty( $from ) && !empty( $to ) ) {
                    $query->whereBetween( $key, [$from, $to] );
                
                }elseif( !empty( $from ) ) {
                    $query->where ($key, '>=', $from );
                
                }elseif( !empty( $to ) ) {
                    $query->where( $key, '<=', $to );
                
                }
            }
        }
        return $query;
    }

    /**
     * 期間の条件文を追加
     * 年月日の値を変更する
     * @param  [type] $query [description]
     * @param  [type] $key   [description]
     * @param  [type] $from  [description]
     * @param  [type] $to    [description]
     * @return [type]        [description]
     */
    public function scopeWherePeriodNormal( $query, $key, $from, $to ){
        //dd($from);
        if( !empty( $from ) ) {
            // 処理が速くなるので、同じ値の時は一つにする
            if( $from == $to ){
                $query = $query->where( $key, '=', $from );

            }else{
                if( !empty( $from ) && !empty( $to ) ) {
                    $query->whereBetween( $key, [$from, $to] );
                    
                }elseif( !empty( $from ) ) {
                    $query->where( $key, '>=', $from );

                }elseif( !empty( $to ) ) {
                    $query->where( $key, '<=', $to );

                }

            }
        }
        return $query;
    }
    
    /**
     * 有無の判定の条件文を追加
     * @param  [type] $query [description]
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function scopeWhereUmuNull( $query, $key, $value ){
        if( !empty( $value ) ) {
            if ( $value === '1' ) {
                $query->whereNotNull( $key );
                
            } elseif ( $value === '0' ) {
                $query->whereNull( $key );
                
            }
        }
        return $query;
    }

    /**
     * チェックボックスで有無の判定をする時のスコープメソッド
     * @param  object $query QueryBuilder
     * @param  string $key   指定のカラム
     * @param  array $value 検索した値
     * @return object        QueryBuilder
     */
    public function scopeWhereUmuNullCheckbox($query, $key, $value)
    {
        //$s = microtime(true);
        if (is_array($value)) {
            $query->where(function ($query) use ($key, $value) {
                foreach ($value as $v) {
                    if ($v === '0') {
                        $query->orWhereNull($key);
                    } elseif ($v === '1') {
                        $query->orWhereNotNull($key);
                    }
                }
            });
        }

        return $query;
    }
    
    /**
     * 取得するデータに削除データを含めるかどうかのメソッド
     * @param  query $query それまでのクエリ
     * @param  [type] $value [description]
     * @return query
     */
    public function scopeIncludeDeleted( $query, $value ) {
        if( !empty( $value ) ) {
            // 削除データのみを対象
            if( $value == '2' ){
                $query->onlyTrashed();

            }else if( $value == "1" ){
                // 削除されていないものを表示
                $query->withTrashed()
                      ->whereNull( $this->getTableName().'.'.$this->getDeletedAtColumn() );

            // 両方を対象
            } else {
                $query->withTrashed();
                
            }
            return $query;
        }
    }

    ###########################
    ## スコープメソッド(並び替え)
    ###########################
    
    /**
     * 複数のorder byを指定するメソッド
     * @param  [type] $query  [description]
     * @param  [type] $orders [description]
     * @return [type]         [description]
     */
    public static function scopeOrderBys( $query, $orders ) {
        if( !empty( $orders ) ) {
            foreach ( $orders as $key => $value ) {
                $query->orderBy( $key, $value );
            }
        }
        return $query;
    }

    ###########################
    ## 日付の確認
    ###########################
    
    /**
     * 
     * @param  string $date [description]
     * @return [type]       [description]
     */
    public static function checkInputDate( $date="" ){
        // 入力された値が空でない時に処理
        if( !empty( $date ) == True ){
            // 日付を年,月, 日で分割
            $splitDate = explode( '-', $date );
            
            // 分割された日付が3つだけの値の時
            if( count( $splitDate ) == 3 ){
                $Y = $splitDate[0];
                $m = $splitDate[1];
                $d = $splitDate[2];

                // 日付として正しいかを確認
                if (checkdate($m, $d, $Y) === true) {
                  return True;
                }
            }
        }

        return False;
    }

}
