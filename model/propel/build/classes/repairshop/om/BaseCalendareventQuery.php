<?php


/**
 * Base class that represents a query for the 'CalendarEvent' table.
 *
 * 
 *
 * @method     CalendareventQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CalendareventQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     CalendareventQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     CalendareventQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     CalendareventQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 *
 * @method     CalendareventQuery groupById() Group by the id column
 * @method     CalendareventQuery groupByFirstName() Group by the first_name column
 * @method     CalendareventQuery groupByLastName() Group by the last_name column
 * @method     CalendareventQuery groupByPhone() Group by the phone column
 * @method     CalendareventQuery groupByNotes() Group by the notes column
 *
 * @method     CalendareventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CalendareventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CalendareventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CalendareventQuery leftJoinCalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Calendar relation
 * @method     CalendareventQuery rightJoinCalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Calendar relation
 * @method     CalendareventQuery innerJoinCalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Calendar relation
 *
 * @method     Calendarevent findOne(PropelPDO $con = null) Return the first Calendarevent matching the query
 * @method     Calendarevent findOneOrCreate(PropelPDO $con = null) Return the first Calendarevent matching the query, or a new Calendarevent object populated from the query conditions when no match is found
 *
 * @method     Calendarevent findOneById(int $id) Return the first Calendarevent filtered by the id column
 * @method     Calendarevent findOneByFirstName(string $first_name) Return the first Calendarevent filtered by the first_name column
 * @method     Calendarevent findOneByLastName(string $last_name) Return the first Calendarevent filtered by the last_name column
 * @method     Calendarevent findOneByPhone(string $phone) Return the first Calendarevent filtered by the phone column
 * @method     Calendarevent findOneByNotes(string $notes) Return the first Calendarevent filtered by the notes column
 *
 * @method     array findById(int $id) Return Calendarevent objects filtered by the id column
 * @method     array findByFirstName(string $first_name) Return Calendarevent objects filtered by the first_name column
 * @method     array findByLastName(string $last_name) Return Calendarevent objects filtered by the last_name column
 * @method     array findByPhone(string $phone) Return Calendarevent objects filtered by the phone column
 * @method     array findByNotes(string $notes) Return Calendarevent objects filtered by the notes column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseCalendareventQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCalendareventQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Calendarevent', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CalendareventQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CalendareventQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CalendareventQuery) {
			return $criteria;
		}
		$query = new CalendareventQuery();
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
	 * @return    Calendarevent|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CalendareventPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CalendareventQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CalendareventPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CalendareventQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CalendareventPeer::ID, $keys, Criteria::IN);
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
	 * @return    CalendareventQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CalendareventPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the first_name column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
	 * $query->filterByFirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $firstName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendareventQuery The current query, for fluid interface
	 */
	public function filterByFirstName($firstName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($firstName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $firstName)) {
				$firstName = str_replace('*', '%', $firstName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CalendareventPeer::FIRST_NAME, $firstName, $comparison);
	}

	/**
	 * Filter the query on the last_name column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
	 * $query->filterByLastName('%fooValue%'); // WHERE last_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $lastName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendareventQuery The current query, for fluid interface
	 */
	public function filterByLastName($lastName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($lastName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $lastName)) {
				$lastName = str_replace('*', '%', $lastName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CalendareventPeer::LAST_NAME, $lastName, $comparison);
	}

	/**
	 * Filter the query on the phone column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
	 * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $phone The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendareventQuery The current query, for fluid interface
	 */
	public function filterByPhone($phone = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($phone)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $phone)) {
				$phone = str_replace('*', '%', $phone);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CalendareventPeer::PHONE, $phone, $comparison);
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
	 * @return    CalendareventQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CalendareventPeer::NOTES, $notes, $comparison);
	}

	/**
	 * Filter the query by a related Calendar object
	 *
	 * @param     Calendar $calendar  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CalendareventQuery The current query, for fluid interface
	 */
	public function filterByCalendar($calendar, $comparison = null)
	{
		if ($calendar instanceof Calendar) {
			return $this
				->addUsingAlias(CalendareventPeer::ID, $calendar->getEventId(), $comparison);
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
	 * @return    CalendareventQuery The current query, for fluid interface
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
	 * @param     Calendarevent $calendarevent Object to remove from the list of results
	 *
	 * @return    CalendareventQuery The current query, for fluid interface
	 */
	public function prune($calendarevent = null)
	{
		if ($calendarevent) {
			$this->addUsingAlias(CalendareventPeer::ID, $calendarevent->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCalendareventQuery
