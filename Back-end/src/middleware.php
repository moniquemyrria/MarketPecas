<?php
// Application middleware
use Slim\Http\Request;
use Slim\Http\Response;

// e.g: $app->add(new \Slim\Csrf\Guard);


// $app->add(function (Request $request, Response $response, $next) {
//     $uri = $request->getUri();
//     if($uri->getScheme() !== 'https') {
//         // Map http to https
//         $httpsUrl = $uri->withScheme('https')->withPort(443)->__toString();

//         // Redirect to HTTPS Url
//         return $response->withRedirect($httpsUrl);
//     }

//     return $next($request, $response);
// });