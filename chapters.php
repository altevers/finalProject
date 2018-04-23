<?php

include('config.php');
include('functions.php');

$gender = $user->getGender();

if(isset($gender)) {
    $sql = file_get_contents('sql/getChapters.sql');
    $params = array(
        'gender' => $gender
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $chapters = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else {
    $sql = file_get_contents('sql/getAllChapters.sql');
    $statement = $database->prepare($sql);
    $statement->execute();
    $chapters = $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	
	<title>NKU Recruitment Portal - Chapters</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="page">
        <nav class="navigation">
            <?php include('navigation.php'); ?>
        </nav>
        <h1>Chapters</h1>
		
		<p>Welcome to the Northern Kentucky University Greek Life Recruitment Portal.<br />
		Thank you for showing interest in our Greek Life community.<br />
        You are currently viewing all of NKU's
            <?php if($gender == "M"): ?>
                Fraternities.
            <?php elseif($gender == "F") : ?>
                Sororities.
            <?php else : ?>
                Greek Life Chapters.
            <?php endif; ?>
            <br>Click on any of the chapters below to view their information and recruitment schedule.
        </p>
		
        <table>
            <tr>
                <th colspan="2">
                    <?php if($gender == "M"): ?>
                        Interfraternal Council
                    <?php elseif($gender == "F") : ?>
                        Panhellenic Council
                    <?php else : ?>
                        All Chapters
                    <?php endif; ?>
                </th>
            </tr>
            <?php foreach($chapters as $chapter) : ?>
                <tr>
                    <td>
                        <a href="chapter.php?chapterID=<?php echo $chapter['chapterID'] ?>">
                            <img class="logo" src="<?php echo $chapter['logoURL'] ?>">
                        </a>
                    </td>
                    <td>
                        Chapter Name: <?php echo $chapter['chapterName'] ?><br>
                        Local Name: <?php echo $chapter['localName'] ?><br>
                        Founding Date: <?php echo $chapter['foundingDate'] ?>
                    </td>
                </tr>            
            <?php endforeach; ?>
            
        </table>
		
        <h3>More chapters will be added in the near future!</h3>
        
	</div>
</body>
    
    <?php echo $user->getMembership() ?>
    
<footer class="footer">
    <?php include('footer.php'); ?>
</footer>

</html>