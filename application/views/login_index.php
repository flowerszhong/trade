<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>登录-途瑞(torun) 物流管理系统</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo asset_url() . '/bootstrap/dist/css/bootstrap.min.css'; ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    .form-signin-heading{
        color: #fff;
    }
    .login{
        background-color: #666 !important;
        background: url(../assets/images/login_bg.jpg) no-repeat;
        background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -webkit-background-size: 100% 100%;
        background-attachment: fixed;
    }
    .form-signin {
        max-width: 400px;
        padding: 15px;
        margin: 60px auto;
    }

    .form-signin label{
        color: #fff;
    }
    .form-signin-heading{
      font-size: 24px;
    }
    </style>

  </head>

  <body class="login">

    <div class="container">

      <?php echo form_open('login/index',array('class'=>'form-signin')); ?>
        <h2 class="form-signin-heading">欢迎使用途瑞物流管理系统</h2>
        <label for="account" class="sr-only">账号</label>
        <input type="input" id="inputAccount" class="form-control" name="username" placeholder="请输入账号" required autofocus>
        <br>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="请输入密码" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> 记住登录
          </label>
        </div>
        <?php if(validation_errors()){ ?>
        <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
        </div>
        <?php } ?>
        <?php if(isset($error)){ ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
        <?php } ?>

        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
      <?php form_close(); ?>

    </div> <!-- /container -->
  </body>
</html>
