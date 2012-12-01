<?php


/**
 * Base class that represents a query for the 'CalendarResource' table.
 *
 * 
 *
 * @method     CalendarresourceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CalendarresourceQuery orderByShopId($order = Criteria::ASC) Order by the shop_id column
 * @method     CalendarresourceQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     CalendarresourceQuery groupById() Group by the id column
 * @method     CalendarresourceQuery groupByShopId() Group by the shop_id column
 * @method     CalendarresourceQuery groupByName() Group by the name column
 *
 * @method     CalendarresourceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CalendarresourceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CalendarresourceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CalendarresourceQuery leftJoinShop($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shop relation
 * @method     CalendarresourceQuery rightJoinShop($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shop relation
 * @method     CalendarresourceQuery innerJoinShop($relationAlias = null) Adds a INNER JOIN clause to the query using the Shop relation
 *
 * @method     CalendarresourceQuery leftJoinCalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Calendar relation
 * @method     CalendarresourceQuery rightJoinCalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Calendar relation
 * @method     CalendarresourceQuery innerJoinCalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Calendar relation
 *
 * @method     Calendarresource findOne(PropelPDO $con = null) Return the first Calendarresource matching the query
 * @method     Calendarresource findOneOrCreate(PropelPDO $con = null) Return the first Calendarresource matching the query, or a new Calendarresource object populated from the query conditions when no match is found
 *
 * @method     Calendarresource findOneById(int $id) Return the first Calendarresource filtered by the id column
 * @method     Calendarresource findOneByShopId(int $shop_id) Return the first Calendarresource filtered by the shop_id column
 * @method     Calendarresource findOneByName(string $name) Return the first Calendarresource filtered by the name column
 *
 * @method     array findById(int $id) Return Calendarresource objects filtered by the id column
 * @method     array findByShopId(int $shop_id) Return Calendarresource objects filtered by the shop_id column
 * @method     array findByName(string $name) Return Calendarresource objects filtered by the name column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseCalendarresourceQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCalendarresourceQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Calendarresource', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CalendarresourceQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CalendarresourceQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CalendarresourceQuery) {
			return $criteria;
		}
		$query = new CalendarresourceQuery();
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
	 * @return    Calendarresource|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CalendarresourcePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CalendarresourcePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CalendarresourcePeer::ID, $keys, Criteria::IN);
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
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CalendarresourcePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the shop_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByShopId(1234); // WHERE shop_id = 1234
	 * $query->filterByShopId(array(12, 34)); // WHERE shop_id IN (12, 34)
	 * $query->filterByShopId(array('min' => 12)); // WHERE shop_id > 12
	 * </code>
	 *
	 * @see       filterByShop()
	 *
	 * @param     mixed $shopId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function filterByShopId($shopId = null, $comparison = null)
	{
		if (is_array($shopId)) {
			$useMinMax = false;
			if (isset($shopId['min'])) {
				$this->addUsingAlias(CalendarresourcePeer::SHOP_ID, $shopId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shopId['max'])) {
				$this->addUsingAlias(CalendarresourcePeer::SHOP_ID, $shopId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CalendarresourcePeer::SHOP_ID, $shopId, $comparison);
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
	 * @return    CalendarresourceQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CalendarresourcePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query by a related Shop object
	 *
	 * @param     Shop|PropelCollection $shop The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function filterByShop($shop, $comparison = null)
	{
		if ($shop instanceof Shop) {
			return $this
				->addUsingAlias(CalendarresourcePeer::SHOP_ID, $shop->getId(), $comparison);
		} elseif ($shop instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CalendarresourcePeer::SHOP_ID, $shop->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByShop() only accepts arguments of type Shop or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Shop relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function joinShop($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Shop');
		
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
			$this->addJoinObject($join, 'Shop');
		}
		
		return $this;
	}

	/**
	 * Use the Shop relation Shop object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShopQuery A secondary query class using the current class as primary query
	 */
	public function useShopQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinShop($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Shop', 'ShopQuery');
	}

	/**
	 * Filter the query by a related Calendar object
	 *
	 * @param     Calendar $calendar  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function filterByCalendar($calendar, $comparison = null)
	{
		if ($calendar instanceof Calendar) {
			return $this
				->addUsingAlias(CalendarresourcePeer::ID, $calendar->getResourceId(), $comparison);
		} elseif ($calendar instanceof PropelCollection) {
			return $this
				->useCalendarQuery()
					->filterByPrimaryKeys($calendar->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByCalendar() only accepts arguments of type Calendar or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Calendar relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function joinCalendar($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Calendar');
		
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
			$this->addJoinObject($join, 'Calendar');
		}
		
		return $this;
	}

	/**
	 * Use the Calendar relation Calendar object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CalendarQuery A secondary query class using the current class as primary query
	 */
	public function useCalendarQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCalendar($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Calendar', 'CalendarQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Calendarresource $calendarresource Object to remove from the list of results
	 *
	 * @return    CalendarresourceQuery The current query, for fluid interface
	 */
	public function prune($calendarresource = null)
	{
		if ($calendarresource) {
			$this->addUsingAlias(CalendarresourcePeer::ID, $calendarresource->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCalendarresourceQuery
