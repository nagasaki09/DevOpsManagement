{{-- 親テンプレートを継承 --}}
@extends('layouts.app')

{{-- jsの読み込み --}}
@section('js')
@parent
@endsection

{{-- メインの内容 --}}
@section('content')


{{-- Deploy確認モーダル --}}


<div class="modal fade" id="deployModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                本当にデプロイしますか？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.href='/dev-ops/deploy/execution'">はい</button>
                <button type="button" class="btn btn-primary">戻る</button>
            </div>
        </div>
    </div>
</div>


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
              <h3 class="box-title">デプロイ対象一覧</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>プロジェクト名</th>
                  <th>作成日時</th>
                  <th>更新日時</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Laravel</td>
                  <td>2018/09/11 12:23
                  </td>
                  <td>2018/09/13 23:33</td>
                  <td class="td_center"> <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#deployModal">Deploy</button></td>
                </tr>
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


@endsection
