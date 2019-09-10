
{{-- ヘッダー部分を読み込み --}}
@include('layouts.header')

<body class="hold-transition skin-green sidebar-mini">
    <div id="wrapper">


        {{-- pcの時のサイドメニューを表示 --}}
        @include('layouts.menu_top')

        {{-- pcの時の左サイドメニューを表示 --}}
        @include('layouts.menu_side')

     

        {{-- 内容の読み込み --}}
        @yield('content')






        <!-- {{-- コピーライトの表示 --}}
        <footer>

            <div class="copy text-center">
                {{-- 設定ファイルから、コピーライトを取得 --}}
                {{ Config::get('original.footer') }}
            </div>

        </footer> -->

        {{-- フッター部分を読み込み --}}
        @include('layouts.footer')
