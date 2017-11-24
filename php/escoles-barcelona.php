<?php
$buffer=file_get_contents("txt/escoles-barcelona.txt");
$buffer=explode("\n",$buffer);
foreach($buffer as $key=>$val) {
	$val=str_replace(chr(0x0c),"",$val);
	$buffer[$key]=$val;
}
//~ print_r($buffer);
//~ die();
foreach($buffer as $key=>$val) {
	if(substr(trim($val),0,2)=="08") {
		$ok=1;
	} else {
		$ok=0;
	}
	if($ok) {
		//~ echo $val."\n";
	} else {
		unset($buffer[$key]);
	}
}
//~ print_r($buffer);
//~ die();
foreach($buffer as $key=>$val) {
	//~ echo $val."\n";
	$temp=array();
	$temp[]=substr($val,0,22);
	$temp[]=substr($val,22,32);
	$temp[]=substr($val,54,6);
	$temp[]=substr($val,60,5);
	$temp[]=substr($val,65,5);
	$temp[]=substr($val,70,6);
	$temp[]=substr($val,76,12);
	$temp[]=substr($val,100,52);
	$temp[]=substr($val,152);
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
foreach($buffer as $key=>$val) {
	$temp=explode(" ",$val[0]);
	$val[0]=sprintf("%02d%03d",$temp[0],$temp[1]);
	$buffer[$key]=$val;
}
//~ print_r($buffer);
//~ die();
$header=array("COD.MUN","MUNICIPI","DTE.","SECCIÓ","SUB.","MESA","COMPREN ELS ELECTORS","LOCALS EN QUE SE CELEBRA LA VOTACIÓ","DIRECCIÓ");
echo implode(";",$header)."\n";
foreach($buffer as $key=>$val) $buffer[$key]=str_replace(array(";",'"'),array(",","'"),$val);
foreach($buffer as $key=>$val) echo implode(";",$val)."\n";
?>