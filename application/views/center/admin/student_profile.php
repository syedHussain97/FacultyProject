<h3>Student Profile</h3>

<p><b>Student Id:</b><?php echo "   " . $student["rno"]?></p>
<p><b>Name:</b><?php echo "   " . $student["name"]?></p>
<p><b>Institute:</b><?php echo "   " . $student["institute"]?></p>

<?php if($courses) {
	for($i=0; $i<sizeof($courses); $i+2) {
		echo $courses["course_code"] . "-" .$courses["course_name"];
	}
}?>
