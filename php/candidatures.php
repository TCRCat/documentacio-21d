<?php
$buffer=file_get_contents("txt/candidatures.txt");
$buffer=explode("\n",$buffer);
foreach($buffer as $key=>$val) {
	if(strpos($val,"Verificable en http://www.boe.es")!==false) {
		unset($buffer[$key]);
	} elseif(strpos($val,"cve: BOE-A-2017-13305")!==false) {
		unset($buffer[$key]);
	} else {
		$val=str_replace(chr(0x0c),"",$val);
		$buffer[$key]=$val;
	}
}
//~ print_r($buffer);
//~ die();
$ok=0;
foreach($buffer as $key=>$val) {
	if(strpos($val,"JUNTA ELECTORAL PROVINCIAL DE")!==false) {
		$ok=1;
	} elseif(strpos($val,"Candidatura núm.")!==false) {
		$ok=2;
	} elseif(strpos($val,"Siglas:")!==false) {
		$ok=1;
	}
	if($ok && trim($val)!="") {
		$ok--;
		//~ echo $val."\n";
	} else {
		unset($buffer[$key]);
	}
}
//~ print_r($buffer);
//~ die();
$provincia="";
$temp=array();
$candidaturas=array();
foreach($buffer as $key=>$val) {
	if(strpos($val,"JUNTA ELECTORAL PROVINCIAL DE")!==false) {
		$provincia=trim(str_replace("JUNTA ELECTORAL PROVINCIAL DE","",$val));
	} elseif(strpos($val,"Candidatura núm.")!==false) {
		if(count($temp)) $candidaturas[]=$temp;
		$temp=array();
		$temp[]=$provincia;
		$temp[]=trim(str_replace("Candidatura núm.","",$val));
	} elseif(strpos($val,"Siglas:")!==false) {
		$temp[]=trim(str_replace("Siglas:","",$val));
	} else {
		$temp[]=trim($val);
	}
}
if(count($temp)) $candidaturas[]=$temp;
$buffer=$candidaturas;
unset($candidaturas);
//~ print_r($buffer);
//~ die();
$siglas=array();
foreach($buffer as $key=>$val) {
	if(isset($val[3])) $siglas[$val[2]]=$val[3];
}
//~ print_r($siglas);
//~ die();
foreach($buffer as $key=>$val) {
	if(!isset($val[3])) {
		foreach($siglas as $key2=>$val2) {
			if(substr($val[2],0,10)==substr($key2,0,10)) {
				$buffer[$key][3]=$val2;
			}
		}
	}
}
//~ print_r($buffer);
//~ die();
$header=array("PROVINCIA","NUM.CAND.","PARTIDO","SIGLAS");
echo implode(";",$header)."\n";
foreach($buffer as $key=>$val) $buffer[$key]=str_replace(array(";",'"'),array(",","'"),$val);
foreach($buffer as $key=>$val) echo implode(";",$val)."\n";
?>