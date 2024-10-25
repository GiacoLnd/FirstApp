<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
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
        <?php
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
                    "</tr>";
                $totalGeneral += $product['total']; // calcule le Montant Total des produits demandés selon variable total
            }
            echo "<tr>",
                    "<td colspan='4'>Total général :</td>", // fusionne les colonnes ensemble horizontalement
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>", // affiche le montant total en gras
                "</tr>",
            "</tbody>",
            "</table>";
            }

                
        ?>
    </body>
</html>