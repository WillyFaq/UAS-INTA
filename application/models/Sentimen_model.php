<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sentimen_model extends CI_Model {

	public function __construct() 
	{ 
		parent::__construct(); 
	} 

	var $table = 'tblsentimen';
	var $pk = 'id_sentimen';

	var $join = 'tblmerk';
	var $fk = 'id_merk';

	public function get_all()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join, $this->table.'.'.$this->fk.' = '.$this->join.'.'.$this->fk);
		return $this->db->get();
	}

	public function get_all_nontrain()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join, $this->table.'.'.$this->fk.' = '.$this->join.'.'.$this->fk);
		$this->db->where("ISNULL(tblsentimen.clasification) OR tblsentimen.clasification = ''");
		return $this->db->get();
	}

	public function get_all_testing()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join, $this->table.'.'.$this->fk.' = '.$this->join.'.'.$this->fk);
		$this->db->where("ket", 0);
		return $this->db->get();
	}

	public function get_all_training()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join, $this->table.'.'.$this->fk.' = '.$this->join.'.'.$this->fk);
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