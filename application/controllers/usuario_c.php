<?php
class Usuario_c extends CI_Controller {
function __construct(){ parent::__construct(); }
public function index(){
    $this->list_usu();
    
}
function cad_usu(){
    $this->load->model('config_m');
    //$arr['action'] = base_url('usuario_c/cad_usu');
    $arr['action'] = 'index.php/usuario_c/cad_usu';
    $arr['titulo'] = 'Cadastrar Usuario';
    //$this->manutencao_m->atualizar_manutencao_where_return('web_pessoas',$data,$where);
    $arr['lista_estado'] = $this->config_m->get_lista_1('id,UF,estado','estados');
    $arr['lista_municipio'] = $this->config_m->get_lista_2('codigo,municipio','municipios_ibge',array('uf'=>'GO'));
    if($this->input->post()){
        echo "entrou no post";
        if($this->config_m->inserir('usuarios',
                array('nome'=>$this->input->post('nome'),
                    'usuario'=>$this->input->post('usuario'),
                    'senha'=>md5($this->input->post('senha')),
                    'status'=>'A',
                    'uf'=>$this->input->post('estados'),
                    'munic'=>$this->input->post('municipios'),
                    'endereco'=>'',
                    'img'=>''))){
            $arr['alert'] = array('alert-success','fa-check','Sucesso');
            echo  $arr['msg'] =  'Cadastrado com sucesso';
        }else{
          $arr['alert'] = array('alert-danger','fa-ban','Erro');  
          echo  $arr['msg'] =  'Erro no Cadastrado';
        }
        $layout_data['conteudo'] = $this->load->view('form_usuario_view.php',$arr,true);
    }else{
       $layout_data['conteudo'] = $this->load->view('form_usuario_view.php',$arr,true);
    }
   $this->load->view('conteiner_view.php', $layout_data); 
}
function edit_usu(){
    $this->load->model('config_m');
    $arr['action'] = 'index.php/usuario_c/edit_usu';
    $arr['titulo'] = 'Editar Usuario';
    $arr['lista_estado'] = $this->config_m->get_lista_1('id,UF,estado','estados');
     $arr['lista_municipio'] = $this->config_m->get_lista_2('codigo,municipio','municipios_ibge',array('uf'=>'AC'));
        if($this->input->post()){
                       $atualizar['nome'] = $this->input->post('nome');
                       $atualizar['usuario'] = $this->input->post('usuario');
                       $atualizar['uf'] = $this->input->post('estados');
                       $atualizar['munic'] = $this->input->post('municipios');
                       
                       if($this->input->post('senha') != ''){
                          if($this->input->post('senha') == $this->input->post('repeti_senha')){
                           //   $this->input->post('senha') = $this->input->post('repeti_senha');
                          }else{
                              $arr['msg'] =  'Senha Incorreta';
                              redirect('index.php/usuarios_c/edit_usu?id='.$this->input->post('hiden_id'));
                          }
                       }
                       $where = array('id'=>$this->input->post('hiden_id')); 
                    if($this->config_m->atualizar('usuarios',$atualizar,$where)){
                        $arr['alert'] = array('alert-success','fa-check','Sucesso');
                        echo  $arr['msg'] =  'Atualizado com sucesso';
                    }else{
                      $arr['alert'] = array('alert-danger','fa-ban','Erro');  
                      echo  $arr['msg'] =  'Erro na Atualização';
                    }
                    //$layout_data['conteudo'] = $this->load->view('form_usuario_view.php',$arr,true);
                    $_SESSION['s_msg'] = $arr['msg'];
                    $_SESSION['s_alert'] = $arr['alert'];
                    redirect("".base_url('index.php/usuario_c/edit_usu?id='.$this->input->post('hiden_id')));
                    
          }else{
                  $result = $this->config_m->get_lista_2('id,nome,usuario,uf,munic','usuarios',array('id'=>$this->input->get('id')));    
                  foreach ($result as $value) {
                      $arr['id'] = $value['id'];
                      $arr['nome'] = $value['nome'];
                      $arr['usuario'] = $value['usuario'];
                      $arr['i_uf'] = $value['uf'];
                      $arr['i_munic'] = $value['munic'];
                  }
                  $layout_data['conteudo'] = $this->load->view('form_usuario_view.php',$arr,true);
          }
   $this->load->view('conteiner_view.php', $layout_data); 
}
function upl(){
    $this->load->model('config_m');
    if($this->input->post()){
                $idu      = $this->input->post('id_usuario');
                
                $nome_arq = $_FILES['imagem']['name'];
                $ext = pathinfo($nome_arq, PATHINFO_EXTENSION);
                $nome_arq = md5(date('Y-m-d H:s:i')).".$ext";
                $config['image_library']    = "gd2";      
                $config['source_image']     = $_FILES['imagem']['tmp_name'];
                $config['maintain_ratio']   = TRUE;      
                $config['width'] = "220";      
                $config['height'] = "220";
                $caminho = $config['new_image'] =  "public/img/".date("d_m_y_h_m_s").".$ext";
                $caminho = date("d_m_y_h_m_s").".$ext";
                $this->load->library('image_lib',$config);
                    if(!$this->image_lib->resize()){
                      echo $this->image_lib->display_errors();
                    }else{
                        /**
                        $lista['info']=$this->usuarios_m->select_atualizar_funcionario($campanha,$idu);
                        if(count($lista['info'])>0){
                            $this->manutencao_m->atualizar_manutencao_where('web_funcionarios',
                                    array('imagem'=>$caminho),
                                    array('id_usuario'=>$idu,
                                        'id_campanha'=>$campanha));
                            if($idu == $this->session->userdata('id_usu')){
                                unlink( base_url($this->session->userdata('imagem')));
                                $this->session->set_userdata('imagem',$caminho);    
                            }
                        }else{
                           $this->manutencao_m->atualizar_manutencao_where('web_pessoas',
                                array('imagem'=>$caminho),
                                array('id_pessoa'=>$idu,
                                    'id_campanha'=>$campanha));
                           if($idu == $this->session->userdata('id_usu')){
                               if($this->session->userdata('imagem') != "public/arquivos/img_perfil/default_img.png"){
                                unlink($this->session->userdata('imagem'));
                               }
                            $this->session->set_userdata('imagem',$caminho);
                           } 
                        }
                        /**/
                        $data = array('img'=>"$caminho");
                        $where = array('id'=>$idu);
                        if( $this->config_m->atualizar('usuarios',$data,$where)){
                            echo "atualizou";
                             $_SESSION['identidade'][1] = $caminho; 
                        }else{
                            echo "não atualizou";
                        }
                        
                    } 
                        //$lista['idu'] = $idu;
                        //$layout_data['conteudo'] = $this->load->view('upload_imagem.php',$lista,true); 
               }else{
                   $lista['idu']      = $this->input->get('id');
                   //$layout_data['conteudo'] = $this->load->view('upl_form.php',$lista,true); 
                   $this->load->view('upl_form.php',$lista); 
               }
}
function list_usu(){
        $this->load->model('config_m');
        //$rs = $this->config_m->get_lista_1('id,nome,munic','usuarios');
        //$this->db->join('web_pessoas wp', "wp.id_pessoa = wr.id_solicitante");
        $rs = $this->config_m->get_lista_3('u.id,u.nome,m.municipio as munic','usuarios as u',array('u.status'=>'A'),array('municipios_ibge as m','m.codigo = u.munic'));  
            if($this->uri->segment(3)){
            $indice = $this->uri->segment(3);
            }else{
              $indice = 0;
            }    
            $arr = $this->aux_arr_pagination($rs, $indice, 'index.php/usuario_c/list_usu');
                $data['lista'] = $arr['lista'];
                $data['links'] = $arr['links'];
                $data['qtd']   = $arr['qtd']; 
                
                
        $layout_data['conteudo'] = $this->load->view('usuario_lista.php',$data,true);
       // $this->load->view('usuario_lista.php',$data);
       $this->load->view('conteiner_view.php', $layout_data);
}
function del_usu(){
    $this->load->model('config_m');
    if(is_numeric($this->input->get('id'))){
        $id = $this->input->get('id');
        if($this->config_m->excluir(array('id'=>$id),'usuarios')){
            
            $_SESSION['msg_del'] = array('alert-info','Exclução realizada com sucesso!');
        }else{
            $_SESSION['msg_del'] = array('alert-ban','Erro ao Excluir!');
        }
    }
    redirect('/usuario_c/list_usu');    
}
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
