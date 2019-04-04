<?php
class Modificador_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    $arr['titulo'] = 'Cadastrar Modificador';
    $arr['action'] = 'index.php/modificador_c/cad';
    $layout_data['conteudo'] = $this->load->view('from_modificador_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function cad(){
 $this->load->model('config_m');
 $arr['titulo'] = 'Cadastrar Modificador';
    $arr['action'] = 'index.php/modificador_c/cad';
    $this->session->set_userdata('pagina_titulo',"<i class='fa fa-suitcase'></i> Estoque > Cadastrar");
	if($this->input->post()){
            $data['porcentagem'] = $this->input->post('percent');
			$data['marca'] = $this->input->post('marca');
			$data['validade'] =  date('Y-m-d H:i:s',strtotime($this->input->post('validade')));
			if($this->config_m->inserir('modificadores',$data)){
			        $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  'Cadastrado com sucesso';
            }else{ $arr['alert'] = array('alert-danger','fa-ban','Erro'); $arr['msg'] =  'Erro no Cadastrado'; }
        }
	//													
	$layout_data['conteudo'] = $this->load->view('from_modificador_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);	
}
function edit(){
$this->load->model('config_m');
    $arr['titulo'] = 'Editar Modificador';
    $arr['action'] = 'index.php/modificador_c/edit';
       $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Modificador </li><li> Editar</li>");        
    if($idm = $this->input->get('id_m')){
	 //$rs = $this->config_m->get_lista_3('e.id_estoque,p.nome,e.fk_produto,e.qtd','estoque as e',array('id_estoque'=>$ide),array('produto p','p.id_produto = e.fk_produto'));
	$rs =  $this->config_m->get_lista_2('marca,porcentagem,validade','modificadores',array('id_modificador'=>$idm));
           $arr['id'] = $idm;
           $arr['marca'] = $rs[0]['marca'];
	   $arr['percent'] = $rs[0]['porcentagem'];
           $arr['validade'] = date('d/m/Y',strtotime($rs[0]['validade']));
     }elseif($this->input->post()){
           $arr['id'] =$idTipo = $this->input->post('hiden_id');
           $arr['marca'] =$data['marca'] =  $this->input->post('marca');
           $arr['percent'] =$data['porcentagem'] =  $this->input->post('percent');
           
           $data['validade'] = date('Y-m-d',strtotime($this->input->post('validade')));
           $arr['validade'] = $this->input->post('validade');
           if($this->config_m->atualizar('modificadores',$data,array('id_modificador'=>$idTipo))){
                $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  $data['marca'].' Atualizado com sucesso';
           }else{
               $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                    $arr['marac'] =  'Erro na Atualização';
           }
      }
    $layout_data['conteudo'] = $this->load->view('from_modificador_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function listar(){
      $this->load->model('config_m');
	$this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Modificador </li><li> Listar</li>");
	$rs = $this->config_m->get_lista_1('id_modificador,marca,validade','modificadores');  
      if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/modificador_c/listar');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
       $layout_data['conteudo'] = $this->load->view('modificador_listar.php',$data,true);
       $this->load->view('conteiner_view.php', $layout_data);
}
function del(){
    $this->load->model('config_m');
    if($idm = $this->input->get('id_m')){
           if($this->config_m->excluir(array('id_modificador'=>$idm),'modificadores')){
             $_SESSION['msg_del']= array('alert-success','Excluido com sucesso');
           }else{ $_SESSION['msg_del']= array('alert-success','Excluido com sucesso'); }
        }
     redirect('modificador_c/listar');   
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