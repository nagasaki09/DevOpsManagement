{{-- 親テンプレートを継承 --}}
@extends('layouts.app')

{{-- jsの読み込み --}}
@section('js')
@parent
@endsection

{{-- メインの内容 --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            デプロイ
            <small>deploy</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-upload"></i> デプロイ</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">イメージ一覧</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>プロジェクト名</th>
                                    <th>リポジトリ数</th>
                                    <th>作成日時</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $showDataP as $key => $value )
                                <tr>
                                    {{-- プロジェクト名 --}}
                                    <td class="td_center">
                                        {{ $value->name }}
                                    </td>
                                    {{-- RepositoryCount --}}
                                    <td class="td_center">
                                        {{ $value->repo_count }}
                                    </td>
                                    {{-- CreationTime --}}
                                    <td class="td_center">
                                        {{ $value->creation_time }}
                                    </td>
                                    {{-- 操作 --}}
                                    <td class="td_center">
                                        <a href="#" title="詳細">
                                            <i class="glyphicon glyphicon-search "></i>
                                        </a>
                                        &nbsp;
                                        <a href="#" title="編集">
                                            <i class="glyphicon glyphicon-edit "></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- page script -->
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>

@endsection
