<?php
    session_start();
    ob_start();
    $title = 'Ajouter des produits';
?>
            <h1>Ajouter des produits</h1>
            <form action="traitement.php" method="post">
            <?php if (isset($_SESSION['message'])): ?>
                    <?php
                    echo htmlspecialchars($_SESSION['message']); // affiche le message lors de l'ajout
                    unset($_SESSION['message']); // Supprime le message après affichage
                    ?>
                <?php endif; ?>
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
                <input type="hidden" name="action" value="add">
                <p>
                    <input type="submit" class="button" name="submit" value="Ajouter le produit">
                </p>
            </form>
            <?php         echo isset($_SESSION['compteurProduit']) ? "<p> <strong>Nombre de produit sélectionné(s) : ". $_SESSION['compteurProduit']."</strong></p>" : 0;
            $content = ob_get_clean();
            require_once 'template.php';?>