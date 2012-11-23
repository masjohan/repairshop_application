<?php


/**
 * Base class that represents a query for the 'RoleAction' table.
 *
 * 
 *
 * @method     RoleactionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     RoleactionQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     RoleactionQuery orderByActionId($order = Criteria::ASC) Order by the action_id column
 *
 * @method     RoleactionQuery groupById() Group by the id column
 * @method     RoleactionQuery groupByRoleId() Group by the role_id column
 * @method     RoleactionQuery groupByActionId() Group by the action_id column
 *
 * @method     RoleactionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     RoleactionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     RoleactionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     RoleactionQuery leftJoinAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Action relation
 * @method     RoleactionQuery rightJoinAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Action relation
 * @method     RoleactionQuery innerJoinAction($relationAlias = null) Adds a INNER JOIN clause to the query using the Action relation
 *
 * @method     Roleaction findOne(PropelPDO $con = null) Return the first Roleaction matching the query
 * @method     Roleaction findOneOrCreate(PropelPDO $con = null) Return the first Roleaction matching the query, or a new Roleaction object populated from the query conditions when no match is found
 *
 * @method     Roleaction findOneById(int $id) Return the first Roleaction filtered by the id column
 * @method     Roleaction findOneByRoleId(int $role_id) Return the first Roleaction filtered by the role_id column
 * @method     Roleaction findOneByActionId(int $action_id) Return the first Roleaction filtered by the action_id column
 *
 * @method     array findById(int $id) Return Roleaction objects filtered by the id column
 * @method     array findByRoleId(int $role_id) Return Roleaction objects filtered by the role_id column
 * @method     array findByActionId(int $action_id) Return Roleaction objects filtered by the action_id column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseRoleactionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseRoleactionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Roleaction', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new RoleactionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    RoleactionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof RoleactionQuery) {
			return $criteria;
		}
		$query = new RoleactionQuery();
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
	 * @return    Roleaction|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = RoleactionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    RoleactionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(RoleactionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    RoleactionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(RoleactionPeer::ID, $keys, Criteria::IN);
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
	 * @return    RoleactionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RoleactionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the role_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRoleId(1234); // WHERE role_id = 1234
	 * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
	 * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
	 * </code>
	 *
	 * @param     mixed $roleId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RoleactionQuery The current query, for fluid interface
	 */
	public function filterByRoleId($roleId = null, $comparison = null)
	{
		if (is_array($roleId)) {
			$useMinMax = false;
			if (isset($roleId['min'])) {
				$this->addUsingAlias(RoleactionPeer::ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roleId['max'])) {
				$this->addUsingAlias(RoleactionPeer::ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RoleactionPeer::ROLE_ID, $roleId, $comparison);
	}

	/**
	 * Filter the query on the action_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByActionId(1234); // WHERE action_id = 1234
	 * $query->filterByActionId(array(12, 34)); // WHERE action_id IN (12, 34)
	 * $query->filterByActionId(array('min' => 12)); // WHERE action_id > 12
	 * </code>
	 *
	 * @see       filterByAction()
	 *
	 * @param     mixed $actionId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RoleactionQuery The current query, for fluid interface
	 */
	public function filterByActionId($actionId = null, $comparison = null)
	{
		if (is_array($actionId)) {
			$useMinMax = false;
			if (isset($actionId['min'])) {
				$this->addUsingAlias(RoleactionPeer::ACTION_ID, $actionId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($actionId['max'])) {
				$this->addUsingAlias(RoleactionPeer::ACTION_ID, $actionId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RoleactionPeer::ACTION_ID, $actionId, $comparison);
	}

	/**
	 * Filter the query by a related Action object
	 *
	 * @param     Action|PropelCollection $action The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RoleactionQuery The current query, for fluid interface
	 */
	public function filterByAction($action, $comparison = null)
	{
		if ($action instanceof Action) {
			return $this
				->addUsingAlias(RoleactionPeer::ACTION_ID, $action->getId(), $comparison);
		} elseif ($action instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RoleactionPeer::ACTION_ID, $action->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByAction() only accepts arguments of type Action or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Action relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RoleactionQuery The current query, for fluid interface
	 */
	public function joinAction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Action');
		
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
			$this->addJoinObject($join, 'Action');
		}
		
		return $this;
	}

	/**
	 * Use the Action relation Action object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActionQuery A secondary query class using the current class as primary query
	 */
	public function useActionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAction($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Action', 'ActionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Roleaction $roleaction Object to remove from the list of results
	 *
	 * @return    RoleactionQuery The current query, for fluid interface
	 */
	public function prune($roleaction = null)
	{
		if ($roleaction) {
			$this->addUsingAlias(RoleactionPeer::ID, $roleaction->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseRoleactionQuery
