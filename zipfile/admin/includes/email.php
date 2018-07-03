<?php 
 $emailto=@$_POST['emailto'];
 $ccto=@$_POST['ccto'];
 $bccto=@$_POST['bccto'];
 $subject_to=@$_POST['subject'];
 $message_to=@$_POST['message'];
$to =$emailto;

$subject = $subject_to;
if(isset($emailto)!='' && $message_to!='')
{
$headers = "From: support@landexperts.in \r\n";
$headers .= "Reply-To: support@landexperts.in \r\n";
$headers .= "CC:" .$ccto. "\r\n";
$headers .= "BCC:" .$bccto. "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = $message_to;
$mail_sent = @mail( $to, $subject, $message, $headers );
if($mail_sent)
{
	echo "Mail send successfully";
}else
{
	echo "Failed to sent";
}

}else
{
	echo "Please enter the E-mail or Message";
}




?>