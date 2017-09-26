<?php
/**
 * REST controller for Options model
 *
 * @author   dev
 * @created  2017-09-25 12:24:17
 */

/**
 * @namespace
 */
namespace Application;

use Application\Options;
use Bluz\Controller\Controller;
use Bluz\Controller\Mapper\Rest;

/**
 * Manipulate with options
 *
 * @SWG\Get(
 *   path="/api/options/{optionNamespace}-{optionKey}",
 *   tags={"options"},
 *   operationId="getOptionByKey",
 *   summary="Find option by namespace and key",
 *   @SWG\Parameter(ref="#/parameters/Auth-Token"),
 *   @SWG\Parameter(
 *     name="optionNamespace",
 *     in="path",
 *     type="string",
 *     required=true,
 *     description="Namespace of option"
 *   ),
 *   @SWG\Parameter(
 *     name="optionKey",
 *     in="path",
 *     type="string",
 *     required=true,
 *     description="Key of option"
 *   ),
 *   @SWG\Response(@SWG\Schema(ref="#/definitions/options"), response=200, description="Given option found"),
 *   @SWG\Response(@SWG\Schema(ref="#/definitions/error"), response=404, description="Page not found")
 * )
 *
 * @SWG\Get(
 *   path="/api/options/",
 *   tags={"options"},
 *   method="GET",
 *   operationId="getOptionsCollection",
 *   summary="Collection of items",
 *   @SWG\Parameter(ref="#/parameters/Auth-Token"),
 *   @SWG\Parameter(ref="#/parameters/offset"),
 *   @SWG\Parameter(ref="#/parameters/limit"),
 *   @SWG\Response(response=200, description="Collection present"),
 *   @SWG\Response(response=206, description="Collection present")
 * )
 *
 * @accept JSON
 *
 * @acl Options/Read
 * @acl Options/Edit
 *
 * @return mixed
 */
return function () {
    /**
     * @var Controller $this
     */
    $rest = new Rest(Options\Crud::getInstance());

    $rest->get('system', 'rest/get')
        ->acl('Options/Read');
    $rest->post('system', 'rest/post')
        ->acl('Options/Edit');
    $rest->put('system', 'rest/put')
        ->acl('Options/Edit');
    $rest->patch('system', 'rest/put')
        ->acl('Options/Edit');
    $rest->delete('system', 'rest/delete')
        ->acl('Options/Edit');

    return $rest->run();
};
