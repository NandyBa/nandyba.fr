<?php
namespace Framework;

#Use
use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;
use \GuzzleHttp\Psr7\Response;

class App
{
    public function run(ServerRequestInterface $request): Response
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[-1] === "/") {
            return (new Response())->withStatus(301)->withHeader('Location', substr($uri, 0, -1));
        }
        if ($uri === '/blog') {
            return new Response(200, [], '<h1>Bienvenue sur le Blog</h1>');
        }
        return new Response(404, [], '<h1>Erreur 404</h1>');
    }
}
