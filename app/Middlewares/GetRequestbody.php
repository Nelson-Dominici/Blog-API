<?php

namespace app\Middlewares;

use Psr\Http\Message\{
    ResponseInterface as Response,
    ServerRequestInterface as Request
};

use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class GetRequestbody
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $contentType = $request->getHeaderLine("Content-Type");

        if (strstr($contentType, "application/json")) {
         
            $contents = json_decode(file_get_contents("php://input"), true);

            if ($contents !== null) {

                $contents = array_map( function( mixed $value )
                {

                    $value = is_string($value) ? trim($value) : $value;
                    return $value;

                }, $contents);
            }
            
            if (json_last_error() === JSON_ERROR_NONE) {
                $request = $request->withParsedBody($contents);
            }
        }

        return $handler->handle($request);
    }
}