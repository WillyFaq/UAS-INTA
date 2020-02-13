<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Topik_model", "", TRUE);
	}

	public function index()
	{
		$data = array(
						'page'		=> 'k2/training_view',
						'tittle'	=> 'Training Data',
						'subtittle'	=> 'Klasifikasi Topik',
						/*'table'		=> $this->gen_table(),*/
						'table_data'=> $this->gen_table_data(),
						'form'		=> 'k2/training'
						);
		$this->load->view('index', $data);
	}

	public function gen_table_data()
	{
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover datatab_form">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Terms', '');
		
		$q = $this->Topik_model->get_all_nontrain();
		$res = $q->result();

		foreach ($res as $row) {
			$this->table->add_row(
									$row->terms,
									$row->id_topik
									);
		}
		return $this->table->generate();
	}

	public function pilih()
	{
		$pilih = $this->input->post('pilih');

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Terms', 'klasifikasi');

		foreach ($pilih as $key => $v) {
			$q = $this->Topik_model->get_data($v);
			$res = $q->result();
			foreach ($res as $row) {
				$inp = '<input type="hidden" name="id_topik[]" value="'.$row->id_topik.'" >';
				//$inp .= '<input type="text" name="klasifikasi[]" >';
				$inp .= form_dropdown("klasifikasi[]", array("Elektronik" => "Elektronik", "Non Elektronik" => "Non Elektronik"));
				$this->table->add_row(
									$row->terms,
									$inp
									);
			}
		}

		echo $this->table->generate();
	}

	public function proses()
	{
		$cek_insert = [];
		$ids = $this->input->post('id_topik');
		foreach ($ids as $k => $v) {
			$kelas = $this->input->post('klasifikasi');
			///cho "$v => $kelas[$k] <br>";
			if(!$this->Topik_model->update(array('clasification' => $kelas[$k], 'ket' => 1), $v)){
				array_push($cek_insert, 0);
			}else{
				array_push($cek_insert, 1);
			}
		}

		if(in_array(1, $cek_insert)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
		}

		redirect('k2/training');
	}

}

/* End of file Training.php */
/* Location: ./application/controllers/k2/Training.php */