<?php
#Partie vérification formulaire et écriture des messages.txt
    $messageErreur = "";
    #Utilisation de isset car il y a 2 submit
    if(isset($_POST["envoie"])) {
        #htmlspecialchars pour éviter que l'utilisateur ne fasse passer du code via les inputs
        $prenom = htmlspecialchars($_POST["prenom"]);
        $message = htmlspecialchars($_POST["message"]);
        #Utilisation de trim car "   " != "" 
        if (trim($prenom) == "" || trim($message) == "") {
            $messageErreur = "Tous les champs sont obligatoires.";
        }else {
            #Supression des espaces inutiles
            $ligne = '<p class="message">'. trim($prenom) . " | " . trim($message) . "</p>\n";
            file_put_contents("messages.txt", $ligne, FILE_APPEND);
        }
    }
?>

<?php
#Vide messages.txt lorsque le bouton clean est utilisé
    if(isset($_POST["cleanButton"])){
        if (file_exists("messages.txt")){
            file_put_contents("messages.txt", "");
        }
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Livre d'or</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="formulaire">
        <h1>Livre d'or</h1>
        <p style="color:red;" class = "message_erreur">
            <?php echo $messageErreur; ?>
        </p>
            <form method="POST" action="">
                <label>Prénom :</label><br>
                <input type="text" name="prenom"><br><br>

                <label>Message :</label><br>
                <textarea name="message"></textarea><br><br>
                <!--2 submit un pour ecrire un commentaire et un pour effacer tout les commentaires-->
                <button type="submit" name="envoie">Envoyer</button>
                <button type="submit" name="cleanButton">Clean</button>
            </form>
    </div>
    <div class="messages_container">
        <?php #Récupération sécurisé du contenu de messages.txt
            if(file_exists("messages.txt")){
                $file = file_get_contents("messages.txt");
                echo $file;
            }
        ?>
    </div>
</body>
</html>


