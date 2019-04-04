<?php
class Demanda_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    $arr['titulo'] = 'Cadastrar Demanda';
    $arr['action'] = 'index.php/demanda_c/cad';
    $layout_data['conteudo'] = $this->load->view('from_demanda_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function cad(){
 $this->load->model('config_m');
 $arr['titulo'] = 'Cadastrar Demanda';
    $arr['action'] = 'index.php/demanda_c/cad';
    $this->session->set_userdata('pagina_titulo',"<i class='fa fa-suitcase'></i> Demanda > Cadastrar");
	$arr['l_func'] = $this->config_m->get_lista_1('id,nome','usuarios');
        if($this->input->post()){
            $data['demanda'] = $this->input->post('demanda');
	    $data['data_inicio'] = date('Y-m-d',  strtotime($this->input->post('di')));
            $data['data_comclusao'] = date('Y-m-d',strtotime($this->input->post('dc')));
            $data['status'] = true;
            $data['fk_funcionario'] = $this->input->post('func');
            
            if($this->config_m->inserir('demandas',$data)){
		    $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  'Cadastrado com sucesso';
            }else{ $arr['alert'] = array('alert-danger','fa-ban','Erro'); $arr['msg'] =  'Erro no Cadastrado'; }
        }
	$layout_data['conteudo'] = $this->load->view('form_demanda_view.php',$arr,true);
        $this->load->view('conteiner_view.php',$layout_data);	
}
function edit(){
$this->load->model('config_m');
    $arr['titulo'] = 'Editar Demanda';
    $arr['action'] = 'index.php/demanda_c/edit';
    $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Demanda </li><li> Editar</li>");        
    $arr['l_func'] = $this->config_m->get_lista_1('id,nome','usuarios');
    if($idd = $this->input->get('id_d')){
           //$select,$tabela,$where,$join1,$join2
            $rs = $this->config_m->get_lista_2('id_demanda,demanda,data_inicio,data_comclusao,fk_funcionario','demandas',array('id_demanda'=>$idd));
            $arr['id'] = $idd;
            $arr['demanda'] = $rs[0]['demanda'];
	    $arr['di'] =  $rs[0]['data_inicio'];
            $arr['dc'] = $rs[0]['data_comclusao'];
            $arr['i_func'] = $rs[0]['fk_funcionario'];
     }elseif($this->input->post()){
           $arr['id'] =$idDemanda = $this->input->post('hiden_id');
             $arr['demanda'] = $data['demanda'] = $this->input->post('demanda');
	     $arr['di'] = $data['data_inicio'] = date('Y-m-d',  strtotime($this->input->post('di')));
             $arr['dc'] = $data['data_comclusao'] = date('Y-m-d',strtotime($this->input->post('dc')));
             $arr['i_func'] =  $data['fk_funcionario'] = $this->input->post('func');
           if($this->config_m->atualizar('demandas',$data,array('id_demanda'=>$idDemanda))){
                $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  ' Atualizado com sucesso';
           }else{
               $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                    $arr['marac'] =  'Erro na Atualização';
           }
      }
    $layout_data['conteudo'] = $this->load->view('form_demanda_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function listar(){
      $this->load->model('config_m');
      $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Demanda </li><li> Listar</li>");
	$rs =  $this->config_m->get_lista_2('id_demanda,demanda','demandas',array('status'=>'1'));
      if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/demanda_c/listar');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
       $layout_data['conteudo'] = $this->load->view('listar_demanda.php',$data,true);
       $this->load->view('conteiner_view.php', $layout_data);
}
function del(){
    $this->load->model('config_m');
    if($idd = $this->input->get('id_d')){
           if($this->config_m->excluir(array('id_demanda'=>$idd),'demandas')){
             $_SESSION['msg_del']= array('alert-success','Excluido com sucesso');
           }else{ $_SESSION['msg_del']= array('alert-success','Excluido com sucesso'); }
        }
     redirect('demanda_c/listar');   
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