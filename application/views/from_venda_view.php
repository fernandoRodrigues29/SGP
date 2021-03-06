<div class="row">
    <!-- left column -->
    <div class="col-lg-10 col-lg-offset-1 ">
        <div class="row">
            <h3 ><?php echo $titulo; ?></h3>
            <?php
            if (isset($_SESSION['s_msg'])) {
                $msg = $_SESSION['s_msg'];
                $alert = $_SESSION['s_alert'];
                unset($_SESSION['s_msg']);
                unset($_SESSION['s_alert']);
            }
            if (isset($msg)) {
                ?>
                <div class="alert <?php echo $alert[0]; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa <?php echo $alert[1]; ?>"></i> <?php echo $alert[2]; ?>!</h4>
                <?php echo $msg; ?>
                </div>
<?php } ?>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal"  action="<?php echo base_url("$action"); ?>" id="myform" method="POST"  role="form" >
            <?php if (isset($id)) { ?>
                <input type="hidden" name="hiden_id" value="<?php echo $id; ?>">
			<?php } ?>
            <div class="row">
                <div class="col-md-10">
                 <label for="">Cliente</label>
                  <div class="col-md-8 input-group">   
                   <span class="input-group-addon" ><i class="fa fa-gear"></i></span>
                   <select name="cliente" class="form-control">
                    <?php foreach ($lista_cliente as $value) {?>
                      <option value="<?php echo $value['id_cliente'] ?>"
                    <?php if(isset($i_cli)){
                        if($value['id_cliente'] == $i_cli ){ echo "selected"; } } ?>  
                     ><?php echo $value['nome'] ?></option>
                     <?php } ?>
                    </select>
                   </div>
                </div>
            </div><br>
	    <div class="row">
                <div class="col-md-10">
                  <label for="">Produto</label>
                <div class="col-md-8 input-group">  
                  <span class="input-group-addon" ><i class="fa fa-gear"></i></span> 
                  <select name="pod" class="form-control">
                    <?php foreach ($lista_produto as $value) {?>
                      <option value="<?php echo $value['id_produto'] ?>"
                    <?php if(isset($i_pod)){
                        if($value['id_produto'] == $i_pod ){ echo "selected"; } } ?>  
                     ><?php echo $value['nome'] ?></option>
                     <?php } ?>
                    </select></div>
                 </div> 
            </div><br>
	    <div class="row">
              <div class="col-md-10">
                  <label for="">Validade</label> 
                <div class="col-md-8 input-group">
                    <span class="input-group-addon" ><i class="fa fa-gear"></i></span>
		    <input type="text" name="validade" value="<?php if (isset($validade)) {echo $validade;} ?>" data-date-format="dd-mm-yyyy" class="form-control" id="dt" placeholder="validade">
                </div>
              </div>    
            </div><br>
			<br>
            <div class="row">
                <button type="submit" class="btn btn-primary">Eviar</button>
            </div>
        </form>
    </div>
</div>            
