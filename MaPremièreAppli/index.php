<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Ajout Produit</title>
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
        <div id="wrapper">
            <h1>Ajouter des produits</h1>
            <form action="traitement.php" method="post"> <!-- méthode post // fait transiter données via requête - pas via URL -->
                <p>
                    <label >
                        Nom Du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p>
                    <label>
                        Prix :
                        <input type="number" step="any" name="price"> <!-- Step='any' permet d'insérer des floats -->
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée :
                        <input type="number" name="qtt" value ="1">  <!-- value="1" : fait commencer l'input number à 1 -->
                    </label>
                </p>
                <p>
                    <input type="submit" class="button" name="submit" value="Ajouter le produit">
                </p>
            </form>
        </div>
    </body>
</html>