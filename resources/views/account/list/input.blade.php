@extends('layouts.app')

{{-- cssの読み込み --}}
@section('css')
@parent
@stop

{{-- jsの読み込み --}}
@section('js')
@parent
<script>
// 反映の確認
function checkSumbit(){
    // 確認がokの時に、処理
    if( confirm('入力頂いた内容を反映してよろしいでしょうか？') ){
        $('form').submit();
    }
}
</script>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>{{ $title }}</h2>
    </div>
</div>
<!-- /. ROW  -->

<hr/>

<div class="row">
    <div class="col-md-6">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                
                {{-- Form --}}
                @if( $inputType == "edit" )
                    {{-- 編集の時の処理 --}}
                    {!! Form::model(
                        $usersMObj,
                        ['role'=> 'form', 'method' => 'post', 'url' => action( $displayObj->ctl . '@postEdit'), 'enctype' => 'multipart/form-data']
                    ) !!}
                    
                @else
                    {{-- 編集の時の処理 --}}
                    {!! Form::model(
                        $usersMObj,
                        ['role'=> 'form', 'method' => 'post', 'url' => action( $displayObj->ctl . '@postCreate'), 'enctype' => 'multipart/form-data']
                    ) !!}

                @endif

                    <div class="row">
                        <div class="col-md-6">

                            {{-- エラー表示 --}}
                            @if( $errors->any() )
                              <div class="alert alert-danger block-center">
                                  @foreach( $errors->all() as $error )
                                      {{ $error }}<br/>
                                  @endforeach
                              </div>
                            @endif

                            {!! Form::hidden( 'id', old('id') ) !!}

                            <div class="form-group">
                                <label><span style="color:#2c71fe;">アカウント名</span><span class="color-dpink">※</span></label>
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'アカウント名を入力してください。']) !!}
                            </div>

                            <div class="form-group">
                                <label><span style="color:#2c71fe;">アカウント名(苗字)</span><span class="color-dpink">※</span></label>
                                {!! Form::text('name_short', old('name_short'), ['class' => 'form-control', 'placeholder' => 'アカウント名(苗字)を入力してください。']) !!}
                            </div>
                            
                            <div class="form-group">
                                <label><span style="color:#2c71fe;">作業者ID(ATFユーザーID)</span></label>
                                {!! Form::text('staff_id', old('staff_id'), ['class' => 'form-control', 'placeholder' => '作業者IDを入力してください。']) !!}
                            </div>

                            <div class="form-group">
                                <label><span style="color:#2c71fe;">連絡先</span></label>
                                {!! Form::text('contact_ran', old('contact_ran'), ['class' => 'form-control', 'placeholder' => '連絡先を入力してください。例:080-0000-0000']) !!}
                            </div>

                            <div class="form-group">
                                <label><span style="color:#2c71fe;">連絡先(親)</span></label>
                                {!! Form::textarea( 'contact_ran_oya', old('contact_ran_oya'), ['class' => 'form-control', 'rows' => '3', 'placeholder' => '親または、家族の連絡先を入力してください。' . PHP_EOL . '例:母 080-0000-0000'] ) !!}
                            </div>

                            <div class="form-group">
                                <label><span style="color:#2c71fe;">特記事項</span></label>
                                {!! Form::textarea( 'tokki_jikou', old('tokki_jikou'), ['class' => 'form-control', 'rows' => '3', 'placeholder' => '特記事項があれば、記載ください。' . PHP_EOL . '例:喘息,エビアレルギー'] ) !!}
                            </div>

                            <div class="form-group">
                                <label><span style="color:#2c71fe;">口座番号</span></label>
                                {!! Form::textarea( 'kouza_number', old('kouza_number'), ['class' => 'form-control', 'rows' => '3', 'placeholder' => '口座番号を入力ください。' . PHP_EOL . '〇〇銀行' . PHP_EOL . '店番号000口座番号0000000'] ) !!}
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>ID<span class="color-dpink">※</span></label>
                                {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'IDをメールアドレスで入力してください。']) !!}
                            </div>

                            <div class="form-group">
                                <label>パスワード<span class="color-dpink">※</span></label>
                                {!! Form::text('password_show', old('password_show'), ['class' => 'form-control', 'placeholder' => 'パスワードを入力してください。']) !!}
                            </div>

                            <div class="form-group">
                                <label>権限<span class="color-dpink">※</span></label>
                                @include( 'elements.account.role', ['name' => 'role', 'value' => $usersMObj->role, 'setting' => ['class' => 'form-control']] )
                            </div>
                            
                            <div class="form-group">
                                <label>社員</label>
                                @include( 'elements.account.syain', ['name' => 'syain_flg', 'value' => $usersMObj->syain_flg, 'setting' => ['class' => 'form-control']] )
                            </div>

                            <div class="form-group">
                                <label>所属<span class="color-dpink">※</span></label>
                                @include( 'elements.account.post', ['name' => 'post', 'value' => $usersMObj->post, 'setting' => ['class' => 'form-control']] )
                            </div>

                            <div class="form-group">
                                <label>開始時刻</label>
                                @include( 'elements.common.hour', ['name' => 'hour_start', 'value' => $usersMObj->hour_start, 'setting' => ['class' => 'form-control']] )
                            </div>

                            <div class="form-group">
                                <label>終了時刻</label>
                                @include( 'elements.common.hour', ['name' => 'hour_end', 'value' => $usersMObj->hour_end, 'setting' => ['class' => 'form-control']] )
                            </div>

                            <div class="form-group">
                                <label>交通費(往復)</label>
                                {!! Form::text('cost_trance', old('cost_trance'), ['class' => 'form-control', 'placeholder' => '交通費を数値で入力してください。', 'onchange'=>'return checkNumOnly(this);', 'onkeyup'=>'return checkNumOnly(this);']) !!}
                            </div>

                            <div class="form-group">
                                <label>行程</label>
                                {!! Form::text('trance', old('trance'), ['class' => 'form-control', 'placeholder' => '例:JR山手線: 東京駅～秋葉原 JR総武線: 秋葉原～錦糸町']) !!}
                            </div>

                            <div class="form-group">
                                <label>鍵フラグ</label>
                                {!! Form::select( 'key_flg', ["----", "有"], old('key_flg'), ['class' => 'form-control'] ) !!}
                            </div>

                            <div class="form-group">
                                <label>カードフラグ</label>
                                {!! Form::select( 'card_flg', ["----", "有"], old('card_flg'), ['class' => 'form-control'] ) !!}
                            </div>

                            {!! Form::button( '入力内容を登録', ['class' => 'btn btn-default btn-success', 'onclick' => 'event.preventDefault(); checkSumbit();']) !!}

                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<!-- /. ROW  -->

@endsection
