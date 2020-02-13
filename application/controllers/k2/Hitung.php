<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hitung extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Topik_model", "", TRUE);
	}

	public function index()
	{
		$data = array(
						'page'		=> 'k2/hitung_view',
						'tittle'	=> 'Perhitungan',
						'subtittle'	=> 'Klasifikasi Topik',
						/*'table'		=> $this->gen_table(),*/
						'table_data'=> $this->gen_table_data(),
						'form'		=> 'k2/hitung'
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
		$this->table->set_heading('Terms');
		
		$q = $this->Topik_model->get_all_testing();
		$res = $q->result();

		foreach ($res as $row) {
			$this->table->add_row(
									$row->terms
									);
		}
		return $this->table->generate();
	}

	public function proses()
	{
		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover datatab_form">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Terms', 'Elektronik', 'Non Elektronik', 'Hasil');


		$q = $this->Topik_model->get_all_training();
		$res = $q->result();
		$data_training = [];
		foreach ($res as $row) {
			array_push($data_training, array('text' => $row->terms, 'class' => $row->clasification));
		}


		$nb = new Biobii\NaiveBayes();
		$nb->setClass(['Elektronik', 'Non Elektronik']);
		$nb->training($data_training);

		//$ha = $nb->predict('alur ceritanya jelek dan aktingnya payah');
		$q = $this->Topik_model->get_all_testing();
		$res = $q->result();

		$data_testting = [];
		foreach ($res as $row) {
			array_push($data_testting, array('id_topik' => $row->id_topik, 'terms' => $row->terms, 'hitung' => $nb->predict($row->terms)));
		}

		/*echo '<pre>';
		//print_r($data_training);
		print_r($data_testting);
		echo '</pre>';*/

		foreach ($data_testting as $k => $v) {
			$kelas = $v['hitung']['class'];
			if($kelas=='Elektronik'){
				$kls = '<span class="label label-success">Elektronik</span>';
			}else{
				$kls = '<span class="label label-danger">Non Elektronik</span>';

			}

			if($this->Topik_model->update(array('clasification' => $kelas), $v['id_topik'])){
				$this->table->add_row(
									$v['terms'],
									$v['hitung']['testClass']['Elektronik']['result'],
									$v['hitung']['testClass']['Non Elektronik']['result'],
									$kls
									);
			}else{
				$this->table->add_row(
									array(
									        'class' => 'td-error',
									        'data' => $v['merk']
									    ),
										$v['hitung']['testClass']['Elektronik']['result'],
										$v['hitung']['testClass']['Non Elektronik']['result'],
										$kls
									);
			}
			
		}

		echo $this->table->generate();
	}

	public function test_sentimen()
	{
		$nb = new Biobii\NaiveBayes();

		$data = [
				    [
				        'text' => 'Filmnya bagus, saya suka',
				        'class' => 'positif'
				    ],
				    [
				        'text' => 'Filmnya menarik, aktingnya bagus',
				        'class' => 'positif'
				    ],
				    [
				        'text' => 'Saya suka film ini sangat keren',
				        'class' => 'positif'
				    ],
				    [
				        'text' => 'Film jelek, aktingnya payah.',
				        'class' => 'negatif'
				    ],
				    [
				        'text' => 'Kecewa, ini adalah film terburuk yang pernah saya tonton',
				        'class' => 'negatif'
				    ],
				];
		$nb->setClass(['positif', 'negatif']);

		$nb->training($data);
		//$ha = $nb->predict('xiamoi yeayy');
		$ha = $nb->predict('jam tangan item tas selempang item sepatu nike merah jaket gunung kaos merah powerbank hp sinyal jelek kalo vc ganteng walo buram');
		$ha = $nb->predict('boros aipon');
		//echo $ha['class'];
		/*$text = 'Kecewa, ini adalah film terburuk yang pernah saya tonton kecewa sekali';

		$sf = new Biobii\Stemmer();
		$stemmed = $sf->stem($text);
		print_r($sf->getWords());*/

		/*$sf = new Sastrawi\Stemmer\StemmerFactory();
		$s = $sf->createStemmer();

		$stemmed = $s->stem($text);
        $words = explode(' ', $stemmed);
        $hasil = [];
        foreach ($words as $word) {
            $hasil[] = $word;
        }

        print_r($hasil);
        $unique = array_unique($hasil);
        $hasil = array_values($unique);
        echo "<br>";
        print_r($hasil);*/
	}

}

/* End of file Hitung.php */
/* Location: ./application/controllers/k2/Hitung.php */