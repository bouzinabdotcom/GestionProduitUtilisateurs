
<!--  

    Devoir PHP 3IIR3
    Effectue par:
        Elguennioui Adam
        Bouzinab Omar
        

    29/01/2020


-->

<?php
    session_start();

    if(isset($_SESSION["login"]) && isset($_SESSION["role"])) {
        $login = $_SESSION["login"];
        $role = $_SESSION["role"];
    }else{
        die("Erreur de connexion!");
    }

    $con = mysqli_connect("localhost", "root", "", "devoir");

    if (!$con) {
        die("Connexion non reussite: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM produit;" ; 
    
    $res = mysqli_query($con, $query);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceuil</title>
</head>
<body>
    <h3 style="text-align: center">Bienvenue Mr/Mme <?php echo $login;?></h3>

    <h3 style="text-align: center"><a href="acceuil.php">Acceuil</a> | <a href="ajouter.php">Ajouter <?php if($role == "admin") echo "| <a href=\"utilisateurs.php\">Utilisateurs";?> | <a href="deconnexion.php">Deconnexion</a></h3>

    <?php
        if (mysqli_num_rows($res) > 0) {
            while($produit = mysqli_fetch_assoc($res)) {
                echo "
                    <hr>
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
                            <a href=\"consulter.php?id=".$produit["idproduit"]."\">Consulter</a>
                            </td>
                        </tr>
                    </table>
                ";
            }
        }
    ?>

</body>
</html>
<?php 
    mysqli_close($con);

?>