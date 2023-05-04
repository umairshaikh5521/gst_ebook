<?php 
require_once('phpmailer/src/PHPMailer.php');
require_once('phpmailer/src/SMTP.php');
require_once('phpmailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Asia/Kolkata');

$siteurl = "https://gst-ebooks.dealcube.in/"; // "https://gst-ebook.com/";
$sitename="GST E-Book";
$mode = "live";/*test*/
// $mode = "test";/*live*/

$googleCaptchaSecret = "6Lfgpm0lAAAAAA3Xtul8ishjBh0CiWjXWSZzs7yW";

$sendemailid="gstebook@gmail.com";
$emailsendername="GST E-Book";
$copyrightname="GST E-Book";
$bcc1="umang@thecreativeocean.com";
$bcc2="";
$cbcc1="support@gst-ebook.com";
$cbcc2="";
$testbcc1="";
$testbcc2="";

//Email Settings - Gmail
$emailHost="smtp.gmail.com";
$emailPort = "587";
$emailUserName = "gstebook@gmail.com"; #"devtest@dealcube.in";
$emailPassword = "vsgvvhmyjkgshgvk"; #"tsFFdsF*@l%{";

/*//Dealcube Domain
$emailHost="mail.dealcube.in";
$emailPort = "465";
$emailUserName = "devtest@dealcube.in";
$emailPassword = "tsFFdsF*@l%{";
*/

$adminSendEmailId = "gstebook@gmail.com";
$adminSendEmailSenderName = "GST E-Book | Enquiry";
$adminemail1 = "gstebook@gmail.com";
$adminemail2 = "";

$mailmessage="We have received your request, and one of our representative shall get back to you.";
$thankyoupagemessage="We have received your request, and one of our representative shall get back to you with more information.";



$referrer = isset($_POST['referer']) ? trim($_POST['referer']) : (isset($_SERVER['HTTP_REFERER']) ? base64_encode($_SERVER['HTTP_REFERER']) : false);//$_SERVER['HTTP_REFERER'];
if(isset($_POST) && !empty($_POST)) {
	function escape($value) {
		$return = '';
		for($i = 0; $i < strlen($value); ++$i) {
			$char = $value[$i];
			$ord = ord($char);
			if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
				$return .= $char;
			else
				$return .= '\\x' . dechex($ord);
		}
		return $return;
	}
	
	$name = escape($_POST['name']);
	$email = escape($_POST['email']);
	$phone = escape($_POST['mobile']);
	$memberOf = escape($_POST['memberOf']);
	$message = escape($_POST['description']);
	$gRecaptchaResponse = escape($_POST['g-recaptcha-response']);

	// UTM Source Data
	// $utm_source = mysqli_real_escape_string($connection, trim($_POST['USOURCE']));
	// $utm_medium = mysqli_real_escape_string($connection, trim($_POST['UMEDIUM']));
	// $utm_campaign = mysqli_real_escape_string($connection, trim($_POST['UCAMPAIGN']));
	// $utm_content = mysqli_real_escape_string($connection, trim($_POST['UCONTENT']));
	// $utm_term = mysqli_real_escape_string($connection, trim($_POST['UTERM']));
	// $utm_initial_referrer = mysqli_real_escape_string($connection, trim($_POST['IREFERRER']));
	// $utm_last_referrer = mysqli_real_escape_string($connection, trim($_POST['LREFERRER']));
	// $utm_landing_page = mysqli_real_escape_string($connection, trim($_POST['ILANDPAGE']));
	// $utm_visite = mysqli_real_escape_string($connection, trim($_POST['VISITS']));

	//Validation begins
	$errorStatus = 0;
	$errmsg = '';
	/*if($gRecaptchaResponse == "") {
		$errorStatus = 1;
		$errmsg .= 'Please verify that you are not a robot.';
	}*/
	// print_r('d'); die();
	if($name == "") {
		$errorStatus = 1;
		$errmsg .= 'Name is required. ';
	} else if(!preg_match("/^[A-Za-z\-'., ]+$/", $name)) {
		$errorStatus = 1;
		$errmsg .= 'Enter a valid name. Only Alphabets accepted. ';
	}

	if($phone == "") {
		$errorStatus = 1;
		$errmsg .= 'Mobile Number is required. ';
	} else if(!preg_match("/^[0]?[789]\d{9}$/", $phone)) {
		$errorStatus = 1;
		$errmsg .= 'Mobile Number should be a valid numberals. ';
	} else if(strlen($phone) != 10) {
		$errorStatus = 1;
		$errmsg .= 'Mobile Number should contain 10 digits. ';
	}

	if($email == "") {
		$errorStatus = 1;
		$errmsg .= 'Email is required. ';
	} elseif(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
		$errorStatus = 1;
		$errmsg .= 'Enter a valid Email Address.';
	}
	
	// if($memberOf == "") {

	// 	$errorStatus = 1;

	// 	$errmsg .= 'Member of field is required. ';

	// }
	
	if($message == "") {

		$errorStatus = 1;

		$errmsg .= 'Message is required. ';

	}
	
	function getBrowser() {
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		} elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}

		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		} elseif(preg_match('/Firefox/i',$u_agent)) {
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		} elseif(preg_match('/Chrome/i',$u_agent)) {
			$bname = 'Google Chrome'; 
			$ub = "Chrome";
		} elseif(preg_match('/Safari/i',$u_agent)) {
			$bname = 'Apple Safari';
			$ub = "Safari";
		} elseif(preg_match('/Opera/i',$u_agent)) {
			$bname = 'Opera';
			$ub = "Opera";
		} elseif(preg_match('/Netscape/i',$u_agent)) {
			$bname = 'Netscape';
			$ub = "Netscape";
		}
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {}
		$i = count($matches['browser']);
		if ($i != 1) {
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			} else {
				$version= $matches['version'][1];
			}
		} else {
			$version= $matches['version'][0];
		}
		if ($version==null || $version=="") {$version="?";}
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	}
	
	function verifyReCaptcha($googleCaptchaSecret, $gRecaptchaResponse, $ip_address) {
	    $ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    	curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query(array('secret' => $googleCaptchaSecret, 'response' => $gRecaptchaResponse, 'remoteip' => $ip_address)));
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$server_output = curl_exec($ch);
    	curl_close($ch);
    	if(isset($server_output)) {
    	    $response = json_decode($server_output);
    	    return (bool) ($response->success && $response->score >= 0.5); //score should be greater than or equal to .5
    	} else {
    	    return false;
    	}
    }
		
	$ua=getBrowser();
	$browsername=$ua['name'];
	$browserversion=$ua['version'];
	$browserplatform=$ua['platform'];
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$dateofreg = date('d-m-Y H:i:s');
	
	if(!verifyReCaptcha($googleCaptchaSecret, $gRecaptchaResponse, $ip_address)) {
	    echo '<script>alert("Please resubmit your data.");history.go(-1);</script>';
	}
	
	if($errorStatus == 0) {
		
		//$mail = new PHPMailer(true);
		$sendEmail = false;
			try {
				$mail = new PHPMailer();
				$mail->isSMTP();	// Comment this when mode is live to send email
				$mail->SMTPSecure ='tls';
				$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
				$mail->Host = $emailHost;
				$mail->Port = $emailPort;
				$mail->SMTPAuth = true;
				$mail->SMTPDebug = 0;
				$mail->Username = $emailUserName;
				$mail->Password = $emailPassword;
				// $mail->SMTPSecure	 = 'SSL';		

				$subject = $emailsendername.' : New Lead Received';
				$toemail =  $email;
				$toname = $name;
				$mail->setFrom($sendemailid,$emailsendername, 0);
				$mail->addAddress($toemail,$toname);
				//$mail->AddReplyTo($sendemailid,$emailsendername);
				// if($bcc4 != '') { $mail->AddBCC($bcc4,$emailsendername); }
				// if($bcc5 != '') { $mail->AddBCC($bcc5,$emailsendername); }

				$mail->isHTML(true); 
				$mail->Subject = $subject;

				$name = isset($name) ? "$name" : '';
				$email = isset($email) ? "$email" : '';
				$phone = isset($phone) ? "$phone" : '';
				$message = isset($message) ? "$message" : '';
				$memberOf = isset($memberOf) ? "$memberOf" : '';

				$body1 = "<table width='100%' border='0'>
				<tr>
					<td align='center'><table style='max-width:600px;margin:0 auto;width:100%; background-color:#f4f4f4; padding:13px;' cellpadding='0' cellspacing='0' border='0' width='600px'>
						<tbody style='background-color:#fff;'>
						<tr align='center'>
        					<a href='".$siteurl."' style='text-decoration:none;vertical-align:top;' target='_blank'>
        						<img src='".$siteurl."/assets/images/logo.png' style='max-height: 100px; max-width: 100px; text-align: center;' alt='GST E-Book'>
        					</a>
    					</tr>
						<tr>
							<td style='padding:30px;'><div style='font-size:26px;font-weight:bold;text-align:center;color:#000000;margin-bottom:20px;font-family:Tahoma, Geneva, sans-serif;'> Thank You, ".$name.".</div></td>
						</tr>
						<tr>
							<td>
								<table width='100%' border='0' cellspacing='0' cellpadding='0' style='max-width: 420px;margin: 0 auto;'>
									<tr>
									<td style='border-bottom:1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;font-weight: bold;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>Name</td>
									<td style='border-bottom: 1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>".$name."</td>
									</tr>
									<tr style='height: 5px;line-height: 0;'>
									<td colspan='2'>&nbsp;</td>
									</tr>
									<tr>
									<td style='border-bottom:1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;font-weight: bold;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>Email Address</td>
									<td style='border-bottom: 1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>".$email."</td>
									</tr>
									<tr style='height: 5px;line-height: 0;'>
									<td colspan='2'>&nbsp;</td>
									</tr>
									<tr>
									<td style='border-bottom:1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;font-weight: bold;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>Phone Number</td>
									<td style='border-bottom: 1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>".$phone."</td>
									</tr>
									<tr style='height: 5px;line-height: 0;'>
									<td colspan='2'>&nbsp;</td>
									</tr>
									<tr>
									<td style='border-bottom:1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;font-weight: bold;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>Member Of</td>
									<td style='border-bottom: 1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>".$memberOf."</td>
									</tr>
									<tr>
									<td style='border-bottom:1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;font-weight: bold;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>Message</td>
									<td style='border-bottom: 1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>".$message."</td>
									</tr>
									<tr style='height: 5px;line-height: 0;'>
									<td colspan='2'>&nbsp;</td>
									</tr>";
									
									$adminBody ="<tr>
    								<td style='border-bottom:1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;font-weight: bold;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>IP Address</td>
    								<td style='border-bottom: 1px solid #E4E4E4;font-size: 15px;padding-top: 9px;padding-bottom:9px;width: 50%;color: #999999;font-family: Tahoma,Geneva,sans-serif;'>".$ip_address."</td>
    								</tr>";
						$body2 = "
							</table>
							</td>
						</tr>
						<tr>
							<td style='padding:30px;'><div style='font-size:14px;text-align:center;color:#000000;margin-bottom:20px;font-family:Tahoma, Geneva, sans-serif;'>".$mailmessage."</div></td>
						</tr>
						<tr>
							<td><table width='100%' cellspacing='0' cellpadding='0' border='0' bgcolor='#F4F4F4' style='padding-bottom:17px;'>
								<tbody>
								<tr>
									<td><table width='100%' cellspacing='0' cellpadding='0' border='0' style='padding:30px 4% 0px 4%;'>
										<tbody>
										<tr>
											<td width='100%' align='center' style='padding-bottom: 15px;font-family: Tahoma,Geneva,sans-serif;'>&copy; ".date('Y')." ".$copyrightname."</td>
										</tr>";
										
										$body2 .= "</tbody>
									</table>
									</td>
								</tr>
								</tbody>
							</table>
							</td>
						</tr>
						</tbody>
					</table>
					</td>
				</tr>
				</table>";
				$mail->MsgHTML( $body1 . $body2 );
				$sendEmail = $mail->Send();	
			} catch (Exception $e) {
				echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}

			if( $sendEmail == true ) {
				if(isset($adminemail1) && $adminemail1 != '') {
					$mail1 = new PHPMailer(true);
					try {
						$mail1 = new PHPMailer();
						$mail1->isSMTP();
						$mail1->SMTPSecure ='tls';
						$mail1->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
						$mail1->Host = $emailHost;
						$mail1->Port = $emailPort;
						$mail1->SMTPAuth = true;
						//$mail1->SMTPDebug = 1;
						$mail1->Username = $emailUserName;
						$mail1->Password = $emailPassword;
						// $mail1->SMTPSecure = 'SSL';
						$mail1->AddReplyTo($sendemailid,$emailsendername);
						$mail1->isHTML(true);
						$mail1->Subject = $subject;
						if($bcc1 != '') { $mail1->AddBCC($bcc1,$emailsendername); }
				        if($bcc2 != '') { $mail1->AddBCC($bcc2,$emailsendername); }

						$mail1->SetFrom($adminSendEmailId,$adminSendEmailSenderName);
						$mail1->AddAddress($adminemail1,$adminSendEmailSenderName);
						$mail1->MsgHTML( $body1 . $adminBody . $body2 );
						$sendEmail = $mail1->Send();
					} catch (Exception $e) {
						echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
					}
				}
				if(isset($adminemail2) && $adminemail2 != '') {
					$mail2 = new PHPMailer(true);
					try {
						$mail2 = new PHPMailer();
						$mail2->isSMTP();
						$mail2->SMTPSecure ='tls';
						$mail2->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
						$mail2->Host = $emailHost;
						$mail2->Port = $emailPort;
						$mail2->SMTPAuth = true;
						//$mail2->SMTPDebug = 1;
						$mail2->Username = $emailUserName;
						$mail2->Password = $emailPassword;
						// $mail2->SMTPSecure = 'SSL';
						$mail2->AddReplyTo($sendemailid,$emailsendername);
						$mail2->isHTML(true);
						$mail2->Subject = $subject;

						$mail2->SetFrom($adminSendEmailId,$adminSendEmailSenderName);
						$mail2->AddAddress($adminemail2,$adminSendEmailSenderName);
						$mail2->MsgHTML( $body1 . $adminBody . $body2 );
						$sendEmail = $mail2->Send();
					} catch (Exception $e) {
						echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
					}
				}
				if($mode != 'test') {
					echo '<script>window.location="'.$siteurl.'thank-you.html"</script>';
					// echo '{ "alert": "success", "message": "Success!<br><br><strong>Reason:</strong><br>' . $thankyoupagemessage . ' " }';
				} else {
					echo '<script>window.location="'.$siteurl.'thank-you.html"</script>';
					// echo '{ "alert": "success", "message": "Success!<br><br><strong>Reason:</strong><br>' . $thankyoupagemessage . ' " }';
					// echo 'Success';
				}
			} else {
				if($mode != 'test') {
					//echo '<script>window.location="'.$siteurl . "contact-us/".'?reg=email-error"</script>';
					echo '<script>alert("Email Failed! We captured your information but can\'t able to send confirmation mail.");history.go(-1);</script>';
				} else {
					echo 'Email Fails<br/>' . $mail->ErrorInfo;
				}
			}

		} else {
			if($mode != 'test') {
				//echo '<script>window.location="'.$siteurl . "contact-us/".'?reg=data-insertion-error"</script>';
				echo '{ "alert": "error", "message": "Registration Failed!<br><br><strong>Reason:</strong><br>Error during insertion of data." }';
			} else {
				echo 'Data fails to insert into DB';
			}
		}
}
 ?>