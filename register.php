<!DOCTYPE HTML>
<html>
	<head>
		<title>Registrati</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="pss.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body class="landing is-preload">
		<div id="page-wrapper">
			<header id="header">
				<a href="home.php" ><h2 style="color: white;">Exploit-me-now</h2></a>
				<nav id="nav">
					<ul>
						<li><a href="home.php">Home</a></li>
						<li><a href="login.php" class="button">Accedi</a></li>
					</ul>
				</nav>
			</header>
			<section id="main" class="container">
				<div class="row">
					<div class="col-12">
						<section class="box">
							<div class="row gtr-uniform">
								<div class="col-12 col-12-mobile">
									<h2>Registra un nuovo account</h2>
								</div>
								<?php
									if (isset($_GET['error']) && $_GET['error'] != '') {
										echo '<div class="col-12 col-12-mobile">
									<h3 class="error">'.$_GET['error'].'</h3>
								</div>';
									}
								?>
							</div>
							<br>
							<form action="confirmRegister.php" method="POST" enctype="utf8" class="row gtr-uniform">
								<div class="col-6 col-12-mobile">
									<label>Username:</label>
									<input type="text" autocomplete="username" id="username" name="username" placeholder="il tuo username" required/>
								</div>
								<div class="col-6 col-12-mobile">
									<label>Password (minimo 8 caratteri - di cui almeno una lettera e un numero):</label>
									<input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autocomplete="new-password" placeholder="8 caratteri minimo" minlength="8" required/>
								</div>
								<div class="col-6 col-12-mobile">
									<label>Confema Password:</label>
									<input type="password" id="cpassword" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="8 caratteri minimo" minlength="8" required/>
								</div>
								<div class="col-6 col-12-mobile">
									<br>
									<br>
									<input type="checkbox" id="mostra" name="mostra" onclick="viewPass()"/>
									<label for="mostra"> Mostra password </label>
								</div>
								<div class="col-12 col-12-mobile" id="message">
									<h3>La password deve avere almeno:</h3>
									<h4 id="letter" class="invalid"><i id="m1" class='far fa-times-circle fa-2x'></i> Una lettera minuscola</h4>
									<h4 id="capital" class="invalid"><i id="c1" class='far fa-times-circle fa-2x'></i> Una lettera maiuscola</h4>
									<h4 id="number" class="invalid"><i id="n1" class='far fa-times-circle fa-2x'></i> Un numero</h4>
									<h4 id="length" class="invalid"><i id="l1" class='far fa-times-circle fa-2x'></i> Avere minimo 8 caratteri</h4>
								</div>
								<div class="col-12 col-12-mobile">
									<input type="submit" value="Registrati"/>
								</div>
							</form>
							<div class="col-12 col-12-mobile"><hr></div>
						</section>
					</div>
				</div>
			</section>
		</div>
		<script>
		
function viewPass() {
    let x = document.getElementById("password");
    if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
		
let myInput = document.getElementById("password");
let letter = document.getElementById("letter");
let capital = document.getElementById("capital");
let number = document.getElementById("number");
let length = document.getElementById("length");
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}
myInput.onkeyup = function() {
  // Validate lowercase letters
  let lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
	$("#m1").removeClass("fa-times-circle");
	$("#m1").addClass("fa-check-circle");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
	$("#m1").addClass("fa-times-circle");
	$("#m1").removeClass("fa-check-circle");
}
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
	$("#c1").removeClass("fa-times-circle");
	$("#c1").addClass("fa-check-circle");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
	$("#c1").addClass("fa-times-circle");
	$("#c1").removeClass("fa-check-circle");
  }
  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
	$("#n1").removeClass("fa-times-circle");
	$("#n1").addClass("fa-check-circle");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
	$("#n1").addClass("fa-times-circle");
	$("#n1").removeClass("fa-check-circle");
  }
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
	$("#l1").removeClass("fa-times-circle");
	$("#l1").addClass("fa-check-circle");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
	$("#l1").addClass("fa-times-circle");
	$("#l1").removeClass("fa-check-circle");
  }
}
</script>
		<?php include 'bottom.inc';?>
	</body>
</html>