<?php

include 'components/connect.php';

;

if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
} else {
	$user_id = '';
};

if (isset($_POST['send'])) {

	$name = $_POST['name'];
	$email = $_POST['email'];
	$number = $_POST['number'];
	$msg = $_POST['msg'];

	$select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
	$select_message->execute([$name, $email, $number, $msg]);

	if ($select_message->rowCount() > 0) {
		//   $message[] = 'already sent message!';
	} else {

		$insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
		$insert_message->execute([$user_id, $name, $email, $number, $msg]);

		//   $message[] = 'sent message successfully!';

	}
}

include 'components/header.php';
?>



	<section class="contact" style=" margin-left: 0%; ">

		<form action="" method="post" style=" margin-left: 0%; position: absolute; border-color: white; ">
			<h3>Leave a message</h3>
			<input type="text" name="name" placeholder="Enter your name " required maxlength="20" class="box">
			<input type="email" name="email" placeholder="Enter your adress email " required maxlength="50" class="box">
			<input type="number" name="number" min="0" max="9999999999" placeholder="Enter your number " required onkeypress="if(this.value.length == 10) return false;" class="box">
			<textarea name="msg" class="box" placeholder="Enter your message " cols="30" rows="10"></textarea>
			<input type="submit" style=" background-color: #FA6868; font-size: 18px; " value="Send message" name="send" class="btn">
		</form>

	</section>






	<!--main area-->
	<main id="main" class="main-site left-sidebar" style="margin-top: 20%;">

		<div class="container">


			<div class="row" style="  margin-top: -280px; margin-left: 40%;">
				<div class=" main-content-area">
					<div class="wrap-contacts ">
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							<div class="contact-box contact-info">
								<div class="wrap-map" style=" width: 100%; ">
									<div class="mercado-google-maps" id="az-google-maps57341d9e51968" data-hue="" data-lightness="1" data-map-style="2" data-saturation="-100" data-modify-coloring="false" data-title_maps="Kute themes" data-phone="088-465 9965 02" data-email="kutethemes@gmail.com" data-address="Z115 TP. Thai Nguyen" data-longitude="-0.120850" data-latitude="51.508742" data-pin-icon="" data-zoom="16" data-map-type="ROADMAP" data-map-height="263">
									</div>
								</div>
								<h2 class="box-title" style=" font-size: 18px">Contact Detail</h2>
								<div class="wrap-icon-box">

									<div class="icon-box-item">
										<i class="fa fa-envelope" aria-hidden="true"></i>
										<div class="right-info">
											<b>Email</b>
											<p>Contact@Marketly.com</p>
										</div>
									</div>

									<div class="icon-box-item">
										<i class="fa fa-phone" aria-hidden="true"></i>
										<div class="right-info">
											<b>Phone</b>
											<p>+212 697 1803</p>
										</div>
									</div>

									<div class="icon-box-item">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										<div class="right-info">
											<b>Mail Office</b>
											<p>Sed ut perspiciatis unde omnis<br />Street Name, Los Angeles</p>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div><!--end main products area-->

			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->


	<br></br>
	<br></br>

	<br></br>




	<?php include 'components/footer.php'; ?>


</body>

</html>