<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
use Dompdf\Dompdf;

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

date_default_timezone_set('America/Manaus');


// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

function URL_ERP()
{
    //Resgister url protheus
    return $URL_ERP = "http://manrand1:5708/api/v1/";
}


// Register cors
require __DIR__ . '/../src/cors.php';
require __DIR__ . '/../src/utils/mail/email.php';
// Register routes
require __DIR__ . '/../src/models/horas/routes.php';
require __DIR__ . '/../src/models/marca/routes.php';

require __DIR__ . '/../src/models/categoria/routes.php';

require __DIR__ . '/../src/models/produto/routes.php';

require __DIR__ . '/../src/models/usuario/routes.php';

require __DIR__ . '/../src/models/cliente/routes.php';

require __DIR__ . '/../src/models/empresa/routes.php';

require __DIR__ . '/../src/models/endereco/routes.php';

require __DIR__ . '/../src/models/contato/routes.php';

require __DIR__ . '/../src/models/oferta/routes.php';

require __DIR__ . '/../src/models/cotacao/routes.php';


// Run app
$app->run();
