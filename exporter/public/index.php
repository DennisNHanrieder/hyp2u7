<?php

declare(strict_types=1);

use Fhooe\Router\Router;
use Fhooe\Twig\RouterExtension;
use Fhooe\Twig\SessionExtension;
use HYP2UE07\CreateDB;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require "../vendor/autoload.php";

/**
 * When working with sessions, start them here.
 */
//session_start();

/**
 * Instantiated Router invocation. Create an object, define the routes and run it.
 */
// Create a new Router object.
$router = new Router();

// Create a monolog instance for logging in the skeleton. Pass it to the router to receive its log messages too.
$logger = new Logger("skeleton-logger");
$logger->pushHandler(new StreamHandler(__DIR__ . "/../logs/router.log"));
$router->setLogger($logger);

// Create a new Twig instance for advanced templates.
$twig = new Environment(
    new FilesystemLoader("../views"),
    [
        "cache" => "../cache",
        "auto_reload" => true,
        "debug" => true
    ]
);

// Add the router extension to Twig. This makes the url_for() and get_base_path() functions available in templates.
$twig->addExtension(new RouterExtension($router));
// Add the session extension to Twig. This makes the session() function available in templates to access entries in $_SESSION.
$twig->addExtension(new SessionExtension());
// Add the debug extension to Twig. This makes the dump() function available in templates to dump variables.
$twig->addExtension(new DebugExtension());

// Set a base path if your code is not in your server's document root.
// TODO: Set the correct base path for your team's directory.
$router->setBasePath("/t1-ue07-teameins/exporter/public");

// Set a 404 callback that is executed when no route matches.
// Example for the use of an arrow function. It automatically includes variables from the parent scope (such as $twig).
$router->set404Callback(fn() => $twig->display("404.html.twig"));

// Define all routes here.
$router->get("/", function () use ($twig) {
    $twig->display("index.html.twig");
});

$router->get("/xml", function () use ($twig) {
    // TODO: Create a new ProductExporter object and pass the Twig object
    $exporter = new \HYP2UE07\ProductExporter($twig);
    // TODO: Call the export() method. Use XML from the ExportFormat enum as a type and specify a filename, e.g., products.xml
    $exporter->export(\HYP2UE07\ExportFormat::XML, "product.xml");
    // TODO: Call displayOutput() to render the template export.html.twig after the conversion has finished.
    $exporter->displayOutput();
});

$router->get("/json", function () use ($twig) {
    // TODO: Create a new ProductExporter object and pass the Twig object
    // TODO: Call the export() method. Use JSON from the ExportFormat enum as a type and specify a filename, e.g., products.json
    // TODO: Call displayOutput() to render the template export.html.twig after the conversion has finished.
});

$router->get("/pdf", function () use ($twig) {
    // TODO: Create a new ProductExporter object and pass the Twig object
    // TODO: Call the export() method. Use PDF from the ExportFormat enum as a type and specify a filename, e.g., products.pdf
    // TODO: Call displayOutput() to render the template export.html.twig after the conversion has finished.
});

$router->get("/createdb", function () use ($twig) {
    $createDB = new CreateDB($twig);
    $createDB->createSchema();
    $createDB->createTable();
    $createDB->addProducts();
    $createDB->displayOutput();
});

// Run the router to get the party started.
$router->run();
