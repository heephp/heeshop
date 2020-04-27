<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>用户登录 -- HeeFramework</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon"/>
    <style>
        .login-action{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
            padding-left: 1em;
        }
        .forgotpwd{
            font-size: 12px;
            color: #999999;
        }
    </style>
    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/atlantis.min.css">
    <style>
        .classic-grid{min-height: auto !important;height: auto !important;}
        .bg{width: 40%;height: 500px;border-radius: 10px;}
        .page-inner{margin:0 !important;}
        .login-form{margin-top: -360px;}
        .login-action{padding: 30px 0 0 0 !important;border-top: 0 !important;}
        .space{margin-top: 100px;}
    </style>
</head>
<body>
<div class="wrapper">
    <div class="page-inner">
        <div class="space"></div>
        <div class="row">
            <div class="panel-header bg-primary-gradient bg ml-auto mr-auto">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">用户登录</h2>
                            <h5 class="text-white op-7 mb-2">欢迎使用</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row login-form">
            <div class="card col-md-4 ml-auto mr-auto ">
                <form action="<?=url('action')?>" method="post">
                <div class="card-body">
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-2 col-form-label">用户名</label>
                        <div class="col-md-9 p-0">
                            <input type="text" class="form-control input-full" name="username"  placeholder="用户名">
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-2 col-form-label">密码</label>
                        <div class="col-md-9 p-0">
                            <input type="password" class="form-control input-full" name="password"  placeholder="***">
                        </div>
                    </div>
                    <?if(conf('is_vcode')=='1'){?>
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-2 col-form-label">验证码</label>
                        <div class="col-md-9 p-0">
                            <div class="row">
                                <div class="col-md-8"><input type="text" class="form-control input-full" name="vcode"  placeholder="验证码"></div>
                                <div class="col-md-4"><img src="<?=url('vcode')?>" class="vcode" onclick="this.src='<?=url('/'.APP.'/index/vcode')?>'"></div>
                            </div>

                        </div>
                    </div>
                    <?}?>
                    <div class="login-action">
                        <input type="submit" value="登录" class="btn btn-success"/>
                        <a class="forgotpwd" href="#">找回密码？</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>