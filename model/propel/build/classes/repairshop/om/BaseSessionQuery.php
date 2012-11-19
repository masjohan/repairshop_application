<?php


/**
 * Base class that represents a query for the '_session' table.
 *
 * 
 *
 * @method     SessionQuery orderBySessionId($order = Criteria::ASC) Order by the session_id column
 * @method     SessionQuery orderByDeviceKey($order = Criteria::ASC) Order by the device_key column
 * @method     SessionQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     SessionQuery orderByUpdatedOn($order = Criteria::ASC) Order by the updated_on column
 *
 * @method     SessionQuery groupBySessionId() Group by the session_id column
 * @method     SessionQuery groupByDeviceKey() Group by the device_key column
 * @method     SessionQuery groupByValue() Group by the value column
 * @method     SessionQuery groupByUpdatedOn() Group by the updated_on column
 *
 * @method     SessionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SessionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SessionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Session findOne(PropelPDO $con = null) Return the first Session matching the query
 * @method     Session findOneOrCreate(PropelPDO $con = null) Return the first Session matching the query, or a new Session object populated from the query conditions when no match is found
 *
 * @method     Session findOneBySessionId(string $session_id) Return the first Session filtered by the session_id column
 * @method     Session findOneByDeviceKey(string $device_key) Return the first Session filtered by the device_key column
 * @method     Session findOneByValue(string $value) Return the first Session filtered by the value column
 * @method     Session findOneByUpdatedOn(string $updated_on) Return the first Session filtered by the updated_on column
 *
 * @method     array findBySessionId(string $session_id) Return Session objects filtered by the session_id column
 * @method     array findByDeviceKey(string $device_key) Return Session objects filtered by the device_key column
 * @method     array findByValue(string $value) Return Session objects filtered by the value column
 * @method     array findByUpdatedOn(string $updated_on) Return Session objects filtered by the updated_on column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseSessionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSessionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Session', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SessionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SessionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SessionQuery) {
			return $criteria;
		}
		$query = new SessionQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Session|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SessionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SessionPeer::SESSION_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SessionPeer::SESSION_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the session_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySessionId('fooValue');   // WHERE session_id = 'fooValue'
	 * $query->filterBySessionId('%fooValue%'); // WHERE session_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $sessionId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterBySessionId($sessionId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($sessionId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $sessionId)) {
				$sessionId = str_replace('*', '%', $sessionId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SessionPeer::SESSION_ID, $sessionId, $comparison);
	}

	/**
	 * Filter the query on the device_key column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDeviceKey('fooValue');   // WHERE device_key = 'fooValue'
	 * $query->filterByDeviceKey('%fooValue%'); // WHERE device_key LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $deviceKey The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByDeviceKey($deviceKey = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($deviceKey)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $deviceKey)) {
				$deviceKey = str_replace('*', '%', $deviceKey);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SessionPeer::DEVICE_KEY, $deviceKey, $comparison);
	}

	/**
	 * Filter the query on the value column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
	 * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $value The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByValue($value = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($value)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $value)) {
				$value = str_replace('*', '%', $value);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SessionPeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query on the updated_on column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUpdatedOn('2011-03-14'); // WHERE updated_on = '2011-03-14'
	 * $query->filterByUpdatedOn('now'); // WHERE updated_on = '2011-03-14'
	 * $query->filterByUpdatedOn(array('max' => 'yesterday')); // WHERE updated_on > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $updatedOn The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function filterByUpdatedOn($updatedOn = null, $comparison = null)
	{
		if (is_array($updatedOn)) {
			$useMinMax = false;
			if (isset($updatedOn['min'])) {
				$this->addUsingAlias(SessionPeer::UPDATED_ON, $updatedOn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedOn['max'])) {
				$this->addUsingAlias(SessionPeer::UPDATED_ON, $updatedOn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SessionPeer::UPDATED_ON, $updatedOn, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Session $session Object to remove from the list of results
	 *
	 * @return    SessionQuery The current query, for fluid interface
	 */
	public function prune($session = null)
	{
		if ($session) {
			$this->addUsingAlias(SessionPeer::SESSION_ID, $session->getSessionId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSessionQuery
