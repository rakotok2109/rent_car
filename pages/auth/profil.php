<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/styles.css">

    <title>Mon profil</title>
</head>
<body>
<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');
if($_SESSION['user'] == null){
    header('Location: /pages/auth/login.php');
}
else{
    $user = unserialize($_SESSION['user']);
}
?>
<div class="container-informations">
    <p><?php echo htmlspecialchars($user->getFirstname()); ?></p>
    <p><?php echo htmlspecialchars($user->getName()); ?></p>
    <p><?php echo htmlspecialchars($user->getPhone()); ?></p>
    <p><?php echo htmlspecialchars($user->getEmail()); ?></p>
</div>

