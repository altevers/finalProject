<?php

include('config.php');

include('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nkuID = $_POST['user-nkuID'];
	$password = $_POST['user-password'];
	
	$sql = file_get_contents('sql/login.sql');
	$params = array(
		'nkuID' => $nkuID,
		'password' => $password
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	if(!empty($users)) {
		$user = $users[0];
		
		$_SESSION['userID'] = $user['userID'];
		
		header('location: account.php');
	}
	
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Login</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
	<div class="page">
        <nav class="navigation">
            <?php include('navigation.php') ?>
        </nav>
		<h1>Login</h1>
        <form action="" method="POST">
            <table>
              <tr>
                <td><input type="text" name="user-nkuID" placeholder="NKU ID" /></td>
                <td><input type="password" name="user-password" placeholder="Password" /><br></td>
              </tr>
              <tr>
                <td style="text-align:right"><input type="submit" class="button" value="Log In" /></td>
                <td><a href="signUp.php"><button type="button" class="button">Sign Up</button></a></td>
              </tr>
            </table>
        </form>
	</div>
</body>
    
<footer class="footer">
    <?php include('footer.php'); ?>
</footer>    
    
</html>