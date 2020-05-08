<?php

use App\Application\Student\MemoryStudentRepository;
use App\Domain\Shared\NotFoundException;
use App\Domain\Student\Repository as StudentRepository;
use App\Statistics\Student\Handlers\XmlHandler;
use DI\Container;
use App\Statistics\Student\ExportResolver;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$config = include(__DIR__ . '/../config/local.php');
$db = new PDO("mysql:host={$config['mysql']['host']};dbname=students_db", $config['mysql']['user'], $config['mysql']['password']);

// Create container
$container = new Container();

// Set student repository
$container->set(StudentRepository::class, function () use ($db) {
    return new \App\Application\Student\MemoryStudentRepository();
    // return new \App\Application\Student\MysqlStudentRepository($db);
});

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/students/{id}', function (Request $request, Response $response, $args) {
    $studentId = (int)$args['id'];

    /** @var StudentRepository $studentRepo */
    $studentRepo = $this->get(StudentRepository::class);

    try
    {
        $student = $studentRepo->getById($studentId);
    }
    catch (NotFoundException $exception)
    {
        $response->getBody()
                 ->write('<html><body><h1>404</h1></body></html>');

        return $response;
    }

    $e = ExportResolver::makeExporter($student);

    $contentType = $e instanceof XmlHandler ? 'application/xml' : 'application/json';
    $response->getBody()
             ->write(
                 $e->export()
             );

    return $response->withHeader('Content-type', $contentType);
});

$app->run();