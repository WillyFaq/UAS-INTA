<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Topik_model extends CI_Model {

	public function __construct() 
	{ 
		parent::__construct(); 
	} 

	var $table = 'tbltopik';
	var $pk = 'id_topik';


	public function get_all()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		return $this->db->get();
	}

	public function get_all_nontrain()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where("ISNULL(clasification) OR clasification = ''");
		return $this->db->get();
	}

	public function get_all_testing()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where("ket", 0);
		return $this->db->get();
	}

	public function get_all_training()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where("ket", 1);
		return $this->db->get();
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

	public function delete_all()
	{
		return $this->db->query("DELETE FROM $this->table");
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, array($this->pk => $id));
	}
} 