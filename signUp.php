<?php

include('config.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nkuID = $_POST['nkuID'];
	$password = $_POST['user-password'];
	$firstName = $_POST['user-first'];
	$lastName = $_POST['user-last'];
	$email = $_POST['user-email'];
	$gender = $_POST['user-gender'];
    $role = $_POST['user-role'];
	
	$sql = file_get_contents('sql/createUser.sql');
	$params = array(
		'nkuID' => $nkuID,
		'password' => $password,
		'firstName' => $firstName,
		'lastName' => $lastName,
		'email' => $email,
        'membership' => $role,
		'gender' => $gender
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	
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
	
	<title>NKU Recruitment Portal</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="page">
        <nav class="navigation">
            <?php include('navigation.php'); ?>
        </nav>
		<h1>NKU Greek Recruitment Portal</h1>
		
		<form action="" method="POST">            
			<div class="form-element">
				<label>First Name:</label>
					<input type="text" name="user-first" class="textbox"  required/>
			</div>
			<div class="form-element">
				<label>Last Name:</label>
					<input type="text" name="user-last" class="textbox" required/>
			</div>
			<div class="form-element">
				<label>NKU ID:</label>
					<input type="text" name="nkuID" class="textbox" required/> <span style="color:#DB504A; font-size:small">* This will be used to log in.</span>
			</div>
			<div class="form-element">
				<label>Password:</label>
					<input type="password" name="user-password" class="textbox" required/>
			</div>
			<div class="form-element">
				<label>Email:</label>
					<input type="text" name="user-email" class="textbox" required/>
			</div>
            <div class="form-element">
				<label>Membership:</label>
					<input type="radio" name="user-role" class="radio" value="2" required/>Chapter Member
                    <input type="radio" name="user-role" class="radio" value="3" />Recruit
			</div>
			<div class="form-element">
				<label>Gender:</label>
					<input type="radio" name="user-gender" class="radio" value="M" required/>Male
					<input type="radio" name="user-gender" class="radio" value="F"/>Female
			</div>
			<div class="form-element" style="text-align:center;">
				<input type="submit" class="button" value="Sign Up" />
				<input type="reset" class="button" value="Clear Form" />
			</div>
		</form>
	</div>
</body>

<footer class="footer">
    <?php include('footer.php'); ?>
</footer>    
    
</html>