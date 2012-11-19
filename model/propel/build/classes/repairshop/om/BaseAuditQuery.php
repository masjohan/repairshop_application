<?php


/**
 * Base class that represents a query for the '_audit' table.
 *
 * 
 *
 * @method     AuditQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AuditQuery orderByWhen($order = Criteria::ASC) Order by the when column
 * @method     AuditQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method     AuditQuery orderByTableName($order = Criteria::ASC) Order by the table_name column
 * @method     AuditQuery orderByTableId($order = Criteria::ASC) Order by the table_id column
 * @method     AuditQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     AuditQuery orderByMysqlUid($order = Criteria::ASC) Order by the mysql_uid column
 *
 * @method     AuditQuery groupById() Group by the id column
 * @method     AuditQuery groupByWhen() Group by the when column
 * @method     AuditQuery groupByAction() Group by the action column
 * @method     AuditQuery groupByTableName() Group by the table_name column
 * @method     AuditQuery groupByTableId() Group by the table_id column
 * @method     AuditQuery groupByUserId() Group by the user_id column
 * @method     AuditQuery groupByMysqlUid() Group by the mysql_uid column
 *
 * @method     AuditQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AuditQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AuditQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Audit findOne(PropelPDO $con = null) Return the first Audit matching the query
 * @method     Audit findOneOrCreate(PropelPDO $con = null) Return the first Audit matching the query, or a new Audit object populated from the query conditions when no match is found
 *
 * @method     Audit findOneById(int $id) Return the first Audit filtered by the id column
 * @method     Audit findOneByWhen(string $when) Return the first Audit filtered by the when column
 * @method     Audit findOneByAction(string $action) Return the first Audit filtered by the action column
 * @method     Audit findOneByTableName(string $table_name) Return the first Audit filtered by the table_name column
 * @method     Audit findOneByTableId(int $table_id) Return the first Audit filtered by the table_id column
 * @method     Audit findOneByUserId(int $user_id) Return the first Audit filtered by the user_id column
 * @method     Audit findOneByMysqlUid(string $mysql_uid) Return the first Audit filtered by the mysql_uid column
 *
 * @method     array findById(int $id) Return Audit objects filtered by the id column
 * @method     array findByWhen(string $when) Return Audit objects filtered by the when column
 * @method     array findByAction(string $action) Return Audit objects filtered by the action column
 * @method     array findByTableName(string $table_name) Return Audit objects filtered by the table_name column
 * @method     array findByTableId(int $table_id) Return Audit objects filtered by the table_id column
 * @method     array findByUserId(int $user_id) Return Audit objects filtered by the user_id column
 * @method     array findByMysqlUid(string $mysql_uid) Return Audit objects filtered by the mysql_uid column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseAuditQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseAuditQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Audit', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AuditQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AuditQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AuditQuery) {
			return $criteria;
		}
		$query = new AuditQuery();
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
	 * @return    Audit|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = AuditPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    AuditQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AuditPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AuditQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AuditPeer::ID, $keys, Criteria::IN);
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
	 * @return    AuditQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AuditPeer::ID, $id, $comparison);
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
	 * @return    AuditQuery The current query, for fluid interface
	 */
	public function filterByWhen($when = null, $comparison = null)
	{
		if (is_array($when)) {
			$useMinMax = false;
			if (isset($when['min'])) {
				$this->addUsingAlias(AuditPeer::WHEN, $when['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($when['max'])) {
				$this->addUsingAlias(AuditPeer::WHEN, $when['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AuditPeer::WHEN, $when, $comparison);
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
	 * @return    AuditQuery The current query, for fluid interface
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
		return $this->addUsingAlias(AuditPeer::ACTION, $action, $comparison);
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
	 * @return    AuditQuery The current query, for fluid interface
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
		return $this->addUsingAlias(AuditPeer::TABLE_NAME, $tableName, $comparison);
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
	 * @return    AuditQuery The current query, for fluid interface
	 */
	public function filterByTableId($tableId = null, $comparison = null)
	{
		if (is_array($tableId)) {
			$useMinMax = false;
			if (isset($tableId['min'])) {
				$this->addUsingAlias(AuditPeer::TABLE_ID, $tableId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($tableId['max'])) {
				$this->addUsingAlias(AuditPeer::TABLE_ID, $tableId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AuditPeer::TABLE_ID, $tableId, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AuditQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(AuditPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(AuditPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AuditPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the mysql_uid column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByMysqlUid('fooValue');   // WHERE mysql_uid = 'fooValue'
	 * $query->filterByMysqlUid('%fooValue%'); // WHERE mysql_uid LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mysqlUid The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AuditQuery The current query, for fluid interface
	 */
	public function filterByMysqlUid($mysqlUid = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mysqlUid)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mysqlUid)) {
				$mysqlUid = str_replace('*', '%', $mysqlUid);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AuditPeer::MYSQL_UID, $mysqlUid, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Audit $audit Object to remove from the list of results
	 *
	 * @return    AuditQuery The current query, for fluid interface
	 */
	public function prune($audit = null)
	{
		if ($audit) {
			$this->addUsingAlias(AuditPeer::ID, $audit->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseAuditQuery
