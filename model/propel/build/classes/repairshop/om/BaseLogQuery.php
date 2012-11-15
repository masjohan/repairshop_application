<?php


/**
 * Base class that represents a query for the 'Log' table.
 *
 * 
 *
 * @method     LogQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     LogQuery orderByWhen($order = Criteria::ASC) Order by the when column
 * @method     LogQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method     LogQuery orderByTableName($order = Criteria::ASC) Order by the table_name column
 * @method     LogQuery orderByTableId($order = Criteria::ASC) Order by the table_id column
 * @method     LogQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 *
 * @method     LogQuery groupById() Group by the id column
 * @method     LogQuery groupByWhen() Group by the when column
 * @method     LogQuery groupByAction() Group by the action column
 * @method     LogQuery groupByTableName() Group by the table_name column
 * @method     LogQuery groupByTableId() Group by the table_id column
 * @method     LogQuery groupByNotes() Group by the notes column
 *
 * @method     LogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     LogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     LogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Log findOne(PropelPDO $con = null) Return the first Log matching the query
 * @method     Log findOneOrCreate(PropelPDO $con = null) Return the first Log matching the query, or a new Log object populated from the query conditions when no match is found
 *
 * @method     Log findOneById(int $id) Return the first Log filtered by the id column
 * @method     Log findOneByWhen(string $when) Return the first Log filtered by the when column
 * @method     Log findOneByAction(string $action) Return the first Log filtered by the action column
 * @method     Log findOneByTableName(string $table_name) Return the first Log filtered by the table_name column
 * @method     Log findOneByTableId(int $table_id) Return the first Log filtered by the table_id column
 * @method     Log findOneByNotes(string $notes) Return the first Log filtered by the notes column
 *
 * @method     array findById(int $id) Return Log objects filtered by the id column
 * @method     array findByWhen(string $when) Return Log objects filtered by the when column
 * @method     array findByAction(string $action) Return Log objects filtered by the action column
 * @method     array findByTableName(string $table_name) Return Log objects filtered by the table_name column
 * @method     array findByTableId(int $table_id) Return Log objects filtered by the table_id column
 * @method     array findByNotes(string $notes) Return Log objects filtered by the notes column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseLogQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseLogQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Log', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new LogQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    LogQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof LogQuery) {
			return $criteria;
		}
		$query = new LogQuery();
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
	 * @return    Log|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = LogPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(LogPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(LogPeer::ID, $keys, Criteria::IN);
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
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(LogPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the when column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByWhen('2011-03-14'); // WHERE when = '2011-03-14'
	 * $query->filterByWhen('now'); // WHERE when = '2011-03-14'
	 * $query->filterByWhen(array('max' => 'yesterday')); // WHERE when > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $when The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function filterByWhen($when = null, $comparison = null)
	{
		if (is_array($when)) {
			$useMinMax = false;
			if (isset($when['min'])) {
				$this->addUsingAlias(LogPeer::WHEN, $when['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($when['max'])) {
				$this->addUsingAlias(LogPeer::WHEN, $when['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LogPeer::WHEN, $when, $comparison);
	}

	/**
	 * Filter the query on the action column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAction('fooValue');   // WHERE action = 'fooValue'
	 * $query->filterByAction('%fooValue%'); // WHERE action LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $action The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function filterByAction($action = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($action)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $action)) {
				$action = str_replace('*', '%', $action);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(LogPeer::ACTION, $action, $comparison);
	}

	/**
	 * Filter the query on the table_name column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTableName('fooValue');   // WHERE table_name = 'fooValue'
	 * $query->filterByTableName('%fooValue%'); // WHERE table_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $tableName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function filterByTableName($tableName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($tableName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $tableName)) {
				$tableName = str_replace('*', '%', $tableName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(LogPeer::TABLE_NAME, $tableName, $comparison);
	}

	/**
	 * Filter the query on the table_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTableId(1234); // WHERE table_id = 1234
	 * $query->filterByTableId(array(12, 34)); // WHERE table_id IN (12, 34)
	 * $query->filterByTableId(array('min' => 12)); // WHERE table_id > 12
	 * </code>
	 *
	 * @param     mixed $tableId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function filterByTableId($tableId = null, $comparison = null)
	{
		if (is_array($tableId)) {
			$useMinMax = false;
			if (isset($tableId['min'])) {
				$this->addUsingAlias(LogPeer::TABLE_ID, $tableId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($tableId['max'])) {
				$this->addUsingAlias(LogPeer::TABLE_ID, $tableId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LogPeer::TABLE_ID, $tableId, $comparison);
	}

	/**
	 * Filter the query on the notes column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
	 * $query->filterByNotes('%fooValue%'); // WHERE notes LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $notes The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function filterByNotes($notes = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($notes)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $notes)) {
				$notes = str_replace('*', '%', $notes);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(LogPeer::NOTES, $notes, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Log $log Object to remove from the list of results
	 *
	 * @return    LogQuery The current query, for fluid interface
	 */
	public function prune($log = null)
	{
		if ($log) {
			$this->addUsingAlias(LogPeer::ID, $log->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseLogQuery
