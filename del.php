<?php

include "scripts/message.php";	
include "scripts/conDB.php";

	$sql="DELETE FROM students";                                     //delete request
 $stmt=$connector->prepare($sql);  
  $result=$stmt->execute();  
  
 
 
    // check if row deleted or not
    if ($stmt->affected_rows > 0) {
        // successfully deleted
        show_succes("Students successfully deleted");
       } 
	else {
        // no students found
        
        show_succes("No students found!", "Students");
     }
	 $stmt->close();
	 $connector->close();
  
   
   


?>