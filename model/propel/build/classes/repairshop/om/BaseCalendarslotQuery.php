<?php


/**
 * Base class that represents a query for the 'CalendarSlot' table.
 *
 * 
 *
 * @method     CalendarslotQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CalendarslotQuery orderByTimeslot($order = Criteria::ASC) Order by the timeslot column
 *
 * @method     CalendarslotQuery groupById() Group by the id column
 * @method     CalendarslotQuery groupByTimeslot() Group by the timeslot column
 *
 * @method     CalendarslotQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CalendarslotQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CalendarslotQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CalendarslotQuery leftJoinCalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Calendar relation
 * @method     CalendarslotQuery rightJoinCalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Calendar relation
 * @method     CalendarslotQuery innerJoinCalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Calendar relation
 *
 * @method     Calendarslot findOne(PropelPDO $con = null) Return the first Calendarslot matching the query
 * @method     Calendarslot findOneOrCreate(PropelPDO $con = null) Return the first Calendarslot matching the query, or a new Calendarslot object populated from the query conditions when no match is found
 *
 * @method     Calendarslot findOneById(int $id) Return the first Calendarslot filtered by the id column
 * @method     Calendarslot findOneByTimeslot(string $timeslot) Return the first Calendarslot filtered by the timeslot column
 *
 * @method     array findById(int $id) Return Calendarslot objects filtered by the id column
 * @method     array findByTimeslot(string $timeslot) Return Calendarslot objects filtered by the timeslot column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseCalendarslotQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCalendarslotQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Calendarslot', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CalendarslotQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CalendarslotQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CalendarslotQuery) {
			return $criteria;
		}
		$query = new CalendarslotQuery();
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
	 * @return    Calendarslot|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CalendarslotPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CalendarslotQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CalendarslotPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CalendarslotQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CalendarslotPeer::ID, $keys, Criteria::IN);
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
	 * @return    CalendarslotQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CalendarslotPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the timeslot column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTimeslot('2011-03-14'); // WHERE timeslot = '2011-03-14'
	 * $query->filterByTimeslot('now'); // WHERE timeslot = '2011-03-14'
	 * $query->filterByTimeslot(array('max' => 'yesterday')); // WHERE timeslot > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $timeslot The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarslotQuery The current query, for fluid interface
	 */
	public function filterByTimeslot($timeslot = null, $comparison = null)
	{
		if (is_array($timeslot)) {
			$useMinMax = false;
			if (isset($timeslot['min'])) {
				$this->addUsingAlias(CalendarslotPeer::TIMESLOT, $timeslot['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($timeslot['max'])) {
				$this->addUsingAlias(CalendarslotPeer::TIMESLOT, $timeslot['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CalendarslotPeer::TIMESLOT, $timeslot, $comparison);
	}

	/**
	 * Filter the query by a related Calendar object
	 *
	 * @param     Calendar $calendar  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarslotQuery The current query, for fluid interface
	 */
	public function filterByCalendar($calendar, $comparison = null)
	{
		if ($calendar instanceof Calendar) {
			return $this
				->addUsingAlias(CalendarslotPeer::ID, $calendar->getSlotId(), $comparison);
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
	 * @return    CalendarslotQuery The current query, for fluid interface
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
	 * @param     Calendarslot $calendarslot Object to remove from the list of results
	 *
	 * @return    CalendarslotQuery The current query, for fluid interface
	 */
	public function prune($calendarslot = null)
	{
		if ($calendarslot) {
			$this->addUsingAlias(CalendarslotPeer::ID, $calendarslot->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCalendarslotQuery
