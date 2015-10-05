<?php

namespace com\readysteadyrainbow\entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use com\readysteadyrainbow\entities\Reward as ChildReward;
use com\readysteadyrainbow\entities\RewardQuery as ChildRewardQuery;
use com\readysteadyrainbow\entities\Map\RewardTableMap;

/**
 * Base class that represents a query for the 'reward' table.
 *
 *
 *
 * @method     ChildRewardQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRewardQuery orderByAnimationname($order = Criteria::ASC) Order by the animationName column
 * @method     ChildRewardQuery orderByLevel($order = Criteria::ASC) Order by the level column
 * @method     ChildRewardQuery orderByScene($order = Criteria::ASC) Order by the scene column
 * @method     ChildRewardQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildRewardQuery groupById() Group by the id column
 * @method     ChildRewardQuery groupByAnimationname() Group by the animationName column
 * @method     ChildRewardQuery groupByLevel() Group by the level column
 * @method     ChildRewardQuery groupByScene() Group by the scene column
 * @method     ChildRewardQuery groupByName() Group by the name column
 *
 * @method     ChildRewardQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRewardQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRewardQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRewardQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRewardQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRewardQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReward findOne(ConnectionInterface $con = null) Return the first ChildReward matching the query
 * @method     ChildReward findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReward matching the query, or a new ChildReward object populated from the query conditions when no match is found
 *
 * @method     ChildReward findOneById(int $id) Return the first ChildReward filtered by the id column
 * @method     ChildReward findOneByAnimationname(string $animationName) Return the first ChildReward filtered by the animationName column
 * @method     ChildReward findOneByLevel(int $level) Return the first ChildReward filtered by the level column
 * @method     ChildReward findOneByScene(string $scene) Return the first ChildReward filtered by the scene column
 * @method     ChildReward findOneByName(string $name) Return the first ChildReward filtered by the name column *

 * @method     ChildReward requirePk($key, ConnectionInterface $con = null) Return the ChildReward by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReward requireOne(ConnectionInterface $con = null) Return the first ChildReward matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReward requireOneById(int $id) Return the first ChildReward filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReward requireOneByAnimationname(string $animationName) Return the first ChildReward filtered by the animationName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReward requireOneByLevel(int $level) Return the first ChildReward filtered by the level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReward requireOneByScene(string $scene) Return the first ChildReward filtered by the scene column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReward requireOneByName(string $name) Return the first ChildReward filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReward[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReward objects based on current ModelCriteria
 * @method     ChildReward[]|ObjectCollection findById(int $id) Return ChildReward objects filtered by the id column
 * @method     ChildReward[]|ObjectCollection findByAnimationname(string $animationName) Return ChildReward objects filtered by the animationName column
 * @method     ChildReward[]|ObjectCollection findByLevel(int $level) Return ChildReward objects filtered by the level column
 * @method     ChildReward[]|ObjectCollection findByScene(string $scene) Return ChildReward objects filtered by the scene column
 * @method     ChildReward[]|ObjectCollection findByName(string $name) Return ChildReward objects filtered by the name column
 * @method     ChildReward[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RewardQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \com\readysteadyrainbow\entities\Base\RewardQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\com\\readysteadyrainbow\\entities\\Reward', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRewardQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRewardQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRewardQuery) {
            return $criteria;
        }
        $query = new ChildRewardQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildReward|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RewardTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RewardTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReward A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, animationName, level, scene, name FROM reward WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildReward $obj */
            $obj = new ChildReward();
            $obj->hydrate($row);
            RewardTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildReward|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildRewardQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RewardTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRewardQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RewardTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRewardQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RewardTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RewardTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RewardTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the animationName column
     *
     * Example usage:
     * <code>
     * $query->filterByAnimationname('fooValue');   // WHERE animationName = 'fooValue'
     * $query->filterByAnimationname('%fooValue%'); // WHERE animationName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $animationname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRewardQuery The current query, for fluid interface
     */
    public function filterByAnimationname($animationname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($animationname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $animationname)) {
                $animationname = str_replace('*', '%', $animationname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RewardTableMap::COL_ANIMATIONNAME, $animationname, $comparison);
    }

    /**
     * Filter the query on the level column
     *
     * Example usage:
     * <code>
     * $query->filterByLevel(1234); // WHERE level = 1234
     * $query->filterByLevel(array(12, 34)); // WHERE level IN (12, 34)
     * $query->filterByLevel(array('min' => 12)); // WHERE level > 12
     * </code>
     *
     * @param     mixed $level The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRewardQuery The current query, for fluid interface
     */
    public function filterByLevel($level = null, $comparison = null)
    {
        if (is_array($level)) {
            $useMinMax = false;
            if (isset($level['min'])) {
                $this->addUsingAlias(RewardTableMap::COL_LEVEL, $level['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($level['max'])) {
                $this->addUsingAlias(RewardTableMap::COL_LEVEL, $level['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RewardTableMap::COL_LEVEL, $level, $comparison);
    }

    /**
     * Filter the query on the scene column
     *
     * Example usage:
     * <code>
     * $query->filterByScene('fooValue');   // WHERE scene = 'fooValue'
     * $query->filterByScene('%fooValue%'); // WHERE scene LIKE '%fooValue%'
     * </code>
     *
     * @param     string $scene The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRewardQuery The current query, for fluid interface
     */
    public function filterByScene($scene = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scene)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $scene)) {
                $scene = str_replace('*', '%', $scene);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RewardTableMap::COL_SCENE, $scene, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRewardQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RewardTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildReward $reward Object to remove from the list of results
     *
     * @return $this|ChildRewardQuery The current query, for fluid interface
     */
    public function prune($reward = null)
    {
        if ($reward) {
            $this->addUsingAlias(RewardTableMap::COL_ID, $reward->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the reward table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RewardTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RewardTableMap::clearInstancePool();
            RewardTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RewardTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RewardTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RewardTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RewardTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RewardQuery
