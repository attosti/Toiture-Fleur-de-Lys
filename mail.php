<?php
define('admin_email','soumissions@toiturefleurdelys.com'); // Change admin email here for example admin@yoursite.com
define('website_name','toiturefleurdelys.com'); // Change website name here for example yoursite.com
define('website_url', 'http://'.$_SERVER['HTTP_HOST']);
define('EMAIL_FROM', 'noreply@'.$_SERVER['HTTP_HOST']);

function strict_secure($str){
	$str = strip_tags(trim($str));
	return $str;
}
function sendEmail($to,$from,$subject,$message,$headname){
	$headers="MIME-Version: 1.0" . "\r\n";
	$headers.="Content-type: text/html; charset=utf-8" . "\r\n";
	$headers.="From: ".$headname.'<'.$from.'>';
	return mail ($to,$subject,$message,$headers);
}


if(isset($_POST['action']) && $_POST['action']=='submitform')
{
	$N = array();
	$N = $_POST['formInput'];	
	$path =  $_SERVER['HTTP_REFERER'];

	$admin_message = '<p>Voici le contenu du message :</p>';
	foreach( $N as $label => $value ){
		$admin_message .= '<p>'.ucwords($label).' : '.$value.'</p>';	
	}
	$admin_message .= '<p>Message : '.$_POST['message'].'</p>';	

	$admin_subject = 'Form Received From '.website_name;
	$user_subject = 'Thank you - '.website_name;
	
	$sendToAdmin = $sendToUsers = '';

	$sendToAdmin = sendEmail('soumissions@toiturefleurdelys.com, soumissionsjp@toiturefleurdelys.com',EMAIL_FROM,$admin_subject,$admin_message,website_name);
	
	if($sendToAdmin)
	{
		$message ='Success::<div class="alert alert-success"><strong><i class="fa fa-info message-icon"></i><span>Message bien envoyé.</span></strong></div>';		
	}else{
		$message ='Error::<div class="alert alert-danger"><strong><i class="fa fa-info message-icon"></i><span>Le message ne s\'est pas envoyé !</span></strong></div>';
	}
	echo $message;
}
exit();
?>