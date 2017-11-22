<?php
$buffer=file_get_contents("txt/escoles-lleida.txt");
$buffer=explode("\n",$buffer);
$ok2=0;
$pagebreak=0;
foreach($buffer as $key=>$val) {
	if(stripos($val,"de la letra")!==false) {
		$ok=1;
	} else {
		$ok=0;
	}
	if(strpos($val,chr(0x0c))!==false) {
		$pagebreak=3;
	} elseif($pagebreak==3 && trim($val)!="") {
		$pagebreak--;
	} elseif($pagebreak==2 && trim($val)!="") {
		$pagebreak--;
	}
	if($ok) {
		//~ echo $val."\n";
		$pagebreak=0;
	} elseif($ok2 && trim($val)!="") {
		$ok=1;
		//~ echo $val."\n";
		$pagebreak=0;
	} elseif($pagebreak==1 && trim($val)!="") {
		$ok=1;
		$pagebreak=0;
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
	$temp[]=substr($val,30,50);
	$temp[]=substr($val,80,20);
	$temp[]=substr($val,100,20);
	$temp[]=substr($val,120,30);
	$temp[]=substr($val,150,50);
	$temp[]=substr($val,200);
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
	if($val[0]=="" && $val[1]=="" && $val[2]=="" && $val[3]=="" && $val[4]=="") {
		if(isset($buffer[$key-1])) $buffer[$key-1][]=$val[5];
		elseif(isset($buffer[$key-2])) $buffer[$key-2][6].=" ".$val[5];
		unset($buffer[$key]);
	}
}
//~ print_r($buffer);
//~ die();
$buffer=array_values($buffer);
foreach($buffer as $key=>$val) {
	if($val[0]=="") $val[0]=$buffer[$key-1][0];
	if($val[1]=="") $val[1]=$buffer[$key-1][1];
	if($val[2]=="") $val[2]=$buffer[$key-1][2];
	$buffer[$key]=$val;
}
//~ print_r($buffer);
//~ die();
foreach($buffer as $key=>$val) {
	$temp=array(
		"",
		$val[0],
		$val[1],
		$val[2],
		(strlen($val[3])==3)?substr($val[3],0,2):"",
		(strlen($val[3])==3)?substr($val[3],2,1):$val[3],
		str_replace(array("De la letra "," a la "),array(""," "),$val[4]),
		$val[5],
		$val[6],
	);
	$buffer[$key]=$temp;
}
//~ print_r($buffer);
//~ die();
$header=array("COD.MUN","MUNICIPI","DTE.","SECCIÓ","SUB.","MESA","COMPREN ELS ELECTORS","LOCALS EN QUE SE CELEBRA LA VOTACIÓ","DIRECCIÓ");
echo implode("|",$header)."\n";
foreach($buffer as $key=>$val) echo implode("|",$val)."\n";
?>