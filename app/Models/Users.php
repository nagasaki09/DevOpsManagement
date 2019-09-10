<?php

namespace App\Models;

use Atf\Models\tAtfModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;

/**
 * 担当者モデル
 *
 * @author yhatsutori
 *
 */
class Users extends Authenticatable {
    
    use Notifiable, tAtfModel, SoftDeletes;
    
    // テーブル名
    protected $table = 'users';

    // 変更可能なカラム
    protected $fillable = [
        'id',
        'name', // アカウント名
        'email', // ID(E-mail)
        'password', // パスワード(ハッシュ値)
        'password_show', // パスワード
        'role', // 権限
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    
    #######################
    ## ログインユーザーの情報取得用のメソッド
    #######################
    
    /**
     * ログインしている人のidの取得
     * @return [type] [description]
     */
    public function getLoginUserId(){
        return $this->id;
    }

    /**
     * ログインしている人の権限の取得
     * @return [type] [description]
     */
    public function getLoginUserRole(){
        return $this->role;
    }

    /**
     * ログインしている人の名前の取得
     * @return [type] [description]
     */
    public function getLoginUserName(){
        return $this->name;
    }

    #######################
    ## プルダウンで利用
    #######################
    
    /**
     * 検索部分で表示されるスタッフ名を取得
     * @return [type] [description]
     */
    public static function getFullhUsers(){
        // テーブル名
        $tableName = 'users';
        
        // 主なSQL
        $sql = "    SELECT
                        id,
                        name,
                        name_short,
                        post
                        --syain_flg,
                        --key_flg,
                        --card_flg

                    FROM
                        {$tableName}

                    WHERE
                        -- 削除されていない人
                        deleted_at IS NULL
                        
                    ORDER BY
                        post asc
                        email asc ";
                        
        // データの取得
        $showData = DB::select(
                            $sql, []
                        );
            
        return $showData;
    }

    #######################
    ## プルダウンで利用
    #######################
    
    /**
     * 検索部分で表示されるスタッフ名を取得
     * @return [type] [description]
     */
    public static function getSearchUsers(){
        // テーブル名
        $tableName = 'users';
        
        // 主なSQL
        $sql = "    SELECT
                        id,
                        name
                    FROM
                        {$tableName}
                    WHERE
                        -- 削除されていない人
                        deleted_at IS NULL ";

        // ユーザー情報を取得
        $loginAccountObj = Auth::user();
        
        // 権限が管理者以外の時
        if( $loginAccountObj->getLoginUserRole() != "1" ){
            // ログイン権限の人のみをプルダウンで表示
            $sql .= " AND id = " . $loginAccountObj->getLoginUserId();
        }
        
        // データの取得
        $showData = DB::select(
                            $sql, []
                        );
        
        return $showData;
    }

    /**
     * 検索部分で表示されるスタッフ名を取得
     * @return [type] [description]
     */
    public static function getSearchFullUsers(){
        // テーブル名
        $tableName = 'users';
        
        // 主なSQL
        $sql = "    SELECT
                        id,
                        name
                    FROM
                        {$tableName}
                    WHERE
                        -- 削除されていない人
                        deleted_at IS NULL ";

        // データの取得
        $showData = DB::select(
                            $sql, []
                        );
        
        return $showData;
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
            // 名前
            ->whereLike( 'name', $requestObj->name )
            // ID
            ->whereLike( 'email', $requestObj->email )
            // 権限
            ->whereMatch( 'role', $requestObj->role );

        // ユーザー情報を取得
        $loginAccountObj = Auth::user();

        // 権限が管理者以外の時
        if( $loginAccountObj->getLoginUserRole() != "1" ){
            // ログイン権限の人のみをプルダウンで表示
            $query = $query->whereMatch( 'id', intval( $loginAccountObj->getLoginUserId() ) );
        }
        
        return $query;
    }

}
