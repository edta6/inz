<?php

// Główna funkcja tworząca id dla dwóch tabel USERS arg2=1000
// oraz tabeli PUPILS arg2=0;
// arg1 może przyjąć pierwszy raz zero, jeżeli nie ma żadnego Id
// lub przyjąć największe ostatnie id z której kolwiek tabeli, i je
// odpowiednio zmodyfikować
function GenId($arg1,$arg2) {

	if($arg1==0 || (floor($arg1/10000)+$arg2)!=date(Y)) {
		
		$id=GenFirstId($arg2);
		
	}
	else {
		
		$id=GenNextId($arg1);
		
	}
		
	return $id;
		
}

function GenFirstId($arg1) {
	
	$number = (date(Y)-$arg1) * 1000 + 1; 
	
	$id=GenInsideId($number);
	
	return $id;
	
}

function GenNextId($arg1) {
	
	$number=floor($arg1/10)+1;
	
	$id=GenInsideId($number);
	
	return $id;
	
}

// Funkcja tworząca z powrotem id. 
// Ostatni argument to do jakiej tabeli to id jest.
//--------------------------------------------------------
function GenReturnId($year, $lp, $arg1) {
	
	$number=($year-$arg1) * 1000 + $lp;
	
	$id=GenInsideId($number);
	
	return $id;

}

//--------------------------------------------------------
function GenInsideId($arg1) {

	$strnum = (string) $arg1;
	
	$weight = array(1,3,1,3,1,3,1); 
	
	$temp = 0;
	
	for($i=0;$i<7;$i++)
	{
		$temp = $temp + ($strnum[$i] * $weight[$i]);
	}
	
	$temp %= 10;
	$temp = 10 - $temp;
	$temp %= 10;
	
	$strnum[7] = $temp;
	
	return (int) $strnum;
}

?>