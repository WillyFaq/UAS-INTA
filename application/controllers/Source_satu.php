<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Source_satu extends CI_Controller {


	var $json = [];


	public function __construct()
	{
		parent::__construct();
		$this->json = $this->get_data();
	}

	public function index()
	{
		$data = array(
						'page'		=> 'source_view',
						'tittle'	=> 'Source 1 : Twitter',
						'json'		=> $this->json,
						'attr'		=> $this->gen_atribute(),
						'form'		=> 'Source_satu'
						);
		$this->load->view('index', $data);
	}

	public function show_data()
	{
		$attr = [];
		foreach ($this->input->post() as $key => $value) {
			array_push($attr, $key);
		}
		array_push($attr, 'Aksi');
		$data = array(
				'page'		=> 'source_view',
				'tittle'	=> 'Source 1 : Twitter',
				'json'		=> $this->json,
				'attr'		=> $this->gen_atribute(),
				'attr_sel'	=> $attr,
				'table'		=> $this->gen_table($attr),
				'form'		=> 'Source_satu'
				);

		$this->load->view('index', $data);
		
	}

	public function gen_atribute()
	{
		$ret = "";
		$attr = ['merk', 'user', 'created_at', 'text'];
		foreach ($attr as $key => $value) {
			$ret .= '<div class="form-group">';
                $ret .= '<label for="'.$value.'" class="col-sm-4 control-label">'.$value.'</label>';
                $ret .= '<div class="col-sm-2">';
                    $ret .= '<input type="checkbox" class="form-control" id="chb_'.$value.'" name="'.$value.'" >';
                $ret .= '</div>';
            $ret .= '</div>';
		}
		return $ret;
	}

	public function gen_table($attr)
	{
		
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover dataTable">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading($attr);


		$data = [];
		foreach ($this->json as $key => $value) {
			foreach ($value as $k => $v) {
				$dd = [];
				foreach ($attr as $a => $b) {
					if($b=='Aksi'){
						$dd['Aksi'] = '<input type="checkbox" class="form-control" id="chb-'.$key.'_'.$k.'" name="data[]" value="'.$key.'_'.$k.'">';
					}else if($b=='Content'){
						$dd['Content'] = '<p class="review-txt" id="rev-'.$key.'_'.$k.'">';
                        $dd['Content'] .= $v->$b;
                        $dd['Content'] .= '</p><a href="#" class="read_more" data-view="0" data-id="'.$key.'_'.$k.'">Read More</a>';
					}else if($b=='merk'){
						$dd['merk'] = $key;
					}else{
						$dd[$b] = $v->$b;
					}
				}
				array_push($data, $dd);
				$this->table->add_row($dd);
			}
		}
		//print_r($data);
		return $this->table->generate();	
	}

	public function get_data()
	{
		$data = array(
						'xiaomi' 	=> json_decode(file_get_contents("./assets/json/tweet_xiaomi.json")),
						'asus' 		=> json_decode(file_get_contents("./assets/json/tweet_asus.json")),
						'oppo' 		=> json_decode(file_get_contents("./assets/json/tweet_oppo.json")),
						'samsung' 	=> json_decode(file_get_contents("./assets/json/tweet_samsung.json")),
						'vivo' 		=> json_decode(file_get_contents("./assets/json/tweet_vivo.json")),
						);
		$ret = [];
		foreach ($data as $k => $v) {
			for($i=0; $i<16; $i++){
				$ret[$k][$i] = $v[$i];
			}
		}
		return $ret;
	}

	public function show_hasil()
	{
		$sel_attribut = [];
		foreach ($this->input->post('attr') as $key => $value) {
			array_push($sel_attribut, $value);
		}
		$pdata = [];
		$idata = [];
		if($this->input->post('data')){
			foreach ($this->input->post('data') as $key => $value) {
				array_push($idata, $value);
				$a = explode("_", $value);
				$merk = $a[0];
				$i = $a[1];
				foreach ($sel_attribut as $c => $d) {
					if($d=='merk'){
						$pdata[$key][$d] = $merk;
					}else{
						$pdata[$key][$d] = $this->json[$merk][$i]->$d;
					}
				}
			}
		}
		$row = [];
		if($this->input->post('tokenizing')){
			$row = $this->text_preprocessing->tokenizing($pdata);
		}else if($this->input->post('case_folding')){
			$a = $this->text_preprocessing->tokenizing($pdata);
			$row = $this->text_preprocessing->case_folding($a);
		}else if($this->input->post('hapus_tanda_baca')){
			$a = $this->text_preprocessing->tokenizing($pdata);
			$b = $this->text_preprocessing->case_folding($a);
			$row = $this->text_preprocessing->hapus_tanda_baca($b);
		}else if($this->input->post('hapus_emoticon')){
			$a = $this->text_preprocessing->tokenizing($pdata);
			$b = $this->text_preprocessing->case_folding($a);
			$row = $this->text_preprocessing->hapus_tanda_baca($b);
		}else if($this->input->post('hapus_kata_tanya')){
			$a = $this->text_preprocessing->tokenizing($pdata);
			$b = $this->text_preprocessing->case_folding($a);
			$c = $this->text_preprocessing->hapus_tanda_baca($b);
			$row = $this->hapus_kata_tanya($c);
		}else if($this->input->post('stopword_removed')){
			$a = $this->text_preprocessing->tokenizing($pdata);
			$b = $this->text_preprocessing->case_folding($a);
			$c = $this->text_preprocessing->hapus_tanda_baca($b);
			$d = $this->text_preprocessing->hapus_kata_tanya($c);
			$row = $this->text_preprocessing->stopword_removed($d);
		}else if($this->input->post('stemming')){
			$a = $this->text_preprocessing->tokenizing($pdata);
			$b = $this->text_preprocessing->case_folding($a);
			$c = $this->text_preprocessing->hapus_tanda_baca($b);
			$d = $this->text_preprocessing->hapus_kata_tanya($c);
			$e = $this->text_preprocessing->stopword_removed($d);
			$row = $this->text_preprocessing->stemming($e);
		}else if($this->input->post('process')){
			$row = $this->text_preprocessing->tokenizing2($pdata);
		}
		$hasil_attr = $sel_attribut; 
		array_push($sel_attribut, 'Aksi');
		$data = array(
				'page'		=> 'source_view',
				'tittle'	=> 'Source 1 : Twitter',
				'json'		=> $this->json,
				'attr'		=> $this->gen_atribute(),
				'attr_sel'	=> $sel_attribut,
				'table'		=> $this->gen_table($sel_attribut),
				'idata'		=> $idata,
				'hasil'		=> $this->gen_table_hasil($hasil_attr, $row),
				'form'		=> 'Source_satu'
				);

		$this->load->view('index', $data);
	}

	public function gen_table_hasil($sel_attribut, $row)
	{
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading($sel_attribut);
		foreach ($row as $key => $value) {
			$in_row = [];
			foreach ($value as $k => $v) {
				//array_push($in_row, $v);
				$in_row[$k] = join(" // ", $v);
			}
			$this->table->add_row($in_row);
		}
		return $this->table->generate();
	}

}


//preg_replace('/[^\p{L}\p{N}\s]/u', '', $string)
/* End of file Source1.php */
/* Location: ./application/controllers/Source1.php */