<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  base_url('public/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo  base_url('public/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css" />
    
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>SCP-</b>Beta</a>
      </div>
      <div class="login-box-body">
       <?php if($err_msg){?>   
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Erro no Acesso!</h4>
           Ocorreu um erro no login, ferifique o usuario e senha!
        </div>
       <?php } ?>  
        <p class="login-box-msg">Entre com o email e senha</p>
        <form action="<?php echo base_url('index.php/autenticacao_c');?>" method="post">
          <div class="form-group has-feedback">
              <input type="email" name="usuario" class="form-control" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" name="senha" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Entar</button>
            </div>
          </div>
        </form>
        <a href="#">fernando_dev@gmail.com</a><br>
        <a href="register.html" class="text-center">123456</a>
        <br>
        <a href="#">fernandoemail@gmail.com</a><br>
        <a href="register.html" class="text-center">123</a>
        <br>
        <a href="#">inserir@gmail.com</a>
        <a href="#" class="text-center">123456</a>
       
      </div>
    </div>
     <script src="<?php echo base_url('public/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
     <script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
     <script src="<?php echo base_url('public/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
