<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediated_schema extends CI_Controller {

	var $json = [];
	var $attr = ['merk', 'user', 'date', 'text'];
	var $attr1 = ['merk', 'user', 'created_at', 'text'];
	var $attr2 = ['merk', 'Author', 'DatePost', 'Content'];

	public function __construct()
	{
		parent::__construct();

		$this->json = $this->get_data();
	}

	public function index()
	{
		$data = array(
						'page'		=> 'mediated_view',
						'tittle'	=> 'Mediated Schema',
						'json'		=> $this->json,
						'attr'		=> $this->gen_atribute(),
						'form'		=> 'Mediated_schema'
						);
		$this->load->view('index', $data);
	}

	public function gen_atribute()
	{
		$ret = "";
		$da = [];
		foreach ($this->attr1 as $key => $value) {
			$ret .= '<div class="form-group">';
                $ret .= '<label for="'.$value.'" class="col-sm-4 control-label">'.$value.'</label>';
                $ret .= '<div class="col-sm-2">';
                    $ret .= '<input type="checkbox" class="form-control chb_source chb_'.$key.'" data-toggle="0" data-id="chb_'.$key.'" id="chb_'.$value.'" name="'.$key.'" >';
                $ret .= '</div>';
            $ret .= '</div>';
		}
		//array_push($da, $ret);
		$da['twiiter'] = $ret;
		$ret = "";
		foreach ($this->attr2 as $key => $value) {
			$ret .= '<div class="form-group">';
                $ret .= '<label for="'.$value.'" class="col-sm-4 control-label">'.$value.'</label>';
                $ret .= '<div class="col-sm-2">';
                    $ret .= '<input type="checkbox" class="form-control chb_source chb_'.$key.'" data-toggle="0" data-id="chb_'.$key.'" id="chb_'.$value.'" name="'.$key.'" >';
                $ret .= '</div>';
            $ret .= '</div>';
		}
		//array_push($da, $ret);
		$da['selular'] = $ret;
		return $da;
	}

	public function show_data()
	{
		$attr = [];
		foreach ($this->input->post() as $key => $value) {
			array_push($attr, $key);
		}
		
		/*echo '<pre>';
		print_r($data);
		echo '</pre>';
		*///array_push($attr, 'Aksi');
		/*$data = array(
						'page'		=> 'mediated_view',
						'tittle'	=> 'Mediated Schema',
						'json'		=> $this->json,
						'attr'		=> $this->gen_atribute(),
						'form'		=> 'Mediated_schema'
						);*/
		$data = array(
						'page'		=> 'mediated_view',
						'tittle'	=> 'Mediated Schema',
						'json'		=> $this->json,
						'attr'		=> $this->gen_atribute(),
						'attr_sel'	=> $attr,
						'table'		=> $this->gen_table($attr),
						'form'		=> 'mediated_schema'
				);

		$this->load->view('index', $data);
		
	}

	public function gen_table($attr)
	{
		
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover dataTable">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);
		$head = [];
		array_push($head, 'Source');
		foreach ($attr as $key => $value) {
			array_push($head, $this->attr[$value]);
		}

		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading($head);


		/*$data = [];
		foreach ($this->json as $key => $value) {
			foreach ($value as $k => $v) {
				$dd = [];
				foreach ($attr as $a => $b) {
					if($b=='Tags'){
						$tag = $v->$b;
						unset($tag[0]);
						$dd['Tags'] = join(",", $tag);
					}else if($b=='Aksi'){
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
		}*/
		$i=1;
		$data = [];
		foreach ($this->json as $a => $b) { // get soruce
			$tmp_dat = [];
			$tmp_dat['source'] = $a;
			foreach ($b as $c => $d) { // get merk
				foreach ($d as $e => $f) { // get data
					foreach ($attr as $k => $v) { // get atribute
						$at = $this->{'attr'.$i}[$v];
						if($at == "merk"){
							$tmp_dat['merk'] = $c;
						}else if($at == 'Content'){
							//$tmp_dat[$this->attr[$v]] = "";
							$tmp_dat[$this->attr[$v]] = '<p class="review-txt" id="rev-'.$c.'_'.$e.'">';
	                        $tmp_dat[$this->attr[$v]] .= $f->$at;
	                        $tmp_dat[$this->attr[$v]] .= '</p><a href="#" class="read_more" data-view="0" data-id="'.$c.'_'.$e.'">Read More</a>';
					
						}else{
							$tmp_dat[$this->attr[$v]] = $f->$at;
						}
					}
					array_push($data, $tmp_dat);
					$this->table->add_row($tmp_dat);
				}
			}
			$i++;
		}
		return $this->table->generate();	
	}

	public function get_data()
	{
		$seluar = array(
						'xiaomi' 	=> json_decode(file_get_contents("./assets/json/selular.id-xiaomi.json")),
						'asus' 		=> json_decode(file_get_contents("./assets/json/selular.id-asus.json")),
						'oppo' 		=> json_decode(file_get_contents("./assets/json/selular.id-oppo.json")),
						'samsung' 	=> json_decode(file_get_contents("./assets/json/selular.id-samsung.json")),
						'vivo' 		=> json_decode(file_get_contents("./assets/json/selular.id-vivo.json")),
						);
		$twitter = array(
						'xiaomi' 	=> json_decode(file_get_contents("./assets/json/tweet_xiaomi.json")),
						'asus' 		=> json_decode(file_get_contents("./assets/json/tweet_asus.json")),
						'oppo' 		=> json_decode(file_get_contents("./assets/json/tweet_oppo.json")),
						'samsung' 	=> json_decode(file_get_contents("./assets/json/tweet_samsung.json")),
						'vivo' 		=> json_decode(file_get_contents("./assets/json/tweet_vivo.json")),
						);
		$data = array(
						'twitter'	=> $twitter,
						'seluar.id'	=> $seluar,
					);
		return $data;
	}
}

/* End of file Mediated_schema.php */
/* Location: ./application/controllers/Mediated_schema.php */