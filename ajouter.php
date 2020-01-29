<?php
    session_start();

    if(isset($_SESSION["login"])) {
        $login = $_SESSION["login"];
    }else{
        header('Location: connexion.php');
        die("Erreur de connexion!");
        
    }

    $con = mysqli_connect("localhost", "root", "", "devoir");

    if (!$con) {
        die("Connexion non reussite: " . mysqli_connect_error());
    }

    $path = "";
    if(!empty($_FILES['uploaded_file']))
    {

        $name = basename( $_FILES['uploaded_file']['name']);

        if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], "img/".$name)) {
        echo "L'image".  basename( $_FILES['uploaded_file']['name']). 
        " a ete bien ajouter";
        } else{
            echo "Erreur: essayer ulterieurement!";
        }
    }


    if(isset($_POST["Submit"])) {
        $query = "
            INSERT INTO produit
            (libelle, description, prix, img)
            VALUES(\"".$_POST["libelle"]."\", \"".$_POST["desc"]."\", \"".$_POST["prix"]."\", \"".$name."\");
        ";


        if(mysqli_query($con, $query)){
            //header("Location: acceuil.php");
        }else{
            echo "Erreur de base de donnees";
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier <?php echo $produit["libelle"] ?></title>
</head>
<body>

    <h3 style="text-align: center">Bienvenue Mr/Mme <?php echo $login;?></h3>

    <h3 style="text-align: center"><a href="acceuil.php">Acceuil</a> | <a href="ajouter.php">Ajouter | <a href="deconnexion.php">Deconnexion</a></h3>
        
    <form enctype="multipart/form-data" style="margin-left: 45%;" action="ajouter.php" method="post">
        
        <input style="display: block" type="text" name="libelle" placeholder="Libelle">
        <input style="display: block" type="textarea" name="desc" placeholder="Description">
        <input style="display: block" type="text" name="prix" placeholder="Prix"> 
        <input type="file" name="uploaded_file"></input>
        <input style="display: block" type="submit" name="Submit" value="Ajouter"> 
        

    </form>
</body>
</html>


<?php
    mysqli_close($con); 
?>