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

<form id="profile-form" method="post" action="../../routes/verif.php?id=update">
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" id="fistname" name="firstname" value="<?php echo htmlspecialchars($user->getFirstname()); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="lastname" value="<?php echo htmlspecialchars($user->getName()); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user->getPhone()); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" readonly>
        </div>

        <div class="choices">
            <input type="radio" id="loueur" name="role" value=1
            class="radio">
            <label for="loueur">Loueur</label>
            <input type="radio" id="client" name="role" value=0
                class="radio">
            <label for="client">Client</label>
        </div>

        <div class="button-container">
            <button type="button" class="edit" id="edit-button">Modifier</button>
            <button type="submit" class="save" id="save-button" style="display: none;">Enregistrer</button>
        </div>
</form>

<script>
    const editButton = document.getElementById('edit-button');
    const saveButton = document.getElementById('save-button');
    const inputs = document.querySelectorAll('#profile-form input');

    editButton.addEventListener('click', () => {
        inputs.forEach(input => input.removeAttribute('readonly'));
        editButton.style.display = 'none';
        saveButton.style.display = 'inline-block';
    });

    saveButton.addEventListener('click', () => {
        inputs.forEach(input => input.setAttribute('readonly', true));
    });
</script>

