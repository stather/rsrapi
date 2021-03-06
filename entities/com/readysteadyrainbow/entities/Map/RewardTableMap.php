<?php

namespace com\readysteadyrainbow\entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use com\readysteadyrainbow\entities\Reward;
use com\readysteadyrainbow\entities\RewardQuery;


/**
 * This class defines the structure of the 'reward' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RewardTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'com.readysteadyrainbow.entities.Map.RewardTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'reward';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\com\\readysteadyrainbow\\entities\\Reward';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'com.readysteadyrainbow.entities.Reward';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'reward.id';

    /**
     * the column name for the animationName field
     */
    const COL_ANIMATIONNAME = 'reward.animationName';

    /**
     * the column name for the level field
     */
    const COL_LEVEL = 'reward.level';

    /**
     * the column name for the scene field
     */
    const COL_SCENE = 'reward.scene';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'reward.name';

    /**
     * the column name for the x field
     */
    const COL_X = 'reward.x';

    /**
     * the column name for the y field
     */
    const COL_Y = 'reward.y';

    /**
     * the column name for the scale field
     */
    const COL_SCALE = 'reward.scale';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Animationname', 'Level', 'Scene', 'Name', 'X', 'Y', 'Scale', ),
        self::TYPE_CAMELNAME     => array('id', 'animationname', 'level', 'scene', 'name', 'x', 'y', 'scale', ),
        self::TYPE_COLNAME       => array(RewardTableMap::COL_ID, RewardTableMap::COL_ANIMATIONNAME, RewardTableMap::COL_LEVEL, RewardTableMap::COL_SCENE, RewardTableMap::COL_NAME, RewardTableMap::COL_X, RewardTableMap::COL_Y, RewardTableMap::COL_SCALE, ),
        self::TYPE_FIELDNAME     => array('id', 'animationName', 'level', 'scene', 'name', 'x', 'y', 'scale', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Animationname' => 1, 'Level' => 2, 'Scene' => 3, 'Name' => 4, 'X' => 5, 'Y' => 6, 'Scale' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'animationname' => 1, 'level' => 2, 'scene' => 3, 'name' => 4, 'x' => 5, 'y' => 6, 'scale' => 7, ),
        self::TYPE_COLNAME       => array(RewardTableMap::COL_ID => 0, RewardTableMap::COL_ANIMATIONNAME => 1, RewardTableMap::COL_LEVEL => 2, RewardTableMap::COL_SCENE => 3, RewardTableMap::COL_NAME => 4, RewardTableMap::COL_X => 5, RewardTableMap::COL_Y => 6, RewardTableMap::COL_SCALE => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'animationName' => 1, 'level' => 2, 'scene' => 3, 'name' => 4, 'x' => 5, 'y' => 6, 'scale' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('reward');
        $this->setPhpName('Reward');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\com\\readysteadyrainbow\\entities\\Reward');
        $this->setPackage('com.readysteadyrainbow.entities');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('animationName', 'Animationname', 'VARCHAR', true, 64, null);
        $this->addColumn('level', 'Level', 'INTEGER', true, null, null);
        $this->addColumn('scene', 'Scene', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('x', 'X', 'DOUBLE', false, null, null);
        $this->addColumn('y', 'Y', 'DOUBLE', false, null, null);
        $this->addColumn('scale', 'Scale', 'DOUBLE', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? RewardTableMap::CLASS_DEFAULT : RewardTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Reward object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RewardTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RewardTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RewardTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RewardTableMap::OM_CLASS;
            /** @var Reward $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RewardTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = RewardTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RewardTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Reward $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RewardTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(RewardTableMap::COL_ID);
            $criteria->addSelectColumn(RewardTableMap::COL_ANIMATIONNAME);
            $criteria->addSelectColumn(RewardTableMap::COL_LEVEL);
            $criteria->addSelectColumn(RewardTableMap::COL_SCENE);
            $criteria->addSelectColumn(RewardTableMap::COL_NAME);
            $criteria->addSelectColumn(RewardTableMap::COL_X);
            $criteria->addSelectColumn(RewardTableMap::COL_Y);
            $criteria->addSelectColumn(RewardTableMap::COL_SCALE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.animationName');
            $criteria->addSelectColumn($alias . '.level');
            $criteria->addSelectColumn($alias . '.scene');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.x');
            $criteria->addSelectColumn($alias . '.y');
            $criteria->addSelectColumn($alias . '.scale');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(RewardTableMap::DATABASE_NAME)->getTable(RewardTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RewardTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RewardTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RewardTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Reward or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Reward object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RewardTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \com\readysteadyrainbow\entities\Reward) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RewardTableMap::DATABASE_NAME);
            $criteria->add(RewardTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = RewardQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RewardTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RewardTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the reward table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RewardQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Reward or Criteria object.
     *
     * @param mixed               $criteria Criteria or Reward object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RewardTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Reward object
        }

        if ($criteria->containsKey(RewardTableMap::COL_ID) && $criteria->keyContainsValue(RewardTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RewardTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = RewardQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RewardTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RewardTableMap::buildTableMap();
