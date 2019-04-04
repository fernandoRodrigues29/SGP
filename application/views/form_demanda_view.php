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
            } if (isset($msg)) { ?>
              <div class="col-lg-9">  
                <div class="alert <?php echo $alert[0]; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa <?php echo $alert[1]; ?>"></i> <?php echo $alert[2]; ?>!</h4>
                <?php echo $msg; ?>
                </div>
              </div>    
<?php } ?>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal"  action="<?php echo base_url("$action"); ?>" id="myform" method="POST"  role="form" >
            <?php if (isset($id)) { ?>
                <input type="hidden" name="hiden_id" value="<?php echo $id; ?>">
			<?php } ?>
            <div class="row ">
               <div class="col-md-12">
                <label>Data De Inicio</label>   
                <div class="col-md-5  input-group">
                <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>    
                    <input type="text"  name="di"  value="<?php if (isset($di)) { echo $di; } ?>" class="form-control calendario"  data-date-format="dd-mm-yyyy"  placeholder="Data Inicio">
                </div>
               </div>    
            </div>
            <br/>
            <div class="row ">
                <div class="col-md-12">
                    <label>Data de Conclusão</label>   
                    <div class="col-md-5  input-group">
                    <span class="input-group-addon" ><i class="fa fa-calendar-o"></i></span>    
                        <input type="text"  name="dc"  value="<?php if (isset($dc)) { echo $dc; } ?>" class="form-control calendario"  data-date-format="dd-mm-yyyy" id="" placeholder="data_conclusão">
                    </div>
                </div>  
            </div>
            <br/>
            <div class="row ">
               <div class="col-md-12">
                    <label>Funcionario</label>   
                <div class="col-md-5 input-group">
                   <span class="input-group-addon" ><i class="fa fa-user"></i></span>    
                     <select name="func" class="form-control">
                        <?php foreach ($l_func as $value) {?>
                          <option value="<?php echo $value['id'] ?>"
                            <?php
                               if(isset($i_func)){  if($value['id'] == $i_func ){ echo "selected"; } } ?> >
                                 <?php echo $value['nome'] ?></option>
                            <?php } ?>
                            </select>
                       </div>
                  </div>     
            </div>
            <div class="row ">
                <div class="col-md-12">
                <label>Demanda</label>
                    <div class="col-md-12">
                    <textarea name="demanda" cols="100" rows="10"><?php if (isset($demanda)) { echo $demanda; } ?></textarea>
                  </div>    
               </div>
            </div>
	    <div class="row">
                <button type="submit" class="btn btn-primary">Eviar</button>
            </div>
        </form>
    </div>
</div>            
