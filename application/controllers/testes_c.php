<?php
class Testes_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    /**$arr['titulo'] = 'Cadastrar Auditoria';
    $arr['action'] = 'index.php/teste_c/listar';
    $layout_data['conteudo'] = $this->load->view('from_auditoria_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);/**/
    $this->listar();
}
function listar(){
      $this->load->model('config_m');
      $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Auditoria </li><li> Listar</li>");
      $rs =  $this->config_m->get_lista_4(
       'codigo_uf,estado,uf', 'estados', array('id >'=>'0'),array(7,1));
      
      if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/testes_c/listar');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
       $layout_data['conteudo'] = $this->load->view('listar_teste02.php',$data,true);
       $this->load->view('conteiner_view.php', $layout_data);
}

function listar_teste(){
      $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Auditoria </li><li> Listar</li>");
    $layout_data['conteudo'] = $this->load->view('listar_teste02.php',null,true);
       $this->load->view('conteiner_view.php', $layout_data);
}

function jsonLista(){}
function aux_arr_pagination($lista,$ind,$url){
        $this->load->library('pagination');
            $data['qtd'] = count($lista);
            if(count($lista)>0){
                        $quebra_lista = array_chunk($lista, 25);
                        $data['i']=$indice = ($ind/25);
                        //echo "<br> dentro do form".$indice;
                        $data['lista'] = $quebra_lista[$indice];
                                $total_row =  count($lista);
                                $config['base_url'] =  base_url($url);
                                $config['total_rows'] = $total_row;
                                $config['per_page'] = 25;

                                $config['first_link'] = '&laquo; First';
                                $config['first_tag_open'] = '<li>';
                                $config['first_tag_close'] = '</li>';

                                $config['last_link'] = 'Last &raquo;';
                                $config['last_tag_open'] = '<li>';
                                $config['last_tag_close'] = '</li>';

                                $config['next_tag_open'] = '<li>';
                                $config['next_tag_close'] = '</li>';

                                $config['prev_tag_open'] = '<li>';
                                $config['prev_tag_close'] = '</li>';

                                $config['cur_tag_open'] = '<li class="active"><a href="">';
                                $config['cur_tag_close'] = '</a></li>';

                                $config['num_tag_open'] = '<li>';
                                $config['num_tag_close'] = '</li>';

               $this->pagination->initialize($config);
               $data['links']=$this->pagination->create_links();
           }else{
               $data['lista'] = null;
           }
        return $data;   
    }
function teste_json(){
     //header('Content-type: application/json');
    $this->load->model('config_m');
        if($this->input->post('offset')){
            $constante = 7;
            $off =$this->input->post('offset');
            $off= --$off;
            $limite = $off*$constante;
        }else{
            $limite = 1;
            $constante = 7;
        }
     $rs =  $this->config_m->get_lista_4('codigo_uf,estado,uf', 'estados', array('id >'=>'0'),array($constante,$limite));
     echo json_encode($rs);
}    

}
?>