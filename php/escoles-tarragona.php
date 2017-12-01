<?php
$buffer=file_get_contents("txt/escoles-tarragona-2017-11-03.txt");
$buffer=explode("\n",$buffer);
foreach($buffer as $key=>$val) {
	if(substr(trim($val),0,4)=="CIE:") unset($buffer[$key]);
}
//~ print_r($buffer);
//~ die();
$ok2=0;
foreach($buffer as $key=>$val) {
	if(substr(trim($val),0,2)=="43") {
		$ok=1;
	} else {
		$ok=0;
	}
	if($ok) {
		//~ echo $val."\n";
	} elseif($ok2 && trim($val)!="") {
		$ok=1;
		//~ echo $val."\n";
	} else {
		unset($buffer[$key]);
	}
	$ok2=$ok;
}
//~ print_r($buffer);
//~ die();
foreach($buffer as $key=>$val) {
	//~ echo $val."\n";
	$temp=array();
	$temp[]=substr($val,18,12);
	$temp[]=substr($val,30,25);
	$temp[]=substr($val,55,5);
	$temp[]=substr($val,60,5);
	$temp[]=substr($val,65,5);
	$temp[]=substr($val,70,5);
	$temp[]=substr($val,75,12);
	$temp[]=substr($val,87,43);
	$temp[]=substr($val,130);
	foreach($temp as $key2=>$val2) {
		$val2=trim($val2);
		$count=1;
		while($count) $val2=str_replace("  "," ",$val2,$count);
		$temp[$key2]=$val2;
	}
	$buffer[$key]=$temp;
}
//~ print_r($buffer);
//~ die();
$buffer=array_values($buffer);
foreach($buffer as $key=>$val) {
	if($val[0]=="") {
		foreach($val as $key2=>$val2) {
			if(isset($buffer[$key-1])) {
				$temp=$buffer[$key-1][$key2]." ".$val2;
				$temp=trim($temp);
				$buffer[$key-1][$key2]=$temp;
			} elseif(isset($buffer[$key-2])) {
				$temp=$buffer[$key-2][$key2]." ".$val2;
				$temp=trim($temp);
				$buffer[$key-2][$key2]=$temp;
			}
		}
		unset($buffer[$key]);
	}
}
//~ print_r($buffer);
//~ die();
foreach($buffer as $key=>$val) {
	$temp=explode(" ",$val[0]);
	$val[0]=sprintf("%02d%03d",$temp[0],$temp[1]);
	$val[2]=sprintf("%02d",$val[2]);
	$val[3]=sprintf("%03d",$val[3]);
	if($val[4]!="") $val[4]=sprintf("%02d",$val[4]);
	$buffer[$key]=$val;
}
//~ print_r($buffer);
//~ die();
$header=array("COD.MUN","MUNICIPI","DTE.","SECCIÓ","SUB.","MESA","COMPREN ELS ELECTORS","LOCALS EN QUE SE CELEBRA LA VOTACIÓ","DIRECCIÓ");
echo implode(";",$header)."\n";
foreach($buffer as $key=>$val) $buffer[$key]=str_replace(array(";",'"'),array(",","'"),$val);
foreach($buffer as $key=>$val) echo implode(";",$val)."\n";
?>