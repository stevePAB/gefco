<?php

// set email address that this is being sent to
$to = 'neil.rayner@gefco.net , sarah.johnson@pabstudios.co.uk , steve@pabstudios.co.uk';

//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
		@$enquiryType = ($_GET['enquiryType']) ? $_GET['enquiryType'] : $_POST['enquiryType'];
		$subject =$enquiryType;
		@$customerName= ($_GET['customerName']) ? $_GET['customerName'] : $_POST['customerName'];
		@$e_mail= ($_GET['email']) ? $_GET['email'] : $_POST['email'];
		@$company= ($_GET['company']) ? $_GET['company'] : $_POST['company'];
		@$custMessage= ($_GET['custMessage']) ? $_GET['custMessage'] : $_POST['custMessage'];
		@$telephoneNumber= ($_GET['telephoneNumber']) ? $_GET['telephoneNumber'] : $_POST['telephoneNumber'];
	
		@$VehiclePreparation = ($_GET['VehiclePreparation']) ? $_GET['VehiclePreparation'] : $_POST['VehiclePreparation'];
		@$Logistics = ($_GET['Logistics']) ? $_GET['Logistics'] : $_POST['Logistics'];
		@$BodyShop = ($_GET['BodyShop']) ? $_GET['BodyShop'] : $_POST['BodyShop'];

if ($_POST) $post=1;
//Simple server side validation for POST data, of course, you should validate the email
	//subject and the html message
	$message = '';
	$from = $e_mail ;
	$message .= '<table>';
			if (isset($customerName)&&$customerName!=''){	
				$message .= '<tr><td>Name</td><td>' . $customerName . '</td></tr>';
				}
			if (isset($e_mail)&&$e_mail!=''){		
				$message .= '<tr><td>Email</td><td>' . $e_mail . '</td></tr>';
				}
	if (isset($company)&&$company!=''){		
				$message .= '<tr><td>Company</td><td>' . $company . '</td></tr>';
				}
				if (isset($telephoneNumber)&&$telephoneNumber!=''){		
				$message .= '<tr><td>telephone</td><td>' . $telephoneNumber . '</td></tr>';
				}
			if (isset( $custaddress)&&$custaddress!=''){	
				$message .= '<tr><td>Address</td><td>' . $custaddress . '</td></tr>';
				}


			if (isset( $VehiclePreparation)&&$VehiclePreparation!=''){	
				$message .= '<tr><td>Vehicle Preparation</td><td>yes</td></tr>';
				}
			if (isset( $Logistics)&&$Logistics!=''){	
				$message .= '<tr><td>Logistics</td><td>yes</td></tr>';
				}
			if (isset( $BodyShop)&&$BodyShop!=''){	
				$message .= '<tr><td>Body Shop</td><td>yes</td></tr>';
				}
			$message .= '</table>';
			$atpos=strrpos($from,"@");
			$dotpos=strrpos($from,".");
			if ($from==''||$from=='Email address'||$atpos<1 || $dotpos<$atpos+2 || $dotpos+2>=strlen($from)||$atpos===false||$dotpos===false ){
				return false;
			}


	//send the mail
	$result = sendmail($to, $subject, $message, $from);
	//send_customer_email($customer_id );
	//if POST was used, display the message straight away
	if ($_POST) {
		
		// get the displayed message
		if ($result) {
				$displayedMessage =  'THANK YOU FOR YOUR INTEREST<br>WE WILL BE IN TOUCH SOON';
		
		} 		else {
			 	$displayedMessage = 'Sorry, unexpected error! Please try again later';
		}
		
	} 

//if the errors array has values


?><?php
//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
// To send HTML mail, the Content-type header must be set
		$headers = implode("\n", array( // \n only becuase stoneacre has a windows mail server. check mail() php documentation.
			'MIME-Version: 1.0',
			'Content-type: text/html; charset=utf-8;',
			'From: ' . $from,
			'Reply-To: '. $to
		));
		//Still need the full document even though its only email.
		$body = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
		<html>
			<head>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
				<title>{$subject}</title>
				<style>
				body{ font-family:Arial; font-size:11px; )
				</style>
			</head>
			<body>
				{$message}
			</body>
		</html>";
	$result = mail($to,$subject,$message,$headers);
	if ($result){
	 return 1;
	 }
	else {
	return 0;
 }
}
?>

<!-- everything below here is for page design -->
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link href="http://fonts.googleapis.com/css?family=Titillium+Web:400,700" rel="stylesheet">

<style>
	
body		{	margin: 0;
				padding: 0;
				box-sizing: border-box;
				font-family: 'Titillium Web', sans-serif;
			}
	
.content	{	margin: 0 auto;
				width: 720px;
				height: 100%;
				overflow: auto;
			}
	
.gefco-box	{	width: 100px;
				height: 100px;
				background:url(links/gefco-logo.jpg);
				margin-top: 30px;
			}	
	
.header		{	margin: 0 auto;
				width:600px;
				background-color:rgba(11,30,96,1.00);
				height: 160px;
				margin-top: calc( 50vh - 160px);	
			}
	
	
.text		{	width: 100%;
				font-size: 2.4em;
				text-align: center;
				line-height: 1.05em;
				padding-top: 41px;
				color: white;
				-webkit-transform:scale(0.8,1); /* Safari and Chrome */
    			-moz-transform:scale(0.8,1); /* Firefox */
    			-ms-transform:scale(0.8,1); /* IE 9 */
    			-o-transform:scale(0.8,1); /* Opera */
    			transform:scale(0.8,1); /* W3C */
			}	
	
	
@media only screen and (max-width: 760px) {

	.content	{	width: 100%;
				}
	}
	
	
	
@media only screen and (max-width: 690px) {
	
	.text		{	font-size: 2em;	
				}
	
	.header		{	height: 140px;
					margin-top: calc( 50vh - 150px);
				}
	}	
	
@media only screen and (max-width: 600px) {

	.header	{	width: 100%;
				}
	}
	
@media only screen and (max-width: 460px) {

	.text		{	font-size: 1.6em;	
				}
	
	.header		{	height: 125px;
					margin-top: calc( 50vh - 140px);
				}
	}	
	
@media only screen and (max-width: 360px) {

	.text		{	font-size: 1.4em;	
				}
	
	.header		{	height: 125px;
					margin-top: calc( 50vh - 140px);
				}
	}		
	
	
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />


<title>GEFCO Landing Page</title>
</head>

<body>

	<div style="height: 160px; background: white;">
		<div class="content">
			<div style="width:100px; height:100px; margin-left: 15px;">
				<a href="https://uk.gefco.net/"><div class="gefco-box"></div></a>	
			</div>	
		</div>
	</div>

	<div style="height: calc( 100vh - 160px); background:url(links/car-background.jpg); background-size: cover; background-position: center; ">
		<div class="content">
			<div class="header">
				<p class="text"><?php 
// this is the displayed success of fail message set at line 68 
echo $displayedMessage;
?></p>
				
				
			</div>
		</div>
	</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-106003186-1', 'auto');
  ga('send', 'pageview');

</script>	

	
	
</body>

</html>



