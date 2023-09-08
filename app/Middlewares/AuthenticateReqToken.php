<?php

namespace app\Middlewares;

use Firebase\JWT;
use app\Entitys\Users;
use app\Helpers\SendJson;
use app\Helpers\EntityManagerHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthenticateReqToken
{

    public function __invoke(Request $req, RequestHandler $handler): Response
    {

    	$headers = $req->getHeaders();

    	$tokenPayload = $this->authenticateJWT($headers);

		if (!$tokenPayload) {

			return SendJson::send([
			    "success" => false,
				"data" => ["message" => "Invalid token"]
			], 401);

		}

		$user = $this->checkUserExists($tokenPayload->userUuid);
		
		if (!$user) {
			
			return SendJson::send([
			    "success" => false,
				"data" => ["message" => "Invalid token"]
			], 401);

		}

		$req = $req->withAttribute("payload", $tokenPayload);

	  	return $handler->handle($req);

    }

    private function authenticateJWT(array $headers): false|object
    {

		if (!empty($headers["authorization"])) {

			try {

				$token = $headers["authorization"][0];
				return JWT\JWT::decode($token, new JWT\Key($_ENV["JWT_KEY"], "HS256"));
			
			} catch (\Exception $e) {

				return false;
			}	

		}

		return false;
    
    }

    private function checkUserExists(string $userUuid): ?object
    {

		$entityManager = EntityManagerHelper::getEntityManager();
		$usersRepository = $entityManager->getRepository(Users::class);
		
		$user = $usersRepository->findOneBy([
		    "uuid" => $userUuid
		]);

		return $user;
    
    }

}