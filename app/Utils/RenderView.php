<?php

namespace app\Utils;

class RenderView
{
	public static function view($templatePath, $data = []): void
	{
	
		$loader = new \Twig\Loader\FilesystemLoader("Public/");
		$twig = new \Twig\Environment($loader);

	    $template = $twig->load($templatePath . ".twig");
	    $template->display($data);
	}
}