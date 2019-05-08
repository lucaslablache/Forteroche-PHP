<?php
/**
 * 
 */
class Vue
{
	//nom du fichier associé a la vue
	private $fichier;

	//titre de la vue
	private $titre;
	

	//détermination du nom du fichier a partir de l'action
	public function __construct($action)
	{
		$this->fichier = "Vue/vue" . $action . ".php";
	}

	//génération et affichage de la vue
	public function generer($donnees)
	{
		$contenu = $this->genererFichier($this->fichier, $donnees);

		$vue = $this->genererFichier('Vue/gabarit.php', array('titre' => $this->titre, 'contenu' => $contenu));

		echo $vue;
	}

	//Génere un fichier vue et renvoie le résultat
	private function genererFichier($fichier, $donnees)
	{
		if (file_exists($fichier)) 
		{
			// rend les elements du tableau $donnees accessibles dans la vue
			extract($donnees);

			//démarrage de la temporisation de sortie
			ob_start();

			//Inclut le fichier vue
			// Son résultat est placé dans le tampon de sortie
			require $fichier;

			// Arret de la temporisation et renvoie du tampon de sortie
			return ob_get_clean();
		}
		else
		{
			throw new Exception("Fichier '$fichier' introuvable");
			
		}
	}
}

?>