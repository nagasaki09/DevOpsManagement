{{-- ペジネート用のクエリを取得する為の変数 --}}
<?php
$pagiSearch = $search;
unset( $pagiSearch["page"] );
?>

{{-- ペジネート --}}
<div class="row">
    <div class="col-xs-2"></div>
    <div class="col-xs-8">
        <div class="dataTables_paginate paging_bootstrap" style="text-align: center;">
            <ul class="pagination">
                {{-- 現在のページ数が1以上の時 --}}
                @if( $data->currentPage() > 1 )
                    <li class="">
                        <a href="?page=1&{{ http_build_query( $pagiSearch ) }}">&laquo; 先頭</a>
                    </li>
                    <li class="">
                        <a href="?page={{ $data->currentPage() - 1 }}&{{ http_build_query( $pagiSearch ) }}">&lsaquo; 前へ</a>
                    </li>
                @else
                    <li class="disabled">
                        <a href="#">&laquo; 先頭</a></a>
                    </li>
                    <li class="disabled">
                        <a href="#">&lsaquo; 前へ</a>
                    </li>
                @endif

                <li class="disabled">
                    <a href="#">
                        &nbsp;&nbsp;
                        {{ empty( $data->total() ) ? '0' : $data->firstItem() }}件 ～ {{ $data->lastItem() }}件 / {{ $data->total() }} 件
                        &nbsp;&nbsp;
                    </a>
                </li>

                {{-- 最後のページかどうかを判定(Boolean) --}}
                @if( $data->hasMorePages() )
                    <li class="">
                        <a href="?page={{ $data->currentPage() + 1 }}&{{ http_build_query( $pagiSearch ) }}">次へ &rsaquo;</a>
                    </li>
                    <li class="next">
                        <a href="?page={{ $data->lastPage() }}&{{ http_build_query( $pagiSearch ) }}">最後 &raquo;</a>
                    </li>
                @else
                    <li class="disabled">
                        <a href="#">次へ &rsaquo;</a></a>
                    </li>
                    <li class="disabled">
                        <a href="#">最後 &raquo;</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
    <div class="col-xs-2"></div>
</div>

