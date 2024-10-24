<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout Produit</title>
    </head>
    <body>
        <form action="traitement.php" method="post">
            <p>
                <label >
                    Nom Du produit :
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix :
                    <input type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value ="1"> 
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
    </body>
</html>