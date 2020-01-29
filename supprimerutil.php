<?php
    session_start();

    if(isset($_GET["id"]) && isset($_SESSION["login"])) {
        $login = $_SESSION["login"];
        $iduser = $_GET["id"];
    }else{
        header('Location: connexion.php');
        die("Erreur de connexion!");
        
    }

    $con = mysqli_connect("localhost", "root", "", "devoir");

    if (!$con) {
        die("Connexion non reussite: " . mysqli_connect_error());
    }

    $query = "DELETE FROM user where iduser=\"".$iduser."\";" ; 
    
    $res = mysqli_query($con, $query);

    

    if($res = mysqli_query($con, $query)) {
        header("Location: acceuil.php");
    }
    else {
        echo "Erreur de base de donnees";
    }


    mysqli_close($con);
?>