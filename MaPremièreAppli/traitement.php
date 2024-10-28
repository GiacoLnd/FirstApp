<?php
session_start(); // Démarre la session permettant de garder les données dans index.php en mémoire


if(isset($_POST['action'])) {
    
    switch ($_POST['action']) {
        case 'add': 
            // Faille XSS (Cross Site Scripting) évitée - empêche l'utilisateur d'injecter du code client malveillant - filtre les données entrées pour ne ressortir sur recap.php que le type de donnée voulue
            $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $price = filter_input(INPUT_POST,'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // FILTER_FLAG_ALLOW_FRACTION permet à l'utilisateur de mettre . pour séparer float
            $qtt = filter_input(INPUT_POST, 'qtt', FILTER_SANITIZE_NUMBER_INT);

            if(!isset($_SESSION['compteurProduit'])) {
                $_SESSION['compteurProduit'] = 0;
            }

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
                $_SESSION ['products'][] = $product;  //j'array push ma variable product dans ma session
                $_SESSION['message'] = ucfirst($name)." a bien été ajouté à votre commande";
            }
        break;

        case 'decrease':   // implémentation de la suppression d'article particuliers
            $name = $_SESSION['products'][$_POST['index']]['name'];
            $index = $_POST['index'];
            if($index !== null && isset($_SESSION['products'][$index])) // vérifie si la quantité est supérieure à 1 - Ne fonctionnera pas si User tente de descendre à 0 ou moins
            {
                $_SESSION['products'][$index]['qtt']--; // Décrémente la quantité de 1
                if($_SESSION['products'][$index]['qtt'] == 0) {
                    unset($_SESSION['products'][$index]);
                    $_SESSION['products'] = array_values($_SESSION['products']);
                    $_SESSION['message'] = $name." a été supprimé.";
                }
            }
            break;
    

        case 'increase':
            $index = $_POST['index'];
            if(isset($_SESSION['products'][$index])){  
                $_SESSION['products'][$index]['qtt']++;  // incrémente la quantité au clic
            }
            break;

        case 'delete':
            $index = $_POST['index'];
            $name = $_SESSION['products'][$index]['name'];
            if(isset($_SESSION['products'][$index])){
                unset($_SESSION['products'][$index]); // supprime l'article uniquement grace à la variable $index
                $_SESSION['products'] = array_values($_SESSION['products']); // réindexe le tableau de produits
                $_SESSION['message'] = ucfirst($name)." supprimé";
            }
            break;

        case 'deleteAll':
            unset($_SESSION['products']); // supprime le tableau complet
            $_SESSION['message'] = "Tous les produits ont été supprimés.";
            break;
        }
    }

// implémentation du compteur de produits totaux
$_SESSION['compteurProduit'] = 0;
if (isset($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $product) {
        $_SESSION['compteurProduit'] += $product['qtt'];
    }
}


if ($_POST['action'] == 'deleteAll' || $_POST['action'] == 'decrease' || $_POST['action'] == 'increase' || $_POST['action'] == 'delete') {
    header("Location: recap.php");
} else {
header("Location: index.php");
}

?>
