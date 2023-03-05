<?php
require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$Host = "mail.dealcube.in";
	$Username = 'devtest@dealcube.in';
	$Password = 'tsFFdsF*@l%{';
	
	
	//$mail = new PHPMailer();
	
	$from = $_POST['email'];
	$subject = 'Thanks for reaching us';
	$cc = 'antojas22@gmail.com';
	
	$to = $_POST['email'];
	
	
	$mail = new PHPMailer; 
	$mail->From = $from; 
	$mail->FromName = "GST-ebook"; 
	$mail->addAddress($to, $_POST['name']); //Provide file path and name of the attachments 
	// $mail->addAttachment("file.txt", "File.txt");
	$mail->IsSMTP();
	$mail->Host = $Host;
	$mail->SMTPAuth = true;
	$mail->Username = $Username;
	$mail->Password = $Password;

	$mail->isHTML(true); 
	$mail->Subject = $subject; 
	$mail->Body = getMailBody(false);
	// $mail->AltBody = "This is the plain text version of the email content"; 
	if(!$mail->send())
	{ 
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{ 
		echo "Message has been sent successfully"; 
	}
	
	$mail->addAddress($cc, "Admin");
	$mail->Body = getMailBody(true);
	if(!$mail->send())
	{ 
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{ 
		echo "Message has been sent successfully"; 
	}
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
	
}
	
function getMailBody($isAdmin = false) {
return '<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
	<head>
		<title>GST-ebook</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<!--[if mso]>
		<xml>
			<o:OfficeDocumentSettings>
				<o:PixelsPerInch>96</o:PixelsPerInch>
				<o:AllowPNG/>
			</o:OfficeDocumentSettings>
		</xml>
		<![endif]-->
		<!--[if !mso]><!-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css"/>
		<!--<![endif]-->
		<style>
			* {
			box-sizing: border-box;
			}
			body {
			margin: 0;
			padding: 0;
			}
			a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
			}
			#MessageViewBody a {
			color: inherit;
			text-decoration: none;
			}
			p {
			line-height: inherit
			}
			.desktop_hide,
			.desktop_hide table {
			mso-hide: all;
			display: none;
			max-height: 0px;
			overflow: hidden;
			}
			.image_block img+div {
			display: none;
			}
			@media (max-width:670px) {
			.desktop_hide table.icons-inner,
			.social_block.desktop_hide .social-table {
			display: inline-block !important;
			}
			.icons-inner {
			text-align: center;
			}
			.icons-inner td {
			margin: 0 auto;
			}
			.row-content {
			width: 100% !important;
			}
			.mobile_hide {
			display: none;
			}
			.stack .column {
			width: 100%;
			display: block;
			}
			.mobile_hide {
			min-height: 0;
			max-height: 0;
			max-width: 0;
			overflow: hidden;
			font-size: 0px;
			}
			.desktop_hide,
			.desktop_hide table {
			display: table !important;
			max-height: none !important;
			}
			}
		</style>
	</head>
	<body style="background-color: #fbfbfb; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
		<table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fbfbfb;" width="100%">
			<tbody>
				<tr>
					<td>
						<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
							<tbody>
								<tr>
									<td>
										<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
											<tbody>
												<tr>
													<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
														<table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
															<tr>
																<td class="pad" style="padding-bottom:20px;padding-left:10px;width:100%;padding-right:0px;">
																	<div align="center" class="alignment" style="line-height:10px"><img alt="Logo" src="assets/images/emailer/logo.png" style="display: block; height: auto; border: 0; width: 130px; max-width: 100%;" title="Logo" width="130"/></div>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #175df1;" width="100%">
							<tbody>
								<tr>
									<td>
										<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
											<tbody>
												<tr>
													<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="50%">
														<div class="spacer_block" style="height:20px;line-height:20px;font-size:1px;"> </div>
														<table border="0" cellpadding="0" cellspacing="0" class="divider_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
															<tr>
																<td class="pad" style="padding-left:10px;padding-top:5px;">
																	<div align="left" class="alignment">
																		<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="80%">
																			<tr>
																				<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 6px solid #FFFFFF;"><span> </span></td>
																			</tr>
																		</table>
																	</div>
																</td>
															</tr>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
															<tr>
																<td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:15px;">
																	<div style="font-family: sans-serif">
																		<div class="" style="font-size: 14px; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2;">
																			<p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><span style="font-size:17px;color:#000000;background-color:#ffffff;"> GST-ebook</span></p>
																		</div>
																	</div>
																</td>
															</tr>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" class="text_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
															<tr>
																<td class="pad" style="padding-left:10px;padding-right:10px;">
																	<div style="font-family: Arial, sans-serif">
																		<div class="" style="font-size: 14px; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2;">
																			<p style="margin: 0; font-size: 30px; mso-line-height-alt: 36px;">Encyclopedia of Indian GST Laws</p>
																		</div>
																	</div>
																</td>
															</tr>
														</table>
														<table border="0" cellpadding="10" cellspacing="0" class="text_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
															<tr>
																<td class="pad">
																	<div style="font-family: sans-serif">
																		<div class="" style="font-size: 14px; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2;">
																			<p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;">GST-ebook is content curation and continuing online Updating platform for professionals and beginners under GST Laws only.</p>
																		</div>
																	</div>
																</td>
															</tr>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" class="text_block block-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
															<tr>
																<td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
																	<div style="font-family: sans-serif">
																		<div class="" style="font-size: 14px; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 16.8px; color: #f9c253; line-height: 1.2;">
																		</div>
																	</div>
																</td>
															</tr>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" class="button_block block-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
															<tr>
																<td class="pad" style="padding-bottom:30px;padding-left:10px;padding-right:10px;text-align:left;">
																	<div align="left" class="alignment">
																		<!--[if mso]>
																		<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://gst-ebook.com/" style="height:50px;width:163px;v-text-anchor:middle;" arcsize="8%" stroke="false" fillcolor="#f9c253">
																			<w:anchorlock/>
																			<v:textbox inset="0px,0px,0px,0px">
																				<center style="color:#175df1; font-family:Arial, sans-serif; font-size:20px">
																					<![endif]--><a href="https://gst-ebook.com/" style="text-decoration:none;display:inline-block;color:#175df1;background-color:#f9c253;border-radius:4px;width:auto;border-top:0px solid #EFA70F;font-weight:undefined;border-right:0px solid #EFA70F;border-bottom:0px solid #EFA70F;border-left:0px solid #EFA70F;padding-top:5px;padding-bottom:5px;font-family:Cabin, Arial, Helvetica Neue, Helvetica, sans-serif;font-size:20px;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:20px;padding-right:20px;font-size:20px;display:inline-block;letter-spacing:normal;"><span dir="ltr" style="word-break:break-word;"><span data-mce-style="" dir="ltr" style=""><strong><span data-mce-style="" dir="ltr" style="line-height: 40px;">Visit Website</span></strong></span></span></span></a>
																					<!--[if mso]>
																				</center>
																			</v:textbox>
																		</v:roundrect>
																		<![endif]-->
																	</div>
																</td>
															</tr>
														</table>
													</td>
													<td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="50%">
														<table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
															<tr>
																<td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
																	<div align="center" class="alignment" style="line-height:10px"><img alt="Surprised Users" src="assets/images/emailer/FACES.gif" style="display: block; height: auto; border: 0; width: 325px; max-width: 100%;" title="Surprised Users" width="325"/></div>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						'.
						getSecondaryBody($isAdmin)
						.'
						<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
							<tbody>
								<tr>
									<td>
										<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
											<tbody>
												<tr>
													<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
														<div class="spacer_block" style="height:40px;line-height:40px;font-size:1px;"> </div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #175df1;" width="100%">
							<tbody>
								<tr>
									<td>
										<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; background-color: #175df1; width: 650px;" width="650">
											<tbody>
												<tr>
													<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 20px; padding-top: 15px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
														<table border="0" cellpadding="10" cellspacing="0" class="social_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
															<tr>
																<td class="pad">
																	<div align="center" class="alignment">
																		<table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="184px">
																			<tr>
																				<td style="padding:0 7px 0 7px;"><a href="javascript:;" target="_blank"><img alt="Facebook" height="32" src="assets/images/emailer/facebook2x.png" style="display: block; height: auto; border: 0;" title="Facebook" width="32"/></a></td>
																				<td style="padding:0 7px 0 7px;"><a href="javascript:;" target="_blank"><img alt="Twitter" height="32" src="assets/images/emailer/twitter2x.png" style="display: block; height: auto; border: 0;" title="Twitter" width="32"/></a></td>
																				<td style="padding:0 7px 0 7px;"><a href="javascript:;" target="_blank"><img alt="Instagram" height="32" src="assets/images/emailer/instagram2x.png" style="display: block; height: auto; border: 0;" title="Instagram" width="32"/></a></td>
																				<td style="padding:0 7px 0 7px;"><a href="javascript:;" target="_blank"><img alt="LinkedIn" height="32" src="assets/images/emailer/linkedin2x.png" style="display: block; height: auto; border: 0;" title="LinkedIn" width="32"/></a></td>
																			</tr>
																		</table>
																	</div>
																</td>
															</tr>
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
			</tbody>
		</table>
		<!-- End -->
	</body>
</html>';
}

function getSecondaryBody($isAdmin) {
	return 
	$isAdmin ? '
						<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
							<tbody>
								<tr>
									<td>
										<table align="center" border="1" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 400px;" width="400">
											<tbody>
												<tr>
													<td>Name:</td>
													<td>'. $_POST['name'] . '</td>
												</tr>
												<tr>
													<td>Email:</td>
													<td>'. $_POST['email'] . '</td>
												</tr>
												<tr>
													<td>Contact No:</td>
													<td>'. $_POST['mobile'] . '</td>
												</tr>
												<tr>
													<td>Description:</td>
													<td>'. $_POST['description'] . '</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
	'
	:
	'
						<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
							<tbody>
								<tr>
									<td>
										<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
											<tbody>
												<tr>
													<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
														<table border="0" cellpadding="0" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
															<tr>
																<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:20px;">
																	<div style="font-family: Arial, sans-serif">
																		<div class="" style="font-size: 14px; font-family: Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif; mso-line-height-alt: 16.8px; color: #393d47; line-height: 1.2;">
																			<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:18px;"><strong>Welcome!</strong></span></p>
																		</div>
																	</div>
																</td>
															</tr>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" class="divider_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
															<tr>
																<td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
																	<div align="center" class="alignment">
																		<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="10%">
																			<tr>
																				<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 3px solid #F9C253;"><span> </span></td>
																			</tr>
																		</table>
																	</div>
																</td>
															</tr>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
															<tr>
																<td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
																	<div style="font-family: Arial, sans-serif">
																		<div class="" style="font-size: 14px; font-family: Cabin, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 16.8px; color: #175df1; line-height: 1.2;">
																			<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:38px;"><strong>Thanks for contacting</strong></span></p>
																			<p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:38px;"><strong>Our team will be in touch with you</strong></span></p>
																		</div>
																	</div>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
	';
}
?>