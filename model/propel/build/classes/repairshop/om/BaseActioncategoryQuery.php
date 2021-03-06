<?php


/**
 * Base class that represents a query for the 'ActionCategory' table.
 *
 * 
 *
 * @method     ActioncategoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ActioncategoryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ActioncategoryQuery orderByNiceLevel($order = Criteria::ASC) Order by the nice_level column
 *
 * @method     ActioncategoryQuery groupById() Group by the id column
 * @method     ActioncategoryQuery groupByName() Group by the name column
 * @method     ActioncategoryQuery groupByNiceLevel() Group by the nice_level column
 *
 * @method     ActioncategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ActioncategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ActioncategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ActioncategoryQuery leftJoinAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Action relation
 * @method     ActioncategoryQuery rightJoinAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Action relation
 * @method     ActioncategoryQuery innerJoinAction($relationAlias = null) Adds a INNER JOIN clause to the query using the Action relation
 *
 * @method     Actioncategory findOne(PropelPDO $con = null) Return the first Actioncategory matching the query
 * @method     Actioncategory findOneOrCreate(PropelPDO $con = null) Return the first Actioncategory matching the query, or a new Actioncategory object populated from the query conditions when no match is found
 *
 * @method     Actioncategory findOneById(int $id) Return the first Actioncategory filtered by the id column
 * @method     Actioncategory findOneByName(string $name) Return the first Actioncategory filtered by the name column
 * @method     Actioncategory findOneByNiceLevel(int $nice_level) Return the first Actioncategory filtered by the nice_level column
 *
 * @method     array findById(int $id) Return Actioncategory objects filtered by the id column
 * @method     array findByName(string $name) Return Actioncategory objects filtered by the name column
 * @method     array findByNiceLevel(int $nice_level) Return Actioncategory objects filtered by the nice_level column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseActioncategoryQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseActioncategoryQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Actioncategory', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ActioncategoryQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ActioncategoryQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ActioncategoryQuery) {
			return $criteria;
		}
		$query = new ActioncategoryQuery();
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
	 * @return    Actioncategory|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ActioncategoryPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ActioncategoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ActioncategoryPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ActioncategoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ActioncategoryPeer::ID, $keys, Criteria::IN);
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
	 * @return    ActioncategoryQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ActioncategoryPeer::ID, $id, $comparison);
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
	 * @return    ActioncategoryQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ActioncategoryPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the nice_level column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByNiceLevel(1234); // WHERE nice_level = 1234
	 * $query->filterByNiceLevel(array(12, 34)); // WHERE nice_level IN (12, 34)
	 * $query->filterByNiceLevel(array('min' => 12)); // WHERE nice_level > 12
	 * </code>
	 *
	 * @param     mixed $niceLevel The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActioncategoryQuery The current query, for fluid interface
	 */
	public function filterByNiceLevel($niceLevel = null, $comparison = null)
	{
		if (is_array($niceLevel)) {
			$useMinMax = false;
			if (isset($niceLevel['min'])) {
				$this->addUsingAlias(ActioncategoryPeer::NICE_LEVEL, $niceLevel['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($niceLevel['max'])) {
				$this->addUsingAlias(ActioncategoryPeer::NICE_LEVEL, $niceLevel['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ActioncategoryPeer::NICE_LEVEL, $niceLevel, $comparison);
	}

	/**
	 * Filter the query by a related Action object
	 *
	 * @param     Action $action  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActioncategoryQuery The current query, for fluid interface
	 */
	public function filterByAction($action, $comparison = null)
	{
		if ($action instanceof Action) {
			return $this
				->addUsingAlias(ActioncategoryPeer::ID, $action->getActionCategoryId(), $comparison);
		} elseif ($action instanceof PropelCollection) {
			return $this
				->useActionQuery()
					->filterByPrimaryKeys($action->getPrimaryKeys())
				->endUse();
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
	 * @return    ActioncategoryQuery The current query, for fluid interface
	 */
	public function joinAction($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useActionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinAction($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Action', 'ActionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Actioncategory $actioncategory Object to remove from the list of results
	 *
	 * @return    ActioncategoryQuery The current query, for fluid interface
	 */
	public function prune($actioncategory = null)
	{
		if ($actioncategory) {
			$this->addUsingAlias(ActioncategoryPeer::ID, $actioncategory->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseActioncategoryQuery
