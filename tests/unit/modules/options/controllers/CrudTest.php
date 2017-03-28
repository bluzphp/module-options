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
     * @todo test functionality
     */
    public function testCrudPage()
    {
        self::setupSuperUserIdentity();

        $this->dispatch('/options/crud/');

        self::assertOk();
    }

    /**
     * @todo test functionality
     */
    public function testCrudPost()
    {
        self::setupSuperUserIdentity();

        $this->dispatch('/options/crud/', [], RequestMethod::POST);

        self::assertOk();
    }

    /**
     * @todo test functionality
     */
    public function testCrudPut()
    {
        self::setupSuperUserIdentity();

        $this->dispatch('/options/crud/', [], RequestMethod::PUT);

        self::assertResponseCode(StatusCode::NOT_FOUND);
    }

    /**
     * @todo test functionality
     */
    public function testCrudDelete()
    {
        self::setupSuperUserIdentity();

        $this->dispatch('/options/crud/', [], RequestMethod::DELETE);

        self::assertResponseCode(StatusCode::NOT_FOUND);
    }
}
