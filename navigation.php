<html>
    
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="chapters.php">Chapters</a></li>
        <?php if($user->isGuest()) : ?>
            <li style="float:right"><a href="login.php">Login</a></li>
            <li style="float:right"><a href="signUp.php">Sign Up</a></li>
        <?php else : ?>
            <li style="float:right"><a href="logout.php">Logout</a></li>
            <li style="float:right"><a href="account.php">My Account</a></li>
        <?php endif; ?>
    </ul>
    
    <!--
    <p>
        <?php echo $user->getResponsibility(); ?><br>
        
        <?php if($user->isGuest() == FALSE) : ?>
            You are currently logged in as: <?php echo $user->getNKUID(); ?>
        <?php else : ?>
            You aren't currently logged in...
        <?php endif ?>
    </p>
    
    <a href="logout.php">Sign Out</a>
    -->

</html>