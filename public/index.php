<?php

use App\Application\Student\MemoryStudentRepository;
use App\Domain\Student\Repository as StudentRepository;
use DI\Container;
use App\Statistics\Student\ExportResolver;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Domain\Student\Student;
use App\Domain\SchoolBoard\Type as SchoolBoard;
use Ramsey\Uuid\Uuid;

require __DIR__ . '/../vendor/autoload.php';

// Create container
$container = new Container();

// Set student repository
$container->set(StudentRepository::class, function () {
    return new MemoryStudentRepository();
});

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/students/{id}', function (Request $request, Response $response, $args) {
    $studentId = (int)$args['id'];

    /** @var StudentRepository $studentRepo */
    $studentRepo = $this->get(StudentRepository::class);

    $student = $studentRepo->getById($studentId);

    $e = ExportResolver::makeExporter($student);

    $response->getBody()->write(
        $e->export()
    );

    return $response;
});

$app->run();