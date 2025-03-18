<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/styles.css">

    <title>Dashboard</title>
</head>
<body>
<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');
if($_SESSION['user'] == null){
    header('Location: /pages/auth/login.php');
}
else{
    $user = unserialize($_SESSION['user']);
    if($user->getRole() != 1){
        header('Location: /pages/home.php');
    }
    if($user->getIsAdmin() == 1){
        $users = UserController::getAllUsers();

    }
else{
    header('Location: /pages/home.php');

}




}

// Sidebar
require_once ($_SERVER['DOCUMENT_ROOT'] . '/pages/struct/sidebar-admin.php');

?>
<section id="content-dashboard">

<nav>
            <i class="icon fa fa-menu"></i>

            <h4 class="texte">Tableau de bord Car Showcase</h4>
        </nav>
        <main>
        <div class="head-title">
        <div class="left">
            <h1>Véhicules</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <i class="icon fas fa-chevron-right "></i>
                    
                </li>
                <li>
                    <a href="../admin/dashboard_car.php" class="active">
                        Utilisateurs
                    </a>
                </li>
            </ul>
            <?php if (isset($_SESSION['deleteMessage'])): ?>
    <?php 
        // Décoder la chaîne JSON en tableau associatif
        $deleteMessage = json_decode($_SESSION['deleteMessage'], true);
    ?>
    <div id="alert-<?php echo $deleteMessage['success'] ? 'success' : 'error'; ?>" class="alert <?php echo $deleteMessage['success'] ? 'alert-success' : 'alert-error'; ?>">
        <?php echo $deleteMessage['message']; ?>
    </div>
    <?php unset($_SESSION['deleteMessage']); ?>
<?php endif; ?>

        </div>
        <a href="../admin/dashboard_add_admin.php">
            <button class="btn btn-download">
                <i class="icon fa-solid fa-user-tie"></i>
                <span class="text">Ajouter un admin</span>
            </button>
        
                
            </a>
    </div>
    <div class="table-data">
        <div class="table-content">
        <div class="head">
               
               <h3>Les utilisateurs</h3>
               <i class="fa-solid fa-magnifying-glass"></i>
               <i class="icon fa-solid fa-filter"></i>
   
       </div>
       <table>
        <thead>
        <tr>

            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Rôle</th>
            <th>Actions</th>
            </tr>

        </thead>
        <tbody>
            <?php foreach($users as $user):?>
            <tr>
                <td><?php echo $user->getFirstname();?></td>
                <td><?php echo $user->getName();?></td>
                <td><?php echo $user->getEmail();?></td>
                <td><?php echo $user->getPhone();?></td>
                <td>
                    <?php echo ($user->getRole() == 1)? 'Loueur' : 'Client simple';?>
                    <br>
                    <?php echo ($user->getIsAdmin() == 1)? 'Administrateur' : '';?>
                </td>
                <td class="action_btns">
                        <form action="" method="get">
                            <input type="hidden" name="id" value="<?php echo $user->getId();?>">
                            <button type="submit">
                            <i class="icon fa-solid fa-edit" style="color:green; font-size: 20px;"></i>
                            </button>
                        </form>
                        <button class="action_btn" onclick="showDeleteModal(<?php echo $user->getId(); ?>)">
                            <i class="icon fa-solid fa-trash" style="color:red; font-size: 20px;"></i>
                        </button>
                        <div id="deleteModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <p class="modal-title">Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                                <form class="modal-body" action="/routes/user.php?action=delete" method="POST">
                                    <input type="hidden" name="id" value="<?php $user->getId(); ?>">
                                    <button type="submit">Oui</button>
                                </form>
                            </div>
                        </div>
                    
                    </td>
            </tr>
            <?php endforeach;?>
        </tbody>
       </table>
        </div>
    </div>
        </main>
</section>




<script>
    // Fonction qui affiche une alerte avec animation
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.style.display = 'block'; // Affiche l'alerte
            alert.style.animation = 'fadeIn 0.5s forwards, fadeOut 0.5s forwards 4s';
            setTimeout(() => {
                alert.style.display = 'none'; // Cache l'alerte après 8 secondes
            }, 8000); // 8000 ms = 8 secondes
        }
    });



    function showDeleteModal(id) {
                                var modal = document.getElementById("deleteModal");
                                modal.style.display = "block";
                                var idInput = modal.querySelector("input[name='id']");
                                idInput.value = id;
                            }

                            function closeModal() {
                                var modal = document.getElementById("deleteModal");
                                modal.style.display = "none";
                            }
</script>