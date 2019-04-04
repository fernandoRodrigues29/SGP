<?php
class Estoque_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    $arr['titulo'] = 'Cadastrar Estoque';
    $arr['action'] = 'index.php/estoque_c/cad';
    $layout_data['conteudo'] = $this->load->view('form_estoque_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function cad(){
 $this->load->model('config_m');
 $arr['titulo'] = 'Cadastrar Estoque';
    $arr['action'] = 'index.php/estoque_c/cad';
    $this->session->set_userdata('pagina_titulo',"<i class='fa fa-suitcase'></i> Estoque > Cadastrar");
	if($this->input->post()){
            $data['fk_produto'] = $this->input->post('fk_p');
			$data['qtd'] = $this->input->post('qtd');
                if($this->config_m->inserir('estoque',$data)){
                    $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  'Cadastrado com sucesso';
                }else{ $arr['alert'] = array('alert-danger','fa-ban','Erro'); $arr['msg'] =  'Erro no Cadastrado'; }
        }
	//	
	$layout_data['conteudo'] = $this->load->view('form_estoque_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);	
}
function edit(){
$this->load->model('config_m');
    $arr['titulo'] = 'Editar Estoque';
    $arr['action'] = 'index.php/estoque_c/edit';
       $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-suitcase'></i> Estoque </li><li> Editar</li>");        
    if($ide = $this->input->get('id_e')){
		   $rs = $this->config_m->get_lista_3('e.id_estoque,p.nome,e.fk_produto,e.qtd','estoque as e',array('id_estoque'=>$ide),array('produto p','p.id_produto = e.fk_produto'));
		   //$rs =  $this->config_m->get_lista_2('fk_produto,qtd','estoque',array('id_estoque'=>$ide));
           $arr['id'] = $ide;
           $arr['fk_p'] = $rs[0]['fk_produto'];
		   $arr['nome'] = $rs[0]['nome'];
		   $arr['qtd'] = $rs[0]['qtd'];
     }else{
           $arr['id'] =$idTipo = $this->input->post('hiden_id');
           $arr['fk_p'] =$data['fk_produto'] =  $this->input->post('fk_p');
           $arr['qtd'] =$data['qtd'] =  $this->input->post('qtd');
		   $arr['nome'] = $this->input->post('nome');
           if($this->config_m->atualizar('estoque',$data,array('id_estoque'=>$idTipo))){
                $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  $data['fk_produto'].' Atualizado com sucesso';
           }else{
               $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                    $arr['msg'] =  'Erro na Atualização';
           }
      }
    $layout_data['conteudo'] = $this->load->view('form_estoque_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function listar(){
      $this->load->model('config_m');
		$this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-suitcase'></i> Estoque </li><li> Listar</li>");
		$rs = $this->config_m->get_lista_3('e.id_estoque,p.nome,e.qtd','estoque as e','id_estoque > 0',array('produto p','p.id_produto = e.fk_produto'));
		//$rs = $this->config_m->get_lista_1('id_estoque,fk_produto,qtd','estoque');  
      if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/estoque_c/listar');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
       $layout_data['conteudo'] = $this->load->view('listar_estoque.php',$data,true);
       $this->load->view('conteiner_view.php', $layout_data);
}
function del(){
    $this->load->model('config_m');
    if($idp = $this->input->get('id_t')){
           if($this->config_m->excluir(array('id_tag'=>$idp),'tags')){
             $_SESSION['msg_del']= array('alert-success',$data['tag'].'Excluido com sucesso');
           }else{ $_SESSION['msg_del']= array('alert-success',$data['tag'].'Excluido com sucesso'); }
        }
     redirect('tags_c/listar');   
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