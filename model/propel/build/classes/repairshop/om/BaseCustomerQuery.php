<?php


/**
 * Base class that represents a query for the 'Customer' table.
 *
 * 
 *
 * @method     CustomerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CustomerQuery orderByRewardPoint($order = Criteria::ASC) Order by the reward_point column
 * @method     CustomerQuery orderByRefererId($order = Criteria::ASC) Order by the referer_id column
 * @method     CustomerQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     CustomerQuery orderByFamilyId($order = Criteria::ASC) Order by the family_id column
 * @method     CustomerQuery orderByShopId($order = Criteria::ASC) Order by the shop_id column
 *
 * @method     CustomerQuery groupById() Group by the id column
 * @method     CustomerQuery groupByRewardPoint() Group by the reward_point column
 * @method     CustomerQuery groupByRefererId() Group by the referer_id column
 * @method     CustomerQuery groupByNotes() Group by the notes column
 * @method     CustomerQuery groupByFamilyId() Group by the family_id column
 * @method     CustomerQuery groupByShopId() Group by the shop_id column
 *
 * @method     CustomerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CustomerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CustomerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CustomerQuery leftJoinShop($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shop relation
 * @method     CustomerQuery rightJoinShop($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shop relation
 * @method     CustomerQuery innerJoinShop($relationAlias = null) Adds a INNER JOIN clause to the query using the Shop relation
 *
 * @method     CustomerQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     CustomerQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     CustomerQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     Customer findOne(PropelPDO $con = null) Return the first Customer matching the query
 * @method     Customer findOneOrCreate(PropelPDO $con = null) Return the first Customer matching the query, or a new Customer object populated from the query conditions when no match is found
 *
 * @method     Customer findOneById(int $id) Return the first Customer filtered by the id column
 * @method     Customer findOneByRewardPoint(int $reward_point) Return the first Customer filtered by the reward_point column
 * @method     Customer findOneByRefererId(int $referer_id) Return the first Customer filtered by the referer_id column
 * @method     Customer findOneByNotes(string $notes) Return the first Customer filtered by the notes column
 * @method     Customer findOneByFamilyId(int $family_id) Return the first Customer filtered by the family_id column
 * @method     Customer findOneByShopId(int $shop_id) Return the first Customer filtered by the shop_id column
 *
 * @method     array findById(int $id) Return Customer objects filtered by the id column
 * @method     array findByRewardPoint(int $reward_point) Return Customer objects filtered by the reward_point column
 * @method     array findByRefererId(int $referer_id) Return Customer objects filtered by the referer_id column
 * @method     array findByNotes(string $notes) Return Customer objects filtered by the notes column
 * @method     array findByFamilyId(int $family_id) Return Customer objects filtered by the family_id column
 * @method     array findByShopId(int $shop_id) Return Customer objects filtered by the shop_id column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseCustomerQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCustomerQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Customer', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CustomerQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CustomerQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CustomerQuery) {
			return $criteria;
		}
		$query = new CustomerQuery();
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
	 * @return    Customer|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CustomerPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CustomerPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CustomerPeer::ID, $keys, Criteria::IN);
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
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CustomerPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the reward_point column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRewardPoint(1234); // WHERE reward_point = 1234
	 * $query->filterByRewardPoint(array(12, 34)); // WHERE reward_point IN (12, 34)
	 * $query->filterByRewardPoint(array('min' => 12)); // WHERE reward_point > 12
	 * </code>
	 *
	 * @param     mixed $rewardPoint The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByRewardPoint($rewardPoint = null, $comparison = null)
	{
		if (is_array($rewardPoint)) {
			$useMinMax = false;
			if (isset($rewardPoint['min'])) {
				$this->addUsingAlias(CustomerPeer::REWARD_POINT, $rewardPoint['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($rewardPoint['max'])) {
				$this->addUsingAlias(CustomerPeer::REWARD_POINT, $rewardPoint['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CustomerPeer::REWARD_POINT, $rewardPoint, $comparison);
	}

	/**
	 * Filter the query on the referer_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRefererId(1234); // WHERE referer_id = 1234
	 * $query->filterByRefererId(array(12, 34)); // WHERE referer_id IN (12, 34)
	 * $query->filterByRefererId(array('min' => 12)); // WHERE referer_id > 12
	 * </code>
	 *
	 * @param     mixed $refererId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByRefererId($refererId = null, $comparison = null)
	{
		if (is_array($refererId)) {
			$useMinMax = false;
			if (isset($refererId['min'])) {
				$this->addUsingAlias(CustomerPeer::REFERER_ID, $refererId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($refererId['max'])) {
				$this->addUsingAlias(CustomerPeer::REFERER_ID, $refererId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CustomerPeer::REFERER_ID, $refererId, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::NOTES, $notes, $comparison);
	}

	/**
	 * Filter the query on the family_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByFamilyId(1234); // WHERE family_id = 1234
	 * $query->filterByFamilyId(array(12, 34)); // WHERE family_id IN (12, 34)
	 * $query->filterByFamilyId(array('min' => 12)); // WHERE family_id > 12
	 * </code>
	 *
	 * @param     mixed $familyId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByFamilyId($familyId = null, $comparison = null)
	{
		if (is_array($familyId)) {
			$useMinMax = false;
			if (isset($familyId['min'])) {
				$this->addUsingAlias(CustomerPeer::FAMILY_ID, $familyId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($familyId['max'])) {
				$this->addUsingAlias(CustomerPeer::FAMILY_ID, $familyId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CustomerPeer::FAMILY_ID, $familyId, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByShopId($shopId = null, $comparison = null)
	{
		if (is_array($shopId)) {
			$useMinMax = false;
			if (isset($shopId['min'])) {
				$this->addUsingAlias(CustomerPeer::SHOP_ID, $shopId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shopId['max'])) {
				$this->addUsingAlias(CustomerPeer::SHOP_ID, $shopId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CustomerPeer::SHOP_ID, $shopId, $comparison);
	}

	/**
	 * Filter the query by a related Shop object
	 *
	 * @param     Shop|PropelCollection $shop The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByShop($shop, $comparison = null)
	{
		if ($shop instanceof Shop) {
			return $this
				->addUsingAlias(CustomerPeer::SHOP_ID, $shop->getId(), $comparison);
		} elseif ($shop instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CustomerPeer::SHOP_ID, $shop->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
	 * Filter the query by a related User object
	 *
	 * @param     User $user  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(CustomerPeer::ID, $user->getCustomerId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			return $this
				->useUserQuery()
					->filterByPrimaryKeys($user->getPrimaryKeys())
				->endUse();
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
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Customer $customer Object to remove from the list of results
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function prune($customer = null)
	{
		if ($customer) {
			$this->addUsingAlias(CustomerPeer::ID, $customer->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCustomerQuery
