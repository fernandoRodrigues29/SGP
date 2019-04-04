
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
       <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3"><input type="text" name="valor" placeholder= "Demanda">
            <button type="submit" alt="Pesquisar" id="botao" class="btn btn-success">
              <i class="fa fa-search"></i> 
            </button>
        </div>
      </div>
        <table class="table table-striped table-bordered table-hover" id="dataTables-ajax">
          <thead>
            <tr>
              <th>#</th>
              <th>Demanda</th>
	      <th><i class='fa fa-trash' title='Excluir'></i></th>
            </tr>
         </thead>
             <tbody>
                <?php
                 $c = 1;
                 if($lista != null){
                 foreach ($lista as $value) {
                  $arrDemanda = explode(" ", $value['demanda']);
                  $demanda = $arrDemanda[0];
                ?>
                   <tr>
                     <td><?php echo $value['id_demanda'] ?></td>  
                     <td><?php echo "<a href='".base_url("index.php/demanda_c/edit?id_d=".$value['id_demanda'])."'>".$demanda." ...</a>"; ?></td>
              	     <td><?php echo "<a href='".base_url("index.php/demanda_c/del?id_d=".$value['id_demanda'])."' onclick='return confirmDialog();'><i class='fa fa-trash'></i></a>"; ?></td>
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
        $.post("<?php echo base_url('index.php/demanda_c/pesquisar');?>",
        { valor: texto},
        function(result){
             window.location = "<?php echo base_url('index.php/demandas_c/view_filtro_arr');?>";
        });
    });
});
</script>
<!---->
