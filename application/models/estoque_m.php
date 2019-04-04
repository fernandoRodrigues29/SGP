<?php
class config_m extends CI_Model{
        function __construct() { 
          parent::__construct();
        }
            //selecionar
            function get_lista_2($select,$tabela,$where){
                $this->db->from($tabela);
                    $this->db->select($select);
                    $this->db->where($where);
                    $query = $this->db->get();
                    //echo $this->db->last_query();
                return $query->result_array();
            }
            function get_lista_3($select,$tabela,$where,$join){
                $ax1 = $join[0];
                $ax2 = $join[1];
               //echo "$ax1 | $ax2";
                $this->db->from($tabela);
                    $this->db->select($select);
                    $this->db->join($ax1,$ax2,'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    //echo $this->db->last_query();
                return $query->result_array();
            }
            //inserir
            function inserir($tabela,$data){
                if($this->db->insert($tabela, $data)){
                    return true;
                }else{
                    return false;
                }
            }
            //editar
            function atualizar($tabela,$data,$where){
                $this->db->where($where);
                if($this->db->update($tabela, $data)){
                    return true;
                }else{
                    return false;
                }
            }
            //excluir
            function excluir($where,$data){
                $this->db->where($where);
                if($this->db->delete($data)){
                    echo $this->db->last_query();
                    return true;
                }else{
                    return false;
                     echo $this->db->last_query();
                }
            }
        }
?>
