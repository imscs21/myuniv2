<!--
	name : Hwang se hyeon, ID: 2016004011, year: 2
-->
<!DOCTYPE html>
<html>
	<head>
		<title>Q1. Forms</title>
		<style type="text/css">
			span {color: blue;}
			img {float:left; height:100px; margin-right:30px}
		</style>
	</head>
	<?php
	//print_r($_POST);
		if (!isset($_POST["sname"]) || !isset($_POST["sid"]) || !isset($_POST["dob"])  || !isset($_POST["email"]) || 
		    !isset($_POST["sclass"]) || !isset($_POST["favoriteChapter"]) || !isset($_POST["diffLab"]) || !isset($_POST["comments"])){
			header("HTTP/1.1 400 Invalid Request");
		    die("HTTP/1.1 400 Invalid Request - you have submitted incomplete form.");
		}
		
		$name = $_POST["sname"];
		$sid = $_POST["sid"];
		$fc = $_POST["favoriteChapter"];
		
		//die();
		/* Validate the parameter 'sname', so that it can only consists of alphabets, dash(-), and white space
		 * (Use regular expression to validate!)
		 * Set the header to "Invalid Request", kill the process, and return an appropriate message 
		 * (HTTP/1.1 400 Invalid Request - your input for Name is invalid.)
		 */
		if (!preg_match("/((^[A-Za-z]*)((([A-Za-z]+)([\-\ ]?)([A-Za-z]+))+)([A-Za-z]*$))|(^[A-Za-z]+$)/",$name)) {
			header("HTTP/1.1 400 Invalid Request");
			die("HTTP/1.1 400 Invalid Request - your input for Name are invalid.'{$name}'");		
		} 
		/* Validate the parameter 'sid', so that it can only be made up of 10 digits
		 * (Use regular expression to validate!)
		 * Set the header to "Invalid Request", kill the process, and return an appropriate message 
		 * (HTTP/1.1 400 Invalid Request - your input for Student ID is invalid.)
		 */  
		if (!preg_match("/^([1-9]\d{9})$/",$sid)) {
			header("HTTP/1.1 400 Invalid Request");
			die("HTTP/1.1 400 Invalid Request - your input for Student ID is invalid.");
		} 

		/* Validate the parameter 'favoriteChapter', so that it can contain no more than 3 options
		 * Set the header to "Invalid Request", kill the process, and return an appropriate message 
		 * (HTTP/1.1 400 Invalid Request -  You have selected more than 3 favorite chapters.)
		 */ 
		if ( ($fc!=null && count($fc)>3)) {
			header("HTTP/1.1 400 Invalid Request");
				die("HTTP/1.1 400 Invalid Request - You have selected more than 3 favorite chapters.");
		}
		
		/* Save the uploaded photo as "$sid.jpg"
		 * for example, if user uploads "photo.jpg" it should be saved as "2011010528.jpg" 
		 * to root directory where 'forms.html' and 'formProcessor.php' are located
		 * 
		 * Initially check if the file is uploaded sucessfully or not
		 */
		if (is_uploaded_file($_FILES["photo"]["tmp_name"])){
			//if the file already exists delete the existing file first	
			
			if (file_exists("$sid.jpg")){
				unlink("$sid.jpg");
			}
			move_uploaded_file($_FILES["photo"]["tmp_name"], "$sid.jpg");
			//save the file as as "$sid.jpg"
			
			
		}
	
		
		$ia = array(); 
		// If checkboxes with names "lab" is checked, store the associated value
		if (isset($_POST["lab"])&&$_POST["lab"]=="on"){
			$ia[] = "Laboratory";
		}
		// If checkboxes with names "project" is checked, store the associated value
		if (isset($_POST["project"])&&$_POST["project"]=="on"){
			$ia[] = "Team Project";
		}
		// If checkboxes with names "exam" is checked, store the associated value
		if (isset($_POST["exam"])&&$_POST["exam"]=="on"){
			$ia[] = "Exam";
		}
		
		function processArray($array) {
			$s = "$array[0]";	
			for($i=1; $i < count($array); $i++){
				$s .= ", ".$array[$i];
			}
			return $s;
		}
    ?>
	<body>
		<h1>Survey Summary</h1>
		<h2>Student Information</h2>
		<img src="<?=$sid?>.jpg" alt="<?=$name?>"/>
		<ul>
			<li>Name: <span><?= $name ?></span></li>
			<li>Student ID: <span><?= $sid ?></span></li>
			<li>Date of Birth: <span><?= $_POST["dob"] ?></span></li>
			<li>Email: <span><?= $_POST["email"] ?></span></li>
			<li>Class: <span><?= $_POST["sclass"] ?></span></li>		 
		</ul>		
		<h2>Course Evaluation Survey:</h2>
		<ul>
			<li>3 Favorite chapters: <span><?= processArray($fc) ?></span></li>
			<li>The most difficult lab session: <span><?= $_POST["diffLab"] ?></span></li>
			<li>Inappropriate assessment method: <span><?= processArray($ia) ?></span></li>
			<li>Additional Comments: <span><?= $_POST["comments"]?></span></li>
		</ul>
	</body>
</html>
