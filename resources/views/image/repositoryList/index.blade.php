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
            リポジトリ
            <small>Repository</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-image"></i> イメージ</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">リポジトリ一覧 </h3>
                        <a onclick="window.location.href='{{ action( $displayObj->ctl . '@getRepositoryDetail' ,$Pid ) }}'"><div  style="float: right; font-size: 25px;" class="glyphicon glyphicon-refresh"></div></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>リポジトリ名</th>
                                    <th>プロジェクト名</th>
                                    <th>タグ数</th>
                                    <th>作成日時</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $repository as $key => $value )
                                <tr  onmouseover="this.style.backgroundColor='#E5E8E7'" onmouseout="this.style.backgroundColor=''">
                                    {{-- リポジトリ名 --}}
                                    <td class="td_center">
                                        <a onclick="window.location.href='{{ action( $displayObj->ctl . '@getImageDetail' ) }}/{{ $Pid }}/{{ $value->repository_name }}'" style='cursor: default;' >{{ $value->repository_name }}</a>
                                    </td>
                                    {{-- プロジェクト名 --}}
                                    <td class="td_center">
                                        {{ $value->project_name }}
                                    </td>
                                    {{-- タグ数 --}}
                                    <td class="td_center">
                                        @if($value->tags_count === NULL)
                                        {{ 0 }}
                                        @else
                                        {{ $value->tags_count }}
                                        @endif
                                    </td>
                                    {{-- CreationTime --}}
                                    
                                    <td class="td_center">
                                        {{ $value->created_at }}
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
