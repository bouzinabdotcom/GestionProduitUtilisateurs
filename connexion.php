<?php

    session_start();
    if(isset($_POST["login"]) && isset($_POST["pwd"])) {
        $login = $_POST["login"];
        $pwd = $_POST["pwd"];

        $con = mysqli_connect("localhost", "root", "", "devoir");

        if (!$con) {
            die("Connexion non reussite: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM user WHERE login = '" . $login . "';" ; //cela est dangereux (SQL Injection Attack)
        
        $res = mysqli_query($con, $query);

        

        if (mysqli_num_rows($res) > 0) {
            while($user = mysqli_fetch_assoc($res)) {
                if($pwd != $user["pwd"]) {
                    echo "Mot de passe ou login incorrecte!";
                }
                else {
                    $_SESSION["user_id"] = $user["iduser"];
                    $_SESSION["login"] = $login;
                    $_SESSION["role"] = $user["role"];
                    header("Location: acceuil.php");
                }
            }
        } else {
            echo "Mot de passe ou login incorrecte!";
        }

        mysqli_close($con);

    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<body>
    <h3 style="text-align: center"><a href="acceuil.php">Acceuil</a> | <a href="connexion.php">Connexion</a></h3>

    <form action="connexion.php" method="post" style="margin-left: 45%;">
        <input type="text" placeholder="Login" name="login" style="display: block;">
        <input type="password" placeholder="Password" name="pwd" style="display: block;">
        <input type="submit" value="Connexion" style="display: block;">
    </form>

</body>
</html>