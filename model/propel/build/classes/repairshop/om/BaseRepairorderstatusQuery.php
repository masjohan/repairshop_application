<?php


/**
 * Base class that represents a query for the 'RepairOrderStatus' table.
 *
 * 
 *
 * @method     RepairorderstatusQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     RepairorderstatusQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     RepairorderstatusQuery groupById() Group by the id column
 * @method     RepairorderstatusQuery groupByStatus() Group by the status column
 *
 * @method     RepairorderstatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     RepairorderstatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     RepairorderstatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     RepairorderstatusQuery leftJoinRepairorder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Repairorder relation
 * @method     RepairorderstatusQuery rightJoinRepairorder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Repairorder relation
 * @method     RepairorderstatusQuery innerJoinRepairorder($relationAlias = null) Adds a INNER JOIN clause to the query using the Repairorder relation
 *
 * @method     Repairorderstatus findOne(PropelPDO $con = null) Return the first Repairorderstatus matching the query
 * @method     Repairorderstatus findOneOrCreate(PropelPDO $con = null) Return the first Repairorderstatus matching the query, or a new Repairorderstatus object populated from the query conditions when no match is found
 *
 * @method     Repairorderstatus findOneById(int $id) Return the first Repairorderstatus filtered by the id column
 * @method     Repairorderstatus findOneByStatus(string $status) Return the first Repairorderstatus filtered by the status column
 *
 * @method     array findById(int $id) Return Repairorderstatus objects filtered by the id column
 * @method     array findByStatus(string $status) Return Repairorderstatus objects filtered by the status column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseRepairorderstatusQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseRepairorderstatusQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Repairorderstatus', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new RepairorderstatusQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    RepairorderstatusQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof RepairorderstatusQuery) {
			return $criteria;
		}
		$query = new RepairorderstatusQuery();
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
	 * @return    Repairorderstatus|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = RepairorderstatusPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    RepairorderstatusQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(RepairorderstatusPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    RepairorderstatusQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(RepairorderstatusPeer::ID, $keys, Criteria::IN);
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
	 * @return    RepairorderstatusQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RepairorderstatusPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the status column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
	 * $query->filterByStatus('%fooValue%'); // WHERE status LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $status The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderstatusQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($status)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $status)) {
				$status = str_replace('*', '%', $status);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RepairorderstatusPeer::STATUS, $status, $comparison);
	}

	/**
	 * Filter the query by a related Repairorder object
	 *
	 * @param     Repairorder $repairorder  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderstatusQuery The current query, for fluid interface
	 */
	public function filterByRepairorder($repairorder, $comparison = null)
	{
		if ($repairorder instanceof Repairorder) {
			return $this
				->addUsingAlias(RepairorderstatusPeer::ID, $repairorder->getRepairOrderStatusId(), $comparison);
		} elseif ($repairorder instanceof PropelCollection) {
			return $this
				->useRepairorderQuery()
					->filterByPrimaryKeys($repairorder->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRepairorder() only accepts arguments of type Repairorder or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Repairorder relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairorderstatusQuery The current query, for fluid interface
	 */
	public function joinRepairorder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Repairorder');
		
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
			$this->addJoinObject($join, 'Repairorder');
		}
		
		return $this;
	}

	/**
	 * Use the Repairorder relation Repairorder object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairorderQuery A secondary query class using the current class as primary query
	 */
	public function useRepairorderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRepairorder($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Repairorder', 'RepairorderQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Repairorderstatus $repairorderstatus Object to remove from the list of results
	 *
	 * @return    RepairorderstatusQuery The current query, for fluid interface
	 */
	public function prune($repairorderstatus = null)
	{
		if ($repairorderstatus) {
			$this->addUsingAlias(RepairorderstatusPeer::ID, $repairorderstatus->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseRepairorderstatusQuery
