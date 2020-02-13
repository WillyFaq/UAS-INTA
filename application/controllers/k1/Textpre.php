<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Textpre extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Sentimen_model", "", TRUE);
		$this->load->model("Merk_model", "", TRUE);
	}

	public function index()
	{						
		$data = array(
						'page'		=> 'k1/textpre_view',
						'tittle'	=> 'Text Preprocessing',
						'subtittle'	=> 'Analisis sentimen produk smartphone',
						/*'table'		=> $this->gen_table(),*/
						'table_data'=> $this->gen_table_data(),
						'form'		=> 'k1/Sort'
						);
		$this->load->view('index', $data);
	}

	public function gen_table_data()
	{
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover datatab_form">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$inx = json_decode(file_get_contents("./assets/results.json"));
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Tweet', '');
		
		foreach ($inx as $k => $v) {
			foreach ($v as $a => $b) {
				$chk = '';
				
				//$cb = "<input class='form-control cbpilih' type='checkbox' $chk value='$k-$a' name='pilih[]'>";
				$cb = "$k-$a";
				$this->table->add_row(
										$b->text,
										$cb
										);
			}
		}
		return $this->table->generate();
	}

	public function proses()
	{
		$pilih = $this->input->post('pilih');
		$inx = json_decode(file_get_contents("./assets/results.json"), true);
		$pdata = [];
		foreach ($pilih as $k => $v) {
			$a = explode("-", $v);
			$d['text'] = $inx[$a[0]][$a[1]]['text'];
			array_push($pdata, $d);
		}
		$a = $this->text_preprocessing->tokenizing($pdata);
		$b = $this->text_preprocessing->case_folding($a);
		$c = $this->text_preprocessing->cleansing($b);
		$d = $this->text_preprocessing->hapus_tanda_baca($c);
		$e = $this->text_preprocessing->ubah_kata_slag($d);
		$f = $this->text_preprocessing->stopword_removed($e);
		$g = $this->text_preprocessing->stopword_removed_sas($f);
		$h = $this->text_preprocessing->stemming($g);

		$cek_insert = [];
		$this->Sentimen_model->delete_all();
		foreach ($h as $k => $v) {
			$desk = $pilih[$k];
			$merk = $this->Merk_model->get_id(explode("-", $desk)[0]);
			$terms = join(" ", $v['text']);
			echo "$k => ".$merk." | ".$desk." => ".$terms;
			echo "<br><br>";
			
			if(!$this->Sentimen_model->add(array('id_merk' => $merk, 'terms' => $terms, 'desc' => $desk))){
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

	public function test()
	{
		$data = '[{"text":["samsung","a20s","kenapa","karena","dari","lama","udh","cinta","mati","sm","produk","ini","wkwk","ga","bisa","ganti","ke","lain","hati","btw","kameranya","juga","bagus","bener2","kayak","kita","liat","scr","nyata","batrenya","awet","harganya","juga","murmer","rekomen","kl","kamu","nyari","hp","under","3jt","malah","25an"]}]';
		$data = json_decode($data,true);
		$slag = json_decode(file_get_contents("./assets/kamus_allay.json"));	
		$ret = [];

		//print_r($data[0]['text']);
		foreach ($data as $a => $b) {
			foreach ($b as $c => $d) {
				foreach ($d as $e => $f) {
					foreach ($slag as $x => $y) {
						if($y->slag == $f){
							$ret[$a][$c][$e] = $y->baku;
							break;	
						}else{
							$ret[$a][$c][$e] = $f;	
						}
					}
				}
			}
		}

		foreach ($ret as $a => $b) {
			foreach ($b as $c => $d) {
				foreach ($d as $e => $f) {
					if (strpos($f, '-') !== false) {
						$slc_arr = explode("-", $f);
						$ret[$a][$c][$e] = $slc_arr[0];
						array_splice($ret[$a][$c], $e, 0, $slc_arr[1] ); 
					}else if(strpos($f, ' ') !== false){
						$slc_arr = explode(" ", $f);
						$ni = $e + 1;
						$ret[$a][$c][$ni] = $slc_arr[0];
						$ni += 1;
						array_splice($ret[$a][$c], $ni, 0, $slc_arr[1] ); 
					}
				}
			}
		}
		echo '<div style="display:flex; flex-direction: row;">';
		echo '<div style="width:190px">';
		echo '<pre style="width:90px">';
		print_r($data);
		echo '</pre>';
		echo '</div>';

		echo '<div style="width:290px">';
		echo '<pre style="width:90px">';
		print_r($ret);
		echo '</pre>';
		echo '</div>';
		echo '</div>';


		/*foreach ($slag as $key => $value) {
			echo $value->slag.'<br>';
		}*/
		/*foreach ($data as $a => $b) {
			foreach ($b as $c => $d) {
				foreach ($d as $e => $f) {

					foreach ($slag as $x => $y) {
						if($y['slag'] == $f){
							$ret[$a][$c][$e] = $y['baku'];
						}
					}
					
				}
			}
		}*/
	}
}

/* End of file Textpre.php */
/* Location: ./application/controllers/k1/Textpre.php */