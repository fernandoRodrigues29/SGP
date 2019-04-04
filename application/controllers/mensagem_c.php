<?php
class Mensagem_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){$this->gerir();}

function enviar(){
    $this->load->model('mensagem_m');
    $this->load->model('config_m');
    $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-envelope-o'></i> Mensagem </li><li> enviar</li>");
    if($idms = $this->input->get('id')){
       $arr['lista'] = $this->mensagem_m->listar_msn($idms);
       $arr['qtdMsg'] = count($arr['lista']);
       $arr['id_remetente'] =$_SESSION['uid'];
            foreach($this->config_m->get_lista_2('id_remetente,id_destinatario','mensagem',array('id_mensagem'=>$idms)) as $value){
                if($value['id_remetente'] == $_SESSION['uid']){
                     $arr['id_destinatario'] =$value['id_destinatario'];
                }else{
                     $arr['id_destinatario'] =$value['id_remetente'];
                }
            }
     }
     if($id_p = $this->input->get('id_p')){
       //$arr['lista'] = $this->mensagem_m->listar_msn(0);
       $arr['id_remetente'] =$_SESSION['uid'];
       $arr['id_destinatario'] =$id_p;
       $arr['qtdMsg'] = 0;
           
     }
    if($this->input->post()){
        if($this->input->post('idm')!=''){
            $data['id_m_pai'] = $this->input->post('idm');
        }else{ $data['id_m_pai'] = 0; }
         $arr['id_remetente'] = $data['id_remetente'] = $this->input->post('idr');
         $arr['id_destinatario'] = $data['id_destinatario'] = $this->input->post('idd');
         $data['tempo_hora'] = date('y-m-d h:m:s');
         $data['texto'] = $this->input->post('msg');
         $data['visibilidade'] = 'P';
         $data['visto'] = 'N';
            $this->config_m->inserir('mensagem',$data);
            if($data['id_m_pai']==0){
                $idm = $this->config_m->ultimo_id('id_mensagem','mensagem');
                $arr['lista'] = $this->mensagem_m->listar_msn($idm);
            }else{
                $arr['lista'] = $this->mensagem_m->listar_msn($this->input->post('idm'));
            }
            $arr['qtdMsg'] = count($arr['lista']);
    }
    
    $layout_data['conteudo'] = $this->load->view('form_mensagem_view.php',$arr,true);
    $this->load->view('conteiner_view',$layout_data);}
function enviar_msg(){
    $this->load->model('mensagem_m');
    $this->load->model('config_m');
    $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-envelope-o'></i> Mensagem </li><li> enviar</li>");
    if($idms = $this->input->get('id')){
       $arr['lista'] = $this->mensagem_m->listar_msn($idms); 
    }else{
        $arr =NULL;
        if($this->input->post('idm')!=''){
            $arr['lista'] = $this->mensagem_m->listar_msn($this->input->post('idm'));
        }
    }
    if($this->input->post()){
        if($this->input->post('idm')!=''){
            $data['m_pai'] = $this->input->post('idm');
        }else{
             $data['m_pai'] = 0;
        }
         $data['usuario_id'] = $this->input->post('uid');
         $data['tempo_hora'] = date('y-m-d h:m:s');
         $data['texto'] = $this->input->post('msg');
         $data['visibilidade'] = 'P';
        $this->config_m->inserir('mensagem',$data);
    }
    
    $layout_data['conteudo'] = $this->load->view('form_mensagem_view2.php',$arr,true);
    $this->load->view('conteiner_view',$layout_data);}    
function responder(){$this->load->view('main_view');}
function gerir(){
    $this->load->model('mensagem_m');
    $this->load->model('config_m');
    $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-envelope-o'></i> Mensagem </li><li> Listar</li>");
    //$arr['lista'] =  $this->config_m->get_lista_1('nome,texto,id, id_mensagem','mensagem');
    //$arr['lista'] =  $this->mensagem_m->listar_msn(1);
    $arr['lista'] =  $this->mensagem_m->listar_mensagens_geral($_SESSION['uid']);
    $layout_data['conteudo'] = $this->load->view('gerir_mensagens_view.php',$arr,true);
    $this->load->view('conteiner_view',$layout_data);}
function excluir(){
    $this->load->model('config_m');
            if($idm = $this->input->get('idm')){
               $where['id_mensagem'] = $idm;
               if($this->config_m->excluir($where,'mensagem')){
                   $where2['id_m_pai'] = $idm;
                   if($this->config_m->excluir($where2,'mensagem')){
                       $_SESSION['msg_del'] = array('alert-info','Mensagem Excluida Com Sucesso');
                   }else{
                       $_SESSION['msg_del'] = array('alert-info','Algo aconteceu de errado');
                   } 
               }
           }
            if($this->input->post()){
                foreach ($this->input->post('ckl') as $value) {
                  //echo  $where['id_mensagem'] = $value; 
                        /**/
                        if($this->config_m->excluir(array('id_mensagem'=>$value),'mensagem')){
                           if($this->config_m->excluir(array('id_m_pai'=>$value),'mensagem')){
                                $_SESSION['msg_del'] = array('alert-info','Mensagem Excluida Com Sucesso');
                            }else{
                                $_SESSION['msg_del'] = array('alert-info','Algo aconteceu de errado');
                            } 
                        }
                         /**/
                }
            }
        redirect('mensagem_c/gerir');
    }
//json 
function json_listar_usuarios(){
 $this->load->model('config_m');
    $arr['lista'] =  $this->config_m->get_lista_1('id,nome,usuario,uf,img','usuarios');
    $arr['qtd'] =count($arr['lista']);    
    print json_encode($arr);
 
}    
    
}
?>
