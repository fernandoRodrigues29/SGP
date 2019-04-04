<div class="row" >
    <div class="col-md-10">
              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Mensagem</h3>
                  <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="<?php echo $qtdMsg;?> Mensagens" class="badge bg-yellow"><?php echo $qtdMsg;?></span>
                    <!----
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!---->
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                      <i class="fa fa-comments"></i>
                    </button>
                    <!--
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                    <!-->
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- area de conversação -->
                  <?php  if(isset($lista)){ $c = 0;  ?>
                  <div class="direct-chat-messages">
                    <?php 
                       foreach ($lista as $value) { 
                            if($c == 0){ $idm =  $value['id_mensagem']; }
                             $c++;
                                 if($_SESSION['uid'] == $value['idr']){echo "*";}else{echo "-";}
                    ?>
                    <?php if($_SESSION['uid'] == $value['idr']){
                        $remetente=true;}else{
                            $remetente=false;}?>  
                   <!-- Messagem do usuario -->
                   <div class="direct-chat-msg <?php if(!$remetente){print "right";} ?>">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-<?php if($remetente){print "left";}else{print "right";} ?>"><?php echo $value['nome']; ?></span>
                        <span class="direct-chat-timestamp pull-<?php if($remetente){print "right";}else{print "left";} ?>"><?php echo date('d M H:m a',strtotime($value['tempo'])); ?></span>
                      </div>
                      <img class="direct-chat-img" src="<?php echo base_url('public/img/'.$value['img']); ?>" alt="message user image">
                      <div class="direct-chat-text"><?php echo $value['texto']; ?></div>
                    </div>
                  <?php } ?> 
                  </div>
                  <?php } ?>
                  <!-- lista de contatos -->
                  <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Count Dracula
                                  <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
                            <span class="contacts-list-msg">How have you been? I was...</span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="box-footer">
                  <form action="<?php echo base_url('index.php/mensagem_c/enviar');?>" method="POST">
                  <?php if(isset($idm)){ ?>
                    <input type="hidden" name="idm" value="<?php echo $idm;?>">
                  <?php }else{ ?>
                    <input type="hidden" name="idm" value="">
                  <?php } ?>  
                    <input type="hidden" name="idd" value="<?php echo $id_destinatario;?>">
                    <input type="hidden" name="idr" value="<?php echo $id_remetente;?>">
                      
                    <div class="input-group">
                      <input type="text" name="msg" placeholder="Digitar a mensagem ..." class="form-control">
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat">Enviar</button>
                          </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
</div>
