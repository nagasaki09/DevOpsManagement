{{-- 親テンプレートを継承 --}}
@extends('layouts.app')

{{-- メインの内容 --}}
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>{{ $title }}</h2>
        {{--<h5>※申請漏れはないように、お願いいたします。</h5>--}}
    </div>
</div>
<!-- /. ROW  -->

<hr/>

{{-- 検索部分を読み込み --}}
@include('account.list.search')

<hr/>

{{-- 権限が管理者の時のみ表示 --}}
@if( $loginAccountObj->getLoginUserRole() == 1 )
<div class="row">
    <div class="col-md-12">
        {!! Form::button( '登録', ['class' => 'btn btn-default btn-danger', 'style' => "width: 100px;", 'onclick' => "location.href='" . action( $displayObj->ctl . '@getCreate') . "'"]) !!}
    </div>
</div>

<hr/>
@endif

<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <tr>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => 'No', 'url' => $sortUrl,
                                    'sort_key' => 'id', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => 'アカウント名', 'url' => $sortUrl,
                                    'sort_key' => 'name', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '苗字', 'url' => $sortUrl,
                                    'sort_key' => 'name_short', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => 'ID', 'url' => $sortUrl,
                                    'sort_key' => 'email', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '権限', 'url' => $sortUrl,
                                    'sort_key' => 'role', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '社員', 'url' => $sortUrl,
                                    'sort_key' => 'syain_flg', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '所属', 'url' => $sortUrl,
                                    'sort_key' => 'post', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '開始時刻', 'url' => $sortUrl,
                                    'sort_key' => 'hour_start', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '終了時刻', 'url' => $sortUrl,
                                    'sort_key' => 'hour_end', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '交通費', 'url' => $sortUrl,
                                    'sort_key' => 'cost_trance', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '鍵フラグ', 'url' => $sortUrl,
                                    'sort_key' => 'key_flg', 'sortTypes' => $sortTypes
                                ])
                                <hr/>
                                @include( 'layouts.sort', [
                                    'name' => 'カードフラグ', 'url' => $sortUrl,
                                    'sort_key' => 'card_flg', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center">
                                @include( 'layouts.sort', [
                                    'name' => '作成日時', 'url' => $sortUrl,
                                    'sort_key' => 'created_at', 'sortTypes' => $sortTypes
                                ])
                                <hr/>
                                @include( 'layouts.sort', [
                                    'name' => '更新日時', 'url' => $sortUrl,
                                    'sort_key' => 'updated_at', 'sortTypes' => $sortTypes
                                ])
                            </th>
                            <th class="th_center" style="width: 6%">操作</th>
                        </tr>

                        @if( !$showData->isEmpty() )
                            @foreach( $showData as $key => $value )
                                <tr>
                                    <td class="td_center">{{ $value->id }}</td>
                                    <td class="td_center">{{ $value->name }}</td>
                                    <td class="td_center">{{ $value->name_short }}</td>
                                    <td class="td_center">{{ $value->email }}</td>
                                    <td class="td_center">{{ $CodeUtil::getRoleName( $value->role ) }}</td>
                                    <td class="td_center">{{ $CodeUtil::getSyainName( $value->syain_flg ) }}</td>
                                    <td class="td_center">{{ $CodeUtil::getPostName( $value->post ) }}</td>
                                    <td class="td_center">{{ $value->hour_start }}時</td>
                                    <td class="td_center">{{ $value->hour_end }}時</td>
                                    <td class="td_center">{{ $value->cost_trance }}円</td>
                                    <td class="td_center">
                                        @if( $value->key_flg == "1" )
                                            <img src="{{ asset('img/key.png') }}">
                                        @endif
                                        <hr/>
                                        @if( $value->card_flg == "1" )
                                            <img src="{{ asset('img/card.png') }}" style="width: 22px;">
                                        @endif
                                    </td>
                                    <td class="td_center">
                                        {{ $value->created_at }}
                                        <hr/>
                                        {{ $value->updated_at }}
                                    </td>
                                    <td class="td_center">
                                        <a href="{{ action( $displayObj->ctl . '@getDetail' ) }}/{{ $value->id }}" title="詳細">
                                            <i class="fa fa-search "></i>
                                        </a>
                                        &nbsp;
                                        <a href="{{ action( $displayObj->ctl . '@getEdit' ) }}/{{ $value->id }}" title="編集">
                                            <i class="fa fa-edit "></i>
                                        </a>
                                        &nbsp;
                                        <a href="{{ action( $displayObj->ctl . '@getDelete' ) }}/{{ $value->id }}" onclick="return confirm('本当に削除してよろしいでしょうか？');" title="削除">
                                            <i class="fa fa-trash "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- /. ROW  -->

@endsection
