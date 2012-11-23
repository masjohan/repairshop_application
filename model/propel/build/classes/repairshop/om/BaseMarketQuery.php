<?php


/**
 * Base class that represents a query for the 'Market' table.
 *
 * 
 *
 * @method     MarketQuery orderById($order = Criteria::ASC) Order by the id column
 *
 * @method     MarketQuery groupById() Group by the id column
 *
 * @method     MarketQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MarketQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MarketQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Market findOne(PropelPDO $con = null) Return the first Market matching the query
 * @method     Market findOneOrCreate(PropelPDO $con = null) Return the first Market matching the query, or a new Market object populated from the query conditions when no match is found
 *
 * @method     Market findOneById(int $id) Return the first Market filtered by the id column
 *
 * @method     array findById(int $id) Return Market objects filtered by the id column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseMarketQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseMarketQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Market', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MarketQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MarketQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MarketQuery) {
			return $criteria;
		}
		$query = new MarketQuery();
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
	 * @return    Market|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = MarketPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    MarketQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(MarketPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MarketQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(MarketPeer::ID, $keys, Criteria::IN);
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
	 * @return    MarketQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MarketPeer::ID, $id, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Market $market Object to remove from the list of results
	 *
	 * @return    MarketQuery The current query, for fluid interface
	 */
	public function prune($market = null)
	{
		if ($market) {
			$this->addUsingAlias(MarketPeer::ID, $market->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseMarketQuery
