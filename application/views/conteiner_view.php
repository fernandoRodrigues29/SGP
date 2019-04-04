<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Desenvolvimento Rodrigues </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('public/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo base_url('public/dist/css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('public/dist/css/skins/_all-skins.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('public/plugins/iCheck/flat/blue.css')?>" rel="stylesheet" type="text/css" />
    <!-- Morris chart --
    <link href="<?php echo base_url('public/plugins/morris/morris.css')?>" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('public/plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url('public/plugins/datepicker/datepicker3.css')?>" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url('public/plugins/daterangepicker/daterangepicker-bs3.css')?>" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo base_url('public/dist/css/operacoes.css')?>" rel="stylesheet" type="text/css" />
    
    <script>
        /**/
        $(document).ready(function(){
            $('.lista_de_usuarios').hide();
        });/**/
        </script>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url('index.php/maincontroller'); ?>" class="logo" style="background-color: #f39c12;">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>CP</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SCP</b>Alpha</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"><?php echo $c = count($_SESSION['lista_mensagem']);?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Você tem <?php echo $c;?>  mensagens</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php foreach ($_SESSION['lista_mensagem'] as $value) { ?>
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo base_url('public/img/'.$value['img'])?>" class="img-circle" alt="User Image"/>
                          </div>
                          <h4>
                            <?php echo $value['nome'];?>
                            <!---->
                            <small><i class="fa fa-clock-o"></i> <?php echo date('H:m',strtotime($value['tempo'])); ?></small>
                          </h4>
                          <p><?php echo $value['texto']; ?></p>
                        </a>
                      </li><!-- end message -->
                      <?php } ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo base_url('index.php/mensagem_c'); ?>">Veja todas as mensagens</a></li>
                </ul>
              </li>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url('public/img/'.$_SESSION['identidade'][1])?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $_SESSION['identidade'][0];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url('public/img/'.$_SESSION['identidade'][1])?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $_SESSION['identidade'][0];?>
                      <!--<small>Member since Nov. 2015</small>-->
                    </p>
                  </li>
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!---->
                    <div class="pull-left">
                      <a href="<?php echo base_url('index.php/usuario_c/edit_usu?id='.$_SESSION['uid']); ?>" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <!---->  
                    <div class="pull-right">
                        <a href="<?php echo base_url('index.php/autenticacao_c/close'); ?>" class="btn btn-default btn-flat">Cai Fora!</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button --
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
              <!---->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('public/img/'.$_SESSION['identidade'][1])?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['identidade'][0];?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Navegação Principal</li>
            <!--
            <li><a href="<?php echo base_url('index.php/maincontroller/desenvolvimento'); ?>"><i class="fa fa-gear"></i> <span>Testes de Desenvolvimento</span></a></li>
            <!--
            <li class="treeview">
              <a href="#">
                <i class="fa fa-area-chart"></i>
                <span>Graficos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/graficos_c/'); ?>"><i class="fa fa-dashboard"></i> Dashbord</a></li>
              </ul>
            </li>
            -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/usuario_c/cad_usu'); ?>"><i class="fa fa-circle-o"></i> Inserir</a></li>
                <li><a href="<?php echo base_url('index.php/usuario_c/list_usu'); ?>"><i class="fa fa-circle-o"></i> Listar</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-suitcase"></i>
                <span>Produtos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/produtos_c/cad'); ?>"><i class="fa fa-circle-o"></i> Inserir Produto</a></li>
                <li><a href="<?php echo base_url('index.php/produtos_c/listar'); ?>"><i class="fa fa-circle-o"></i> Listar Produtos</a></li>
                <li><a href="<?php echo base_url('index.php/tipos_c/'); ?>"><i class="fa fa-gears"></i> Tipos de Produtos</a></li>
              </ul>
            </li>
	    <li class="treeview">
              <a href="#">
                <i class="fa fa-tag"></i>
                <span>Tags</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/tags_c/cad'); ?>"><i class="fa fa-circle-o"></i> Inserir Tags</a></li>
                <li><a href="<?php echo base_url('index.php/tags_c/listar'); ?>"><i class="fa fa-circle-o"></i> Listar Tags</a></li>
              </ul>
            </li>
	    <li class="treeview">
	      <a href="#">
                <i class="fa fa-tag"></i>
                <span>Estoque</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('index.php/estoque_c/listar'); ?>"><i class="fa fa-circle-o"></i> Listar estoque</a></li>
                </ul>
	     </li>
            <li class="treeview">
	      <a href="#">
                <i class="fa fa-tag"></i>
                <span>Modificadores</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
                <ul class="treeview-menu">
                    <!---->
                    <li><a href="<?php echo base_url('index.php/modificador_c/cad'); ?>"><i class="fa fa-circle-o"></i> Inserir Modificador</a></li>
                    <!---->
                    <li><a href="<?php echo base_url('index.php/modificador_c/listar'); ?>"><i class="fa fa-circle-o"></i> Listar Modificador</a></li>
                </ul>
	    </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Venda</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/venda_c/cad'); ?>"><i class="fa fa-circle-o"></i> Inserir</a></li>
                <li><a href="<?php echo base_url('index.php/venda_c/listar'); ?>"><i class="fa fa-circle-o"></i> Listar</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Cliente</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/cliente_c/cad'); ?>"><i class="fa fa-circle-o"></i> Inserir</a></li>
                <li><a href="<?php echo base_url('index.php/cliente_c/listar'); ?>"><i class="fa fa-circle-o"></i> Listar</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i>
                <span>Demandas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/demanda_c/cad'); ?>"><i class="fa fa-circle-o"></i> Inserir</a></li>
                <li><a href="<?php echo base_url('index.php/demanda_c/listar'); ?>"><i class="fa fa-circle-o"></i> Listar</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i>
                <span>Auditoria</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('index.php/auditoria_c/listar'); ?>"><i class="fa fa-circle-o"></i> Auditoria</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url('index.php/mensagem_c'); ?>"><i class="fa fa-comments-o"></i> <span>Mensagem</span></a></li>
           </ul>
        </section><!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
             <?php echo $this->session->userdata('pagina_titulo');?> 
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!--<div class="col-lg-12 connectedSortable">-->
            <div class="container">    
                <div class="row"><?php echo $conteudo;?></div>
              </div>  
            <!--</div>-->
        </section><!-- right col -->
      </div><!-- /.row (main row) -->
       
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
      
      <!-- Control Sidebar -->      
      <aside class="control-sidebar control-sidebar-dark">                
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3> 
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>               
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>                                    
                </a>
              </li> 
              <li>
                <a href='javascript::;'>               
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>                                    
                </a>
              </li> 
              <li>
                <a href='javascript::;'>               
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-waring pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>                                    
                </a>
              </li> 
              <li>
                <a href='javascript::;'>               
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>                                    
                </a>
              </li>               
            </ul><!-- /.control-sidebar-menu -->         

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">            
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked />
                </label>                
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" />
                </label>                
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>                
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
       <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <script  type="text/javascript" > 
           $(document).ready(function(){
            $("select[name=estados]").change(function(){
                   $("select[name=municipios]").html('<option value="0">Carregando...</option>');
                   $.post("<?php echo base_url('index.php/configuracao_c/combo_estados');?>",
                             {estado:$(this).val()},
                                   function(valor){
                                    $("select[name=municipios]").html(valor);
                                   }
                          );
            });
           });
       </script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>    
    
    <!-- Chart js -->
    <script src="<?php echo base_url('public/plugins/chartjs/Chart.min.js')?>" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url('public/plugins/sparkline/jquery.sparkline.min.js')?>" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>" type="text/javascript"></script>
    <!-- jQuery Knob Chart --
    <script src="<?php echo base_url('public/plugins/knob/jquery.knob.js')?>" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('public/plugins/daterangepicker/daterangepicker.js')?>" type="text/javascript"></script>
    <!-- InputMask -->
	<script src="<?php echo base_url('public/plugins/input-mask/jquery.inputmask.js') ?>"></script>
	<script src="<?php echo base_url('public/plugins/input-mask/jquery.inputmask.date.extensions.js') ?>"></script>
	<script src="<?php echo base_url('public/plugins/input-mask/jquery.inputmask.extensions.js') ?>"></script>
	<!-- datepicker -->
    <script src="<?php echo base_url('public/plugins/datepicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('public/plugins/slimScroll/jquery.slimscroll.min.js')?>" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('public/plugins/fastclick/fastclick.min.js')?>'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('public/dist/js/app.min.js')?>" type="text/javascript"></script>    
    
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url('public/dist/js/pages/dashboard.js')?>" type="text/javascript"></script>    
    
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('public/dist/js/demo.js')?>" type="text/javascript"></script>
        <script>
	 $( "#dt" ).datepicker();
         $( ".calendario" ).datepicker();
	//$("#valmasc").inputmask("99.99", {"placeholder": "99%"});
	</script>
  </body>
</html>