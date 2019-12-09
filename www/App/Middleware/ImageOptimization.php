<?php
namespace App\Middleware;
/**
 * 
 */

class ImageOptimization
{
	
	function addTitle($content){
		$researchs = [
			'repartition__epargne_des_francais.jpg"' <= "les produits d'épargne sans risque préférés des français"
		];
		for ($i=0; $i < count($researchs) ; $i++) { 
			$replace = $researchs[$i][0].' title="'.$researchs[$i][1].'" ';
			$content = str_replace($researchs[$i][0], $replace, $content);
		}
		return $content;
	}
}


?>