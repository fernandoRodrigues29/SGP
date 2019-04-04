<div class="row">
            <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $titulo;?></h3>
                 <?php 
                 if(isset($_SESSION['s_msg'])){
                     $msg = $_SESSION['s_msg'];
                     $alert = $_SESSION['s_alert'];
                     unset($_SESSION['s_msg']);
                     unset($_SESSION['s_alert']);
                 }
                 if(isset($msg)){ ?>
                    <div class="alert <?php echo $alert[0];?> alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa <?php echo $alert[1];?>"></i> <?php echo $alert[2];?>!</h4>
                      <?php  echo $msg;?>
                    </div>
                  <?php } ?>
                </div><!-- /.box-header -->
                
                <!-- form start -->
                <form class="form-horizontal"  action="<?php echo base_url("$action");?>" id="myform" method="POST"  role="form" >
                    <?php if(isset($id)){ ?>
                    <input type="hidden" name="hiden_id" value="<?php echo $id; ?>">
                    <?php } ?>
          <!-- --> <div class="box-body"><!---->
                           <div class="row">
                             <div class="col-md-6">  
                               <div class="col-md-10 input-group">
                                <label >Nome</label>
                                <input type="text" name="nome" value="<?php if(isset($nome)){ echo $nome; }?>" class="form-control" id="nome" placeholder="Enter com o Nome">
                              </div>
                             </div>
                             <div class="col-md-6">  
                               <div class="col-md-10 input-group">
                                <label >Usuario/email</label>
                                <input type="text"  name="usuario"  value="<?php if(isset($usuario)){ echo $usuario; }?>" class="form-control" id="usuario" placeholder="Enter com o Usuario">
                              </div>
                            </div>   
                           </div>
                           
                           <div class="row">
                                <div class="col-md-6"> 
                                   <div class="col-md-10 input-group">
                                      <label for="senha">Senha</label>
                                      <input type="password" name="senha"  class="form-control" id="senha" placeholder="Password">
                                   </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="col-md-10 input-group">
                                      <label for="repetir_senha">Repetir Senha</label>
                                      <input type="password" name="repetir_senha"  class="form-control" id="senha" placeholder="Password">
                                   </div> 
                               </div>     
                            </div>
                           <br> 
                           <div class="row">
                            <div class="col-md-6">
                                 
                                 <label for="estado">Estado</label>
                                 <select name="estados" id="cb_estados" class="form-control">
                                         <?php foreach ($lista_estado as $value) {?>
                                         <option value="<?php echo $value['UF'] ?>"
                                             <?php
                                             if(isset($i_uf)){
                                                if($value['UF'] == $i_uf ){ echo "selected"; }
                                             }
                                             ?>  
                                           ><?php echo $value['estado'] ?></option>
                                         <?php } ?>
                                     </select>
                                 
                            </div>
                            <div class="col-md-6">   
                                     <label for="estado">Municipios</label>
                                     <select name="municipios"  class="form-control">
                                         <?php foreach ($lista_municipio as $value) {?>
                                         <option value="<?php echo $value['codigo'] ?>"   
                                             <?php 
                                                if(isset($i_munic)){
                                                if($value['codigo'] == $i_munic ){ echo "selected"; }
                                                }
                                            ?>
                                                 ><?php echo $value['municipio'] ?></option>
                                         <?php } ?>
                                     </select>
                            </div> 
                           </div>
          <!-- --> </div> <!---->
                    <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Inserir</button>
                  </div>
                </form>
              </div><!-- /.box -->
</div>
</div>            
