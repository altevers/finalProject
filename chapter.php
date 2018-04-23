<?php

include('config.php');
include('functions.php');

$chapterID = get('chapterID');

$sql = file_get_contents('sql/getChapterInfo.sql');
$params = array(
	'chapterID' => $chapterID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$chapters = $statement->fetchAll(PDO::FETCH_ASSOC);

$chapter = $chapters[0];

$sql = file_get_contents('sql/getChapterSocial.sql');
$params = array(
	'chapterID' => $chapterID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$socials = $statement->fetchAll(PDO::FETCH_ASSOC);

$sql = file_get_contents('sql/getChapterEvents.sql');
$params = array(
	'chapterID' => $chapterID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$events = $statement->fetchAll(PDO::FETCH_ASSOC);

$subscriptions = $user->getSubscriptions();

$userID = $user->getUserID();
$responsibilityID = $user->getMembership();

$sql = file_get_contents('sql/getMembershipID.sql');
    $params = array(
        'userID' => $userID,
        'chapterID' => $chapterID
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $memberships = $statement->fetchAll(PDO::FETCH_ASSOC);

if(!empty($memberships)) {
    $membershipID = $memberships[0];
}
else {
    $membershipID = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch($_POST['form-action']) {
        case 'subscribe':
            if($membershipID == 0) {
                $chapterID = $_POST['user-subscribe'];

                $sql = file_get_contents('sql/makeMembership.sql');
                $params = array(
                    'userID' => $userID,
                    'chapterID' => $chapterID,
                    'responsibilityID' => $responsibilityID
                );
                $statement = $database->prepare($sql);
                $statement->execute($params);
            }
            else {
                $sql = file_get_contents('sql/updateMembership.sql');
                $params = array(
                    'membershipID' => $membershipID['membershipID'],
                    'active' => "Y"
                );
                $statement = $database->prepare($sql);
                $statement->execute($params);
            }
            header('location: chapters.php');
        break;
        case 'unsubscribe':
            $sql = file_get_contents('sql/updateMembership.sql');
            $params = array(
                'membershipID' => $membershipID['membershipID'],
                'active' => "N"
            );
            $statement = $database->prepare($sql);
            $statement->execute($params);

            header('location: chapters.php');
        break;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Greek Life: <?php echo $chapter['chapterName'] ?></title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="page">
        <nav class="navigation">
            <?php include('navigation.php') ?>
        </nav>
		<h1><?php echo $chapter['chapterName'] ?></h1>

        <?php if($user->getMembership() == 3 && !in_array($chapter['chapterID'], $subscriptions)) : ?> <!-- Subscribe -->
            <form action="" method="POST" class="subform">
                <input type="hidden" name="user-subscribe" class="textbox" value="<?php echo $chapterID ?>" />
                <input type="hidden" name="form-action" value="subscribe">
                <input type="submit" class="button" value="Subscribe to <?php echo $chapter['chapterName'] ?>"/>
            </form>
        <?php elseif($user->getMembership() == 3 && in_array($chapter['chapterID'], $subscriptions)) : ?> <!-- Unsubscribe -->
            <form action="" method="POST" class="subform">
                <input type="hidden" name="user-unsubscribe" class="textbox" value="<?php echo $chapterID ?>" />
                <input type="hidden" name="form-action" value="unsubscribe">
                <input type="submit" class="button" value="Unsubscribe from <?php echo $chapter['chapterName'] ?>"/>
            </form>
        <?php elseif($user->getChapterID() == 0 && $user->getMembership() == 2) : ?> <!-- Chapter Member without Chapter -->
            <form action="" method="POST" class="subform">
                <input type="hidden" name="user-subscribe" class="textbox" value="<?php echo $chapterID ?>" />
                <input type="hidden" name="form-action" value="subscribe">
                <input type="submit" class="button" value="I'm a Member of this Chapter"/>
            </form>
        <?php elseif($user->getChapterID() == $chapterID && ($user->getMembership() == 2 || $user->getMembership() == 1)) : ?> <!-- Chapter Member or Admin of current chapter -->
            <p class="subform">
                <a href="recruitList.php?chapterID=<?php echo $chapterID ?>"?><button class="button">View Possible New Members</button></a>
            </p>
        <?php elseif($user->getChapterID() != $chapterID && ($user->getMembership() == 2 || $user->getMembership() == 1)) : ?> <!-- Chapter Member or Admin of a different chapter -->
            <p>
                You are not a member of this chapter.
            </p>
        <?php else :?> <!-- Guest -->
            <p>You aren't currently signed in. You can't subscribe to chapter events before signing in or creating an account.</p>
        <?php endif; ?>
        
        <h2><?php echo $chapter['localName']; ?></h2><br>
        <h4 style="margin-top:-20px;"><?php echo $chapter['foundingDate']; ?></h4><br>
			<p>&nbsp;&nbsp;<?php echo $chapter['missionStatement']; ?></p>
        
        <!-- Insert Recruitment Video -->
        
        <table class="social">
            <tr>
                <th colspan="<?php echo sizeof($socials) ?>">Social Channels</th>
            </tr>
            <tr>
                <?php foreach($socials as $social) : ?>
                    <td>
                        <a href="<?php echo $social['url']?>" target="_blank">
                            <?php echo $social['platform'] ?>
                        </a>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
        
        <table>
            <tr>
                <th colspan="<?php echo sizeof($events) ?>">Recruitment Events</th>
            </tr>
            <tr>
                <?php foreach($events as $event) : ?>
                    <td>
                        <b><?php echo $event['title']; ?></b><br>
                        Date: <?php echo $event['eventDate']; ?><br>
                        Time: <?php echo $event['eventTime']; ?><br>
                        Place: <?php echo $event['location']; ?><br><hr>
                        <?php echo $event['description']; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
		
	</div>
</body>
    
<?php echo $membershipID['membershipID'] . " " . $userID . " " . $chapterID  . " " . $user->getMembership() ?>
    
<footer class="footer">
    <?php include('footer.php'); ?>
</footer>    
    
</html>