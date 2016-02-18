<html>
<head>
<title>Bharath Parlapalli - DWA15 P2 Generate Password</title>
<link rel="stylesheet" type="text/css" href="base.css">
</head>
<body>
<div class="headerlabel">
XKCD random password generator
</div>
<div class="form">
<?php
$error = false;
$noOfWords = 0;

if(isset($_REQUEST['subpass']) && $_REQUEST['subpass'] == "generate Password") {


// all validations in this function
function ValidateFormInputs($requestArray) {
	$errArray = array();
	$usesymbol = false;
	$usenumber = false;
	// expecting noofwords, usenumber, use symbol 
	if(!empty($requestArray['noofwords']) ) {
	    if(is_numeric($requestArray['noofwords'])) {	    	
	    	if(!intval($requestArray['noofwords'])) {
	    		$errArray[] ="the Number of Words should be atleast 1";
	    	}
	    }
	    else if($requestArray['noofwords'] === "0") {
	    	$errArray[] ="the Number of Words should be atleast 1";
	    }
	    else {
	    	$errArray[] ="the value in Number of Words box is not numeric";
	    }
	}
	else {
		if($requestArray['noofwords'] === "0") {
						$errArray[] ="the Number of Words should be atleast 1";
		}
		else {
		$errArray[] ="the Number of Words box is empty";
	   }
	}
  if(!empty($errArray)) {
	return  array("error"=>true,"messages"=>$errArray);

	}
	else {
		return array("error"=>false, "reqarray"=>$requestArray);
	}

}

// perform validtion
$validate  = ValidateFormInputs($_REQUEST);

// check if validation passed
	if($validate['error']) {
			$error = true;
	  
	}
	else {
		$reqarray = $validate['reqarray'];
	}


// show errors
	if($error) {	
			echo '<div class="errors">'; 
				 foreach($validate['messages'] as $err) {
 				 echo $err."<br>"; 
				 }

			echo '</div>';
						}
	else {
		
		$wordlist = array();
		$file = fopen('verbs.csv', 'r');
			while (($line = fgetcsv($file)) !== FALSE) {
  			//$line is an array of the csv elements
 			 $wordlist[] = $line[0];
			}
		fclose($file);
		$wordstotal = count($wordlist);
		if($reqarray['noofwords'] > 1) {
		$random_picks = array_rand( $wordlist, $reqarray['noofwords']);
		}
		else {
			$random_picks[] = array_rand( $wordlist, $reqarray['noofwords']);
		}
	 echo '<div class="password">';
		for($iter =0; $iter<=$reqarray['noofwords'] ; $iter++ ){
		     echo $wordlist[$random_picks[$iter]];
		  if($iter < ($reqarray['noofwords']-1)) {
		  	echo "-";
		  }
		}
		if(!empty($reqarray['usesymbol']) &&$reqarray['usesymbol'] ) {
			
			$arraySplChars = array("&","@","<",">","#","^");
			$rand_num_chars = array_rand($arraySplChars, 1);
			echo "-".$arraySplChars[$rand_num_chars];
		}
		if(!empty($reqarray['usenumber']) &&$reqarray['usenumber'] ) {
			$arrayNum = array(1,2,3,4,5,6,7,8,9,0);
			$rand_num = array_rand($arrayNum, 1);
			echo "-".$arrayNum[$rand_num];
		}
		echo '</div>';
	}

} // end of form submit check

?>


<form action="#" method="POST">
<div>
 <label for="noofwords">No Of Words</label>
  <input type="text" name="noofwords" value="<?php if(!empty($_REQUEST['noofwords'])) {echo $_REQUEST['noofwords'];} else if($_REQUEST['noofwords'] === '0') { echo '0';}?>" maxlength="1" class="onechar">
  </div>
  <div>
  <label for="usenumber">Use Number?</label>
  <input type="checkbox" name ="usenumber" value="true" <?php if(!empty($_REQUEST['usenumber']) && $_REQUEST['usenumber']) { echo "checked";} ?>>
  <label for="usesymbol">Use Symbol?</label>
  <input type="checkbox" name="usesymbol" value="true" <?php if(!empty($_REQUEST['usesymbol']) && $_REQUEST['usesymbol']) { echo "checked"; } ?>>
  </div>
  <div class="submit">
  <input  type="submit" class ="submitbtn" name="subpass" value="generate Password"/>
  </div>
</form>
</div>
</body>
</html>