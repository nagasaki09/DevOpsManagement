<?php

namespace App\Models;

use Atf\Models\AtfModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;

/**
 * ホームモデル
 *
 * @author yhatsutori
 *
 */
class Home extends AtfModel{
    
    use SoftDeletes;
    
    // テーブル名
    protected $table = 'home';

    // 変更可能なカラム
    protected $fillable = [
        'id',
        
        'memo', // メモ

        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
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
        return $query;
    }
    
}
