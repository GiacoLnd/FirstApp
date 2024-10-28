<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.4.0/remixicon.css" rel="stylesheet">
        <title>Récapitulatif des produits</title>
    </head>
    <header>
            <nav>
                <ul>
                    <li><a href="index.php">Ajouter des produits</a></li>
                    <li><a href="recap.php">Récapitulatif</a></li>
                </ul>
            </nav>
    </header>
    <body>
        <div id ="wrapper">
        <?php
            if (isset($_SESSION['message'])): ?>
                    <?php
                    echo htmlspecialchars($_SESSION['message']);
                    unset($_SESSION['message']); // Supprime le message après affichage
                    ?>
            <?php endif;
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {
                echo "<p> Aucun produit en session ...</p>";
                // Si aucun produit inséré, affiche Aucun produit en session ...
            }
            else {
                // sinon affiche un tableau avec ces titres et créé la variable montant total
                echo "<table>",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                            "</tr>",
                        "</thead>",
                        "<tbody>";
            $totalGeneral = 0;    
            // récupère dans une boucle les valeurs filtrées des variables entrées dans index.php
            foreach($_SESSION['products'] as $index => $product){
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>".$product['qtt']."</td>",
                        "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td> 
                        <form method='post' action='traitement.php' style='display:inline;'>
                            <input type='hidden' name='index' value='" . $index . "'> 
                                <button type='submit' name='action' value='decrease'> - </button>
                                <button type='submit' name='action' value='increase'> + </button>
                                <button type='submit' name='action' value='delete'><i class='ri-delete-bin-2-line'></i></button>
                        </form>
                        </td>",
                    "</tr>";
                $totalGeneral += $product['total']; // calcule le Montant Total des produits demandés selon variable total
            }
            echo "<tr>",
                    "<td colspan='4'>Total général :</td>", // fusionne les colonnes ensemble horizontalement
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>", // affiche le montant total en gras
                "</tr>",
            "</tbody>",
            "</table>";
            };?>
        <form method="post" action="traitement.php">
            <button type='submit' name='action' value='deleteAll'>Supprimer tous les produits</button>
        </form>
        <?php echo isset($_SESSION['compteurProduit']) ? "<p> Nombre de produit sélectionné(s)". $_SESSION['compteurProduit']."</p>" : 0;

                
        ?>
    </body>
</html>