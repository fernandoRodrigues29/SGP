<?php
class Tipos_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    $arr['titulo'] = 'Cadastrar Tipo';
    $arr['action'] = 'index.php/tipos_c/cad';
    $layout_data['conteudo'] = $this->load->view('form_tipo_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function cad(){
 $this->load->model('config_m');
 $arr['titulo'] = 'Cadastrar Tipos';
    $arr['action'] = 'index.php/tipos_c/cad';
    $this->session->set_userdata('pagina_titulo',"<i class='fa fa-suitcase'></i> Tipos > Cadastrar");
	if($this->input->post()){
            $data['tipo'] = $this->input->post('tipo');
                if($this->config_m->inserir('tipo',$data)){
                    $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  'Cadastrado com sucesso';
                }else{ $arr['alert'] = array('alert-danger','fa-ban','Erro'); $arr['msg'] =  'Erro no Cadastrado'; }
        }
	//	
	$layout_data['conteudo'] = $this->load->view('form_tipo_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);	
}
function edit(){
$this->load->model('config_m');
    $arr['titulo'] = 'Editar Tipo';
    $arr['action'] = 'index.php/tipos_c/edit';
       $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-suitcase'></i> Tipo </li><li> Editar</li>");        
    if($idt = $this->input->get('id_t')){
           $rs =  $this->config_m->get_lista_2('tipo','tipo',array('id_tipo'=>$idt));
           $arr['id'] = $idt;
           $arr['tipo'] = $rs[0]['tipo'];
     }else{
           $arr['id'] =$idTipo = $this->input->post('hiden_id');
           $arr['tipo'] =$data['tipo'] =  $this->input->post('tipo');
           
           if($this->config_m->atualizar('tipo',$data,array('id_tipo'=>$idTipo))){
                $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  $data['tipo'].' Atualizado com sucesso';
           }else{
               $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                    $arr['msg'] =  'Erro na Atualização';
           }
           
        }
    $layout_data['conteudo'] = $this->load->view('form_tipo_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function listar(){
      $this->load->model('config_m');
       $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-suitcase'></i> Tipos </li><li> Listar</li>");
      $rs = $this->config_m->get_lista_1('t.id_tipo,t.tipo','tipo as t');  
      if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/tipos_c/listar');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
       $layout_data['conteudo'] = $this->load->view('tipos_listar.php',$data,true);
       $this->load->view('conteiner_view.php', $layout_data);
}
function del(){
    $this->load->model('config_m');
    if($idp = $this->input->get('id_t')){
           if($this->config_m->excluir(array('id_tipo'=>$idp),'tipo')){
             $_SESSION['msg_del']= array('alert-success',$data['nome'].'Excluido com sucesso');
           }else{ $_SESSION['msg_del']= array('alert-success',$data['nome'].'Excluido com sucesso'); }
        }
     redirect('tipos_c/listar');   
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

}
?>