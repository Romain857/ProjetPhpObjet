<?php
	session_start();

	include_once('class/autoload.php');
	$site = new page_base();
	$controleur=new controleur();
	$request = strtolower($_SERVER['REQUEST_URI']);
	$params = explode('/', trim($request, '/'));
    $params = array_filter($params);
	if (!isset($params[1]))
	{
		$params[1]='accueil';
	}
	switch ($params[1]) {
		case 'accueil' :
			$site->titre='Accueil';
			$site->js='accueil';
			$site-> right_sidebar=$site->rempli_right_sidebar();
			$site-> left_sidebar=$controleur->retourne_article($site->titre);
            $site-> total=$controleur->flux_rss("Le Monde", "https://www.lemonde.fr/planete/rss_full.xml");
            $site-> total=$controleur->flux_rss("Sciences & Avenir (Nature et Environnement)", "https://www.sciencesetavenir.fr/nature-environnement/rss.xml");
            #$site-> left_sidebar=$controleur->flux_rss("");
			$site->affiche();
			break;
        case 'departement' :
            $site->titre='Departement';
            $site-> total=$controleur->retourne_tableau($site->titre);
            $site->js='departement';
            $site->js='jquery.dataTables.min';
            $site->js='dataTables.bootstrap4.min';
            $site->css='dataTables.bootstrap4.min';
            $site->affiche();
            break;
		case 'connexion' :
			$site->titre='Connexion';
			$site->js='jquery.validate.min';
			$site->js='messages_fr';
			$site->js='tooltipster.bundle.min';
			$site->js='connexion';
            $site->js='all';
            $site->css='tooltipster.bundle.min';
            $site->css='all';
			$site-> right_sidebar=$site->rempli_right_sidebar();
			$site-> left_sidebar=$controleur->retourne_formulaire_login();
			$site-> left_sidebar=$controleur->retourne_modal_message();
			$site->affiche();
			break;
		case 'deconnexion' :
			$_SESSION=array();
			session_destroy();
			echo '<script>document.location.href="Accueil"; </script>';
			break;
		default: 
			$site->titre='Accueil';
			$site-> right_sidebar=$site->rempli_right_sidebar();
			$site-> left_sidebar='<img src="'.$site->path.'/image/erreur-404.png" alt="Erreur de liens">';
			$site->affiche();
			break;
	}	
	
?>