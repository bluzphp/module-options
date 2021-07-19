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
 * @OA\Get(
 *   path="/api/options/{optionNamespace}-{optionKey}",
 *   tags={"options"},
 *   operationId="getOptionByKey",
 *   summary="Find option by namespace and key",
 *   security={
 *     {"api_key": {}}
 *   },
 *   @OA\Parameter(
 *     name="optionNamespace",
 *     in="path",
 *     required=true,
 *     description="Namespace of option",
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     name="optionKey",
 *     in="path",
 *     required=true,
 *     description="Key of option",
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(@OA\JsonContent(ref="#/components/schemas/option"), response=200, description="Given option found"),
 *   @OA\Response(@OA\JsonContent(ref="#/components/schemas/error"), response=404, description="User not found")
 * )
 *
 * @OA\Get(
 *   path="/api/options/",
 *   tags={"options"},
 *   method="GET",
 *   operationId="getOptionsCollection",
 *   summary="Collection of items",
 *   security={
 *     {"api_key": {}}
 *   },
 *   @OA\Parameter(ref="#/components/parameters/offset_in_query"),
 *   @OA\Parameter(ref="#/components/parameters/limit_in_query"),
 *   @OA\Response(
 *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/option")),
 *     response=200,
 *     description="Collection"
 *   ),
 *   @OA\Response(
 *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/option")),
 *     response=206,
 *     description="Collection (partial)"
 *   )
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
