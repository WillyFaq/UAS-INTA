<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Textpre extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Topik_model", "", TRUE);
	}

	public function index()
	{						
		$data = array(
						'page'		=> 'k2/textpre_view',
						'tittle'	=> 'Text Preprocessing',
						'subtittle'	=> 'Klasifikasi Topik',
						/*'table'		=> $this->gen_table(),*/
						'table_data'=> $this->gen_table_data(),
						'form'		=> 'k2/Sort'
						);
		$this->load->view('index', $data);
	}

	public function gen_table_data()
	{
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover datatab_form">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$inx = json_decode(file_get_contents("./assets/results2.json"));
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Tweet', '');
		
		foreach ($inx as $k => $v) {
			$cb = "$k";
				$this->table->add_row(
										$v->text,
										$cb
										);
			
		}
		return $this->table->generate();
	}

	public function proses()
	{
		$pilih = $this->input->post('pilih');
		$inx = json_decode(file_get_contents("./assets/results2.json"), true);
		$pdata = [];
		foreach ($pilih as $k => $v) {
			$a = explode("-", $v);
			$da['text'] = $inx[$k]['text'];
			array_push($pdata, $da);
		}
		$a = $this->text_preprocessing->tokenizing($pdata);
		$b = $this->text_preprocessing->case_folding($a);
		$c = $this->text_preprocessing->cleansing($b);
		$d = $this->text_preprocessing->hapus_tanda_baca($c);
		$e = $this->text_preprocessing->ubah_kata_slag($d);
		$f = $this->text_preprocessing->stopword_removed($e);
		$g = $this->text_preprocessing->stopword_removed_sas($f);
		$h = $this->text_preprocessing->stemming($g);

		//print_r($h);
		$cek_insert = [];
		$this->Topik_model->delete_all();
		foreach ($h as $k => $v) {
			$desk = $pilih[$k];
			$terms = join(" ", $v['text']);
			/*echo "$k => ".$desk." => ".$terms;
			echo "<br><br>";
			*/
			if(!$this->Topik_model->add(array('terms' => $terms, 'desc' => $desk))){
				array_push($cek_insert, 0);
			}else{
				array_push($cek_insert, 1);
			}
		}

		if(in_array(1, $cek_insert)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			echo 'success';
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			echo 'fail';
		}


	}

}

/* End of file Textpre.php */
/* Location: ./application/controllers/k2/Textpre.php */