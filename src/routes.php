<?php

namespace PHPMaker2021\project1;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // pacientes
    $app->any('/PacientesList[/{id_paciente}]', PacientesController::class . ':list')->add(PermissionMiddleware::class)->setName('PacientesList-pacientes-list'); // list
    $app->any('/PacientesAdd[/{id_paciente}]', PacientesController::class . ':add')->add(PermissionMiddleware::class)->setName('PacientesAdd-pacientes-add'); // add
    $app->any('/PacientesEdit[/{id_paciente}]', PacientesController::class . ':edit')->add(PermissionMiddleware::class)->setName('PacientesEdit-pacientes-edit'); // edit
    $app->any('/PacientesDelete[/{id_paciente}]', PacientesController::class . ':delete')->add(PermissionMiddleware::class)->setName('PacientesDelete-pacientes-delete'); // delete
    $app->group(
        '/pacientes',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_paciente}]', PacientesController::class . ':list')->add(PermissionMiddleware::class)->setName('pacientes/list-pacientes-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_paciente}]', PacientesController::class . ':add')->add(PermissionMiddleware::class)->setName('pacientes/add-pacientes-add-2'); // add
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_paciente}]', PacientesController::class . ':edit')->add(PermissionMiddleware::class)->setName('pacientes/edit-pacientes-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_paciente}]', PacientesController::class . ':delete')->add(PermissionMiddleware::class)->setName('pacientes/delete-pacientes-delete-2'); // delete
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
