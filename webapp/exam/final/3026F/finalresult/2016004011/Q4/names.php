<?php
/**
 * name : Hwang se hyeon, ID: 2016004011, year: 2
 */
if (isset($_GET["type"])){
	$type = $_GET["type"];
	if($type != "list"){
		header("HTTP/1.1 400 Invalid Request");
		die("HTTP/1.1 400 Invalid Request - you passed in a wrong type parameter.");
	}
	nameList();
} else {
	babyname();
}

function nameList(){
	$names = "";
	$lines = file("rank.txt", FILE_IGNORE_NEW_LINES);
	foreach ($lines as $line) {
		$names = $names.substr($line, 0, strpos($line, " "))." ";
	}
	
	if ($names) {
		/* Change the code in this if statement to produce XML data to be sent to the client as shown below.
	    * Do NOT embed XML syntax in print or string use PHP's DOM
		* <babynames>
		*	<name>Aaden</name>
		*	<name>Aaliyah</name>
		*	...
		*	<name>Zuri</name>
		* </babynames>
 		* 
 		 */
		$names =explode(" ",trim($names));
		 $dom = new DOMDocument();
		 $top_tag  = $dom->createElement("babynames");
		foreach($names as $nm){
			$bytag = $dom->createElement("name");
			$bytag->appendChild($dom->createTextNode($nm));
			$top_tag->appendChild($bytag);
		}
		 $dom->appendChild($top_tag);
		 header("Content-type: text/xml");
		 print $dom->saveXML();
		 

	} else {
		header("HTTP/1.1 410 Gone");
		die("HTTP/1.1 410 Gone - There is no data!.");
	}
}

	
function babyname(){
	$name = get_parameter("name");
	$gender = get_parameter("gender");

	$baby_info = "";
	$lines = file("rank.txt", FILE_IGNORE_NEW_LINES);
	foreach ($lines as $line) {
		if (preg_match("/^$name $gender /", $line)) {
			$baby_info = $line;
			break;
		}
	}
	
	if ($baby_info) {
		/* Change the code in this if statement to produce JSON data to be sent to the client.
 		*  In this code, call the generate_json() function
		* 
 		 */
		 
		header("Content-type: text/json");
		print generate_json($baby_info,$name,$gender);
		
		
		
	} else {
		header("HTTP/1.1 410 Gone");
		die("HTTP/1.1 410 Gone - There is no data for this name/gender.");
	}
}

/* Change the code in this function to produce and return JSON data.
 * Do NOT embed JSON syntax in print or string use associative arrays
 * 
 */
function generate_json($line, $name, $gender) {
	$tmp = array();
	$tmp['name']=$name;
	$tmp['gender']=$gender;
	$tmp['rankings']=array();
	$tln = explode(" ",trim($line));
	for($i = 2;$i<count($tln);$i++){
		array_push($tmp['rankings'],(int)$tln[$i]);
	}
	return json_encode($tmp);
}

function get_parameter($name) {
	if (isset($_GET[$name])) {
		return $_GET[$name];
	} else {
		header("HTTP/1.1 400 Invalid Request");
		die("HTTP/1.1 400 Invalid Request - you forgot to pass a '$name' parameter.");
	}
}
?>