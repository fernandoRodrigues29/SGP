<div class="row">
    <!-- left column -->
    <div class="col-lg-10 col-lg-offset-1 ">
        <!-- general form elements --
        <div class="box box-primary">
        <!----> 
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
				 <input type="hidden" name="fk_p" value="<?php echo $fk_p; ?>">
				 <input type="hidden" name="nome" value="<?php echo $nome; ?>">
			<?php } ?>
            <div class="row">
                <div class="col-md-5 input-group">
                    <span class="input-group-addon" ><i class="fa fa-gear"></i></span>
                    <input  class="form-control" type="text" value="<?php echo " ".$nome; ?>" disabled="disabled" /> 
		</div>
            </div>
			<div class="row">
                <div class="col-md-5 input-group">
                    <span class="input-group-addon" ><i class="fa fa-gear"></i></span>
                    <input type="text" name="qtd" value="<?php if (isset($qtd)) {	echo $qtd;	} ?>" class="form-control" id="qtd" placeholder="Qtd no Estoque">
                </div>
            </div>
			<br>
            <div class="row">
                <button type="submit" class="btn btn-primary">Eviar</button>
            </div>
        </form>
    </div>
</div>            
