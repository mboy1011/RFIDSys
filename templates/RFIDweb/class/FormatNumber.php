<?php 

class Formatnumber{

	public function __construct(){
	}//end default constructor

	public function twoDecimalPlaces($value){
		$value = number_format($value, 2);
		return $value;
	}


	public function putComma($value){
		$value = number_format($value);
		return $value;
	}

}//end class


 ?>