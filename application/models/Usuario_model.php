<?php
class Usuario_model extends CI_Model{
	public function salva($usuario){
		return $this->db->insert("usuarios", $usuario);
	}
	public function procuraUsuario($email,$senha){

		$this->db->where("email", $email);
        $this->db->where("senha", $senha);
        						  //tabela
        $usuario = $this->db->get("usuarios")->row_array();
        return $usuario;
	}
}