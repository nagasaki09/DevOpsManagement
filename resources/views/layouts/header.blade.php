<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex,nofollow">
        <meta name="googlebot" content="noindex,nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>
            {{-- 設定ファイルから、タイトル名を取得 --}}
            {{ Config::get('original.title') }}
            @if( isset( $title ) == True )
            &nbsp;|&nbsp;{{ $title }}
            @endif
        </title>

        {{-- cssの読み込み --}}
        @section('css')
        <link rel="stylesheet" href="{{ asset('css/adminlte/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('css/adminlte/font-awesome.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('css/adminlte/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/adminlte/AdminLTE.css') }}">

        <link rel="stylesheet" href="{{ asset('css/adminlte/_all-skins.min.css') }}">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
        <link rel="stylesheet" href="{{ asset('css/adminlte/dataTables.bootstrap.css') }}">
        
        <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

        @show
    </head>
