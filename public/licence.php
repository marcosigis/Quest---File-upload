<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){     
    $uploadDir = 'uploads/';

    $tempName = explode(".", $_FILES["avatar"]["name"]);
    $newName = round(microtime(true)) . '.' . end($tempName);


    $uploadFile = $uploadDir . $newName;
    //$uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg','jpeg','png', 'webp', 'gif'];
    $maxFileSize = 1000000;
    
    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png ou webp ou gif!';
}

    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    if (isset($errors)) {
        echo "<h1>" . $errors[0] . "</h1>";
        
        var_dump($errors);
        var_dump($_FILES);
    } else {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
        var_dump($_FILES);

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<img src="uploads/<?= $newName ?>">

</body>
</html>

