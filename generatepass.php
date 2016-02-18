<?php
var_dump($_REQUEST);

$validate  =ValidateFormInputs($_REQUEST);
var_dump($validate);

function ValidateFormInputs($requestArray) {
	$errArray = array();
	$noofwords;
	$usesymbol = false;
	$usenumber = false;
	// expecting noofwords, usenumber, use symbol 
	if(!empty($requestArray['noofwords']) && $requestArray['noofwords'] != null) {
	    if(is_numeric($requestArray['noofwords'])) {
	    	$noOfWords = intval($requestArray['noofwords']);
	    }
	    else {
	    	$errArray[] ="the Number of Words box is not numeric";
	    }
	}
	else {
		$errArray[] ="the Number of Words box is empty";
	}
  if(!empty($errArray)) {
	return  array("error"=>"true","messages"=>$errArray);
	}
	else {
		return true;
	}

}

?>