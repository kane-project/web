<?php 

	session_start();
	
	if($slug == 'terms') $page = "Terms of Service";
	if($slug == 'privacy') $page = "Privacy Policy";

	include("header.php"); 
?>

<body>

	<?php include("navbar.php"); ?>

	<main id="main">

		<section class="intro-single">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="title-single-box">
							<h1 class="title-single"><?php echo $page; ?></h1>
							<?php 
								if($page == "Terms of Service") 
								{
									echo <<<_END
									<h3>KaneProject Rental Website - Terms and Conditions</h3>

									 <p>Welcome to KaneProject, a rental website designed to assist newcomers in finding suitable accommodations. These Terms and Conditions govern your use of the KaneProject website ("the Website"), provided to you by KaneProject LLC ("we", "us", "our"). By accessing or using our services, you agree to be bound by these Terms and Conditions. Please read them carefully before proceeding.</p>

									<h3>Acceptance of Terms:</h3>
									 <p>By accessing or using the Website, you agree to be bound by these Terms and Conditions and our Privacy Policy. If you do not agree to these terms, you may not use the Website.</p>

									<h3>Eligibility:</h3>
									 <p>You must be at least 18 years old to use the Website. By using the Website, you warrant that you are at least 18 years old and have the legal capacity to enter into these Terms and Conditions.</p>

									<h3>User Accounts:</h3>
									 <p>You may need to create an account to access certain features of the Website. You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete. You are responsible for maintaining the confidentiality of your account and password and for restricting access to your account, and you agree to accept responsibility for all activities that occur under your account.</p>

									<h3>Rental Listings:</h3>
									 <p>The Website facilitates the listing of rental properties by landlords and property managers. We do not own, inspect, or have any control over the listed properties. We do not guarantee the accuracy, completeness, or authenticity of the listings. Users are responsible for conducting their own due diligence before entering into any rental agreements.</p>

									<h3>User Conduct:</h3>
									 <p>You agree not to use the Website for any unlawful purpose or in any way that violates these Terms and Conditions. You agree not to use the Website to harass, abuse, defame, threaten, or otherwise violate the legal rights of others.</p>

									<h3>Intellectual Property:</h3>
									 <p>All content, features, and functionality of the Website, including but not limited to text, graphics, logos, icons, images, audio clips, and software, are the property of KaneProject LLC or its licensors and are protected by copyright, trademark, and other intellectual property laws.</p>

									<h3>Privacy:</h3>
									 <p>Your privacy is important to us. Our Privacy Policy explains how we collect, use, and disclose your personal information. By using the Website, you consent to the collection, use, and disclosure of your personal information as described in our Privacy Policy.</p>

									<h3>Disclaimer of Warranties:</h3>
									 <p>The Website is provided on an "as is" and "as available" basis, without any warranties of any kind, either express or implied. We do not warrant that the Website will be uninterrupted or error-free, that defects will be corrected, or that the Website or the servers that make it available are free of viruses or other harmful components.</p>

									<h3>Limitation of Liability:</h3>
									 <p>In no event shall KaneProject LLC, its officers, directors, employees, or agents be liable for any direct, indirect, incidental, special, or consequential damages arising out of or in any way connected with your use of the Website, whether based on warranty, contract, tort (including negligence), or any other legal theory.</p>

									<h3>Indemnification:</h3>
									 <p>You agree to indemnify and hold harmless KaneProject LLC, its officers, directors, employees, and agents from and against any claims, liabilities, damages, losses, and expenses, including without limitation, reasonable legal and accounting fees, arising out of or in any way connected with your use of the Website or your violation of these Terms and Conditions.</p>

									<h3>Changes to Terms:</h3>
									 <p>We reserve the right to modify these Terms and Conditions at any time. Any changes will be effective immediately upon posting on the Website. Your continued use of the Website after the posting of revised Terms and Conditions constitutes your acceptance of such changes.</p>

									<h3>Governing Law:</h3>
									 <p>These Terms and Conditions shall be governed by and construed in accordance with the laws of Ontario, Canada, without regard to its conflict of law principles.</p>

									<h3>Contact Us:</h3>
									 <p>If you have any questions or concerns about these Terms and Conditions, please contact us at info@kaneproject.ca.</p>

						
									
_END;
								} 
								
								else if($page == "Privacy Policy") 
								{
									echo <<<_END
									<h3>KaneProject Rental Website - Privacy Policy</h3>
                                     <p>This Privacy Policy explains how KaneProject LLC ("we", "us", "our") collects, uses, and discloses personal information when you use our website ("the Website"). By accessing or using the Website, you consent to the collection, use, and disclosure of your personal information as described in this Privacy Policy.</p>

    								<h3>Information We Collect</h3>
   									 <p><strong>Personal Information:</strong> When you create an account on our Website, we may collect personal information such as your name, email address, phone number, and any other information you choose to provide.</p>
    								 <p><strong>Usage Information:</strong> We may automatically collect certain information about your device and how you interact with our Website, including your IP address, browser type, operating system, and browsing activity.</p>
        							 <p><strong>Cookies:</strong> We may use cookies and similar tracking technologies to collect information about your browsing activity and preferences. You can control cookies through your browser settings and other tools.</p>

    								<h3>How We Use Your Information</h3>
    								 <p>We use the information we collect to provide, maintain, and improve our services, including customizing your experience and facilitating communication between users.</p>
    								 <p>We may use your email address to send you updates, newsletters, or other communications related to our services. You can opt out of receiving these communications at any time.</p>
    								 <p>We may use usage information and cookies to analyze trends, administer the Website, track users' movements around the Website, and gather demographic information about our user base.</p>

    								<h3>Disclosure of Your Information</h3>
    								 <p>We may share your personal information with third-party service providers who assist us in operating the Website, conducting our business, or servicing you, subject to appropriate confidentiality and security measures.</p>
    								 <p>We may disclose your personal information if required to do so by law or in response to valid legal requests, such as court orders or subpoenas.</p>

    								<h3>Data Security</h3>
    								 <p>We take reasonable measures to protect the security of your personal information against unauthorized access, disclosure, or alteration. However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.</p>

    								<h3>Children's Privacy</h3>
    								 <p>The Website is not intended for children under the age of 13. We do not knowingly collect personal information from children under the age of 13. If you are a parent or guardian and believe that your child has provided us with personal information, please contact us.</p>

    								<h3>Your Choices</h3>
    								 <p>You can update or correct your account information at any time by logging into your account settings.</p>
    								 <p>You can opt out of receiving promotional communications from us by following the unsubscribe instructions included in each communication or by contacting us directly.</p>
    								 <p>You can control cookies through your browser settings and other tools.</p>

    								<h3>Changes to this Privacy Policy</h3>
    								 <p>We reserve the right to modify this Privacy Policy at any time. Any changes will be effective immediately upon posting on the Website. Your continued use of the Website after the posting of revised Privacy Policy constitutes your acceptance of such changes.</p>

    								<h3>Contact Us</h3>
    								 <p>If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at info@kaneproject.ca.</p>



_END;
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
			
	</main>

	<?php include("footer.php"); ?>

</body>
</html>