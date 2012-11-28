<?php


/**
 * Base class that represents a query for the 'Calendar' table.
 *
 * 
 *
 * @method     CalendarQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CalendarQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     CalendarQuery orderBySlotId($order = Criteria::ASC) Order by the slot_id column
 * @method     CalendarQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 *
 * @method     CalendarQuery groupById() Group by the id column
 * @method     CalendarQuery groupByUserId() Group by the user_id column
 * @method     CalendarQuery groupBySlotId() Group by the slot_id column
 * @method     CalendarQuery groupByEventId() Group by the event_id column
 *
 * @method     CalendarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CalendarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CalendarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CalendarQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     CalendarQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     CalendarQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     CalendarQuery leftJoinCalendarevent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Calendarevent relation
 * @method     CalendarQuery rightJoinCalendarevent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Calendarevent relation
 * @method     CalendarQuery innerJoinCalendarevent($relationAlias = null) Adds a INNER JOIN clause to the query using the Calendarevent relation
 *
 * @method     CalendarQuery leftJoinCalendarslot($relationAlias = null) Adds a LEFT JOIN clause to the query using the Calendarslot relation
 * @method     CalendarQuery rightJoinCalendarslot($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Calendarslot relation
 * @method     CalendarQuery innerJoinCalendarslot($relationAlias = null) Adds a INNER JOIN clause to the query using the Calendarslot relation
 *
 * @method     Calendar findOne(PropelPDO $con = null) Return the first Calendar matching the query
 * @method     Calendar findOneOrCreate(PropelPDO $con = null) Return the first Calendar matching the query, or a new Calendar object populated from the query conditions when no match is found
 *
 * @method     Calendar findOneById(int $id) Return the first Calendar filtered by the id column
 * @method     Calendar findOneByUserId(int $user_id) Return the first Calendar filtered by the user_id column
 * @method     Calendar findOneBySlotId(int $slot_id) Return the first Calendar filtered by the slot_id column
 * @method     Calendar findOneByEventId(int $event_id) Return the first Calendar filtered by the event_id column
 *
 * @method     array findById(int $id) Return Calendar objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Calendar objects filtered by the user_id column
 * @method     array findBySlotId(int $slot_id) Return Calendar objects filtered by the slot_id column
 * @method     array findByEventId(int $event_id) Return Calendar objects filtered by the event_id column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseCalendarQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCalendarQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Calendar', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CalendarQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CalendarQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CalendarQuery) {
			return $criteria;
		}
		$query = new CalendarQuery();
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
	 * @return    Calendar|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CalendarPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CalendarPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CalendarPeer::ID, $keys, Criteria::IN);
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
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CalendarPeer::ID, $id, $comparison);
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
	 * @see       filterByUser()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(CalendarPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(CalendarPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CalendarPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the slot_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySlotId(1234); // WHERE slot_id = 1234
	 * $query->filterBySlotId(array(12, 34)); // WHERE slot_id IN (12, 34)
	 * $query->filterBySlotId(array('min' => 12)); // WHERE slot_id > 12
	 * </code>
	 *
	 * @see       filterByCalendarslot()
	 *
	 * @param     mixed $slotId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterBySlotId($slotId = null, $comparison = null)
	{
		if (is_array($slotId)) {
			$useMinMax = false;
			if (isset($slotId['min'])) {
				$this->addUsingAlias(CalendarPeer::SLOT_ID, $slotId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($slotId['max'])) {
				$this->addUsingAlias(CalendarPeer::SLOT_ID, $slotId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CalendarPeer::SLOT_ID, $slotId, $comparison);
	}

	/**
	 * Filter the query on the event_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByEventId(1234); // WHERE event_id = 1234
	 * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
	 * $query->filterByEventId(array('min' => 12)); // WHERE event_id > 12
	 * </code>
	 *
	 * @see       filterByCalendarevent()
	 *
	 * @param     mixed $eventId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (is_array($eventId)) {
			$useMinMax = false;
			if (isset($eventId['min'])) {
				$this->addUsingAlias(CalendarPeer::EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventId['max'])) {
				$this->addUsingAlias(CalendarPeer::EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CalendarPeer::EVENT_ID, $eventId, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(CalendarPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CalendarPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');
		
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
			$this->addJoinObject($join, 'User');
		}
		
		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Filter the query by a related Calendarevent object
	 *
	 * @param     Calendarevent|PropelCollection $calendarevent The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterByCalendarevent($calendarevent, $comparison = null)
	{
		if ($calendarevent instanceof Calendarevent) {
			return $this
				->addUsingAlias(CalendarPeer::EVENT_ID, $calendarevent->getId(), $comparison);
		} elseif ($calendarevent instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CalendarPeer::EVENT_ID, $calendarevent->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByCalendarevent() only accepts arguments of type Calendarevent or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Calendarevent relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function joinCalendarevent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Calendarevent');
		
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
			$this->addJoinObject($join, 'Calendarevent');
		}
		
		return $this;
	}

	/**
	 * Use the Calendarevent relation Calendarevent object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CalendareventQuery A secondary query class using the current class as primary query
	 */
	public function useCalendareventQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCalendarevent($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Calendarevent', 'CalendareventQuery');
	}

	/**
	 * Filter the query by a related Calendarslot object
	 *
	 * @param     Calendarslot|PropelCollection $calendarslot The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function filterByCalendarslot($calendarslot, $comparison = null)
	{
		if ($calendarslot instanceof Calendarslot) {
			return $this
				->addUsingAlias(CalendarPeer::SLOT_ID, $calendarslot->getId(), $comparison);
		} elseif ($calendarslot instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CalendarPeer::SLOT_ID, $calendarslot->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByCalendarslot() only accepts arguments of type Calendarslot or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Calendarslot relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function joinCalendarslot($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Calendarslot');
		
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
			$this->addJoinObject($join, 'Calendarslot');
		}
		
		return $this;
	}

	/**
	 * Use the Calendarslot relation Calendarslot object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CalendarslotQuery A secondary query class using the current class as primary query
	 */
	public function useCalendarslotQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCalendarslot($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Calendarslot', 'CalendarslotQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Calendar $calendar Object to remove from the list of results
	 *
	 * @return    CalendarQuery The current query, for fluid interface
	 */
	public function prune($calendar = null)
	{
		if ($calendar) {
			$this->addUsingAlias(CalendarPeer::ID, $calendar->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCalendarQuery
