<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/styles.css">

    <title>Ajout de voiture</title>
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

    $reservations = ReservationController::getAllReservations();

}



if (isset($_SESSION['ajoutvoitureSuccess'])) {
    // Affichez un message d'alerte
    echo "<script type='text/javascript'>
            alert('La voiture a été ajoutée avec succès !');
          </script>";

 
    unset($_SESSION['ajoutvoitureSuccess']);
}

if( isset($_SESSION['ajoutvoitureErreur'])) {
    // Affichez un message d'alerte
    echo "<script type='text/javascript'>
            alert".$_SESSION['ajoutvoitureErreur'].";);
          </script>";

    unset($_SESSION['ajoutvoitureErreur']);
}

// Sidebar
require_once ($_SERVER['DOCUMENT_ROOT'] . '/pages/struct/sidebar-admin.php');

?>

<!-- MAIN -->

<section id="content-dashboard">
<nav>
            <i class="icon fa fa-menu"></i>
            <h4 class="texte">Tableau de bord Car Showcase</h4>
        </nav>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Ajout de véhicule</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li>
                            <i class="icon fas fa-chevron-right "></i>
                            
                        </li>
                        <li>
                        <a href="../admin/dashboard_car.php" class="active">
                                Véhicules
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="table-data">
                <div class="table-content">
                    <div class="head">
                        <h3>Ajouter une voiture</h3>

                    </div>
                
        <form  action="/routes/car.php?action=add" method="POST" enctype="multipart/form-data">
            <div class="form-group">
               
                    <label  for="brand">Marque</label>
                    <div class="custom-select" style="width:200px;">
                            <select required style="font-size: 18px ; padding: 6px 5px; margin: 5px 0px" name="brand"
                                id="" class="form-control">
                                <option value="Toyota">Toyota</option>
                                <option value="Mitshubishi">Mitshubishi</option>
                                <option value="Honda">Honda</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Izuzu">Izuzu</option>
                                <option value="Daihatsu">BMW </option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Mercedes">Mercedes</option>
                            </select><br>
                        </div>
              

                
                    <label  for="model">Modele</label>
                    <input  required type="text" id="model" name="model"  placeholder="Modele"><br />
           

         
                    <label  for="kilometrage">Kilométrage</label>
                    <input  type="number" min=0  id="kilometrage" name="kilometrage"  placeholder="Kilometrage"><br /><br>
                

              
                    <label  for="description">Description</label>
                    <input required class="" maxlength="255" max=255 type="text" id="description" name="description"  placeholder="Description"><br /> <br>
        

              
                <label class="" for="vitesse">Boîte de vitesse</label>

                    <div class="choices">
                <label for="vitesse">Manuelle</label>
                        <input type="radio" id="manuelle" name="vitesse" value=1
                            class="radio">
                       
                            <label for="vitesse">Automatique</label>
                        <input type="radio" id="automatique" name="vitesse" value=0
                            class="radio">
                       
                </div>
                
             

                
                    <label class="" for="year">Année</label>
                    <input required min=1900 class="" type="number" id="year" name="year"  placeholder="Year"><br /><br>
               

              
                    <label class="label" for="image">Image</label>
                    <input required type="file" name="image"><br><br>
              

               
                    <label class="" for="prix">Prix/jour</label>
                    <input required min=0 class="" type="number" id="prix" name="prix"  placeholder="Prix"><br><br>
                

                
                    <label class="" for="ville">Ville</label>
                    <input required  class="" type="text" id="ville" name="ville"  placeholder="Ville"><br><br>
            

             
                <label class="label" for="disponibilite">Disponibilité</label>

                    <div class="choices">
                    <label for="disponibilite">OUI</label>
                        <input required type="radio" id="oui" name="disponibilite" value=1
                            class="radio">
                      
                            <label for="disponibilite">NON</label>
                        <input required type="radio" id="non" name="disponibilite" value=0
                            class="radio">
                     
              
                </div>
               
            </div>

            <button type="submit" >Ajouter ma voiture</button>
        </form>
   



                </div>
            </div>
        </main>

</section>

  


</body>
</html>

