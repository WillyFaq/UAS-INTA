<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akurasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Topik_model", "", TRUE);
	}

	public function index()
	{
		$data = array(
						'page'		=> 'k2/akurasi_view',
						'tittle'	=> 'Akurasi',
						'subtittle'	=> 'Klasifikasi Topik',
						/*'table'		=> $this->gen_table(),*/
						'table_data'=> $this->gen_table_data(),
						'form'		=> 'k2/akurasi'
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
		$this->table->set_heading('Terms', 'Kelas');
		
		$q = $this->Topik_model->get_all_training();
		$res = $q->result();

		foreach ($res as $row) {
			if($row->clasification=='Elektronik'){
				$kls = '<span class="label label-success">Elektronik</span>';
			}else{
				$kls = '<span class="label label-danger">Non Elektronik</span>';

			}
			$this->table->add_row(
									$row->terms,
									$kls
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
		$this->table->set_heading('Terms', 'Kelas Prediksi', 'Kelas Hasil', 'Hasil');


		$q = $this->Topik_model->get_all_training();
		//$q = $this->Topik_model->get_all();
		$res = $q->result();
		$data_training = [];
		foreach ($res as $row) {
			array_push($data_training, array('text' => $row->terms, 'class' => $row->clasification));
		}


		$nb = new Biobii\NaiveBayes();
		$nb->setClass(['Elektronik', 'Non Elektronik']);
		$nb->training($data_training);

		//$ha = $nb->predict('alur ceritanya jelek dan aktingnya payah');
		$q = $this->Topik_model->get_all_training();
		$res = $q->result();

		$data_testting = [];
		foreach ($res as $row) {
			array_push($data_testting, array('id_topik' => $row->id_topik, 'terms' => $row->terms, 'kelas' => $row->clasification,  'hitung' => $nb->predict($row->terms)));
		}

		$tp = 0;
		$fp = 0;
		$tn = 0;
		$fn = 0;
		foreach ($data_testting as $k => $v) {
			$kelas = $v['hitung']['class'];
			if($kelas=='Elektronik'){
				$klsh = '<span class="label label-success">Elektronik</span>';
			}else{
				$klsh = '<span class="label label-danger">Non Elektronik</span>';
			}

			if($v['kelas']=='Elektronik'){
				$klsp = '<span class="label label-success">Elektronik</span>';
				if($kelas == $v['kelas']){
					$tp++;
					$klsa = '<span class="label label-primary">True Elektronik</span>';
				}else{
					$fp++;
					$klsa = '<span class="label label-info">False Elektronik</span>';
				}
			}else{
				$klsp = '<span class="label label-danger">Non Elektronik</span>';
				if($kelas == $v['kelas']){
					$tn++;
					$klsa = '<span class="label label-danger">True Non Elektronik</span>';
				}else{
					$fn++;
					$klsa = '<span class="label label-warning">False Non Elektronik</span>';
				}
			}

			$this->table->add_row(
									$v['terms'],
									$klsp,
									$klsh,
									$klsa
									);
			
		}

		echo $this->table->generate();
		echo '<hr>';
		$tab1 = '<table class="table">
                    <thead>
                    	<tr>
                            <th></th>
                            <th></th>
                            <th collspan="2">kelas prediksi</th>
                    	</tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Elektronik</th>
                            <th>Non Elektronik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="2">Kelas Hasil</td>
                            <th>Elektronik</th>
                            <td>'.$tp.'</td>
                            <td>'.$fp.'</td>
                        </tr>
                        <tr>
                            <th>Non Elektronik</th>
                            <td>'.$fn.'</td>
                            <td>'.$tn.'</td>
                        </tr>
                    </tbody>   
                </table>';
        $precision = ($tp/($tp+$fp))*100;
        $recall = ($tp/($tp+$fn))*100;
        $acurasi = ( ($tp+$tn) / ($tp+$fp+$tn+$fn) )*100;
        $tab1 .= '<hr>
                <table class="table">
                    <tbody>
                        <tr>
                            <th width="10%">Precision</th>
                            <td width="1%">:</td>
                            <td>'.number_format($precision, 2).'%</td>
                        </tr>
                        <tr>
                            <th>Recall</th>
                            <td>:</td>
                            <td>'.number_format($recall, 2).'%</td>
                        </tr>
                        <tr>
                            <th>Accuracy</th>
                            <td>:</td>
                            <td>'.number_format($acurasi, 2).'%</td>
                        </tr>
                    </tbody>
                </table>';
        echo $tab1;

	}

}

/* End of file Akurasi.php */
/* Location: ./application/controllers/k2/Akurasi.php */