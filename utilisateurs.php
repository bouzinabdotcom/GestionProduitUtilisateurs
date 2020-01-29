<?php
    session_start();

    if(!isset($_SESSION["login"])) {
        die("Erreur de connexion!");
    }

    $con = mysqli_connect("localhost", "root", "", "devoir");

    if (!$con) {
        die("Connexion non reussite: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM user;" ; 
    
    $res = mysqli_query($con, $query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Utilisateurs</title>
</head>
<body>

    <?php
        if (mysqli_num_rows($res) > 0) {
            while($user = mysqli_fetch_assoc($res)) {
                echo "
                    
                    <table width=\"100%\">
                        <tr>
                            <th style=\"text-align: left\"><b>Login</b></th>
                            <th style=\"text-align: left\"><b>Role</b></th>

                        </tr>

                        <tr>
                            <td width=\"30%\">
                                <p>".$user["login"]."</p>
                            </td>
                            <td width=\"30%\">
                                <p>".$user["role"]."</p>
                            </td>
                            <td width=\"10%\">
                                <a href=\"supprimerutil.php?id=".$user["iduser"]."\">Supprimer</a>
                            </td>
                            <td width=\"10%\">
                                <a href=\"modifierutil.php?id=".$user["iduser"]."\">Modifier</a>
                            </td>

                            
                        </tr>
                    </table>
                ";

                
            }
            echo "<a href=\"ajouterutil.php\">Ajouter</a>";
        }
    ?>
    
</body>
</html>

<?php mysqli_close($con)?>