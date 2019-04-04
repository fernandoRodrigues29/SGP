<!----> 
<div class="row">
<!---->
  <div class="col-md-12"> 
     <div class="row">
          <div class="col-md-12">
            <div class="input-group">  
                <h3 class="box-title"><?php echo $titulo; ?></h3>
                <?php
                if (isset($_SESSION['s_msg'])) { $msg = $_SESSION['s_msg']; $alert = $_SESSION['s_alert'];
                    unset($_SESSION['s_msg']); unset($_SESSION['s_alert']); }
                if (isset($msg)) {
                ?>
                    <div class="alert <?php echo $alert[0]; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa <?php echo $alert[1]; ?>"></i> <?php echo $alert[2]; ?>!</h4>
                        <?php echo $msg; ?>
                    </div>
                <?php } ?>
            </div>    
         </div>   
        </div> 
    <div class="box-body">
        
        <!-- form start -->
        <form class="form-horizontal"  action="<?php echo base_url("$action"); ?>" id="myform" method="POST"  role="form" >
            <?php if (isset($id)) { ?>
                <input type="hidden" name="hiden_id" value="<?php echo $id; ?>">
        <?php } ?>
            <div class="row">
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon" ><i class="fa fa-users"></i></span>
                    <input type="text" name="produto" value="<?php if (isset($produto)) {
                        echo $produto;
                    } ?>" class="form-control" id="prod" placeholder="Produto">
                  </div>  
                </div>
            </div>
            <br/>     
            <div class="row">
                <div class="col-md-12">
                   <div class="input-group">  
                    <textarea name="descricao"class="form-control" cols="155" rows="5" ><?php if (isset($descricao)) { echo $descricao; } ?></textarea>
                  </div>  
                </div>
            </div>
            <br/>
            <div class="row ">
                    <div class="col-md-6">
                      <div class="input-group">  
                        <span class="input-group-addon" ><i class="fa fa-dollar"></i></span>    
                        <input type="text"  name="valor"  value="<?php if (isset($valor)) { echo $valor; } ?>" class="form-control" id="valor" placeholder="Enter com o Valor">
                      </div>  
                    </div>
                    <div class="col-md-6">
                      <div class="input-group">   
                        <span class="input-group-addon" ><i class="fa fa-paperclip"></i></span>    
                        <select name="tipo" class="form-control">
                            <option value="0"> -- Tipo -- </option> 
                              <?php foreach ($lista_tipo as $value) { ?>
                                <option value="<?php echo $value['id_tipo'] ?>" 
                                    <?php if (isset($tipo)) { if ($value['id_tipo'] == $tipo) {  echo "selected"; } } ?>>
                                        <?php echo $value['tipo'] ?>
                                </option>
                             <?php } ?>
                        </select>
                     </div>   
                    </div>
            </div>
           <br/>
            <div class="row">
                <div class="col-lg-6">
                 <div class="input-group">   
                    <span class="input-group-addon" ><i class="fa fa-paperclip"></i></span>    
                    <select name="tipo" class="form-control">
                        <option value="0"> -- Tipo -- </option> 
                          <?php foreach ($lista_tipo as $value) { ?>
                            <option value="<?php echo $value['id_tipo'] ?>" 
                                <?php if (isset($tipo)) { if ($value['id_tipo'] == $tipo) {  echo "selected"; } } ?>>
                                    <?php echo $value['tipo'] ?>
                            </option>
                         <?php } ?>
                    </select>
                </div>
              </div>      
                <br>
            </div>
            <br/>
             <div class="row">
                <div class="col-lg-5">
                    <div class="input-group">    
                    <button type="submit" class="btn btn-primary">Inserir</button>
                    </div>
                </div>
            </div>
        </form>
   </div>
</div>
<!---->
</div>
<!---->            
