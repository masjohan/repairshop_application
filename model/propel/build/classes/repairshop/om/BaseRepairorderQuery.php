<?php


/**
 * Base class that represents a query for the 'RepairOrder' table.
 *
 * 
 *
 * @method     RepairorderQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     RepairorderQuery orderByVehicleId($order = Criteria::ASC) Order by the vehicle_id column
 * @method     RepairorderQuery orderByTag($order = Criteria::ASC) Order by the tag column
 * @method     RepairorderQuery orderByRepairOrderStatusId($order = Criteria::ASC) Order by the repair_order_status_id column
 * @method     RepairorderQuery orderByTimeIn($order = Criteria::ASC) Order by the time_in column
 * @method     RepairorderQuery orderByExpected($order = Criteria::ASC) Order by the expected column
 * @method     RepairorderQuery orderByTech($order = Criteria::ASC) Order by the tech column
 *
 * @method     RepairorderQuery groupById() Group by the id column
 * @method     RepairorderQuery groupByVehicleId() Group by the vehicle_id column
 * @method     RepairorderQuery groupByTag() Group by the tag column
 * @method     RepairorderQuery groupByRepairOrderStatusId() Group by the repair_order_status_id column
 * @method     RepairorderQuery groupByTimeIn() Group by the time_in column
 * @method     RepairorderQuery groupByExpected() Group by the expected column
 * @method     RepairorderQuery groupByTech() Group by the tech column
 *
 * @method     RepairorderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     RepairorderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     RepairorderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     RepairorderQuery leftJoinVehicle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Vehicle relation
 * @method     RepairorderQuery rightJoinVehicle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Vehicle relation
 * @method     RepairorderQuery innerJoinVehicle($relationAlias = null) Adds a INNER JOIN clause to the query using the Vehicle relation
 *
 * @method     RepairorderQuery leftJoinRepairorderstatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the Repairorderstatus relation
 * @method     RepairorderQuery rightJoinRepairorderstatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Repairorderstatus relation
 * @method     RepairorderQuery innerJoinRepairorderstatus($relationAlias = null) Adds a INNER JOIN clause to the query using the Repairorderstatus relation
 *
 * @method     RepairorderQuery leftJoinRepairorderitem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Repairorderitem relation
 * @method     RepairorderQuery rightJoinRepairorderitem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Repairorderitem relation
 * @method     RepairorderQuery innerJoinRepairorderitem($relationAlias = null) Adds a INNER JOIN clause to the query using the Repairorderitem relation
 *
 * @method     Repairorder findOne(PropelPDO $con = null) Return the first Repairorder matching the query
 * @method     Repairorder findOneOrCreate(PropelPDO $con = null) Return the first Repairorder matching the query, or a new Repairorder object populated from the query conditions when no match is found
 *
 * @method     Repairorder findOneById(int $id) Return the first Repairorder filtered by the id column
 * @method     Repairorder findOneByVehicleId(int $vehicle_id) Return the first Repairorder filtered by the vehicle_id column
 * @method     Repairorder findOneByTag(string $tag) Return the first Repairorder filtered by the tag column
 * @method     Repairorder findOneByRepairOrderStatusId(int $repair_order_status_id) Return the first Repairorder filtered by the repair_order_status_id column
 * @method     Repairorder findOneByTimeIn(string $time_in) Return the first Repairorder filtered by the time_in column
 * @method     Repairorder findOneByExpected(string $expected) Return the first Repairorder filtered by the expected column
 * @method     Repairorder findOneByTech(string $tech) Return the first Repairorder filtered by the tech column
 *
 * @method     array findById(int $id) Return Repairorder objects filtered by the id column
 * @method     array findByVehicleId(int $vehicle_id) Return Repairorder objects filtered by the vehicle_id column
 * @method     array findByTag(string $tag) Return Repairorder objects filtered by the tag column
 * @method     array findByRepairOrderStatusId(int $repair_order_status_id) Return Repairorder objects filtered by the repair_order_status_id column
 * @method     array findByTimeIn(string $time_in) Return Repairorder objects filtered by the time_in column
 * @method     array findByExpected(string $expected) Return Repairorder objects filtered by the expected column
 * @method     array findByTech(string $tech) Return Repairorder objects filtered by the tech column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseRepairorderQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseRepairorderQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Repairorder', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new RepairorderQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    RepairorderQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof RepairorderQuery) {
			return $criteria;
		}
		$query = new RepairorderQuery();
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
	 * @return    Repairorder|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = RepairorderPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(RepairorderPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(RepairorderPeer::ID, $keys, Criteria::IN);
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
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RepairorderPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the vehicle_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByVehicleId(1234); // WHERE vehicle_id = 1234
	 * $query->filterByVehicleId(array(12, 34)); // WHERE vehicle_id IN (12, 34)
	 * $query->filterByVehicleId(array('min' => 12)); // WHERE vehicle_id > 12
	 * </code>
	 *
	 * @see       filterByVehicle()
	 *
	 * @param     mixed $vehicleId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByVehicleId($vehicleId = null, $comparison = null)
	{
		if (is_array($vehicleId)) {
			$useMinMax = false;
			if (isset($vehicleId['min'])) {
				$this->addUsingAlias(RepairorderPeer::VEHICLE_ID, $vehicleId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($vehicleId['max'])) {
				$this->addUsingAlias(RepairorderPeer::VEHICLE_ID, $vehicleId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RepairorderPeer::VEHICLE_ID, $vehicleId, $comparison);
	}

	/**
	 * Filter the query on the tag column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTag('fooValue');   // WHERE tag = 'fooValue'
	 * $query->filterByTag('%fooValue%'); // WHERE tag LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $tag The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByTag($tag = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($tag)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $tag)) {
				$tag = str_replace('*', '%', $tag);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RepairorderPeer::TAG, $tag, $comparison);
	}

	/**
	 * Filter the query on the repair_order_status_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRepairOrderStatusId(1234); // WHERE repair_order_status_id = 1234
	 * $query->filterByRepairOrderStatusId(array(12, 34)); // WHERE repair_order_status_id IN (12, 34)
	 * $query->filterByRepairOrderStatusId(array('min' => 12)); // WHERE repair_order_status_id > 12
	 * </code>
	 *
	 * @see       filterByRepairorderstatus()
	 *
	 * @param     mixed $repairOrderStatusId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByRepairOrderStatusId($repairOrderStatusId = null, $comparison = null)
	{
		if (is_array($repairOrderStatusId)) {
			$useMinMax = false;
			if (isset($repairOrderStatusId['min'])) {
				$this->addUsingAlias(RepairorderPeer::REPAIR_ORDER_STATUS_ID, $repairOrderStatusId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($repairOrderStatusId['max'])) {
				$this->addUsingAlias(RepairorderPeer::REPAIR_ORDER_STATUS_ID, $repairOrderStatusId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RepairorderPeer::REPAIR_ORDER_STATUS_ID, $repairOrderStatusId, $comparison);
	}

	/**
	 * Filter the query on the time_in column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTimeIn('2011-03-14'); // WHERE time_in = '2011-03-14'
	 * $query->filterByTimeIn('now'); // WHERE time_in = '2011-03-14'
	 * $query->filterByTimeIn(array('max' => 'yesterday')); // WHERE time_in > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $timeIn The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByTimeIn($timeIn = null, $comparison = null)
	{
		if (is_array($timeIn)) {
			$useMinMax = false;
			if (isset($timeIn['min'])) {
				$this->addUsingAlias(RepairorderPeer::TIME_IN, $timeIn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($timeIn['max'])) {
				$this->addUsingAlias(RepairorderPeer::TIME_IN, $timeIn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RepairorderPeer::TIME_IN, $timeIn, $comparison);
	}

	/**
	 * Filter the query on the expected column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByExpected('2011-03-14'); // WHERE expected = '2011-03-14'
	 * $query->filterByExpected('now'); // WHERE expected = '2011-03-14'
	 * $query->filterByExpected(array('max' => 'yesterday')); // WHERE expected > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $expected The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByExpected($expected = null, $comparison = null)
	{
		if (is_array($expected)) {
			$useMinMax = false;
			if (isset($expected['min'])) {
				$this->addUsingAlias(RepairorderPeer::EXPECTED, $expected['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($expected['max'])) {
				$this->addUsingAlias(RepairorderPeer::EXPECTED, $expected['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(RepairorderPeer::EXPECTED, $expected, $comparison);
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
	 * @return    RepairorderQuery The current query, for fluid interface
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
		return $this->addUsingAlias(RepairorderPeer::TECH, $tech, $comparison);
	}

	/**
	 * Filter the query by a related Vehicle object
	 *
	 * @param     Vehicle|PropelCollection $vehicle The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByVehicle($vehicle, $comparison = null)
	{
		if ($vehicle instanceof Vehicle) {
			return $this
				->addUsingAlias(RepairorderPeer::VEHICLE_ID, $vehicle->getId(), $comparison);
		} elseif ($vehicle instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RepairorderPeer::VEHICLE_ID, $vehicle->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByVehicle() only accepts arguments of type Vehicle or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Vehicle relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function joinVehicle($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Vehicle');
		
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
			$this->addJoinObject($join, 'Vehicle');
		}
		
		return $this;
	}

	/**
	 * Use the Vehicle relation Vehicle object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VehicleQuery A secondary query class using the current class as primary query
	 */
	public function useVehicleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinVehicle($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Vehicle', 'VehicleQuery');
	}

	/**
	 * Filter the query by a related Repairorderstatus object
	 *
	 * @param     Repairorderstatus|PropelCollection $repairorderstatus The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByRepairorderstatus($repairorderstatus, $comparison = null)
	{
		if ($repairorderstatus instanceof Repairorderstatus) {
			return $this
				->addUsingAlias(RepairorderPeer::REPAIR_ORDER_STATUS_ID, $repairorderstatus->getId(), $comparison);
		} elseif ($repairorderstatus instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RepairorderPeer::REPAIR_ORDER_STATUS_ID, $repairorderstatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByRepairorderstatus() only accepts arguments of type Repairorderstatus or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Repairorderstatus relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function joinRepairorderstatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Repairorderstatus');
		
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
			$this->addJoinObject($join, 'Repairorderstatus');
		}
		
		return $this;
	}

	/**
	 * Use the Repairorderstatus relation Repairorderstatus object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairorderstatusQuery A secondary query class using the current class as primary query
	 */
	public function useRepairorderstatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRepairorderstatus($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Repairorderstatus', 'RepairorderstatusQuery');
	}

	/**
	 * Filter the query by a related Repairorderitem object
	 *
	 * @param     Repairorderitem $repairorderitem  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function filterByRepairorderitem($repairorderitem, $comparison = null)
	{
		if ($repairorderitem instanceof Repairorderitem) {
			return $this
				->addUsingAlias(RepairorderPeer::ID, $repairorderitem->getRepaireOrderId(), $comparison);
		} elseif ($repairorderitem instanceof PropelCollection) {
			return $this
				->useRepairorderitemQuery()
					->filterByPrimaryKeys($repairorderitem->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRepairorderitem() only accepts arguments of type Repairorderitem or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Repairorderitem relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function joinRepairorderitem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Repairorderitem');
		
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
			$this->addJoinObject($join, 'Repairorderitem');
		}
		
		return $this;
	}

	/**
	 * Use the Repairorderitem relation Repairorderitem object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepairorderitemQuery A secondary query class using the current class as primary query
	 */
	public function useRepairorderitemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRepairorderitem($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Repairorderitem', 'RepairorderitemQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Repairorder $repairorder Object to remove from the list of results
	 *
	 * @return    RepairorderQuery The current query, for fluid interface
	 */
	public function prune($repairorder = null)
	{
		if ($repairorder) {
			$this->addUsingAlias(RepairorderPeer::ID, $repairorder->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseRepairorderQuery
