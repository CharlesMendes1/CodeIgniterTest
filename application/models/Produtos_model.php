<?php
class Produtos_model extends CI_Model {


	public function buscaTodos() {
	    return $this->db->get('produtos')->result_array();
	}
	public function adiciona($produto){
		return $this->db->insert('produtos',$produto);
	}
}