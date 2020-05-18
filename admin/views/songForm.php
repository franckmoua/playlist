

<?php if(isset($_SESSION['messages'])): ?>
	<div>
		<?php foreach($_SESSION['messages'] as $message): ?>
			<?= $message ?><br>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<a href="index.php?controller=artists&action=list">retourner à la liste des chansons</a><br><br>

<form action="index.php?controller=songs&action=<?= isset($song) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">

	<label for="title">titre :</label>
	<input  type="text" name="title" id="title" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['title'] : '' ?><?= isset($song) ? $song['title'] : '' ?>" /><br>
	
	<label for="artist_id">Artiste :</label>
	<select name="artist_id" id="artist_id">
		
		<?php foreach($artists as $artist): ?>
			<option value="<?= $artist['id']; ?>" <?php if(isset($song) && $song['artist_id'] == $artist['id']): ?>selected="selected"<?php endif; ?>><?= $artist['name']; ?></option>
		<?php endforeach; ?>
	
	</select><br>
    <label for="album_id">Album :</label>
	<select name="album_id" id="album_id">
		
		<?php foreach($albums as $album): ?>
			<option value="<?= $album['id']; ?>" <?php if(isset($song) && $song['album_id'] == $album['id']): ?>selected="selected"<?php endif; ?>><?= $album['name']; ?></option>
		<?php endforeach; ?>
	
	</select><br>
	
	
	<input type="submit" value="Enregistrer" />

</form>

</body>

</html>