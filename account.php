<?php

include('config.php');
include('functions.php');

if($user->isGuest()) {
    header('locaiton: login.php');
}

$userID = $user->getUserID();
$membership = $user->getMembership();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    switch($_POST['form-action']) {
        case 'register': 
            $membership = $_POST['user-membership'];
            $user->setMembership($membership);
            
            header('location: chapters.php');
        break;
        case 'update':
            $password = $_POST['user-password'];
            $email = $_POST['user-email'];
            $cellPhone = $_POST['user-phone'];
            $gpa = $_POST['user-gpa'];
            $classLevel = $_POST['user-class'];
            $highSchool = $_POST['user-highSchool'];

            $sql = file_get_contents('sql/updateUser.sql');
            $params = array(
                'password' => $password,
                'email' => $email,
                'cellPhone' => $cellPhone,
                'gpa' => $gpa,
                'classLevel' => $classLevel,
                'highSchool' => $highSchool,
                'userID' => $userID
            );
            $statement = $database->prepare($sql);
            $statement->execute($params);

            $user->setPassword($password);
            $user->setEmail($email);
            $user->setCellPhone($cellPhone);
            $user->setGPA($gpa);
            $user->setClassLevel($classLevel);
            $user->setHighSchool($highSchool);
            
            header('location: chapters.php');
        break;
    }
}

$sql = file_get_contents('sql/getSubscriptions.sql');
$params = array(
    'userID' => $user->getUserID()
);
$statement = $database->prepare($sql);
$statement->execute($params);
$chapters = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <title>Greek Life: My Account</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="page">
        <nav class="navigation">
            <?php include('navigation.php') ?>
        </nav>
		<h1>My Account</h1>
        
        <?php if(!isset($membership)) : ?>
            <form action="" method="POST">
                <input type="radio" name="user-membership" class="radio" value="3" required/>Recruit
                <input type="radio" name="user-membership" class="radio" value="2"/>Chapter Member
                <input type="hidden" name="form-action" value="register">
                <input type="submit" class="button" value="Register">
            </form>
        <?php else : ?>
            <p>You are currently registered as a(n) <?php echo $user->getResponsibility() ?>. Contact an Admin if this needs to be changed.</p>
        <?php endif; ?>

        <h3>
            <?php echo $user->getFirstName() . " " . $user->getLastName() ?>:
        </h3>
        
        <p>
            Here you can view and update your information as well as look at the upcoming events for the chapters that you are interested in!
        </p>
        
        <?php if($user->getMembership() == 3) : ?>
            <p>
                Visit Chapters' Pages to view their rush events.
            </p>
        <?php elseif($user->getChapterID() != 0 ) : ?>
            <p>
                Go to your Chapter's Page: <a href="chapter.php?chapterID=<?php echo $user->getChapterID() ?>"><?php echo $user->getChapter() ?></a>
            </p>
        <?php else : ?>
            <p>
                You are currently not associated with a Chapter. Be sure to visit your chapter's page and register as a member. <a href="chapters.php">Chapters.</a>
            </p>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="form-element">
                <label>First Name:</label>
                <input readonly type="text" name="user-first" class="textbox" value="<?php echo $user->getFirstName(); ?>" />
                <label>Last Name:</label>
                <input readonly type="text" name="user-last" class="textbox" value="<?php echo $user->getLastName(); ?>" />
                <label>NKU ID:</label>
                <input readonly type="text" name="nkuID" class="textbox" value="<?php echo $user->getNKUID(); ?>" />
            </div>
            <hr>
            <div class="form-element">
                <label>Password:</label>
                <input type="password" name="user-password" class="textbox" value="<?php echo $user->getPassword(); ?>" required />
            </div>    
            <div class="form-element">    
                <label>Email:</label>
                <input type="text" name="user-email" class="textbox" value="<?php echo $user->getEmail(); ?>" required />
            </div>
            <div class="form-element">    
                <label>Cell Phone:</label>
                <input type="text" name="user-phone" class="textbox" maxlength="10" value="<?php echo $user->getCellPhone(); ?>" />
            </div>
            <div class="form-element">    
                <label>Class Level:</label>
                <select name="user-class">
                    <option value="<?php echo $user->getClassLevel(); ?>" selected><?php echo $user->getClassLevel(); ?></option>
                    <option value="Freshman">Freshman</option>
                    <option value="Sophomore">Sophomore</option>
                    <option value="Junior">Junior</option>
                    <option value="Senior">Senior</option>
                </select>
            </div>    
            <div class="form-element">
                <label>GPA:</label> (On a 4.000 Scale)
                <input type="number" step=".001" name="user-gpa" class="textbox" value="<?php echo $user->getGPA(); ?>" />
            </div>
            <div class="form-element">    
                <label>High School:</label>
                <input type="text" name="user-highSchool" class="textbox" value="<?php echo $user->getHighSchool(); ?>" />
            </div>
            <div class="form-element">
                <input type="hidden" name="form-action" value="update">
                <input type="submit" class="button" value="Update">
            </div>
        </form>
		
	</div>
</body>
    
    <?php echo $user->getMembership()?>
    
<footer class="footer">
    <?php include('footer.php'); ?>
</footer>

</html>