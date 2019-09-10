<?php

namespace App\Util;

// 予定
use App\Models\Schedule;
// 実績
use App\Models\Result;

/**
 * アプリケーションで使う関数をまとめたクラス
 */
class AppUtil {

    /**
     * 予定の給与を取得
     * @param  [type] $year  [description]
     * @param  [type] $month [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public static function getScheduleKyuyo( $year, $month, $id ){
        // 指定されたスタッフの予定の勤務時間の合計を取得
        $data = Schedule::getStaffSumHours( $year, $month, $id );
        
        // 時間がある時
        if( isset( $data[0]->hours ) == True ){
            return $data[0]->hours * 1000;
        }
        
        return 0;
    }

    /**
     * 予定の勤務時間を取得
     * @param  [type] $year  [description]
     * @param  [type] $month [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public static function getScheduleHours( $year, $month, $id ){
        // 指定されたスタッフの予定の勤務時間の合計を取得
        $data = Schedule::getStaffSumHours( $year, $month, $id );
        
        // 時間がある時
        if( isset( $data[0]->hours ) == True ){
            // 小数の時かどうかで処理を分ける
            if( strstr( $data[0]->hours, '.' ) != False ){
                $hoursList = explode( ".", round( $data[0]->hours, 2 ) );

                // 分を60分単位で表示
                $minitsu = "0";

                // 分に変換
                if( $hoursList[1] == "25" ){
                    $minitsu = "15";

                }elseif( $hoursList[1] == "50" ){
                    $minitsu = "30";

                }elseif( $hoursList[1] == "75" ){
                    $minitsu = "45";

                }

                // 小数点を時間の単位から100単位に変換して表示
                $hour_start = $hoursList[0] . "." . $minitsu;

                return $hour_start;

            }else{
                return $data[0]->hours;

            }

        }
        
        return 0;
    }

    /**
     * 実績の給与を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getResultKyuyo( $year, $month, $id ){
        // 指定されたスタッフの実績の勤務時間の合計を取得
        $data = Result::getStaffSumHours( $year, $month, $id );
        
        // 時間がある時
        if( isset( $data[0]->hours ) == True ){
            return $data[0]->hours * 1000;
        }
        
        return 0;
    }

    /**
     * 実績の務時間を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getResultHours( $year, $month, $id ){
        // 指定されたスタッフの実績の勤務時間の合計を取得
        $data = Result::getStaffSumHours( $year, $month, $id );
        
        // 時間がある時
        if( isset( $data[0]->hours ) == True ){
            // 小数の時かどうかで処理を分ける
            if( strstr( $data[0]->hours, '.' ) != False ){
                $hoursList = explode( ".", round( $data[0]->hours, 2 ) );

                // 分を60分単位で表示
                $minitsu = "0";

                // 分に変換
                if( $hoursList[1] == "25" ){
                    $minitsu = "15";

                }elseif( $hoursList[1] == "50" ){
                    $minitsu = "30";

                }elseif( $hoursList[1] == "75" ){
                    $minitsu = "45";

                }

                // 小数点を時間の単位から100単位に変換して表示
                $hour_start = $hoursList[0] . "." . $minitsu;

                return $hour_start;

            }else{
                return $data[0]->hours;

            }
            
        }
        
        return 0;
    }

    /**
     * 実績の務時間を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getResultDayHours( $year, $month, $day, $id ){
        // 指定されたスタッフの実績の勤務時間の合計を取得
        $data = Result::getStaffSumHours( $year, $month, $id, $day );
        
        // 時間がある時
        if( isset( $data[0]->hours ) == True ){
            return $data[0]->hours;
        }
        
        return 0;
    }

    /**
     * 実績の交通費を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getResultCostTrance( $year, $month, $id ){
        // 指定されたスタッフの実績の勤務時間の合計を取得
        $data = Result::getStaffSumHours( $year, $month, $id );
        
        // 時間がある時
        if( isset( $data[0]->cost_trance ) == True ){
            return $data[0]->cost_trance;
        }
        
        return 0;
    }

 }
