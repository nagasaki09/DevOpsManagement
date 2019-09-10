
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-body">

                {!! Form::model(
                    $search,
                    ['role'=> 'form', 'id' => 'searchForm', 'method' => 'get', 'url' => action( $displayObj->ctl . '@getSearch'), 'enctype' => 'multipart/form-data']
                ) !!}

                    {!! Form::hidden( 'row_num', old('row_num') ) !!}

                    <div class="row">
                        <div class="col-sm-2">
                            <div id="dataTables-example_filter" class="dataTables_filter">
                                アカウント:
                                {!! Form::text( 'name', null, ['class' => 'form-control'] ) !!}
                            </div>
                        </div>
                        
                        <div class="col-sm-2">
                            <div id="dataTables-example_filter" class="dataTables_filter">
                                ID:
                                {!! Form::text( 'email', null, ['class' => 'form-control'] ) !!}
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div id="dataTables-example_filter" class="dataTables_filter">
                                権限:
                                @include( 'elements.account.role', ['name' => 'role', 'value' => null, 'setting' => ['class' => 'form-control']] )
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <br/>
                            {!! Form::button( 'クリア', ['class' => 'btn btn-default btn-info', 'style' => "width: 90px;", 'onclick' => "location.href='" . action( $displayObj->ctl . '@getIndex') . "'"]) !!}
                            {!! Form::submit( '検索', ['class' => 'btn btn-default btn-primary', 'style' => "width: 90px;"]) !!}
                        </div>

                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
