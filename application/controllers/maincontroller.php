<?php
class Maincontroller extends CI_Controller {
	function __construct()
    {
	parent::__construct();
        /**/
	//session_start();
        if($_SESSION['acesso']!=true){
           session_destroy();
            redirect('/autenticacao_c/');
        }
    }
		
	
	public function index()
	{
                $this->load->model('config_m');
                //lista produto
                $x0 = $this->config_m->get_lista_1("id_produto,nome,valor","produto");
                $arr['qtd_produto'] = count($x0);
                $arr['lista_produto'] = $x0;
                $est_campos ='['; 
                $contador=1;
                foreach ($arr['lista_produto'] as $value) {
                    $est_campos .=$value['nome'].'';
                    if($contador<$arr['qtd_produto']){
                        $est_campos .=',';
                    }
                    $contador++;
                }
               $arr['lista_campos_estq'] =  $est_campos .=']';
               //echo $arr['lista_campos_estq']."<br>";
               //lista de usuarios
                $x1 = $this->config_m->get_lista_1("id,nome,usuario,img","usuarios");
                $arr['qtd_usuario'] = count($x1);
                $arr['lista_usuario'] = $x1;
                $arr['lista_mensagem'] = count($_SESSION['lista_mensagem']);
                $arr['lista_msg'] = $this->config_m->get_lista_q('SELECT m.texto, m.tempo_hora, u.nome, u.img
                    FROM mensagem AS m
                    JOIN usuarios AS u ON u.id = m.id_remetente
                    WHERE m.id_remetente = '.$_SESSION['uid'].'
                    ORDER BY m.id_mensagem DESC
                    LIMIT 3');
                
                 $arr['lista'] = $this->config_m->get_lista_1("id_produto,produto,descricao,qtd","view_estoque");
                 $arr_estoque = $this->config_m->get_lista_1("qtd","estoque");
                 $qt = 0;
                 foreach ($arr_estoque as $value) {
                     $qt +=$value['qtd'];
                 }
                 $arr['estoque'] = $qt;
                //estoque
                 $query = "SELECT p.nome, e.qtd FROM estoque AS e JOIN produto AS p ON p.id_produto = e.fk_produto";
                    $l_arr_estoque = $this->config_m->get_lista_q($query);
                       $arl= array();
                    $ct_estoque =  count($l_arr_estoque);   
                       /*[{"name":"p1","y":"252"},{"name":"vassoura","y":"31"},{"name":"controle2","y":"4780"},{"name":"lava lou\u00e7a","y":"0"},{"name":"lava lou\u00e7a","y":"0"},{"name":"lava lou\u00e7a2","y":"0"}]*/
                       $cl = "[";
                       $contador=1;
                          foreach ($l_arr_estoque as $le) {
                                $cl .="{name:'".$le['nome']."',y:".$le['qtd']."}"; 
                                if($contador<$ct_estoque){
                                    $cl .=",";
                                }
                                $contador++;
                          }
                       $arr['lista_est_char']= $cl .= "]";  
                //$arr['lista2'] = $this->config_m->get_lista_1("marca,qtd","view_marcadores");
                 $arr['lista3'] = $this->config_m->get_lista_1("tipo,qtd","view_tipo");
       $this->load->view('main_view',$arr);
                //$this->load->view('conteiner_view');
	}
        public function desenvolvimento()
	{
                $this->load->model('config_m');
                    $arr['lista'] = $this->config_m->get_lista_1("codigo_uf,uf,estado","estados");
                    $layout_data['conteudo'] = $this->load->view('listar_testes.php',$arr,true);
                    $this->load->view('conteiner_view.php',$layout_data);
                //$this->load->view('conteiner_view');
	}
        public function controle(){
            $arr = array();
            $arr2 = array();
            $arr_c = array();
            $arr['nome']="fernando";
            $arr['idade']="29";
            $arr2['nome']="fernanda";
            $arr2['idade']="31";
            $arr_c['alpha'] =$arr; 
            $arr_c['bravo'] =$arr2; 
            $arr_c['charlie'] ="qtd"; 
            print json_encode($arr_c);
            //print '[{"value": "1","descricao": "1"},{"value": "2","descricao": "2"},{"value": "3","descricao": "3"}]';
        }
        public function controle2(){
            $this->load->model('config_m');
            $limit = $this->input->post('lmt');
                    $poffset = $this->input->post('offst');
                      $offset =  $poffset*$limit-$limit;   
                        if($this->input->post('psq')!=''){
                            $where = "uf like '%".$this->input->post('psq')."%'";
                            $rs_total=$this->config_m->get_lista_2("id,codigo_uf,uf,estado","estados",$where);
                            $arr['qtd'] = count($rs_total);
                        }else{
                            $where = "id > 0";
                        }
                        $rs=$this->config_m->get_lista_t("id,codigo_uf,uf,estado","estados",$where,$limit,$offset);
                        $arr['lista'] = $rs;
                        
                        print json_encode($arr);
        }
        public function desenvolvimento_json()
	{       $this->load->model('config_m');
                if($this->input->post()){
                    $limit = $this->input->post('lmt');
                    $poffset = $this->input->post('offst');
                      $offset =  $poffset*$limit-$limit;   
                        if($this->input->post('psq')!=''){ $where = "uf like '%".$this->input->post('psq')."%'";
                          $rs_total=$this->config_m->get_lista_2("id,codigo_uf,uf,estado","estados",$where);
                          $arr['qtd'] = count($rs_total);
                        }else{ $where = "id > 0"; }
                        
                        $rs = $this->config_m->get_lista_5("id,codigo_uf,uf,estado","estados",$where,$limit,$offset);
                        $arr['lista']=$rs;
                      
                        print json_encode($arr);
                }else{
                    $rs_total=$this->config_m->get_lista_2("id,codigo_uf,uf,estado","estados","codigo_uf > 0");
                    $rs = $this->config_m->get_lista_5("id,codigo_uf,uf,estado","estados","codigo_uf > 0",5,0);
                    $arr['lista'] = $rs;
                    $arr['qtd'] = count($rs_total);
                    //$arr['lista'] = $this->config_m->get_lista_t("id,codigo_uf,uf,estado","estados");
                    print json_encode($arr);
                    
                } 
                    
       }
}
?>