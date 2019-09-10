{{-- 親テンプレートを継承 --}}
@extends('layouts.app')

{{-- メインの内容 --}}
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>{{ $title }}</h2>
    </div>
</div>
<!-- /. ROW  -->

<hr/>

<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label><span style="color:#2c71fe;">アカウント名</span></label><br/>
                            {{ $usersMObj->name }}
                        </div>

                        <div class="form-group">
                            <label><span style="color:#2c71fe;">アカウント名(苗字)</span></label><br/>
                            {{ $usersMObj->name_short }}
                        </div>
                        
                        <div class="form-group">
                            <label><span style="color:#2c71fe;">作業者ID(ATFユーザーID)</span></label><br/>
                            {{ $usersMObj->staff_id }}
                        </div>

                        <div class="form-group">
                            <label><span style="color:#2c71fe;">連絡先</span></label><br/>
                            {{ $usersMObj->contact_ran }}
                        </div>

                        <div class="form-group">
                            <label><span style="color:#2c71fe;">連絡先(親)</span></label><br/>
                            {!! nl2br( $usersMObj->contact_ran_oya ) !!}
                        </div>

                        <div class="form-group">
                            <label><span style="color:#2c71fe;">特記事項</span></label><br/>
                            {!! nl2br( $usersMObj->tokki_jikou ) !!}
                        </div>

                        <div class="form-group">
                            <label><span style="color:#2c71fe;">口座番号</span></label><br/>
                            {!! nl2br( $usersMObj->kouza_number ) !!}
                        </div>

                    </div>

                    <div class="col-md-6"></div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID</label><br/>
                            {{ $usersMObj->email }}
                        </div>

                        <div class="form-group">
                            <label>パスワード</label><br/>
                            {{ $usersMObj->password_show }}
                        </div>

                        <div class="form-group">
                            <label>権限</label><br/>
                            {{ $CodeUtil::getRoleName( $usersMObj->role ) }}
                        </div>
                        
                        <div class="form-group">
                            <label>社員</label><br/>
                            {{ $CodeUtil::getSyainName( $usersMObj->syain_flg ) }}
                        </div>

                        <div class="form-group">
                            <label>所属</label><br/>
                            {{ $CodeUtil::getPostName( $usersMObj->post ) }}
                        </div>

                        <div class="form-group">
                            <label>開始時刻</label><br/>
                            {{ $usersMObj->hour_start }}時
                        </div>

                        <div class="form-group">
                            <label>終了時刻</label><br/>
                            {{ $usersMObj->hour_end }}時
                        </div>
                        
                        <div class="form-group">
                            <label>交通費</label><br/>
                            {{ $usersMObj->cost_trance }}円
                        </div>

                        <div class="form-group">
                            <label>行程</label><br/>
                            {{ $usersMObj->trance }}
                        </div>

                        <div class="form-group">
                            <label>鍵フラグ</label><br/>
                            @if( $usersMObj->key_flg == "1" )
                                <img src="{{ asset('img/key.png') }}">
                            @endif

                        </div>

                        <div class="form-group">
                            <label>カードフラグ</label><br/>
                            @if( $usersMObj->key_flg == "1" )
                                <img src="{{ asset('img/card.png') }}" style="width: 22px;">
                            @endif

                        </div>

                        <div class="form-group">
                            <label>作成日時</label><br/>
                            {{ $usersMObj->created_at }}
                        </div>

                        <div class="form-group">
                            <label>更新日時</label><br/>
                            {{ $usersMObj->updated_at }}
                        </div>

                    </div>

                    <div class="col-md-6"></div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- /. ROW  -->

@endsection
