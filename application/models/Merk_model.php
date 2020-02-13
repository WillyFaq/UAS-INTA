<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk_model extends CI_Model {

	public function __construct() 
	{ 
		parent::__construct(); 
	} 

	var $table = 'tblmerk';
	var $pk = 'id_merk';

	public function get_all()
	{
		return $this->db->get($this->table);
	}

	public function get_data($id)
	{
		$this->db->where(array($this->pk => $id));
		return $this->db->get($this->table);
	}

	public function get_where($id)
	{
		$this->db->where($id);
		return $this->db->get($this->table);
	}

	public function get_id($merk)
	{
		$this->db->where("nama_merk", $merk);
		$q =  $this->db->get($this->table);
		$res = $q->result();
		foreach ($res as $row) {
			return $row->id_merk;
		}
	}

	public function add($da)
	{
		return $this->db->insert($this->table, $da);
	}

	public function update($data, $_id)
	{
		$this->db->set($data);
		$this->db->where($this->pk, $_id);
		return $this->db->update($this->table);
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, array($this->pk => $id));
	}

} 