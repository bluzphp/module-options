<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

declare(strict_types=1);

namespace Application\Options;

use Bluz\Proxy\Auth;
use Bluz\Validator\Traits\Validator;
use Application\Users;

/**
 * Options Row
 *
 * @package  Application\Options
 *
 * @property string $namespace
 * @property string $key
 * @property integer $userId
 * @property string $value
 * @property string $description
 * @property string $created
 * @property string $updated
 *
 * @SWG\Definition(definition="options", title="option", required={"namespace", "key"})
 * @SWG\Property(property="namespace", type="string", description="Options namespace", example="default")
 * @SWG\Property(property="key", type="string", description="Key", example="Some key")
 * @SWG\Property(property="userId", type="integer", description="Author ID", example=2)
 * @SWG\Property(property="value", type="string", description="Value", example="Some Value")
 * @SWG\Property(property="description", type="string", description="Description", example="Some description for key")
 * @SWG\Property(property="created", type="string", format="date-time", description="Created date",
 *     example="2017-03-17 19:06:28")
 * @SWG\Property(property="updated", type="string", format="date-time", description="Last updated date",
 *     example="2017-03-17 19:06:28")
 */
class Row extends \Bluz\Db\Row
{
    use Validator;

    /**
     * {@inheritdoc}
     */
    protected function afterRead() : void
    {
        if ($this->value) {
            $this->value = unserialize($this->value, ['allowed_classes' => false]);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeSave() : void
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
    protected function beforeInsert() : void
    {
        // unique validator
        $this->addValidator('key')
            ->callback(
                function () {
                    return !$this->getTable()->findRowWhere(['key' => $this->key, 'namespace' => $this->namespace]);
                },
                'Key name is already exists'
            );

        /* @var \Application\Users\Row $user */
        if ($user = Auth::getIdentity()) {
            $this->userId = $user->getId();
        } else {
            $this->userId = Users\Table::SYSTEM_USER;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeUpdate() : void
    {
        $this->updated = gmdate('Y-m-d H:i:s');
    }
}
