<?php
$user = new User($_SESSION['userEmail']);
//require_once 'Story.php';
if (isset($_GET['logout']) && $_GET['logout'] == 'true')
    User::logout();
if (isset($_GET['unregister']) && $_GET['unregister'] == 'true') {
    $user->unregister();
}
?>
<a href="?logout=true<?php echo $user->getUserId(); ?>">LogOut</a><br />
<a href="?unregister=true&id=">unregister</a>
<br />
<br />
<br />