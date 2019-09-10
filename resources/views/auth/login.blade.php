
    {{-- ヘッダー部分を読み込み --}}
    @include('layouts.header')


<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>DevOps</b>管理画面</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">自分のメールアドレスでログインしてください</p>

            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
                <div class="form-group has-feedback">
                    {{-- ID(E-mail) --}}
                    <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Your E-mail" required autofocus>

                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {{-- パスワード --}}
                    <input class="form-control" type="password" name="password" placeholder="Your Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">ログイン</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    @show

    {{-- フッター部分を読み込み --}}
    @include('layouts.footer')