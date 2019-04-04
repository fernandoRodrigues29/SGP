<?php
class config_m extends CI_Model{
        function __construct() { 
          parent::__construct();
          //$this->db = $this->load->database($_SESSION['banco_dados_ag'],true);
        }
            //selecionar
            function get_lista_q($query){
                $rs =$this->db->query($query);
                return $rs->result_array();
            }
        
            function get_lista_0($tabela){
                $this->db->from($tabela);
                $query = $this->db->get();
                return $query->result_array();
            }
            
            function get_lista_1($select,$tabela){
                $this->db->from($tabela);
                    $this->db->select($select);
                    $query = $this->db->get();
                return $query->result_array();
            }
            
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
            //
            function get_lista_4($select,$tabela,$where,$limit){
                $this->db->from($tabela);
                    $this->db->select($select);
                    $this->db->where($where);
                    if(count($limit) >1){
                        $this->db->limit($limit[0],$limit[1]);
                    }else{
                        $this->db->limit($limit);
                    }
                    $query = $this->db->get();
                    //echo $this->db->last_query();
                return $query->result_array();
            }
            function get_lista_5($select,$tabela,$where,$limit,$offset){
                $this->db->from($tabela);
                    $this->db->select($select);
                    $this->db->where($where);
                    $this->db->limit($limit, $offset);
                    $query = $this->db->get();
                    //return $this->db->last_query();
                return $query->result_array();
            }
            function get_lista_t($select,$tabela,$where,$limit,$offset){
                $this->db->from($tabela);
                    $this->db->select($select);
                    $this->db->where($where);
                    $this->db->limit($limit, $offset);
                    $query = $this->db->get();
                    //return $this->db->last_query();
                    return $query->result_array();
            }
            //inserir
            function inserir($tabela,$data){
                if($this->db->insert($tabela, $data)){
                    //echo $this->db->last_query();
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
            //retornar ultimo id
            function ultimo_id($chave,$tabela){
                $this->db->select_max($chave);
                $result= $this->db->get($tabela)->row_array();
                return $result[$chave];
            }
        }
?>
