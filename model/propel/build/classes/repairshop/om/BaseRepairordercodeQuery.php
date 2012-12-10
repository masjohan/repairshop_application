<?php


/**
 * Base class that represents a query for the 'RepairOrderCode' table.
 *
 * 
 *
 * @method     RepairordercodeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     RepairordercodeQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     RepairordercodeQuery orderBySystem($order = Criteria::ASC) Order by the system column
 * @method     RepairordercodeQuery orderByDesc($order = Criteria::ASC) Order by the desc column
 *
 * @method     RepairordercodeQuery groupById() Group by the id column
 * @method     RepairordercodeQuery groupByCode() Group by the code column
 * @method     RepairordercodeQuery groupBySystem() Group by the system column
 * @method     RepairordercodeQuery groupByDesc() Group by the desc column
 *
 * @method     RepairordercodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     RepairordercodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     RepairordercodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     RepairordercodeQuery leftJoinRepairorderitem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Repairorderitem relation
 * @method     RepairordercodeQuery rightJoinRepairorderitem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Repairorderitem relation
 * @method     RepairordercodeQuery innerJoinRepairorderitem($relationAlias = null) Adds a INNER JOIN clause to the query using the Repairorderitem relation
 *
 * @method     Repairordercode findOne(PropelPDO $con = null) Return the first Repairordercode matching the query
 * @method     Repairordercode findOneOrCreate(PropelPDO $con = null) Return the first Repairordercode matching the query, or a new Repairordercode object populated from the query conditions when no match is found
 *
 * @method     Repairordercode findOneById(int $id) Return the first Repairordercode filtered by the id column
 * @method     Repairordercode findOneByCode(string $code) Return the first Repairordercode filtered by the code column
 * @method     Repairordercode findOneBySystem(string $system) Return the first Repairordercode filtered by the system column
 * @method     Repairordercode findOneByDesc(string $desc) Return the first Repairordercode filtered by the desc column
 *
 * @method     array findById(int $id) Return Repairordercode objects filtered by the id column
 * @method     array findByCode(string $code) Return Repairordercode objects filtered by the code column
 * @method     array findBySystem(string $system) Return Repairordercode objects filtered by the system column
 * @method     array findByDesc(string $desc) Return Repairordercode objects filtered by the desc column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseRepairordercodeQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseRepairordercodeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Repairordercode', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new RepairordercodeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    RepairordercodeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof RepairordercodeQuery) {
			return $criteria;
		}
		$query = new RepairordercodeQuery();
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
	 * @return    Repairordercode|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = RepairordercodePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    RepairordercodeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(RepairordercodePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    RepairordercodeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(RepairordercodePeer::ID, $keys, Criteria::IN);
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
	 * @return    RepairordercodeQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RepairordercodePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the code column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
	 * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $code The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairordercodeQuery The current query, for fluid interface
	 */
	public function filterByCode($code = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($code)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $code)) {
				$code = str_replace('*', '%', $code);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RepairordercodePeer::CODE, $code, $comparison);
	}

	/**
	 * Filter the query on the system column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySystem('fooValue');   // WHERE system = 'fooValue'
	 * $query->filterBySystem('%fooValue%'); // WHERE system LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $system The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairordercodeQuery The current query, for fluid interface
	 */
	public function filterBySystem($system = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($system)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $system)) {
				$system = str_replace('*', '%', $system);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RepairordercodePeer::SYSTEM, $system, $comparison);
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
	 * @return    RepairordercodeQuery The current query, for fluid interface
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
		return $this->addUsingAlias(RepairordercodePeer::DESC, $desc, $comparison);
	}

	/**
	 * Filter the query by a related Repairorderitem object
	 *
	 * @param     Repairorderitem $repairorderitem  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepairordercodeQuery The current query, for fluid interface
	 */
	public function filterByRepairorderitem($repairorderitem, $comparison = null)
	{
		if ($repairorderitem instanceof Repairorderitem) {
			return $this
				->addUsingAlias(RepairordercodePeer::ID, $repairorderitem->getRoCodeId(), $comparison);
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
	 * @return    RepairordercodeQuery The current query, for fluid interface
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
	 * @param     Repairordercode $repairordercode Object to remove from the list of results
	 *
	 * @return    RepairordercodeQuery The current query, for fluid interface
	 */
	public function prune($repairordercode = null)
	{
		if ($repairordercode) {
			$this->addUsingAlias(RepairordercodePeer::ID, $repairordercode->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseRepairordercodeQuery
