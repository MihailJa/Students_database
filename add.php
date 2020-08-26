<?php
include "scripts/message.php";

function is_filled()                //function for check if the fields are filled 
{
	if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['id']) && isset($_POST['grade'])&& isset($_POST['email']))
	return true;

return false;	
}

function check_name_or_lastname($name)    //function for validate name and last name
{		
	if(preg_match('/^\s*[a-zA-Zа-яА-ЯёЁ]{2,}\s*$/u',$name))
	return true;

return false;	
}
function check_id($id)                     // function for validate isikukood
{ 
    $_id=trim($id);
	if(preg_match('/\d{11}/', $_id))
	{
		 $c = 1;
         $count = 0;
		do
            {
                $checksum = 0;
                for ($i = 0; $i < 10; $i++)
                {
                    $checksum += $_id[$i] * ($c == 10 ? $c = 1 : $c);
                   $c++;
                }
                if ($checksum % 11 == $_id[10])
                    return true;
                $c = 3;
                $count++;
            } while ($checksum % 11 == 10 &&  $count != 2);

            if ($checksum % 11 == 10 && $_id[10] == 0)
                return true;			
    }         
        return false;	
}
function check_email($email)               // function for validate email
{
	if(preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,4}$/',$email))
	return true;

return false;	
	
	
}
function check_grade($data) {                // function for validate gradle
  
  if($data>0 && $data<5)
	  return true;
  
  return false;  
}

function name_conversion($name)              //name conversion function   
{
	$str=trim($name);
	$first_char=mb_substr($str, 0,1);
	$another_chars=mb_substr($str, 1);
	return mb_strtoupper($first_char).mb_strtolower($another_chars);	
}

function email_conversation($email)           //email conversion function  
{
	return strtolower($email);	
}


function check_input($data) {                 //function to prevent injection 
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if(is_filled())
{
$fn=$_POST['first_name'];
$ln=$_POST['last_name'];
$id=$_POST['id'];
$gr=$_POST['grade'];
$em=$_POST['email'];
$mes=null;
$errormessage="";
	if(!check_name_or_lastname($fn))	                       // check to valide input
		$errormessage .= "Invalid first name<br>";		
	
	if(!check_name_or_lastname($ln))	
		$errormessage .="Invalid last name<br>";		
	
	if(!check_id($id))	
		$errormessage .= "Invalid id<br>";		
	
	if(!check_email($em))	
		$errormessage .= "Invalid email<br>";	
	
	if(!check_grade($gr))	
		$errormessage .= "Invalid grade<br>";
		
	if($errormessage)
	{
		show_error($errormessage);
		exit();
	}
	
	$fn=check_input(name_conversion($fn));                   //prevent injection
	$ln=check_input(name_conversion($ln));
	$em=check_input(email_conversation($em));
	$id=check_input($id);
    $gr=check_input($gr);
	
	if(isset($_POST['message']))
	$mes=check_input($_POST['message']);	
} else
{
	 show_error("Missing fields");
	exit();
}
include "scripts/conDB.php";

$query="INSERT INTO students (id_code, first_name, last_name, grade, email, message) VALUES(?, ?, ?, ?, ?, ?)";  // query
$stmt = $connector->prepare($query);
$stmt->bind_param("sssiss",$id, $fn, $ln, $gr, $em, $mes);
$result=$stmt->execute();

if($result)                                                                  //successful query
{
	show_succes("$fn $ln added in DataBase!");
	
} else                                                                     //No Records Found
	show_error("A similar record already exists");

$stmt->close();
$connector->close();












?>