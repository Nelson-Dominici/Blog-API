<?php

namespace app\Entity\Contente\Services;

use app\Utils\AppException;
use app\DataBase\ConnectDB;

class SeePostService
{

	private static $containerTags = [
		"(h)" => "h2",
		"(p)" => "p",
		"(s)" => "strong"
	];

	private static $voidTags = [
		"(b)" => "br"
	];

	private static function putVoidTags($contente): string{
		
		foreach (self::$voidTags as $contTag => $htmlTag) {

			$pos = 0;
			$tag = "<".$htmlTag.">";

			while (($pos = strpos($contente, $contTag, $pos)) !== false) {

			    $contente = substr_replace($contente, $tag, $pos, strlen($contTag));
			    $pos = $pos + strlen($contTag);
			}

			return $contente;
		}
	}

	private static function putContainerTags($contente): string{

		foreach (self::$containerTags as $contTag => $htmlTag) {

			$pos = 0;
	
			$opening = false;
			$closure = false;

			while (($pos = strpos($contente, $contTag, $pos)) !== false) {

			    if(!$opening){
			        $opening = true;
			        $contente = substr_replace($contente, "<".$htmlTag.">", $pos, strlen($contTag));
			    }

			    else if($opening){
			        $opening = false;
			        $contente = substr_replace($contente, "</".$htmlTag.">", $pos, strlen($contTag));
			    }

			    $pos = $pos + strlen($contTag);
			}

		}

		return $contente;
	}

	public static function execute($urlParams): array|false{

		$sql = "SELECT title, contente, post_date FROM posts WHERE id = ?";

		$pdo = ConnectDB::connect()->prepare($sql);
		$pdo->bindValue(1, $urlParams["id"], \PDO::PARAM_INT);
		$pdo->execute();

		$result = $pdo->fetchAll(\PDO::FETCH_ASSOC);

		if(empty($result)){
			return false;
		}
		
		$contente = self::putContainerTags($result[0]["contente"]);
		$contente = self::putVoidTags($contente);

		return [
			"contente" => trim($contente),
			"title" => $result[0]["title"],
			"post_date" => $result[0]["post_date"]
		];
	}
}