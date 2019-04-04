<?php
class Graficos_c extends CI_Controller {
    function __construct(){ parent::__construct(); }
    public function index(){  $this->grafico();}
    function grafico(){
        $this->load->model('config_m');
        $this->session->set_userdata('pagina_titulo',"<li><i class='fa fa-area-chart'></i> Graficos </li><li> Listar</li>");
        $arr['lista'] = $this->config_m->get_lista_1("id_produto,produto,descricao,qtd","view_estoque");
        $arr['lista2'] = $this->config_m->get_lista_1("marca,qtd","view_marcadores");
        $arr['lista3'] = $this->config_m->get_lista_1("tipo,qtd","view_tipo");
        
        $layout_data['conteudo'] = $this->load->view('graficos.php',$arr,true);   
        $this->load->view('conteiner_view.php', $layout_data);
        //$this->load->view('conteiner_graficos.php', $layout_data);
        //$this->load->view('graficos.php', $layout_data);
    }
    
}
?>
