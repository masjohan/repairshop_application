<?php


/**
 * Base class that represents a query for the 'RepairOrderItem' table.
 *
 * 
 *
 * @method     RepairorderitemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     RepairorderitemQuery orderByRepaireOrderId($order = Criteria::ASC) Order by the repaire_order_id column
 * @method     RepairorderitemQuery orderByRoCodeId($order = Criteria::ASC) Order by the ro_code_id column
 * @method     RepairorderitemQuery orderByTech($order = Criteria::ASC) Order by the tech column
 * @method     RepairorderitemQuery orderByDesc($order = Criteria::ASC) Order by the desc column
 * @method     RepairorderitemQuery orderByPrice($order = Criteria::ASC) Order by the price column
 *
 * @method     RepairorderitemQuery groupById() Group by the id column
 * @method     RepairorderitemQuery groupByRepaireOrderId() Group by the repaire_order_id column
 * @method     RepairorderitemQuery groupByRoCodeId() Group by the ro_code_id column
 * @method     RepairorderitemQuery groupByTech() Group by the tech column
 * @method     RepairorderitemQuery groupByDesc() Group by the desc column
 * @method     RepairorderitemQuery groupByPrice() Group by the price column
 *
 * @method     RepairorderitemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     RepairorderitemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     RepairorderitemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     RepairorderitemQuery leftJoinRepairordercode($relationAlias = null) Adds a LEFT JOIN clause to the query using the Repairordercode relation
 * @method     RepairorderitemQuery rightJoinRepairordercode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Repairordercode relation
 * @method     RepairorderitemQuery innerJoinRepairordercode($relationAlias = null) Adds a INNER JOIN clause to the query using the Repairordercode relation
 *
 * @method     RepairorderitemQuery leftJoinRepairorder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Repairorder relation
 * @method     RepairorderitemQuery rightJoinRepairorder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Repairorder relation
 * @method     RepairorderitemQuery innerJoinRepairorder($relationAlias = null) Adds a INNER JOIN clause to the query using the Repairorder relation
 *
 * @method     Repairorderitem findOne(PropelPDO $con = null) Return the first Repairorderitem matching the query
 * @method     Repairorderitem findOneOrCreate(PropelPDO $con = null) Return the first Repairorderitem matching the query, or a new Repairorderitem object populated from the query conditions when no match is found
 *
 * @method     Repairorderitem findOneById(int $id) Return the first Repairorderitem filtered by the id column
 * @method     Repairorderitem findOneByRepaireOrderId(int $repaire_order_id) Return the first Repairorderitem filtered by the repaire_order_id column
 * @method     Repairorderitem findOneByRoCodeId(int $ro_code_id) Return the first Repairorderitem filtered by the ro_code_id column
 * @method     Repairorderitem findOneByTech(string $tech) Return the first Repairorderitem filtered by the tech column
 * @method     Repairorderitem findOneByDesc(string $desc) Return the first Repairorderitem filtered by the desc column
 * @method     Repairorderitem findOneByPrice(string $price) Return the first Repairorderitem filtered by the price column
 *
 * @method     array findById(int $id) Return Repairorderitem objects filtered by the id column
 * @method     array findByRepaireOrderId(int $repaire_order_id) Return Repairorderitem objects filtered by the repaire_order_id column
 * @method     array findByRoCodeId(int $ro_code_id) Return Repairorderitem objects filtered by the ro_code_id column
 * @method     array findByTech(string $tech) Return Repairorderitem objects filtered by the tech column
 * @method     array findByDesc(string $desc) Return Repairorderitem objects filtered by the desc column
 * @method     array findByPrice(string $price) Return Repairorderitem objects filtered by the price column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseRepairorderitemQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseRepairorderitemQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Repairorderitem', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new RepairorderitemQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    RepairorderitemQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof RepairorderitemQuery) {
			return $criteria;
		}
		$query = new RepairorderitemQuery();
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
	 * @return    Repairorderitem|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = RepairorderitemPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(RepairorderitemPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(RepairorderitemPeer::ID, $keys, Criteria::IN);
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
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RepairorderitemPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the repaire_order_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRepaireOrderId(1234); // WHERE repaire_order_id = 1234
	 * $query->filterByRepaireOrderId(array(12, 34)); // WHERE repaire_order_id IN (12, 34)
	 * $query->filterByRepaireOrderId(array('min' => 12)); // WHERE repaire_order_id > 12
	 * </code>
	 *
	 * @see       filterByRepairorder()
	 *
	 * @param     mixed $repaireOrderId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByRepaireOrderId($repaireOrderId = null, $comparison = null)
	{
		if (is_array($repaireOrderId)) {
			$useMinMax = false;
			if (isset($repaireOrderId['min'])) {
				$this->addUsingAlias(RepairorderitemPeer::REPAIRE_ORDER_ID, $repaireOrderId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($repaireOrderId['max'])) {
				$this->addUsingAlias(RepairorderitemPeer::REPAIRE_ORDER_ID, $repaireOrderId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RepairorderitemPeer::REPAIRE_ORDER_ID, $repaireOrderId, $comparison);
	}

	/**
	 * Filter the query on the ro_code_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRoCodeId(1234); // WHERE ro_code_id = 1234
	 * $query->filterByRoCodeId(array(12, 34)); // WHERE ro_code_id IN (12, 34)
	 * $query->filterByRoCodeId(array('min' => 12)); // WHERE ro_code_id > 12
	 * </code>
	 *
	 * @see       filterByRepairordercode()
	 *
	 * @param     mixed $roCodeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByRoCodeId($roCodeId = null, $comparison = null)
	{
		if (is_array($roCodeId)) {
			$useMinMax = false;
			if (isset($roCodeId['min'])) {
				$this->addUsingAlias(RepairorderitemPeer::RO_CODE_ID, $roCodeId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roCodeId['max'])) {
				$this->addUsingAlias(RepairorderitemPeer::RO_CODE_ID, $roCodeId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RepairorderitemPeer::RO_CODE_ID, $roCodeId, $comparison);
	}

	/**
	 * Filter the query on the tech column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTech('fooValue');   // WHERE tech = 'fooValue'
	 * $query->filterByTech('%fooValue%'); // WHERE tech LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $tech The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByTech($tech = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($tech)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $tech)) {
				$tech = str_replace('*', '%', $tech);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RepairorderitemPeer::TECH, $tech, $comparison);
	}

	/**
	 * Filter the query on the desc column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDesc('fooValue');   // WHERE desc = 'fooValue'
	 * $query->filterByDesc('%fooValue%'); // WHERE desc LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $desc The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByDesc($desc = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($desc)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $desc)) {
				$desc = str_replace('*', '%', $desc);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RepairorderitemPeer::DESC, $desc, $comparison);
	}

	/**
	 * Filter the query on the price column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPrice(1234); // WHERE price = 1234
	 * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
	 * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
	 * </code>
	 *
	 * @param     mixed $price The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(RepairorderitemPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(RepairorderitemPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RepairorderitemPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query by a related Repairordercode object
	 *
	 * @param     Repairordercode|PropelCollection $repairordercode The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByRepairordercode($repairordercode, $comparison = null)
	{
		if ($repairordercode instanceof Repairordercode) {
			return $this
				->addUsingAlias(RepairorderitemPeer::RO_CODE_ID, $repairordercode->getId(), $comparison);
		} elseif ($repairordercode instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RepairorderitemPeer::RO_CODE_ID, $repairordercode->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByRepairordercode() only accepts arguments of type Repairordercode or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Repairordercode relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function joinRepairordercode($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Repairordercode');
		
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
			$this->addJoinObject($join, 'Repairordercode');
		}
		
		return $this;
	}

	/**
	 * Use the Repairordercode relation Repairordercode object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairordercodeQuery A secondary query class using the current class as primary query
	 */
	public function useRepairordercodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRepairordercode($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Repairordercode', 'RepairordercodeQuery');
	}

	/**
	 * Filter the query by a related Repairorder object
	 *
	 * @param     Repairorder|PropelCollection $repairorder The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function filterByRepairorder($repairorder, $comparison = null)
	{
		if ($repairorder instanceof Repairorder) {
			return $this
				->addUsingAlias(RepairorderitemPeer::REPAIRE_ORDER_ID, $repairorder->getId(), $comparison);
		} elseif ($repairorder instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RepairorderitemPeer::REPAIRE_ORDER_ID, $repairorder->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    RepairorderitemQuery The current query, for fluid interface
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
	 * @param     Repairorderitem $repairorderitem Object to remove from the list of results
	 *
	 * @return    RepairorderitemQuery The current query, for fluid interface
	 */
	public function prune($repairorderitem = null)
	{
		if ($repairorderitem) {
			$this->addUsingAlias(RepairorderitemPeer::ID, $repairorderitem->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseRepairorderitemQuery
