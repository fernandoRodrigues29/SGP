<?php
class Autenticacao_c extends CI_Controller {
function __construct(){ parent::__construct(); }
    public function index(){
        $this->validar();
        //$this->load->view('main_view');
    }

    function validar(){
         $this->load->model('validacao_m');
         $this->load->model('mensagem_m');
        $data['usuario'] = $this->input->post('usuario');
        $data['senha'] = md5($this->input->post('senha'));
        //echo "senha <br>".$data['nome']."-".$data['senha']."<br>";
        if($this->input->post()){
        if($arr = $this->validacao_m->validacao($data)){
            $_SESSION['acesso'] = TRUE;
            foreach($arr as $value) {
               $_SESSION['uid'] = $idu = $value['id'];
               $_SESSION['identidade'] =  array($value['nome'],$value['img']);
               //echo " ".$_SESSION['identidade'][0]." ".$_SESSION['identidade'][1];
               $_SESSION['lista_mensagem'] = $this->mensagem_m->listar_msn_u($idu);
            }
            redirect('/maincontroller/index');  
        }else{
            $_SESSION['acesso'] = FALSE;
            //$layout_data = null;
            $layout_data['err_msg'] = true;
            $this->load->view('login.php', $layout_data);
        }
        }else{
          $layout_data = null;
           $layout_data['err_msg'] = false;
          $this->load->view('login.php', $layout_data);  
        }
    }
    function close(){
        session_destroy();
          //$this->log_interacao_sair();
          $this->session->sess_destroy();
           redirect('/autenticacao_c');
    }
    
    
}
?>
