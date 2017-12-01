<?php
$buffer=file_get_contents("txt/escoles-girona-2017-11-03.txt");
$buffer=explode("\n",$buffer);
$ok2=0;
foreach($buffer as $key=>$val) {
	if(substr(trim($val),0,2)=="17") {
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
	$temp[]=substr($val,20,15);
	$temp[]=substr($val,35,35);
	$temp[]=substr($val,70,7);
	$temp[]=substr($val,77,11);
	$temp[]=substr($val,88,8);
	$temp[]=substr($val,96,7);
	$temp[]=substr($val,103,28);
	$temp[]=substr($val,131,63);
	$temp[]=substr($val,192);
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
			$temp=$buffer[$key-1][$key2]." ".$val2;
			$temp=trim($temp);
			$buffer[$key-1][$key2]=$temp;
		}
		unset($buffer[$key]);
	} else {
		$val[6]=str_replace(array("De la letra "," a la "),array(""," "),$val[6]);
		$buffer[$key]=$val;
	}
}
//~ print_r($buffer);
//~ die();
$header=array("COD.MUN","MUNICIPI","DTE.","SECCIÓ","SUB.","MESA","COMPREN ELS ELECTORS","LOCALS EN QUE SE CELEBRA LA VOTACIÓ","DIRECCIÓ");
echo implode(";",$header)."\n";
foreach($buffer as $key=>$val) $buffer[$key]=str_replace(array(";",'"'),array(",","'"),$val);
foreach($buffer as $key=>$val) echo implode(";",$val)."\n";
?>