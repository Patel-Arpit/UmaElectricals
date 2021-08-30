<?php
require('top.php');
if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] == 'yes') {
?>
	<script>
		window.location.href = 'my_order.php';
	</script>
<?php } ?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('media/cate_img/back.jpg') no-repeat scroll center center / cover ;">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
							<a class="breadcrumb-item" href="index.php">Home</a>
							<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							<span class="breadcrumb-item active">Login/Register</span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->

<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="contact-form-wrap mt--60">
					<div class="col-xs-12">
						<div class="contact-title">
							<h2 class="title__line--6">Login</h2>
						</div>
					</div>
					<div class="col-xs-12">
						<form id="login-form" method="post">
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="email" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
								</div>
								<span class="field_error" id="login_email_error"></span>
							</div>
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
									<input type="password" name="reset_password" id="reset_password" placeholder="Reset Your Password*" style="width:60%">
									<button type="button" onclick="reset_send_otp()" class="fv-btn btn_send_otp login_btns">send OTP</button>

								</div>
								<div class="contact-box name submit_otp">
									<input type="text" id="set_otp" placeholder="OTP*" style="width: 30%" class="verify_otp">
									<button type="button" id="btn_verify_otp" class="fv-btn btn_verify_otp verify_otp login_btns">Verify OTP</button>
								</div>
								<span id="otp_field_error" class="field_error"></span>

								<span class="field_error" id="login_password_error"></span>

								<div class="forgot_password" onclick="forgot_password()">Forgot Password</div>
							</div>

							<div class="contact-btn">
								<button type="button" class="fv-btn" id="login_btn" onclick="user_login()">Login</button>

								<button type="button" class="fv-btn reset" id="update_password">Reset</button>
							</div>

						</form>
						<div class="form-output login_msg">
							<p class="form-messege field_error"></p>
						</div>
					</div>
				</div>

			</div>


			<div class="col-md-6">
				<div class="contact-form-wrap mt--60">
					<div class="col-xs-12">
						<div class="contact-title">
							<h2 class="title__line--6">Register</h2>
						</div>
					</div>
					<div class="col-xs-12">
						<form id="register-form" action="#" method="post">
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
								</div>
								<span class="field_error" id="name_error"></span>
							</div>
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="email" name="email" class="first_box" id="email" placeholder="Your Email*" style="width: 45%">
									<button type="button" onclick="send_otp()" class="fv-btn email_sent_otp first_box login_btns">Send OTP</button>
									<input type="text" id="email_otp" placeholder="OTP*" style="width: 30%" class="email_verify_otp second_box" required>
									<button type="button" onclick="submit_otp()" class="fv-btn email_verify_otp second_box login_btns">Verify OTP</button>
									<span id="email_otp_result"></span>
								</div>
								<span class="field_error" id="email_error"></span>
							</div>
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
								</div>
								<span class="field_error" id="mobile_error"></span>
							</div>
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
								</div>
								<span class="field_error" id="password_error"></span>
							</div>

							<div class="contact-btn">
								<button type="button" onclick="user_register()" class="fv-btn">Register</button>
							</div>
						</form>
						<div class="form-output register_msg">
							<p class="form-messege field_error"></p>
						</div>
					</div>
				</div>

			</div>

		</div>
</section>
<?php require('footer.php') ?>