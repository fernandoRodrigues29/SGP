<?php
class Produtos_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    $arr['titulo'] = '';
    $arr['action'] = '';
    $layout_data['conteudo'] = $this->load->view('form_produtos_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
    
}

function cad(){
    $this->load->model('config_m');
    $arr['lista_tipo'] =  $this->config_m->get_lista_0('tipo');
    $arr['lista_mod'] =  $this->config_m->get_lista_0('modificadores');
    $arr['titulo'] = 'Cadastrar Produto';
    $arr['action'] = 'index.php/produtos_c/cad';
    $this->session->set_userdata('pagina_titulo',"<i class='fa fa-suitcase'></i> Produto > Cadastrar");
        if($this->input->post()){
            $data['nome'] = $this->input->post('produto');
            $data['descricao'] = $this->input->post('descricao');
            $data['tipo'] = $this->input->post('tipo');
            $data['valor'] = $this->input->post('valor');
                if($this->config_m->inserir('produto',$data)){
						//cadastrar Estoque
						$arr_01=$this->config_m->get_lista_1('MAX(id_produto)as idp','produto');
						if(count($arr_01)>0){
							$data0['fk_produto'] = $arr_01[0]['idp'];
							$data0['qtd'] = 0;
							$this->config_m->inserir('estoque',$data0);	
						}
					$arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  'Cadastrado com sucesso';
                }else{
                    $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                    $arr['msg'] =  'Erro no Cadastrado';
                }
        }
    $layout_data['conteudo'] = $this->load->view('form_produtos_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function edt(){
    $this->load->model('config_m');
    
    $arr['titulo'] = 'Editar Produto';
    $arr['action'] = 'index.php/produtos_c/edt';
        $arr['lista_tipo'] =  $this->config_m->get_lista_0('tipo');
        $arr['lista_mod'] =  $this->config_m->get_lista_0('modificadores');
       $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-suitcase'></i> Produto </li><li> Editar</li>");        
    if($idp = $this->input->get('id_p')){
            
           $rs =  $this->config_m->get_lista_2('nome,descricao,tipo,valor','produto',array('id_produto'=>$idp));
           
           $arr['id'] = $idp;
           $arr['produto'] = $rs[0]['nome'];
           $arr['descricao'] = $rs[0]['descricao'];
           $arr['tipo'] = $rs[0]['tipo'];
           $arr['valor'] = $rs[0]['valor'];
           //$arr['mod'] = $rs[0]['fkmodificador'];
        }else{
           $arr['id'] =$idProduto = $this->input->post('hiden_id');
           $arr['produto'] =$data['nome'] =  $this->input->post('produto');
           $arr['descricao'] =$data['descricao'] = $this->input->post('descricao');
           $arr['tipo'] =$data['tipo'] = $this->input->post('tipo');
           $arr['valor'] =$data['valor'] = $this->input->post('valor');
           //$arr['mod'] =$data['fkmodificador'] = $this->input->post('mod');
           
           if($this->config_m->atualizar('produto',$data,array('id_produto'=>$idProduto))){
                $arr['alert'] = array('alert-success','fa-check','Sucesso');
                    $arr['msg'] =  $data['nome'].' Atualizado com sucesso';
           }else{
               $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                    $arr['msg'] =  'Erro na Atualização';
           }
           
        }
    $layout_data['conteudo'] = $this->load->view('form_produtos_view.php',$arr,true);
    $this->load->view('conteiner_view.php',$layout_data);
}
function del(){
    $this->load->model('config_m');
    if($idp = $this->input->get('id_p')){
           if($this->config_m->excluir(array('id_produto'=>$idp),'produto')){
                    $_SESSION['msg_del']= array('alert-success',$data['nome'].'Excluido com sucesso');
           }else{
                    $_SESSION['msg_del']= array('alert-success',$data['nome'].'Excluido com sucesso');
           }
          
        }
     redirect('produtos_c/listar');   
    //$layout_data['conteudo'] = $this->load->view('produtos_listar.php',$arr,true);    
    //$this->load->view('conteiner_view.php',$layout_data);
}
function listar(){
      $this->load->model('config_m');
       $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-suitcase'></i> Produto </li><li> Listar</li>");
      $rs = $this->config_m->get_lista_3('p.id_produto,p.nome,t.tipo as tp','produto as p','1=1',array('tipo as t','t.id_tipo = p.tipo'));  
      if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/produtos_c/listar');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
                
                
       $layout_data['conteudo'] = $this->load->view('produtos_listar.php',$data,true);
       $this->load->view('conteiner_view.php', $layout_data);
}
function imagem_produto(){}
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
function jsonListar() {
        
    }

}
?>
