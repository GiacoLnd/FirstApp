<?php
    session_start(); // Démarre la session permettant de garder les données dans index.php en mémoire

    if(isset($_POST['submit'])) {
        // Faille XSS (Cross Site Scripting) évitée - empêche l'utilisateur d'injecter du code client malveillant - filtre les données entrées pour ne ressortir sur recap.php que le type de donnée voulue
        $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST,'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // FILTER_FLAG_ALLOW_FRACTION permet à l'utilisateur de mettre . pour séparer float
        $qtt = filter_input(INPUT_POST, 'qtt', FILTER_SANITIZE_NUMBER_INT);


    // on peut utiliser quoi à part filter input? : htmlspecialchar 
    // ex : htmlspecialchar(INPUT_POST,'name')
    // filter_input mieux car possibilité de filtrer valeur
        if($name && $price && $qtt) { 
            // si la sanitisation s'est bien passé
            //Je créé un tableau associatif en récupérant les valeurs textuelles pour créer les différentes variables
            $product = [
                'name' => $name,
                'price' => $price,
                'qtt' => $qtt,
                'total' => $price * $qtt
            ];
            $_SESSION ['products'][] = $product;  //je array push ma variable product dans ma session 
        }
    }

    header("Location: index.php");

