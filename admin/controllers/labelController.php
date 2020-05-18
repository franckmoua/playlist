<?php 
require('models/Label.php');

if($_GET['action'] == 'list'){
	$labels = getAllLabels();
    $pageTitle='Liste de tous les labels';
    $view='views/labelList.php';
	//require('views/labelList.php');
}

elseif($_GET['action'] == 'new'){
    $pageTitle='Ajouter un nouvel label';
    $view='views/labelForm.php';
	//require('views/labelForm.php');
}

elseif($_GET['action'] == 'add'){
	
	if(empty($_POST['name'])){
		
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
		}
		
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=labels&action=new');
		exit;
	}
	else{
		$resultAdd = addLabel($_POST);
		
		$_SESSION['messages'][] = $resultAdd ? 'Label enregistré !' : "Erreur lors de l'enregistreent du Label ... :(";
		
		header('Location:index.php?controller=labels&action=list');
		exit;
	}
}

elseif($_GET['action'] == 'edit'){
    $pageTitle='Modification d\'un label';
	if(!empty($_POST)){
		if(empty($_POST['name'])){
		
			if(empty($_POST['name'])){
				$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
			}
		
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=labels&action=edit&id=' . $_GET['id']);
			exit;
		}
		else{
			$result = updateLabel($_GET['id'], $_POST);
			$_SESSION['messages'][] = $result ? 'label mis à jour !' : 'Erreur lors de la mise à jour... :(';
			header('Location:index.php?controller=labels&action=list');
			exit;
		}
	}
	else{
		if(!isset($_SESSION['old_inputs'])){
			if(isset($_GET['id'])){
				$label = getLabel($_GET['id']);
				if($label == false){
					header('Location:index.php?controller=labels&action=list');
					exit;
				}
			}
			else{
				header('Location:index.php?controller=labels&action=list');
				exit;
			}
		}
		$view='views/labelForm.php';
		//require('views/labelForm.php');
	}

}
elseif($_GET['action'] == 'delete'){
	if(isset($_GET['id'])){
		$result = deleteLabel($_GET['id']);
	}
	else{
		header('Location:index.php?controller=labels&action=list');
		exit;
	}

	$_SESSION['messages'][] = $result ? 'label supprimé !' : 'Erreur lors de la suppression... :(';
	
	header('Location:index.php?controller=labels&action=list');
	exit;
}

