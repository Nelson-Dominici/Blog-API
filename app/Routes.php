<?php

$app->group("/post", function( $group )
{

	$postUserRouter = require "Entity/Post/PostUser/PostUserRouter.php";
	$postUserRouter($group);

	$group->group("/adm", function( $group )
	{

		$postAdmRouter = require "Entity/Post/PostAdm/PostAdmRouter.php";
		$postAdmRouter($group);

	})->add(new \app\Middlewares\Token\CheckCookieBlock());	

	$group->group("/comment", function( $group )
	{

		$postCommentRouter = require "Entity/Post/Comment/PostCommentRouter.php";
		$postCommentRouter($group);

	});	

});

$app->group("/user", function( $group )
{

	$userAccountRouter = require "Entity/User/Account/UserAccountRouter.php";
	$userAccountRouter($group);	

});