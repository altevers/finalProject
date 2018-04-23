<?php

include('config.php');
include('functions.php');

$chapterID = get('chapterID');

if($user->getMembership() == 3 || $user->isGuest()) {
    header('location: login.php');
}

$sql = file_get_contents('sql/getChapterInfo.sql');
$params = array(
	'chapterID' => $chapterID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$chapters = $statement->fetchAll(PDO::FETCH_ASSOC);

$chapter = $chapters[0];

$sql = file_get_contents('sql/getRecruitList.sql');
$params = array(
	'chapterID' => $chapterID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$recruits = $statement->fetchAll(PDO::FETCH_ASSOC);

function getComments($chapterID, $postedAbout, $database) {
    $sql = file_get_contents('sql/getComments.sql');
    $params = array(
        'chapterID' => $chapterID,
        'postedAbout' => $postedAbout
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $comments;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$content = $_POST['user-comment'];
    $postedAbout = $_POST['user-postedAbout'];
    $userID = $user->getUserID();

    $sql = file_get_contents('sql/addComment.sql');
	$params = array(
        'chapterID' => $chapterID,
        'postedAbout' => $postedAbout,
        'postedBy' => $userID,
        'content' => $content
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
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
        <a href="chapter.php?chapterID=<?php echo $chapterID ?>"><h1 class="title"><?php echo $chapter['chapterName'] ?></h1></a>
		<h3>Possible New Members:</h3>
        
        <?php foreach($recruits as $recruit) : ?>
            <?php echo $recruit['firstName'] . " " . $recruit['lastName'] ?>:<br>        
            <div class="commentarea">
                <?php $comments = getComments($chapterID, $recruit['userID'], $database); ?>
                <?php foreach($comments as $comment) : ?>
                    <p class="comment">"<?php echo $comment['content'] ?>"<br></p>
                <?php endforeach; ?>
                <form action="" method="POST">
                    <div class="form-element">
                        <input type="hidden" name="user-postedAbout" class="textbox" value="<?php echo $recruit['userID'] ?>" />
                        <textarea rows="4" cols="50" name="user-comment">Enter comment here...</textarea><br>
                        <input type="submit" class="button" value="Post Comment" />
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
        
		
	</div>
</body>
    
<footer class="footer">
    <?php include('footer.php'); ?>
</footer> 

</html>