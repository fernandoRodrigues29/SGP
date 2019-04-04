<?php
class mensagem_m extends CI_Model{
   function __construct() { 
      parent::__construct();
     //$this->db = $this->load->database($_SESSION['banco_dados_ag'],true);
   }
   function listar_msn($idms){
                $query = $this->db->query('
                SELECT m.id_mensagem, u.nome AS nome, m.texto AS texto, m.id_remetente AS id, m.id_mensagem, u.img, m.tempo_hora AS tempo, id_remetente AS idr, id_destinatario AS idd
                FROM mensagem m
                JOIN usuarios u ON m.id_remetente = u.id
                WHERE m.id_mensagem ='.$idms.'
                OR m.id_m_pai ='.$idms.'
                ORDER BY m.id_mensagem');
               // echo $this->db->last_query();
                return $query->result_array();
   }
   function retornar_destinatario($idm,$id_remetente){
                $query = $this->db->query('
                SELECT id_destinatario as idd
                FROM mensagem m
                JOIN usuarios u ON m.id_remetente = u.id
                AND m.id_mensagem ='.$idm.'
                AND m.id_remetente ='.$id_remetente.'     
                UNION 
                SELECT id_destinatario as idd 
                FROM mensagem m
                JOIN usuarios u ON m.id_remetente = u.id
                AND m.id_m_pai ='.$idm.'
                AND m.id_remetente ='.$id_remetente.'
                ');
                echo $this->db->last_query();
                return $query->result_array();
   }
   function listar_msn_u($idusu){
               $query = $this->db->query('
                SELECT u.nome AS nome, m.texto AS texto, u.img, m.tempo_hora as tempo
                FROM mensagem m
                JOIN usuarios u ON m.id_remetente = u.id
                AND  id_destinatario = '.$idusu);
                //echo $this->db->last_query();
                return $query->result_array();
   }
    function listar_msn_gerenciar($idu){
                $query = $this->db->query('
                SELECT u.nome AS nome, m.texto AS texto, m.id_remetente AS id,m.id_mensagem, u.img, m.tempo_hora as tempo 
                FROM mensagem m
                JOIN usuarios u ON m.id_remetente = u.id
                AND m.id_remetente ='.$idu.'
                UNION 
                SELECT u.nome AS nome, m.texto AS texto, m.id_remetente AS id,m.id_mensagem, u.img, m.tempo_hora as tempo 
                FROM mensagem m
                JOIN usuarios u ON m.id_destinario = u.id
                AND m.id_destinatrio ='.$idu.'');
               // echo $this->db->last_query();
                return $query->result_array();
   }
   function listar_mensagens_geral($id){
       $query = $this->db->query('SELECT u.nome AS nome, m.texto AS texto, m.id_remetente AS id,m.id_mensagem, u.img, m.tempo_hora as tempo,id_remetente as idr,id_destinatario as idd
                                   FROM  mensagem m
                                   JOIN usuarios u ON m.id_remetente = u.id
                                    WHERE m.id_remetente = '.$id.'
                                    AND m.id_m_pai =0
                                    UNION 
                                    SELECT u.nome AS nome, m.texto AS texto, m.id_remetente AS id,m.id_mensagem, u.img, m.tempo_hora as tempo,id_remetente as idr,id_destinatario as idd 
                                    FROM  mensagem m
                                    JOIN usuarios u ON m.id_remetente = u.id
                                        WHERE m.id_mensagem in (select m2.id_mensagem from mensagem m2 where m2.id_destinatario = '.$id.')
                                    and m.id_m_pai = 0');
       return $query->result_array(); 
   }
     function inserir_mensagem($id_m,$id_r,$id_d){
                $query = $this->db->query('
                SELECT u.nome AS nome, m.texto AS texto, m.id_remetente AS id,m.id_mensagem, u.img, m.tempo_hora as tempo 
                FROM mensagem m
                JOIN usuarios u ON m.id_remetente = u.id
                AND m.id_mensagem ='.$idms.'
                UNION 
                SELECT u.nome AS nome, m.texto AS texto, m.id_remetente AS id,m.id_mensagem, u.img, m.tempo_hora as tempo 
                FROM mensagem m
                JOIN usuarios u ON m.id_remetente = u.id
                AND m.id_m_pai ='.$idms.'');
               // echo $this->db->last_query();
                return $query->result_array();
   }
}
?>
