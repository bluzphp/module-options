<?php

/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

declare(strict_types=1);

namespace Application\Options;

use Bluz\Db\Exception\DbException;
use Bluz\Db\Exception\InvalidPrimaryKeyException;
use Bluz\Db\Exception\TableNotFoundException;

/**
 * Class Table
 *
 * @package Application\Options
 *
 * @method static Row create(array $data = [])
 * @method static Row|null findRow($primaryKey)
 * @method static Row|null findRowWhere($whereList)
 */
class Table extends \Bluz\Db\Table
{
    /**
     * Default namespace for all keys
     */
    public const NAMESPACE_DEFAULT = 'default';

    /**
     * Table
     *
     * @var string
     */
    protected $name = 'options';

    /**
     * Primary key(s)
     * @var array
     */
    protected $primary = ['namespace', 'key'];

    /**
     * Get option value for use it from any application place
     *
     * @param string $key
     * @param string $namespace
     * @return mixed
     * @throws DbException
     */
    public static function get(string $key, string $namespace = self::NAMESPACE_DEFAULT)
    {
        if ($row = self::findRowWhere(['key' => $key, 'namespace' => $namespace])) {
            return $row->value;
        }
        return null;
    }

    /**
     * Set option value for use it from any application place
     *
     * @param string $key
     * @param mixed $value
     * @param string $namespace
     * @return mixed
     * @throws DbException
     * @throws InvalidPrimaryKeyException
     * @throws TableNotFoundException
     */
    public static function set(string $key, $value, string $namespace = self::NAMESPACE_DEFAULT)
    {
        $row = self::findRowWhere(['key' => $key, 'namespace' => $namespace]);
        if (!$row) {
            $row = self::create();
            $row->key = $key;
            $row->namespace = $namespace;
        }
        $row->value = $value;
        return $row->save();
    }

    /**
     * Remove option
     *
     * @param string $key
     * @param string $namespace
     * @return integer
     * @throws DbException
     */
    public static function remove(string $key, string $namespace = self::NAMESPACE_DEFAULT)
    {
        return self::delete(['key' => $key, 'namespace' => $namespace]);
    }
}
