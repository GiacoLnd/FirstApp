<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.4.0/remixicon.css" rel="stylesheet">$
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <title><?php echo $title ?></title>
    </head>
    <body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Ajouter des produits</a></li>
                <li><a href="recap.php">Récapitulatif</a></li>
            </ul>
        </nav>
    </header>
    <div id="wrapper">
        
        <?= $content ?>	
    
    </div>
    </body>
</html>