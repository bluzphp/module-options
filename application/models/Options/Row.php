<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

declare(strict_types=1);

namespace Application\Options;

use Bluz\Validator\Traits\Validator;

/**
 * Options Row
 *
 * @property string $namespace
 * @property string $key
 * @property string $value
 * @property string $description
 * @property string $created
 * @property string $updated
 *
 * @category Application
 * @package  Options
 */
class Row extends \Bluz\Db\Row
{
    use Validator;

    /**
     * {@inheritdoc}
     */
    protected function afterRead()
    {
        if ($this->value) {
            $this->value = unserialize($this->value);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeSave()
    {
        $this->value = serialize($this->value);

        $this->addValidator('namespace')
            ->required()
            ->slug();
        $this->addValidator('key')
            ->required()
            ->slug();
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeInsert()
    {
        // unique validator
        $this->addValidator('key')
            ->callback(
                function () {
                    return !$this->getTable()->findRowWhere(['key' => $this->key, 'namespace' => $this->namespace]);
                },
                'Key name is already exists'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeUpdate()
    {
        $this->updated = gmdate('Y-m-d H:i:s');
    }
}
