
<body>

<?php if(isset($_SESSION['messages'])): ?>
    <div>
        <?php foreach($_SESSION['messages'] as $message): ?>
            <?= $message ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h2>ici la liste complète des artistes : </h2>

<a href="index.php?controller=artists&action=new">Ajouter un nouvel artiste</a>

<?php foreach($artists as $artist): ?>
    <p><?=  htmlspecialchars($artist['name']) ?>
        <a href="index.php?controller=artists&action=edit&id=<?= $artist['id'] ?>">modifier</a>
        <a href="index.php?controller=artists&action=delete&id=<?= $artist['id'] ?>">supprimer</a></p>
<?php endforeach; ?>


</body>
