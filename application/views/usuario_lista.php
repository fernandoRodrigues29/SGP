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

    <div class="table-responsive">
       <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3"><input type="text" name="valor" placeholder= " Nome ou Telefone">
            <button type="submit" alt="Pesquisar" id="botao" class="btn btn-success">
              <i class="fa fa-search"></i> 
            </button>
        </div>
      </div>
        <table class="table table-striped table-bordered table-hover" id="dataTables-ajax">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome/editar</th>
              <th>Cidade</th>
              <th><i class='fa fa-camera' title='Camera'></i></th>
              <th><i class='fa fa-trash' title='Excluir'></i></th>
            </tr>
         </thead>
             <tbody>
                <?php
                 $c = 1;
                 if($lista != null){
                 foreach ($lista as $value) {
                    
                 ?>
                   <tr>
                     <td><?php echo $value['id'] ?></td>  
                     <td><?php echo "<a href='".base_url("index.php/usuario_c/edit_usu?id=".$value['id'])."'>".$value['nome']."</a>"; ?></td>
                     <td><?php echo $value['munic'] ?></td>
                      <td><?php echo "<a href='".base_url("index.php/usuario_c/upl?id=".$value['id'])."'><i class='fa fa-camera'></i></a>"; ?></td>
                     <td><?php echo "<a href='".base_url("index.php/usuario_c/del_usu?id=".$value['id'])."' onclick='return confirmDialog();'><i class='fa fa-trash'></i></a>"; ?></td>
                   </tr>  
                 <?php $c++; }}else{ ?>
                 <tr>
                     <td colspan="4"><b>Vazio</b></td>  
                 </tr>  
                 <?php } ?>  
               </tbody>

         </table>
            <?php if($lista != null){ ?>
                <span style="float: left;"><b><?php echo $qtd; ?></b> Registros </span>
                <ul class="pagination" style="float: right;">
                 <?php echo $links;  ?> 
                </ul>
            <?php } ?>
    </div>
</div>
<script>
$(document).ready(function(){
   $("#botao").click(function(){
        var texto = $('input[name=valor]').val();
        $('#botao').show();
        $.post("<?php echo base_url('index.php/usuario_c/pesquisar');?>",
        { valor: texto},
        function(result){
             window.location = "<?php echo base_url('index.php/usuario_c/view_filtro_arr');?>";
        });
       /**/ 
    });
});
</script>
<!---->
