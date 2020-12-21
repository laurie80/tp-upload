<!-- UPLOAD DE FICHIER AVEC PREVIEW PHP -->

<?php
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['fileToUpload']) and $_FILES['fileToUpload']['error'] == 0) {

    // Testons si le fichier n'est pas trop gros
    if ($_FILES['fileToUpload']['size'] <= 1024000) {


        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['fileToUpload']['name']);
        $extension_upload = mime_content_type($_FILES['fileToUpload']['tmp_name']);
        $extensions_autorisees = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];

        if (in_array($extension_upload, $extensions_autorisees)) {
            // On peut valider le fichier et le stocker définitivement
            $extensionFile = strrchr($_FILES["fileToUpload"]["name"], ".");
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'img/' . uniqid($_FILES['fileToUpload']['name']) . $extensionFile);

            echo '<script>alert("Votre dossier a bien été transféré !")</script>';
        } else {
            echo '<script>alert("Format non correspondant")</script>';
        }
    } else {
        echo '<script>alert("la taille de votre fichier est trop grande")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=e, initial-scale=1.0">
    <title>exo-binome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="uploadPreview/style.css">
</head>

<body>

    <!-- PARTIE HTML AVEC FORMULAIRE  -->

    <div class="container flex-column d-flex align-content-center justify-content-center">

        <p class="text-center h1 title mt-3">Veuillez choisir une image :</p>

        <div class="d-flex align-content-center justify-content-center">
            <img class="d-flex align-content-center justify-content-center" id="preview" src="">
        </div>

        <form class="m-auto d-flex align-content-center justify-content-center" action="index.php" method="post" enctype="multipart/form-data">

            <div>
                <input class="m-3 input1" type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="button d-flex justify-content-end align-content-end">
                <button class="btn btn-danger m-3" id="submit" type="submit">UPLOAD</button>
            </div>
            <div>
                <a href="galery.php" class="btn btn-danger" role="button"> Visitez la galerie <button class="btn btn-warning"><?php
                    $files = glob("img/*.*");
                    $compteur = count($files);
                    echo $compteur; ?></button></a>
            </div>
        </form>

    </div>

    <!-- LECTEUR AUDIO POUR INCLURE LA MUSIQUE -->

    <div class="m-auto d-flex align-content-center justify-content-center">
        <figure>
            <audio controls autoplay loop src="audio/mariah_carey.mp3">
            </audio>
        </figure>
    </div>

    <script src="uploadPreview/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

</body>

</html>