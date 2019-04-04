<?php
class Auditoria_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    $arr['titulo'] = 'Cadastrar Auditoria';
    $arr['action'] = 'index.php/auditoria_c/cad';
    $layout_data['conteudo'] = $this->load->view('from_auditoria_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function cad(){
 $this->load->model('config_m');
 $arr['titulo'] = 'Cadastrar Auditoria';
    $arr['action'] = 'index.php/auditoria_c/cad';
    $this->session->set_userdata('pagina_titulo',"<i class='fa fa-suitcase'></i> Auditoria > Cadastrar");
	$arr['l_munic'] = $this->config_m->get_lista_1('codigo,municipio','municipios_ibge');
        $arr['l_uf'] = $this->config_m->get_lista_1('codigo_uf,uf','estados');
        if($this->input->post()){
            $data['acao'] = $this->input->post('acao');
	    $data['data_cad'] = date('Y-m-d',$this->input->post('data_cad'));
            $data['id_atuante'] = $this->input->post('id_atuante');
            $data['id_passivo'] = $this->input->post('id_passivo');
            
            if($this->config_m->inserir('cliente',$data)){
		    $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  'Cadastrado com sucesso';
            }else{ $arr['alert'] = array('alert-danger','fa-ban','Erro'); $arr['msg'] =  'Erro no Cadastrado'; }
        }
	$layout_data['conteudo'] = $this->load->view('from_cliente_view.php',$arr,true);
        $this->load->view('conteiner_view.php',$layout_data);	
}
function edit(){
$this->load->model('config_m');
$this->load->model('venda_m');
    $arr['titulo'] = 'Editar Venda';
    $arr['action'] = 'index.php/venda_c/edit';
    $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Venda </li><li> Editar</li>");        
        $arr['l_munic'] = $this->config_m->get_lista_1('codigo,municipio','municipios_ibge');
        $arr['l_uf'] = $this->config_m->get_lista_1('codigo_uf,uf','estados');
    if($idc = $this->input->get('id_c')){
           //$select,$tabela,$where,$join1,$join2
          $rs = $this->config_m->get_lista_2('id_venda,fk_cliente,fk_pod,data_venda','venda',array('id_venda'=>$idv));
           $arr['id'] = $idc;
           $data['contato'] = $this->input->post('contato');
	    $data['email'] = $this->input->post('email');
            $data['uf'] = $this->input->post('uf');
            $data['munic'] = $this->input->post('munic');
            $data['end'] = $this->input->post('end');
            $data['nome'] = $this->input->post('nome');
            
     }elseif($this->input->post()){
           $arr['id'] =$idCliente = $this->input->post('hiden_id');
            $arr['i_cli'] =$data['fk_cliente'] =  $this->input->post('cliente');
            $arr['i_pod'] =$data['fk_pod'] =  $this->input->post('pod');
           
                    $data['data_venda'] = date('Y-m-d',strtotime($this->input->post('validade')));
                        $arr['validade'] = $this->input->post('validade');
           if($this->config_m->atualizar('venda',$data,array('id_venda'=>$idVenda))){
                $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  ' Atualizado com sucesso';
           }else{
               $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                    $arr['marac'] =  'Erro na Atualização';
           }
      }
    $layout_data['conteudo'] = $this->load->view('from_venda_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function listar(){
      $this->load->model('config_m');
      $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Auditoria </li><li> Listar</li>");
      $rs =  $this->config_m->get_lista_2(
       'id_auditoria,acao,data_cad,id_atuante,id_alvo', 'auditoria', array('id_auditoria >'=>'0'));
      
      if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/auditoria_c/listar');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
       $layout_data['conteudo'] = $this->load->view('listar_auditoria.php',$data,true);
       $this->load->view('conteiner_view.php', $layout_data);
}
function del(){
    $this->load->model('config_m');
    if($idv = $this->input->get('id_v')){
           if($this->config_m->excluir(array('id_venda'=>$idv),'venda')){
             $_SESSION['msg_del']= array('alert-success','Excluido com sucesso');
           }else{ $_SESSION['msg_del']= array('alert-success','Excluido com sucesso'); }
        }
     redirect('venda_c/listar');   
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