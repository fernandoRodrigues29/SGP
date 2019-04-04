<?php
class Cliente_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    $arr['titulo'] = 'Cadastrar Cliente';
    $arr['action'] = 'index.php/cliente_c/cad';
    $layout_data['conteudo'] = $this->load->view('from_cliente_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function cad(){
 $this->load->model('config_m');
 $arr['titulo'] = 'Cadastrar Cliente';
    $arr['action'] = 'index.php/cliente_c/cad';
    $this->session->set_userdata('pagina_titulo',"<i class='fa fa-suitcase'></i> Cliente > Cadastrar");
	$arr['l_munic'] = $this->config_m->get_lista_2('codigo,municipio','municipios_ibge',array('UF' =>'AC'));
        $arr['l_uf'] = $this->config_m->get_lista_1('codigo_uf,uf','estados');
        if($this->input->post()){
            $data['contato'] = $this->input->post('contato');
	    $data['email'] = $this->input->post('email');
            $data['uf'] = $this->input->post('estados');
            $data['munic'] = $this->input->post('municipios');
            $data['end'] = $this->input->post('end');
            $data['nome'] = $this->input->post('nome');
	    
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
   $arr['titulo'] = 'Editar Cliete';
    $arr['action'] = 'index.php/cliente_c/edit';
    $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> cliente </li><li> Editar</li>");        
        $arr['l_munic'] = $this->config_m->get_lista_1('codigo,municipio','municipios_ibge');
        $arr['l_uf'] = $this->config_m->get_lista_1('codigo_uf,uf','estados');
    if($idc = $this->input->get('id_c')){
           //$select,$tabela,$where,$join1,$join2
            $rs = $this->config_m->get_lista_2('id_cliente,nome,contato,email,uf,munic,end','cliente',array('id_cliente'=>$idc));
            $arr['id'] = $idc;
            $arr['contato'] = $rs[0]['contato'];
	    $arr['email'] =  $rs[0]['email'];
            $arr['i_uf'] = $rs[0]['uf'];
            $arr['i_munic'] = $rs[0]['munic'];
            $arr['end'] = $rs[0]['end'];
            $arr['nome'] = $rs[0]['nome'];
            
            
     }elseif($this->input->post()){
           $arr['id'] =$idCliente = $this->input->post('hiden_id');
           
           $arr['nome'] = $data['nome'] =  $this->input->post('nome'); 
           $arr['contato'] = $data['contato'] =  $this->input->post('contato');
	    $arr['email'] =   $data['email'] =  $this->input->post('email');
            $arr['i_uf'] =  $data['uf'] =  $this->input->post('estados');
            $arr['i_munic'] =  $data['munic'] =  $this->input->post('municipios');
            $arr['end'] = $data['end'] =  $this->input->post('end');
           
            if($this->config_m->atualizar('cliente',$data,array('id_cliente'=>$idCliente))){
                $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  ' Atualizado com sucesso';
           }else{
               $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                    $arr['marac'] =  'Erro na Atualização';
           }
      }
    $layout_data['conteudo'] = $this->load->view('from_cliente_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function listar(){
      $this->load->model('config_m');
      $this->load->model('venda_m');
      $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-gears'></i> Venda </li><li> Listar</li>");
	$rs =  $this->config_m->get_lista_2('id_cliente,nome','cliente',array('id_cliente >'=>'0'));
      
       if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/cliente_c/listar');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
       $layout_data['conteudo'] = $this->load->view('listar_cliente.php',$data,true);
       $this->load->view('conteiner_view.php', $layout_data);
}
function del(){
    $this->load->model('config_m');
    if($idc = $this->input->get('id_c')){
           if($this->config_m->excluir(array('id_cliente'=>$idc),'cliente')){
             $_SESSION['msg_del']= array('alert-success','Excluido com sucesso');
           }else{ $_SESSION['msg_del']= array('alert-success','Excluido com sucesso'); }
        }
     redirect('cliente_c/listar');   
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