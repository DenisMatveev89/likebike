<?php

$date=date("d.m.y "); // число.месяц.год  
$time=date("H:i "); // часы:минуты:секунды 

if(isset($_POST['profile_phone'])){
	
	$phone = $form = ' '.$_POST['profile_phone'].' ';  
	if(isset($_POST['profile_name'])){
		$name = ' '.$_POST['profile_name'].' ';  
	}else{
		$name = '';
	}
	if(isset($_POST['profile_email'])){
		$email = '<b>Email:</b> '.$_POST['profile_email'].' ';  
	}else{
		$email = '';
	}
	if(isset($_POST['form_comment'])){
		$form = ''.$_POST['form_comment'].' ';  
	}else{
		$form = '';
	} 

	/*$message = $form.$name.$phone.$email;*/
	$message = $date.$time.$name.$phone;
	/*Отправляем письмо с помощью PHPmailer*/
	require_once('phpmailer/class.phpmailer.php');

	$mail             = new PHPMailer(); 

	$mail->CharSet = 'UTF-8';
	
	$body             = $message;

	$address = "kedr.pa@gmail.com";

	$mail->AddReplyTo($address, 'LikeBike');

	$mail->SetFrom($address, 'LikeBike');

		
	$mail->AddAddress($address, 'LikeBike');

	$mail->Subject    = "Заявка с LikeBike";

	$mail->AltBody    = $message; 

	$mail->MsgHTML($body);


	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo 'sent';
	}
		
	
}else{
	echo "Оставь надежду всяк сюда входящий";
}

// Сохраняем в базу данных 
 
$f = fopen("message.txt", "a+"); 

fwrite($f,"\n ЗАЯВКА $date в $time "); 
 
fwrite($f,"\n $name просит перезвонить по номеру $phone"); 
 
fwrite($f,"\n -------------------------------"); 
 
fclose($f); 

?>