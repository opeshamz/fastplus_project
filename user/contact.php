<?php
include('include/autoloader.php');
$smarty->assign('is_contact',1);
if (isset($_POST['submit'])) {
		$name = make_safe($_POST['name']);
		$email = make_safe($_POST['email']);
		$title = make_safe($_POST['title']);
		$content = make_safe($_POST['content']);
		$recaptcha_response = trim($_POST['g-recaptcha-response']);
		$validemail = "^([[:alnum:]_.\-]{1,64})@([[:alnum:]_.\-]{2,40})(\.[a-z]{2,6})$";
		$check_capatcha = checkRecaptcha($options['api_recaptcha_private'],$recaptcha_response);
		if (empty($name)) {
		$message = notification('warning',"Insert Your Name Please.");
		} elseif (empty($email)) {
		$message = notification('warning',"Insert Your E-Mail Please.");
		} elseif (ereg($validemail, $email) === false) {
		$message = notification('warning',"Insert Valid E-Mail Please.");
		} elseif (empty($title)) {
		$message = notification('warning',"Insert Message Title Please.");
		} elseif (empty($content)) {
		$message = notification('warning',"Insert Message Content Please.");
		} elseif ($check_capatcha == 0) {
		$message = notification('warning',"Invalid Captcha Code.");
		} else {
			$body = 'Message From : <br />'.$name.' ('.$email.')<br /><p>'.$content.'</p>';
			if ($options['mail_mail_method'] == 'smtp') {
				$send = send_smtp_mail($options['mail_smtp_host'],$options['mail_smtp_port'],$options['mail_smtp_username'],$options['mail_smtp_password'],$email,$options['mail_reciption_email'],$title,$body);
			} else {
				$send = send_simple_mail($options['mail_send_email'],$options['mail_reciption_email'],$title,$body);
			}
			if ($send == true) {
				$message = notification('success',"We Get Your Message and We Will Reply it As Soon As Possible.");
			} else {
				$message = notification('danger',"Error Happened");
			}
		}
}
$smarty->assign('message',$message);
$smarty->assign('seo_title','Contact Us');
$smarty->assign('seo_keywords',$options['general_seo_keywords']);
$smarty->assign('seo_description',$options['general_seo_description']);
$smarty->display('contact.html');
?>