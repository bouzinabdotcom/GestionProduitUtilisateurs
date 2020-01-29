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


    if(isset($_GET["Submit"])) {
        
        $query = "
            INSERT INTO user
            (login, pwd, role)
            VALUES(\"".$_GET["login"]."\", \"".$_GET["pwd"]."\", \"".$_GET["role"]."\");
        ";

        echo $query;

        if(mysqli_query($con, $query)){
            header("Location: utilisateurs.php");
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
        
    <form style="margin-left: 45%;" action="ajouterutil.php" method="get">
        
        <input style="display: block" type="text" name="login" placeholder="Login">
        <input style="display: block" type="password" name="pwd" placeholder="Mot De Passe"> 
        <select name="role" >
            <option value="lecteur">Lecteur</option>
            <option value="admin">Admin</option>

        </select>
        <input style="display: block" type="submit" name="Submit" value="Ajouter"> 
        

    </form>
</body>
</html>


<?php
    mysqli_close($con); 
?>