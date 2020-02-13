<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Text_preprocessing
{
	
	function tes_hoo()
	{
		return "HOHOHOHO";
	}

	function tokenizing($data)
	{

		$ret = [];
		foreach ($data as $key => $value) {
			foreach ($value as $a => $b) {
				$ret[$key][$a] = preg_split('/[\s]+/', $b); 
				/*$token = strtok($b, " ");
				$i = 0;
				while ($token !== false){
					//$ret[$key][$a] = $token; 
				   	//echo "$token<br>";
					$ret[$key][$a][$i] = $token; 
				   	$i++;
				   	$token = strtok(" ");
			   	}*/
			}	
		}

		return $ret;
	}

	function case_folding($data)
	{	
		$ret = [];
		foreach ($data as $key => $value) {
			foreach ($value as $a => $b) {
				if(!is_array($b)){
					$ret[$key][$a] = strtolower($b); 
				}else{
					foreach ($b as $c => $d) {
						$ret[$key][$a][$c] = strtolower($d);	
					}
				}
			}	
		}	
		return $ret;	
	}

	function cleansing($data)
	{
		$regex = "((https?|ftp)\:\/\/)?"; // SCHEME 
		$regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
		$regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
		$regex .= "(\:[0-9]{2,5})?"; // Port 
		$regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
		$regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
		$regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 

		$ret = [];
		foreach ($data as $key => $value) {
			foreach ($value as $a => $b) {
				
					foreach ($b as $c => $d) {
						if (strpos($d, '@') !== false) {
						    //$ret[$key][$a] = $b;
						}else{
							if(preg_match("/^$regex$/", $d)){
							}else{
								$ret[$key][$a][$c] = $d;	
							}
						}
						///$ret[$key][$a][$c] = preg_replace('/[^\p{L}\p{N}\s]/u', '', $d);	
					}
			}	
		}
		foreach ($ret as $key => $v) {
			foreach ($v as $a => $b) {
				$tmp_ret = array_values($b);
				$ret[$key][$a] = $tmp_ret;
			}
		}
		return $ret;	
	}



	function hapus_tanda_baca($data)
	{
		$ret = [];
		foreach ($data as $key => $value) {
			foreach ($value as $a => $b) {
				if(!is_array($b)){
					$ret[$key][$a] =preg_replace('/[^\p{L}\p{N}\s]/u', '', $b);
				}else{
					foreach ($b as $c => $d) {
						$ret[$key][$a][$c] =preg_replace('/[^\p{L}\p{N}\s]/u', '', $d);	
					}
				}
			}	
		}

		foreach ($ret as $key => $value) {
			foreach ($value as $a => $b) {
				foreach ($b as $c => $d) {
					if(!is_array($b)){
						if($b == ''){
							unset($ret[$key][$a]);// = '[spasi]';	
						}
					}else{
						foreach ($b as $c => $d) {
							if($d == ''){
								unset($ret[$key][$a][$c]); //= '[spasi]';	
							}	
						}
					}
				}
			}
		}

		foreach ($ret as $key => $v) {
			foreach ($v as $a => $b) {
				$tmp_ret = array_values($b);
				$ret[$key][$a] = $tmp_ret;
			}
		}
		return $ret;	
	}

	function ubah_kata_slag($data)
	{
		$slag = json_decode(file_get_contents("./assets/kamus_allay.json"));	
		$ret = [];
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
		return $ret;
	}

	function stopword_removed($data)
	{
		$stopword_arr = json_decode(file_get_contents("./assets/json/stopwords_id.json"));	
		$ret = $data;
		foreach ($data as $a => $b) {
			foreach ($b as $c => $d) {
				foreach ($d as $e => $f) {
					if(in_array($f, $stopword_arr)){
						unset($ret[$a][$c][$e]);
					}
				}
			}
		}
		return $ret;
	}

	function stopword_removed_sas($data)
	{
		$stopWordRemoverFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
		$ret = $data;
		$stopword = $stopWordRemoverFactory->createStopWordRemover();
		foreach ($data as $a => $b) {
			foreach ($b as $c => $d) {
				foreach ($d as $e => $f) {
					if($stopword->remove($f)==''){
						unset($ret[$a][$c][$e]);
					}
				}
			}
		}
		return $ret;
	}

	function stemming($data)
	{
		$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
		$ret = $data;
		$stemmer = $stemmerFactory->createStemmer();
		foreach ($data as $a => $b) {
			foreach ($b as $c => $d) {
				foreach ($d as $e => $f) {
					$ret[$a][$c][$e] = $stemmer->stem($f);
				}
			}
		}
		return $ret;
	}
	

}

/* End of file Text_preprocessing.php */
/* Location: ./application/libraries/Text_preprocessing.php */
