<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Sentimen_model", "", TRUE);
		$this->load->model("Merk_model", "", TRUE);
		$this->load->model("Topik_model", "", TRUE);
	}

	public function index()
	{
		$data = array(
						'page'				=> 'dashboard_view',
						'sentimen_chart'	=> $this->get_sentimen(),
						'topik_chart'		=> $this->get_topik(),
						);
		$this->load->view('index', $data);
	}

	public function get_sentimen()
	{
		$q = $this->Sentimen_model->get_all();
		$res = $q->result();
		$data = [];
		foreach ($res as $row) {
			if(!isset($data[$row->nama_merk][$row->clasification])){
				$data[$row->nama_merk][$row->clasification] = 1;
			}else{
				$data[$row->nama_merk][$row->clasification] += 1;
			}
		}
		return $data;
	}

	public function get_topik()
	{
		$q = $this->Topik_model->get_all();
		$res = $q->result();
		$data = [];
		foreach ($res as $row) {
			if(!isset($data[$row->clasification])){
				$data[$row->clasification] = 1;
			}else{
				$data[$row->clasification] += 1;
			}
		}
		//print_r($data);
		return $data;
	}


}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */