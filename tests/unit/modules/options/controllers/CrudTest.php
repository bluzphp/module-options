<?php

/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Tests\Options;

use Application\Tests\ControllerTestCase;
use Bluz\Http\RequestMethod;
use Bluz\Http\StatusCode;

/**
 * @group    module-options
 * @group    crud
 *
 * @package  Application\Tests\Options
 * @author   Anton Shevchuk
 * @created  15.05.14 12:35
 */
class CrudTest extends ControllerTestCase
{
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        self::getApp()->useLayout(false);
        self::setupSuperUserIdentity();
    }

    public function testGetCrudForm()
    {
        $this->dispatch('/options/crud/');

        self::assertOk();
        self::assertQueryCount('form[method="POST"]', 1);
    }

    public function testSendCrudFrom()
    {
        $this->dispatch(
            '/options/crud/',
            ['namespace' => 'default', 'key' => 'test', 'value' => 'create'],
            RequestMethod::POST
        );

        self::assertOk();
    }

    public function testUpdateCrudForm()
    {
        $this->dispatch(
            '/options/crud/',
            ['namespace' => 'default', 'key' => 'test', 'value' => 'update'],
            RequestMethod::PUT
        );

        self::assertOk();
    }

    public function testDeleteCrud()
    {
        $this->dispatch(
            '/options/crud/',
            ['namespace' => 'default', 'key' => 'test'],
            RequestMethod::DELETE
        );

        self::assertOk();
    }
}
