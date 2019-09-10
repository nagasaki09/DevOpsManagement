{{-- 親テンプレートを継承 --}}
@extends('layouts.app')

{{-- jsの読み込み --}}
@section('js')
@parent
@endsection

{{-- メインの内容 --}}
@section('content')



<div class="row">
    <div class="col-md-12">
        <h2>
            {{-- プロジェクトIDがあるときに、プロジェクト名を表示 --}}
            @if( isset( $projectId ) == True && !empty( $projectId ) == True )
                {{ $CodeUtil::getProjectName( $projectId ) }}&nbsp;/&nbsp;{{ $title }}
            @else
                {{ $title }}
            @endif
            
        </h2>
        {{--<h5>※申請漏れはないように、お願いいたします。</h5>--}}
    </div>
</div>

<hr/>

<div class="row">
    <div class="col-md-12 panel-warning">
        <div class="content-box-header panel-heading">
            <div class="panel-title "></div>

        </div>

        <div class="content-box-large box-with-header">
            coming soon!! テスト結果一覧
            
            
        </div>

    </div>
</div>

@endsection
