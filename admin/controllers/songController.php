<?php 
require('models/Album.php');
require('models/Artist.php');
require('models/Song.php');

if($_GET['action'] == 'list'){
	$songs = getAllSongs();
    $pageTitle='Liste de tous les chansons';
    $view='views/songList.php';
	//require('views/songList.php');
}

elseif($_GET['action'] == 'new'){
    $artists = getAllArtists();
    $albums = getAllAlbums();
    $pageTitle='Ajouter une chanson';
    $view='views/songForm.php';
	//require('views/songForm.php');
}

elseif($_GET['action'] == 'add'){
	
	if(empty($_POST['title']) || empty($_POST['artist_id']) ){
		
		if(empty($_POST['title'])){
			$_SESSION['messages'][] = 'Le champ titre est obligatoire !';
        }
		if(empty($_POST['artist_id'])){
            $_SESSION['messages'][] = 'Le champ Artiste est obligatoire !';
        }
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=songs&action=new');
		exit;
	}
	else{
		$resultAdd = addSong($_POST);
		
		$_SESSION['messages'][] = $resultAdd ? 'Chanson enregistré !' : "Erreur lors de l'enregistrement de la chanson ... :(";
		
		header('Location:index.php?controller=songs&action=list');
		exit;
	}
}

elseif($_GET['action'] == 'edit'){
    $pageTitle='Modification d\'un artiste';
    $artists = getAllArtists();
    $albums = getAllAlbums();
	if(!empty($_POST)){
		if(empty($_POST['title']) || empty($_POST['artist_id']) ){
		
			if(empty($_POST['title'])){
				$_SESSION['messages'][] = 'Le champ titre est obligatoire !';
            }

            if(empty($_POST['artist_id'])){
				$_SESSION['messages'][] = 'Le champ artiste est obligatoire !';
            }
            
		
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=songs&action=edit&id=' . $_GET['id']);
			exit;
		}
		else{
			$result = updateSong($_GET['id'], $_POST);
			$_SESSION['messages'][] = $result ? 'Chanson mise à jour !' : 'Erreur lors de la mise à jour... :(';
			header('Location:index.php?controller=songs&action=list');
			exit;
		}
	}
	else{
		if(!isset($_SESSION['old_inputs'])){
			if(isset($_GET['id'])){
				$song = getSong($_GET['id']);
				if($song == false){
					header('Location:index.php?controller=songs&action=list');
					exit;
				}
			}
			else{
				header('Location:index.php?controller=songs&action=list');
				exit;
			}
        }
        $songs = getAllSongs();
		$view='views/songForm.php';
		//require('views/songForm.php');
	}

}
elseif($_GET['action'] == 'delete'){
	if(isset($_GET['id'])){
		$result = deleteSong($_GET['id']);
		if(!empty($_POST['name']) || empty($_POST['artist_id'])){
            unlink('../playlist-mvc/assets/images/artist'. $artists['image']);
        }

	}
	else{
		header('Location:index.php?controller=songs&action=list');
		exit;
	}

	$_SESSION['messages'][] = $result ? 'Chanson supprimée !' : 'Erreur lors de la suppression... :(';
	
	header('Location:index.php?controller=songs&action=list');
	exit;
}
