<?php
class Configuracao_c extends CI_Controller {
    function __construct(){ parent::__construct();$this->load->model('config_m'); }
        public function index(){
            
        }
        function combo_estados(){
            $where['uf'] = $this->input->post('estado');
            //$where['uf']="RJ";
            $arr = $this->config_m->get_lista_2("codigo, municipio, uf",'municipios_ibge',$where);
            foreach ($arr as $value) {
                  echo "<option value=".$value['codigo'].">".$value['municipio']."</option>";
            }
        }
}
?>
