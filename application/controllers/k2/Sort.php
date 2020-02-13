<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sort extends CI_Controller {

	public $ret = [];

	public function index()
	{						
		$data = array(
						'page'		=> 'k2/sort_view',
						'tittle'	=> 'Sorting Data',
						'subtittle'	=> 'Klasifikasi Topik',
						'table'		=> $this->gen_table(),
						'table_data'=> $this->gen_table_data(),
						'form'		=> 'k2/Sort'
						);
		$this->load->view('index', $data);
	}

	public function gen_table()
	{
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'File', 'Jumlah Data');

		$json_file = scandir('./assets/data2');
		unset($json_file[0], $json_file[1]);

		$tmp_merk = '';
		$jumlah = 0;
		$this->ret = array();
		$i = 0;
		foreach ($json_file as $k => $v) {
			$tmp_merk = explode("_", explode('.', $v)[0]);
			$key = "";//$tmp_merk[1]."_".$tmp_merk[2];
			$dt = json_decode(file_get_contents("./assets/data2/".$v));
			//$this->ret[$key] = $dt;
			$this->ret = array_merge($this->ret, $dt);
			$jumlah += sizeof($dt);
			$no = $k-1;
			$fn = '<a target="blank" href="'.base_url('assets/data2/'.$v).'">'.$v.'</a>';
			$this->table->add_row($no, $fn, sizeof($dt));
		}
		$cell_data = [array(
					        'data' => 'Jumlah',
					        'colspan' => 2,
					        'class' => 'tfoot'
					    ), array(
					        'data' => $jumlah,
					        'class' => 'tfoot',
					    )];
		$this->table->add_row($cell_data);
		return $this->table->generate();
	}

	public function gen_table_data()
	{
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover datatab_form">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$inx = json_decode(file_get_contents("./assets/index2.json"));
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('User', 'Date', 'Tweet', 'Aksi');
		
		foreach ($this->ret as $k => $v) {
			$chk = '';
			if(in_array($k, $inx)){
				$chk = 'checked';
			}
			$cb = "<input class='form-control' type='checkbox' $chk value='$k' name='pilih[]'>";
			
			$this->table->add_row(
									$v->user,
									$v->created_at,
									$v->text,
									$cb
									);
		}

		return $this->table->generate();
	}

	public function proses()
	{
		$pilih = $this->input->post('pilih');
		//print_r($this->ret);
		$this->gen_table();
		//print_r($this->ret);
		//echo $this->ret[1];
		$hasil = [];
		foreach ($pilih as $k => $v) {
			array_push($hasil, $this->ret[$v]);
		}
		//print_r($hasil);
		$fp = fopen('./assets/results2.json', 'w');
		fwrite($fp, json_encode($hasil));
		fclose($fp);

		$fp = fopen('./assets/index2.json', 'w');
		fwrite($fp, json_encode($pilih));
		fclose($fp);


		$this->session->set_flashdata('msg_title', 'Sukses!');
		$this->session->set_flashdata('msg_status', 'alert-success');
		$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
		echo 'success';
		
	}

}



/*


if($this->Kriteria_model->delete($v)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil dihapus! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
*/







/* End of file Sort.php */
/* Location: ./application/controllers/k2/Sort.php */