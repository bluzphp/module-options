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

/**
 * @group    module-options
 * @group    grid
 *
 * @package  Application\Tests\Options
 * @author   Anton Shevchuk
 * @created  15.05.14 12:35
 */
class GridTest extends ControllerTestCase
{
    /**
     * Dispatch module/controller
     *
     * @todo test functionality
     */
    public function testControllerPage()
    {
        self::setupSuperUserIdentity();

        $this->dispatch('/options/grid/');
        self::assertOk();
    }
}
