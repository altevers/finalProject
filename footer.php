<html>
    <?php if($user->isGuest() == FALSE) : ?>
        You are currently logged in as: <?php echo $user->getNKUID(); ?>
    <?php else : ?>
        You aren't currently logged in...
    <?php endif ?>
</html>