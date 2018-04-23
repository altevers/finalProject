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
	
	<title>Greek Life: Northern Kentucky University</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="page">
        <nav class="navigation">
            <?php include('navigation.php'); ?>
        </nav>
		<h1>Northern Kentucky University</h1>
		
		<h3>Recruitment Portal</h3>
        
        <p>
            &nbsp;&nbsp;Use this portal to view information on all the chapters that are here at Northern Kentucky University. <a href="signUp.php">Sign Up</a> if you would like to keep track of what chapters you are interested in and to keep track of when their recruitments events are.
        </p>
        <p>
            &nbsp;&nbsp;Fraternities and sororities are the largest, most visible, and most active groups on the NKU campus. The Office of Fraternity and Sorority Life advises and supports our community of 19 total organizations (soon to be 21) along with the Inter-Fraternity Council, Panhellenic Council, and National Pan-Hellenic Council.
        </p>
        <p>
            &nbsp;&nbsp;Currently this portal only supports Interfraternal Council (IFC) and Panhellenic Council (PHC) chapters. Information regarding the National Panhellenic Council (NPHC) and National Association of Latino Fraternal Organizations (NALFO) can be found <a href="https://inside.nku.edu/greeklife.html" target="_blank">here</a>.
        </p>
        <div class="loginbox">
        <p style="text-align:center">
            Consider creating an account to take advantage of all this portal's features.<br>
            If you already have an account, be sure to login.
        </p>
            <form method="POST">
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
		
	</div>
    
</body>

<footer class="footer">
    <?php include('footer.php'); ?>
</footer>    
    
</html>