<?php
include "scripts/message.php";

function show_head_table()                                 // method for print first part web-page
{
	
	print "<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <title>HTML5 forms</title>
	<meta name='keywords' content='HTML5 development, css...'>
    <meta name='description' content='In our company is ... HTML5 development.....'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' 
	integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' 
integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'
integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' 
integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <link rel='stylesheet' href='styles/style1.css' />
	<script src='scripts/script1.js'></script>
  </head>
  <body>
  <h2 style=\"color:black\">Students</h2>
   <table class='table table-hover'>
   <thead>
   <tr>
   <th>First name</th>
   <th>Last name</th>
   <th>Id</th>
   <th>Grade</th>
   <th>Email</th>
   <th>Message</th>   
   </tr>   
   </thead>
   <tbody>";	
}
function show_foot_table()                                            // method for print second part web-page
{
	print "</tbody>
	</table>
 </body>	
</html>	";	
}

function all_students($firstname, $lastname, $id, $grade, $email, $message): string                 // method for print a table
{
	$result="<tr>
	<td>$firstname</td>
	<td>$lastname</td>
	<td>$id</td>
	<td>$grade</td>
	<td>$email</td>
	<td>$message</td>
	</tr>";
	
	return $result;
}
	
	

include "scripts/conDB.php";                                            // script for connect to DataBase


	
	$sql="SELECT * FROM students";                                         //query 
 $stmt=$connector->prepare($sql);
 $stmt->execute();
 $stmt->bind_result( $id, $firstname, $lastname, $grade, $email, $message);
 $stmt->store_result();
 $numrows = $stmt->num_rows;
 if($numrows>0){                                                               // if 
	    show_head_table(); 
        while ($stmt->fetch()) {
			echo all_students($firstname, $lastname, $id, $grade, $email, $message);
            
        }
		 show_foot_table();
 }else 
 {                                                                      // no students found
    
    show_succes("No students found","Students!");
	
}
  $stmt->close();                                                     //closing connection to DataBase;	
$connector->close();

	
	
	
	
	
	
	
	
	
	

?>