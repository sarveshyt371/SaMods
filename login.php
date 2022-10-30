<?php
session_start();
unset($_SESSION['user_logado']);
if (isset($_POST['username'])) {
	include 'dbconnection.php';
	
	$user = trim(isset($_POST['username']) ? $_POST['username'] : '');
	$pass = trim(isset($_POST['password']) ? $_POST['password'] : '');
	
	$userchecked = mysqli_real_escape_string($con, $user);
	$passchecked = mysqli_real_escape_string($con, $pass);
	
	$query = mysqli_query($con, "SELECT * FROM users WHERE username = '".$userchecked."' AND password = '".$passchecked."'");
	$check = mysqli_num_rows($query);
	if ($check == 1) {
		$_SESSION['user_logado'] = $userchecked;
		$det = mysqli_fetch_assoc($query);
		if ($det['type'] == "reseller") {
			header("Location: ".BASE_URL . "index_reseller");
		} else if ($det['type'] == "admin") {
			header("Location: ".BASE_URL . "index");
        } else if ($det['type'] == "cliente") {
            header("Location: ".BASE_URL . "index_cliente");
		} else {
			$_SESSION['acao'] = "Invalid User Type";
			session_destroy();
		}
	} else {
		$_SESSION['acao'] = "Incorrect Username Or Password";
	}
}
?>

<!DOCTYPE html>
<head>
<title>Login RxMods</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="https://rxmods.com/login.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<body>
<div class="login-box">
<h2>RxMods</h2>

<?php if (!empty($_SESSION['acao'])) { ?>

<div class="alert alert-danger d-flex align-items-center text-white" style="height: 18px; background-color:#9D48FF; border-color:#9D48FF" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
  <div>
   <?php echo $_SESSION['acao'];
									        unset($_SESSION['acao']);?>

  </div>
</div>
 <?php } ?>
<form action="" method="POST">
<div class="user-box">
<input required type="text" name="username" placeholder="Username" value="">
<label></label>
</div>
<div class="user-box">
<input required type="password" name="password" placeholder="Password" value="">
<label></label>
</div>
<button class="button" type="submit" name="RxSubmit"> <span></span>
<span></span>
<span></span>
<span></span>
Enter
</button>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/631aa77e37898912e968180a/1gcg1silu';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>

</html>
