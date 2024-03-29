<?php

/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

declare(strict_types=1);

namespace Application\Options;

use Bluz\Grid\Source\SelectSource;

/**
 * Grid based on SQL
 *
 * @package Application\Options
 */
class Grid extends \Bluz\Grid\Grid
{
    /**
     * @var string
     */
    protected $uid = 'options';

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        // Array
        $adapter = new SelectSource();
        $adapter->setSource(Table::select());

        $this->setAdapter($adapter);
        $this->setDefaultLimit(25);
        $this->setAllowOrders(['id', 'key', 'namespace', 'value', 'created', 'deleted']);
    }
}
