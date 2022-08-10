<?php
include_once __DIR__. '/src/API/api.php';
include_once 'dashboard/user/authentication/user-signin.php';
include_once 'dashboard/superadmin/controller/select-settings-coniguration-controller.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="src/img/<?php echo $logo ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $SiteKEY ?>"></script>
    <link rel="stylesheet" href="src/css/login.css?v=<?php echo time(); ?>">
    <title>Sign In</title>
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="src/img/<?php echo $logo ?>" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Sign In</h4>
							<form action="dashboard/user/authentication/user-signin.php" method="POST" class="my-login-validation" novalidate="">
							<input type="hidden" id="g-token" name="g-token">
								<div class="form-group">
									<label for="email">E-mail</label>
									<input id="email" type="email" class="form-control" name="email" required autofocus>
									<div class="invalid-feedback">
										E-mail is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="public/user/forgot-password" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit"  id="submit" class="btn btn-primary btn-block" name="btn-signin">
										Sign In
									</button>
								</div>
							</form>
						</div>
					</div>
					<footer>&copy; <?php echo $system_copyright ?></footer>
				</div>
			</div>
		</div>
	</section>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="src/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="src/js/SigninForm.js"></script>
	<script>

		// CAPTCHA
			grecaptcha.ready(function() {
			grecaptcha.execute('<?php echo $SiteKEY ?>', {action: 'submit'}).then(function(token) {
				document.getElementById("g-token").value = token;
			});
			});

	</script>

	<!-- SWEET ALERT -->
	<?php

		if(isset($_SESSION['status']) && $_SESSION['status'] !='')
		{
			?>
			<script>
				swal({
				title: "<?php echo $_SESSION['status_title']; ?>",
				text: "<?php echo $_SESSION['status']; ?>",
				icon: "<?php echo $_SESSION['status_code']; ?>",
				button: false,
				timer: <?php echo $_SESSION['status_timer']; ?>,
				});
			</script>
			<?php
			unset($_SESSION['status']);
		}
	?>
</body>
</html>