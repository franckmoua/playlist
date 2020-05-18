<?php 
require('models/Album.php');
require('models/Artist.php');

if($_GET['action'] == 'list'){
	$albums = getAllAlbums();
    $pageTitle='Liste de tous les albums';
	$view='views/albumList.php';
	//require('views/albumList.php');
}

elseif($_GET['action'] == 'new'){
    $artists = getAllArtists();
    $pageTitle='Ajouter un nouvel album ';
    $view='views/albumForm.php';
	//require('views/albumForm.php');
}

elseif($_GET['action'] == 'add'){
	
	if(empty($_POST['name'] || empty($_POST['artist_id']))){
		
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
        }
        if(empty($_POST['year'])){
            $_SESSION['messages'][] = 'Le champ année est obligatoire !';
        }
		if(empty($_POST['artist_id'])){
            $_SESSION['messages'][] = 'Le champ Artiste est obligatoire !';
        }
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=albums&action=new');
		exit;
	}
	else{
		$resultAdd = addAlbum($_POST);
		
		$_SESSION['messages'][] = $resultAdd ? 'Album enregistré !' : "Erreur lors de l'enregistrement de l'album ... :(";
		
		header('Location:index.php?controller=albums&action=list');
		exit;
	}
}

elseif($_GET['action'] == 'edit'){
    $pageTitle='Modification d\'un album ';
	$artists = getAllArtists();
	if(!empty($_POST)){
		if(empty($_POST['name']) || empty($_POST['year']) || empty($_POST['artist_id']) ){
		
			if(empty($_POST['name'])){
				$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
            }
            if(empty($_POST['year'])){
				$_SESSION['messages'][] = 'Le champ année est obligatoire !';
            }
            if(empty($_POST['artist_id'])){
				$_SESSION['messages'][] = 'Le champ artiste est obligatoire !';
            }
            
		
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=albums&action=edit&id=' . $_GET['id']);
			exit;
		}
		else{
			$result = updateAlbum($_GET['id'], $_POST);
			$_SESSION['messages'][] = $result ? 'album mis à jour !' : 'Erreur lors de la mise à jour... :(';
			header('Location:index.php?controller=albums&action=list');
			exit;
		}
	}
	else{
		if(!isset($_SESSION['old_inputs'])){
			if(isset($_GET['id'])){
				$album = getAlbum($_GET['id']);
				if($album == false){
					header('Location:index.php?controller=albums&action=list');
					exit;
				}
			}
			else{
				header('Location:index.php?controller=albums&action=list');
				exit;
			}
        }
        $artists = getAllArtists();
		$view='views/albumForm.php';
		//require('views/albumForm.php');
	}

}
elseif($_GET['action'] == 'delete'){
	if(isset($_GET['id'])){
		$result = deleteAlbum($_GET['id']);
	}
	else{
		header('Location:index.php?controller=albums&action=list');
		exit;
	}

	$_SESSION['messages'][] = $result ? 'album supprimé !' : 'Erreur lors de la suppression... :(';
	
	header('Location:index.php?controller=albums&action=list');
	exit;
}
