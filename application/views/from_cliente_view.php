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
            
            <div class="row ">
                <div class="col-md-5  input-group">
                <span class="input-group-addon" ><i class="fa fa-user"></i></span>    
                    <input type="text"  name="nome"  value="<?php if (isset($nome)) { echo $nome; } ?>" class="form-control"  placeholder=" Nome">
                </div>
            </div>
            <br>    
            <div class="row ">
                <div class="col-md-5  input-group">
                <span class="input-group-addon" ><i class="fa fa-phone"></i></span>    
                    <input type="text"  name="contato"  value="<?php if (isset($contato)) { echo $contato; } ?>" class="form-control" id="valor" placeholder="Contato">
                </div>
            </div>
            <br/>
            <div class="row ">
                <div class="col-md-5  input-group">
                <span class="input-group-addon" ><i class="fa fa-at"></i></span>    
                    <input type="text"  name="email"  value="<?php if (isset($email)) { echo $email; } ?>" class="form-control" id="valor" placeholder="Enter com o E-Mail">
                </div>
            </div>
            <br/>
            <div class="row ">
                <div class="col-md-5 input-group">
                   <span class="input-group-addon" ><i class="fa fa-map-marker"></i></span>    
                               
                                 <select name="estados" class="form-control">
                                         <?php foreach ($l_uf as $value) {?>
                                         <option value="<?php echo $value['uf'] ?>"
                                             <?php
                                             if(isset($i_uf)){
                                                if($value['uf'] == $i_uf ){ echo "selected"; }
                                             }
                                             ?>  
                                           ><?php echo $value['uf'] ?></option>
                                         <?php } ?>
                                     </select>
                                 </div>
            </div><br>
	    <div class="row">
                <div class="col-md-5 input-group">
                   <span class="input-group-addon" ><i class="fa fa-map-marker"></i></span>    
                   
                     <select name="municipios"  class="form-control">
                       <?php foreach ($l_munic as $value) {?>
                        <option value="<?php echo $value['codigo'] ?>"   
                          <?php  if(isset($i_munic)){ if($value['codigo'] == $i_munic ){ echo "selected"; } } ?>
                        ><?php echo $value['municipio'] ?></option>
                       <?php } ?>
                      </select>
                 </div>
            </div>
            <br>
            <div class="row ">
                <div class="col-md-5  input-group">
                <span class="input-group-addon" ><i class="fa fa-home"></i></span>    
                    <input type="text"  name="end"  value="<?php if (isset($end)) { echo $end; } ?>" class="form-control"  placeholder="Endereço">
                </div>
            </div>
            <br>
	    <div class="row">
                <button type="submit" class="btn btn-primary">Eviar</button>
            </div>
        </form>
    </div>
</div>            
