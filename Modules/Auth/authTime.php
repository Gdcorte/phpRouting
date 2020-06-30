<?php 
/**
 *  Developed by: Gustavo Diniz da Corte
 *  Email: gustavodacorte@gmail.com
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    YOU ARE NOT AUTHENTICATED, I WILL AUTHENTICATE YOU BASTARD!
    <?php echo "<br>" . $_SERVER['DOCUMENT_ROOT'] . "<br> AND TAKE YOU TO: " . $_SESSION['targetUri'] ; ?>
</body>
</html>