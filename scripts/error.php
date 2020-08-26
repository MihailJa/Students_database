<?php

function show_error($message){     // for displaying error
	
		echo "<!DOCTYPE html>
  <html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <title>Error</title>	
	<style type=\"text/css\">
	body {
		background-color:#cecece;
		color: red;		
	}
	h1,p{
		text-align: center;
	}
	</style>
	</head>
  <body>
  <h1>Error!<h1>
  <p>$message</p>
   </body>
   </html>";
	}

?>