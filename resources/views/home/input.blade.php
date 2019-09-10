{{-- 親テンプレートを継承 --}}
@extends('layouts.app')

{{-- jsの読み込み --}}
@section('js')
@parent
<script src="{{ asset( 'vendors/ckeditor/ckeditor.js' ) }}"></script>
<script src="{{ asset( 'vendors/ckeditor/adapters/jquery.js' ) }}"></script>

<script>
$( 'textarea#ckeditor_full' ).ckeditor(
    {width:'98%', height: '500px'}
);
</script>

@endsection

{{-- メインの内容 --}}
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>
            {{ $title }}
        </h2>
        
    </div>
</div>
<!-- /. ROW  -->

<div class="row">
    <div class="col-md-12">

        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="content-box-header panel-heading">
                <div class="panel-title ">Homeのメモ欄</div>
                
                <div class="panel-options">
                    {{-- 権限が管理者の時のみ表示 --}}
                    @if( $loginAccountObj->getLoginUserRole() == 1 )
                        <a href="{{ action( $displayObj->ctl . '@getEdit' ) }}">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                    @endif
                </div>
            </div>
            
            <div class="panel-body">
                {{-- 編集の時の処理 --}}
                {!! Form::model(
                    $homeMObj,
                    ['role'=> 'form', 'method' => 'post', 'url' => action( $displayObj->ctl . '@postEdit'), 'enctype' => 'multipart/form-data']
                ) !!}
                    
                    {{ Form::hidden( 'id', old('id') ) }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{-- メモ --}}
                                {!! Form::textarea('memo', old('memo'), ['id' => 'ckeditor_full']) !!}
                                
                            </div>

                            {!! Form::submit( '入力内容を登録', ['class' => 'btn btn-default btn-success']) !!}

                        </div>
                    </div>

                {!! Form::close() !!}

            </div>

        </div>

    </div>
</div>
<!-- /. ROW  -->

@endsection
