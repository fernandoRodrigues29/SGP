<style>
    .users-list>li img {
    border-radius: 50%;
    max-width: 100%;
    height: 90px;
    width: 90px;
}
</style>
<h4 class="text-center">Consulta</h4>
<div class="col-lg-12">
<?php 
if(!empty($_SESSION['msg_del'])){ 
     //$typ = "alert-success"; $mensagen="Registro Excluido Com sucesso!";
     $ar_m = $_SESSION['msg_del'];
     $typ = $ar_m[0];
     $mensagem = $ar_m[1];
?>
    <div class="row">
        <div class="alert <?php echo $typ;?> alert-dismissable"><?php echo $mensagem;?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
    </div>
<?php unset($_SESSION['msg_del']);}?>
    <div class="lista_de_usuarios">
    <div class="row">
        <div class="col-md-12">
                <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Equipe</h3>

                  <div class="box-tools pull-right">
                    <span id="numero_usuarios" class="label label-danger">9 Menbros</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix" id="lista_usuarios_img"></ul>
                </div>
                <!-- /.box-body --
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
          
        </div>
    </div>
    </div>
    <div class="row">
        <ul class="l1"></ul>
        <div class="col-lg-3"><button type="submit" alt="usuarios" id="botao_usuarios" value="Enviar Mensagem" class="btn btn-success"> <i class="fa fa-comments-o fa-2x"></i> </button></div>
    </div>
    <div class="row">
        <br>
    </div>
    <div class="table-responsive">
       <!-- TO DO List -->
        <div class="col-lg-10">
              <div class="box box-primary">
              <!--  
              <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Lista de Mensagem</h3>
                  <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                      <li><a href="#">&laquo;</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->
                <form action="<?php echo base_url('index.php/mensagem_c/excluir');?>" method="POST">
                <div class="box-body">
                  <ul class="todo-list">
                    <?php foreach ($lista as $value) { 
                        $texto_simples = substr($value['texto'],0,10); // Split up the whole string
                    ?>
                     <li>
                      <span class="handle"><!-- mover lista -->
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <input type="checkbox" value="<?php echo $value['id_mensagem']; ?>" name="ckl[]"/>
                      <span class="text"><a href="<?php echo base_url('index.php/mensagem_c/enviar?id='.$value['id_mensagem']);?>"> <?php echo " ".$value['nome']." - ".$texto_simples." ...";?></a></span>
                      <div class="tools">
                        <a href="<?php echo base_url('index.php/mensagem_c/excluir?idm='.$value['id_mensagem']);?>"><i class="fa fa-trash-o"></i></a>
                      </div>
                    </li>
                    <?php } ?>
                </ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                    <button class="btn btn-default pull-right" type="submit" ><i class="fa fa-trash-o"></i> Excluir</button>
                </div>
                </form>
              </div>
        </div>
        <!-- /.box -->
    </div>
</div>
<script>
$(document).ready(function(){
    
$('.lista_de_usuarios').hide();
  $.getJSON("<?php echo base_url('index.php/mensagem_c/json_listar_usuarios');?>", function(result){
      //console.log(result.lista);
      //console.log(result.qtd);
      $("#numero_usuarios").html(result.qtd+' Menbros');
      //numero_usuarios
       for (var key in result.lista) {
           var $lista_1 = result.lista[key];
           var thtml = '<img src="http://localhost/freelancer_seymer/CodeIgniter-3.0.0/public/img/'+$lista_1.img+'" alt="User Image">'+
                   '<a class="users-list-name" href="http://localhost/freelancer_seymer/CodeIgniter-3.0.0/index.php/mensagem_c/enviar?id_p='+$lista_1.id+'">'+$lista_1.nome+'</a>'
                   +'<span class="users-list-date">'+$lista_1.usuario+'</span>';
           $("#lista_usuarios_img").append($('<li>')
            .html(thtml));
           //console.log($lista_1.nome);
       }
  });
 
 
 $("#botao_usuarios").click(function(){
       $(".lista_de_usuarios").toggle( "fast", function() {
            // Animation complete.
        });
        //$this.hidden();
       /**/ 
    });
});
</script>
<!---->
