<?php
    session_start();

    if(isset($_GET["id"]) && isset($_SESSION["login"])) {
        $login = $_SESSION["login"];
        $idproduit = $_GET["id"];
    }else{
        header('Location: connexion.php');
        die("Erreur de connexion!");
        
    }

    $con = mysqli_connect("localhost", "root", "", "devoir");

    if (!$con) {
        die("Connexion non reussite: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM produit where idproduit=\"".$idproduit."\";" ; 
    
    $res = mysqli_query($con, $query);

    if(! (mysqli_num_rows($res) > 0)) {
        die("Produit n'existe pas!");
    }

    $produit = mysqli_fetch_assoc($res);

    if(isset($_GET["Submit"])) {
        $query = "
            UPDATE produit
            SET libelle = \"".$_GET["libelle"]."\", description=\"".$_GET["desc"]."\", prix = \"".$_GET["prix"]."\"
            WHERE idproduit = ".$idproduit.";
        ";

        if($res = mysqli_query($con, $query)){
            header("Location: acceuil.php");
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
        
    <form style="margin-left: 45%;" action="modifier.php" method="get">
        
        <input style="display: block" type="text" name="id" placeholder="id" value=<?php echo $idproduit?>>
        <input style="display: block" type="text" name="libelle" placeholder="Libelle">
        <input style="display: block" type="textarea" name="desc" placeholder="Description"> 
        <input style="display: block" type="text" name="prix" placeholder="Prix"> 
        <input style="display: block" type="submit" name="Submit" value="Modifier"> 
        

    </form>
</body>
</html>


<?php
    mysqli_close($con); 
?>