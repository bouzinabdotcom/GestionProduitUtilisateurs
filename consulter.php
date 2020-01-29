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



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $produit["libelle"];?></title>
</head>
<body>


<h3 style="text-align: center">Bienvenue Mr/Mme <?php echo $login;?></h3>

<h3 style="text-align: center"><a href="acceuil.php">Acceuil</a> | <a href="ajouter.php">Ajouter | <a href="deconnexion.php">Deconnexion</a></h3>
    <?php
    echo "
    
    <table width=\"100%\">
        <tr>
            <td width=\"30%\">
                <img width =\"250px\" src=\"img/".$produit["img"]."\">
            </td>
            <td width=\"50%\">
                <h2>".$produit["libelle"]."</h2>
                <p style=\"font-size: 24px;\">".$produit["description"]."</p>
            </td>
            <td width=\"10%\">
                <p>".$produit["prix"]."DH</p>
            </td>

            <td> 
            <a style=\"display: block\" href=\"modifier.php?id=".$produit["idproduit"]."\">Modifier</a>
            <a style=\"display: block\" href=\"supprimer.php?id=".$produit["idproduit"]."\">Supprimer</a>
            
            </td>
        </tr>
    </table>
";
    ?>
</body>
</html>


<?php
    mysqli_close($con);

?>