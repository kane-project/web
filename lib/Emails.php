<?php 

// Emails.php
// Manages sending emails to users
// Author: kiduswb

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class KaneMail
{
    public $previewText;
    public $greeting;
    public $message;
    public $linkForButton;
    public $buttonText;
    public $altLink;
    public $userID;
}

/**
 * send_transactional_email
 * Sends a transactional email to a user
 * Connected to AWS's SMTP server
 * $to_name: Name of the recipient
 * $to_email: Email address of the recipient
 * $subject: Subject of the email
 * $mailType: button?, long text?, alert? lol
 * $body: Body of the email
 * $altbody (optional): Alternative body of the email for non-HTML clients
 * @return bool
 */
function send_transactional_email($mailDetails, $name, $to_email, $subject, $mailType, $altbody = "")
{
    $mail = new PHPMailer(true);
    loadEnv();

    try 
    {
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USER'];
        $mail->Password   = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $_ENV['SMTP_PORT'];
        $mail->setFrom('no-reply@kaneproject.ca', 'KANE Project Notifications');
        $mail->addAddress($to_email, $name);
        $mail->addReplyTo('info@kaneproject.ca', 'KANE Project Mail');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = build_button_email($mailDetails);
        $mail->AltBody = $altbody;
        $mail->send();
    } catch (Exception $e) { 
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}"); 
        return false;
    }

    return true;
}

/**
 * send_internal_email
 * Sends an internal email (mostly contact forms) to the KANE Project team
 * @return bool
 */
function send_internal_email($name, $email, $subject, $message, $uid = 0) {
	$mail = new PHPMailer(true);
    loadEnv();

    try 
    {
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USER'];
        $mail->Password   = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $_ENV['SMTP_PORT'];
        $mail->setFrom('no-reply@kaneproject.ca', 'Contact Form Entry');
        $mail->addAddress('info@kaneproject.ca', 'info@kaneproject.ca');
        $mail->addReplyTo('info@kaneproject.ca', 'info@kaneproject.ca');
        $mail->isHTML(true);
        $mail->Subject = $subject;
		$uid_context = $uid != 0 ? "User ID: <a target='_blank' style='text-decoration:none;' href='/admin/user/$uid'></a>" : "";
        $mail->Body    = <<<_END
		<h3>New Contact Form Entry</h3>
		<p><strong>Name:</strong> $name</p>
		<p><strong>Email:</strong> $email</p>
		<p><strong>Message:</strong> $message</p>
		<p><strong>$uid_context</strong></p>
_END;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
    } catch (Exception $e) { 
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}"); 
        return false;
    }

    return true;
}

/**
 * build_transactional_email
 * Builds a transactional email
 * @param  KaneMail $mailDetails
 * @return string
 */
function build_button_email($mailDetails)
{
    return <<<_EMAIL
<!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>KANE Project Mail</title>
	<style media="all" type="text/css">
		@media all {
			.btn-primary table td:hover {
				background-color: #ec0867 !important;
			}

			.btn-primary a:hover {
				background-color: #ec0867 !important;
				border-color: #ec0867 !important;
			}
		}

		@media only screen and (max-width: 640px) {

			.main p,
			.main td,
			.main span {
				font-size: 16px !important;
			}

			.wrapper {
				padding: 8px !important;
			}

			.content {
				padding: 0 !important;
			}

			.container {
				padding: 0 !important;
				padding-top: 8px !important;
				width: 100% !important;
			}

			.main {
				border-left-width: 0 !important;
				border-radius: 0 !important;
				border-right-width: 0 !important;
			}

			.btn table {
				max-width: 100% !important;
				width: 100% !important;
			}

			.btn a {
				font-size: 16px !important;
				max-width: 100% !important;
				width: 100% !important;
			}
		}

		@media all {
			.ExternalClass {
				width: 100%;
			}

			.ExternalClass,
			.ExternalClass p,
			.ExternalClass span,
			.ExternalClass font,
			.ExternalClass td,
			.ExternalClass div {
				line-height: 100%;
			}

			.apple-link a {
				color: inherit !important;
				font-family: inherit !important;
				font-size: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
				text-decoration: none !important;
			}

			#MessageViewBody a {
				color: inherit;
				text-decoration: none;
				font-size: inherit;
				font-family: inherit;
				font-weight: inherit;
				line-height: inherit;
			}
		}
	</style>
</head>

<body
	style="font-family: Helvetica, sans-serif; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.3; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f4f5f6; margin: 0; padding: 0;">
	<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body"
		style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f4f5f6; width: 100%;"
		width="100%" bgcolor="#f4f5f6">
		<tr>
			<td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;
			</td>
			<td class="container"
				style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; max-width: 600px; padding: 0; padding-top: 24px; width: 600px; margin: 0 auto;"
				width="600" valign="top">
				<div class="content"
					style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 600px; padding: 0;">

					<!-- START CENTERED WHITE CONTAINER -->
					<span class="preheader"
						style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">
						$mailDetails->previewText
					</span>
					<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main"
						style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border: 1px solid #eaebed; border-radius: 16px; width: 100%;"
						width="100%">

						<!-- START MAIN CONTENT AREA -->
						<tr>
							<td class="wrapper"
								style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; box-sizing: border-box; padding: 24px;"
								valign="top">
								<p
									style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">
									$mailDetails->greeting</p>
								<p
									style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">
									$mailDetails->message</p>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0"
									class="btn btn-primary"
									style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%; min-width: 100%;"
									width="100%">
									<tbody>
										<tr>
											<td align="left"
												style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; padding-bottom: 16px;"
												valign="top">
												<table role="presentation" border="0" cellpadding="0" cellspacing="0"
													style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
													<tbody>
														<tr>
															<td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; border-radius: 4px; text-align: center; background-color: #0867ec;"
																valign="top" align="center" bgcolor="#0867ec"> <a
																	href="$mailDetails->linkForButton" target="_blank"
																	style="border: solid 2px #0867ec; border-radius: 4px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 16px; font-weight: bold; margin: 0; padding: 12px 24px; text-decoration: none; text-transform: capitalize; background-color: #0867ec; border-color: #0867ec; color: #ffffff;">
																$mailDetails->buttonText</a> </td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
								<p
									style="font-family: Helvetica, sans-serif; font-size: 13px; font-weight: normal; margin: 0; margin-bottom: 16px;">
									Can't click the button? Copy and paste this link into your browser - <a href="$mailDetails->altLink">$mailDetails->altLink</a></p>
							</td>
						</tr>

						<!-- END MAIN CONTENT AREA -->
					</table>

					<!-- START FOOTER -->
					<div class="footer" style="clear: both; padding-top: 24px; text-align: center; width: 100%;">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0"
							style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;"
							width="100%">
							<tr>
								<td class="content-block"
									style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center;"
									valign="top" align="center">
									<span class="apple-link"
										style="color: #9a9ea6; font-size: 16px; text-align: center;">The KANE Project, 160 Kendal Ave, Toronto, ON</span>
									<br><a href="https://kaneproject.ca/unsubscribe/$mailDetails->userID"
										style="text-decoration: underline; color: #9a9ea6; font-size: 16px; text-align: center;">Unsubscribe</a> |
										<a href="https://kaneproject.ca/legal/privacy"
										style="text-decoration: underline; color: #9a9ea6; font-size: 16px; text-align: center;">Privacy Policy</a>
								</td>
							</tr>
						</table>
					</div>
					<br><br><br>
					<!-- END FOOTER -->

					<!-- END CENTERED WHITE CONTAINER -->
				</div>
			</td>
			<td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;
			</td>
		</tr>
	</table>
</body>

</html>
_EMAIL;

}