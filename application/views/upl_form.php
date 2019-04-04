<!---->
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <!-- Bootstrap 3.3.4 -->
 <link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />    
 <!-- Bootstrap 3.3.2 JS -->
 <script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>    
     
<!---->
<link href="<?php echo base_url('public/css_v/picedit/picedit.min.css')?>" rel="stylesheet">
<script src="<?php echo base_url('public/js_v/picedit/picedit.min.js')?>"></script>
<!---->
<br>
<div class="row">
  <?php echo ''; /* echo "-*-".$this->session->userdata('imagem')."-*-";*/ ?>  
</div>

<form action="<?php echo base_url('index.php/usuario_c/upl');?>" method="POST" enctype="multipart/form-data">
    <div class="row">
            <div class="col-lg-5">
                <input type="hidden" name="id_usuario" value="<?php echo $idu; ?>" >
                <input type="file" name="imagem" id="thebox">    
            </div>
    </div>
    <br>
    <div class="row">
      <div class="col-lg-4">  
        <div class="col-lg-3"> 
             <button class="btn-success btn-lg" type="submit" >Enviar</button>    
        </div>
        <div class="col-lg-3"> 
             <a href="<?php echo base_url('index.php/usuario_c/list_usu');?>" class="btn-info btn-lg" type="submit" >Retornar</a>    
        </div>
      </div>    
   </div>    
</form>

<script type="text/javascript">
	$(function() {
		$('#thebox').picEdit();
	});
</script>