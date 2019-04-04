
<h4 class="text-center">Consulta</h4>
<div class="col-lg-12">
<?php
if(!empty($_SESSION['msg_del'])){
     $ar_m = $_SESSION['msg_del'];
     $typ = $ar_m[0];
     $mensagem = $ar_m[1];
?>
    <div class="row">
        <div class="col-md-10">
        <div class="alert <?php echo $typ;?> alert-dismissable"><?php echo $mensagem;?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
        </div>
    </div>
<?php 
unset($_SESSION['msg_del']);}
?>

    <div class="table-responsive">
      <div class="col-md-10">  
       <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3"><input type="text" name="valor" placeholder= "Auditoria">
            <button type="submit" alt="Pesquisar" id="botao" class="btn btn-success">
              <i class="fa fa-search"></i> 
            </button>
        </div>
      </div>
        <table class="table table-striped table-bordered table-hover" id="dataTables-ajax">
          <thead>
            <tr>
              <th>#</th>
              <th>Ação</th>
	      <th>Data</th>
            </tr>
         </thead>
             <tbody>
                <?php
                 $c = 1;
                 if($lista != null){
                 foreach ($lista as $value) {
                ?>
                   <tr>
                     <td><?php echo $value['id_auditoria'] ?></td>  
                     <td><?php echo $value['acao']; ?></td>
              	     <td><?php echo date('d/m/Y',strtotime($value['data_cad'])); ?></td>
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
        $.post("<?php echo base_url('index.php/auditoria_c/pesquisar');?>",
        { valor: texto},
        function(result){
             window.location = "<?php echo base_url('index.php/auditoria_c/view_filtro_arr');?>";
        });
    });
});
</script>
<!---->
