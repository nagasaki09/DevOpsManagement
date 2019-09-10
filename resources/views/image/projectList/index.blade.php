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
            プロジェクト
            <small>Project</small>
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
                        <h3 class="box-title">プロジェクト一覧 </h3>
                         <a href="/image/search"><div  style="float: right; font-size: 25px;" class="glyphicon glyphicon-refresh"></div></a>
                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>プロジェクト名</th>
                                    <th>リポジトリ数</th>
                                    <th>作成日時</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $showDataP as $key => $value )
                                <tr onmouseover="this.style.backgroundColor='#E5E8E7'" onmouseout="this.style.backgroundColor=''">
                                    {{-- プロジェクト名 --}}
                                    <td class="td_center">
                                       <a onclick="window.location.href='{{ action( $displayObj->ctl . '@getRepositoryDetail',$value->project_id ) }}'" style='cursor: default;' > {{ $value->name }}</a>
                                    </td>
                                    {{-- RepositoryCount --}}
                                    <td class="td_center">
                                        @if($value->repo_count === NULL)
                                        {{ 0 }}
                                        @else
                                        {{ $value->repo_count }}
                                        @endif
                                    </td>
                                    {{-- CreationTime --}}
                                    @php
                                    $creation_time = new DateTime($value->creation_time);
                                    $creation_time->setTimeZone(new DateTimeZone('Asia/Tokyo'));
                                    $creationTime = $creation_time->format('Y-m-d H:i');
                                    @endphp
                                    <td class="td_center">
                                        {{ $creationTime }}
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
