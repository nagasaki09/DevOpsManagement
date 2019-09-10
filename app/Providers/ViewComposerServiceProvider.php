<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Util\CodeUtil;
use View;

/**
 * Viewに値を埋め込むサービスプロバイダー
 *
 * @author y-hatsutori
 *
 */
class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * サービスプロバイダーを定義する時のルールです
     * （共通項目）
     *
     */
    public function boot()
    {
        // ログインユーザー情報の埋め込み
        View::composer( ['*'], 'Atf\Http\ViewComposers\AtfLoginAccountComposer' );
        
        // ログインユーザー情報の埋め込み
        View::composer( ['*'], 'App\Http\ViewComposers\UtilComposer' );

        ######################
        ## 共通
        ######################

        // 年のSelect
        View::composer('elements.common.year', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"];

            // 1年前
            $year = date( "Y", strtotime( date("Y-m-d") . ' -1 year' ) );
            $view->options[$year] = $year;

            // 当年
            $year = date( "Y" );
            $view->options[$year] = $year;

            // 1年後
            $year = date( "Y", strtotime( date("Y-m-d") . ' +1 year' ) );
            $view->options[$year] = $year;
        });

        // 月のSelect
        View::composer('elements.common.month', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"];

            // 1月から12月までを指定
            for( $month=1; $month <= 12; $month++ ){ 
                $view->options[$month] = $month;
            }

        });

        // 日のSelect
        View::composer('elements.common.day', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"];

            // 1日から31月までを指定
            for( $day=1; $day <= 31; $day++ ){ 
                $view->options[$day] = $day;
            }

        });

        // 時間のSelect
        View::composer('elements.common.hour', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"];

            // 0時から24時までを指定
            for( $hour=0; $hour <= 24; $hour++ ){ 
                $view->options[$hour] = $hour . "時";
            }

        });

        // アカウントの権限のSelect
        View::composer('elements.common.account_staff', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"] + CodeUtil::getUsersList();

        });

        // アカウントの権限のSelect
        View::composer('elements.common.account_staff_full', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"] + CodeUtil::getUsersFullList();

        });

        // 表示件数のSelect
        View::composer('elements.common.row_num', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"] + CodeUtil::getRowNumList();

        });

        ######################
        ## アカウント
        ######################

        // アカウントの権限のSelect
        View::composer('elements.account.role', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"] + CodeUtil::getRoleList();

        });

        // アカウントの社員のSelect
        View::composer('elements.account.syain', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"] + CodeUtil::getSyainList();

        });

        // アカウントの所属のSelect
        View::composer('elements.account.post', function($view) {
            // 独自変数に、selectの中身を格納
            $view->options = ["" => "----"] + CodeUtil::getPostList();

        });

    }
    
    // 
    public function register(){}

}