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
            Dockerステータス
            <small>Status</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/status"><i class="fa fa-archive"></i> Dockerステータス</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Dockerステータス一覧</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>コンテナ</th>
                                    <th>イメージ</th>
                                    <th>作成日時</th>
                                    <th>ステータス</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $showData as $key => $value )
                                <tr>
                                    {{-- コンテナ名 --}}
                                    <td class="td_center">
                                        {{ $value->name }}
                                    </td>
                                    {{-- イメージ名 --}}
                                    <td class="td_center">
                                        {{ $value->image }}
                                    </td>
                                    {{-- 作成日時 --}}
                                    <td class="td_center">
                                        {{ $value->created }}
                                    </td>
                                    {{-- ステータス --}}
                                    <td class="td_center">
                                        {{ $value->status }}
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
