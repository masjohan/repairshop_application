<?php


/**
 * Base class that represents a query for the 'Action' table.
 *
 * 
 *
 * @method     ActionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ActionQuery orderByPath($order = Criteria::ASC) Order by the path column
 * @method     ActionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ActionQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 *
 * @method     ActionQuery groupById() Group by the id column
 * @method     ActionQuery groupByPath() Group by the path column
 * @method     ActionQuery groupByName() Group by the name column
 * @method     ActionQuery groupByNotes() Group by the notes column
 *
 * @method     ActionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ActionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ActionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ActionQuery leftJoinRoleaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Roleaction relation
 * @method     ActionQuery rightJoinRoleaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Roleaction relation
 * @method     ActionQuery innerJoinRoleaction($relationAlias = null) Adds a INNER JOIN clause to the query using the Roleaction relation
 *
 * @method     Action findOne(PropelPDO $con = null) Return the first Action matching the query
 * @method     Action findOneOrCreate(PropelPDO $con = null) Return the first Action matching the query, or a new Action object populated from the query conditions when no match is found
 *
 * @method     Action findOneById(int $id) Return the first Action filtered by the id column
 * @method     Action findOneByPath(string $path) Return the first Action filtered by the path column
 * @method     Action findOneByName(string $name) Return the first Action filtered by the name column
 * @method     Action findOneByNotes(string $notes) Return the first Action filtered by the notes column
 *
 * @method     array findById(int $id) Return Action objects filtered by the id column
 * @method     array findByPath(string $path) Return Action objects filtered by the path column
 * @method     array findByName(string $name) Return Action objects filtered by the name column
 * @method     array findByNotes(string $notes) Return Action objects filtered by the notes column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseActionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseActionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Action', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ActionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ActionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ActionQuery) {
			return $criteria;
		}
		$query = new ActionQuery();
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
	 * @return    Action|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ActionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ActionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ActionPeer::ID, $keys, Criteria::IN);
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
	 * @return    ActionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ActionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the path column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPath('fooValue');   // WHERE path = 'fooValue'
	 * $query->filterByPath('%fooValue%'); // WHERE path LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $path The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActionQuery The current query, for fluid interface
	 */
	public function filterByPath($path = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($path)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $path)) {
				$path = str_replace('*', '%', $path);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ActionPeer::PATH, $path, $comparison);
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
	 * @return    ActionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ActionPeer::NAME, $name, $comparison);
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
	 * @return    ActionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ActionPeer::NOTES, $notes, $comparison);
	}

	/**
	 * Filter the query by a related Roleaction object
	 *
	 * @param     Roleaction $roleaction  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActionQuery The current query, for fluid interface
	 */
	public function filterByRoleaction($roleaction, $comparison = null)
	{
		if ($roleaction instanceof Roleaction) {
			return $this
				->addUsingAlias(ActionPeer::ID, $roleaction->getActionId(), $comparison);
		} elseif ($roleaction instanceof PropelCollection) {
			return $this
				->useRoleactionQuery()
					->filterByPrimaryKeys($roleaction->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRoleaction() only accepts arguments of type Roleaction or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Roleaction relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActionQuery The current query, for fluid interface
	 */
	public function joinRoleaction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Roleaction');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Roleaction');
		}
		
		return $this;
	}

	/**
	 * Use the Roleaction relation Roleaction object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RoleactionQuery A secondary query class using the current class as primary query
	 */
	public function useRoleactionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRoleaction($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Roleaction', 'RoleactionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Action $action Object to remove from the list of results
	 *
	 * @return    ActionQuery The current query, for fluid interface
	 */
	public function prune($action = null)
	{
		if ($action) {
			$this->addUsingAlias(ActionPeer::ID, $action->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseActionQuery
