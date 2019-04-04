<?php
class Validacao_m extends CI_Model{
        function __construct() { 
          parent::__construct();
        }
            function validacao($data){
                $this->db->from('usuarios');
                $this->db->where($data);
                    if($query = $this->db->get()){
                        //echo $this->db->last_query();
                        $this->db->close();
                        return $query->result_array();
                       
                    }else{
                        //echo $this->db->last_query();
                        $this->db->close();
                        return false;
                    }
                
                
            }
  }
?>
