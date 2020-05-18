<!doctype html>
<html lang="en">
<head>
    <title><?= $pageTitle; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="afficher description de la page">
</head>
<body>
<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<div>
    <?php require ($view); ?>


</div>
</body>
</html>