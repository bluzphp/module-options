<?php

/**
 * CRUD for options
 */

/**
 * @namespace
 */
namespace Application;

use Bluz\Controller\Controller;
use Bluz\Controller\Mapper\Crud;

/**
 * @accept HTML
 * @accept JSON
 * @privilege Management
 *
 * @return mixed
 */
return function () {
    /**
     * @var Controller $this
     */
    $crud = new Crud(Options\Crud::getInstance());

    $crud->get('system', 'crud/get');
    $crud->post('options', 'crud/post')->fields(['namespace', 'key', 'value', 'description']);
    $crud->put('system', 'crud/put')->fields(['value', 'description']);
    $crud->delete('system', 'crud/delete');

    return $crud->run();
};
