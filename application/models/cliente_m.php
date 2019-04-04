<?php
class cliente_m extends CI_Model{
        function __construct() { 
          parent::__construct();
          //$this->db = $this->load->database($_SESSION['banco_dados_ag'],true);
        }
         function get_listaJoin($select,$tabela,$where,$join1,$join2){
         $ax01 = $join1[0];
         $ax02 = $join1[1];
         
         $ax11 = $join2[0];
         $ax12 = $join2[1];
          //echo "$ax1 | $ax2";
        $this->db->from($tabela);
                    $this->db->select($select);
                    $this->db->join($ax01,$ax02,'left');
                    $this->db->join($ax11,$ax12,'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    //echo $this->db->last_query();
                return $query->result_array();
            }
 }
?>
