
<h4 class="text-center">Consulta</h4>
<div class="col-lg-12">
<?php
if(!empty($_SESSION['msg_del'])){
     $ar_m = $_SESSION['msg_del'];
     $typ = $ar_m[0];
     $mensagem = $ar_m[1];
?>
    <div class="row">
       <div class="col-md-11">     
        <div class="alert <?php echo $typ;?> alert-dismissable"><?php echo $mensagem;?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
       </div> 
    </div>
<?php 
unset($_SESSION['msg_del']);}
?>

    <div class="row">
     <div class="col-md-11">   
       <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3"><input type="text" name="valor" placeholder= "Produto">
            <button type="submit" alt="Pesquisar" id="botao" class="btn btn-success">
              <i class="fa fa-search"></i> 
            </button>
        </div>
      </div>
        <table class="table table-striped table-bordered table-hover" id="dataTables-ajax">
          <thead>
            <tr>
              <th>#</th>
              <th>Cliente</th>
              <th>Produto</th>
              <th>Validade</th>
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
                     <td><?php echo "<a href='".base_url("index.php/venda_c/edit?id_v=".$value['id_venda'])."'>".$value['id_venda']."</a>"; ?></td>
                     <td><?php echo $value['cliente'] ?></td>
                     <td><?php echo $value['produto'] ?></td> 
                     <td><?php echo $value['data_venda'] ?></td>  
                     <td><?php echo "<a href='".base_url("index.php/venda_c/del?id_v=".$value['id_venda'])."' onclick='return confirmDialog();'><i class='fa fa-trash'></i></a>"; ?></td>
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
</div>
<script>
$(document).ready(function(){
   $("#botao").click(function(){
        var texto = $('input[name=valor]').val();
        $('#botao').show();
        $.post("<?php echo base_url('index.php/produtos_c/pesquisar');?>",
        { valor: texto},
        function(result){
             window.location = "<?php echo base_url('index.php/produtos_c/view_filtro_arr');?>";
        });
    });
});
</script>
<!---->
