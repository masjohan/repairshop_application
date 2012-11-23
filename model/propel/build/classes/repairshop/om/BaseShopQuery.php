<?php


/**
 * Base class that represents a query for the 'Shop' table.
 *
 * 
 *
 * @method     ShopQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ShopQuery orderByChainId($order = Criteria::ASC) Order by the chain_id column
 * @method     ShopQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ShopQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ShopQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ShopQuery orderByProvince($order = Criteria::ASC) Order by the province column
 * @method     ShopQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ShopQuery orderByPostal($order = Criteria::ASC) Order by the postal column
 * @method     ShopQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ShopQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method     ShopQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ShopQuery orderByOwnerId($order = Criteria::ASC) Order by the owner_id column
 * @method     ShopQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 *
 * @method     ShopQuery groupById() Group by the id column
 * @method     ShopQuery groupByChainId() Group by the chain_id column
 * @method     ShopQuery groupByName() Group by the name column
 * @method     ShopQuery groupByAddress() Group by the address column
 * @method     ShopQuery groupByCity() Group by the city column
 * @method     ShopQuery groupByProvince() Group by the province column
 * @method     ShopQuery groupByCountry() Group by the country column
 * @method     ShopQuery groupByPostal() Group by the postal column
 * @method     ShopQuery groupByPhone() Group by the phone column
 * @method     ShopQuery groupByFax() Group by the fax column
 * @method     ShopQuery groupByEmail() Group by the email column
 * @method     ShopQuery groupByOwnerId() Group by the owner_id column
 * @method     ShopQuery groupByNotes() Group by the notes column
 *
 * @method     ShopQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ShopQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ShopQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ShopQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ShopQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ShopQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ShopQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ShopQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ShopQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     Shop findOne(PropelPDO $con = null) Return the first Shop matching the query
 * @method     Shop findOneOrCreate(PropelPDO $con = null) Return the first Shop matching the query, or a new Shop object populated from the query conditions when no match is found
 *
 * @method     Shop findOneById(int $id) Return the first Shop filtered by the id column
 * @method     Shop findOneByChainId(int $chain_id) Return the first Shop filtered by the chain_id column
 * @method     Shop findOneByName(string $name) Return the first Shop filtered by the name column
 * @method     Shop findOneByAddress(string $address) Return the first Shop filtered by the address column
 * @method     Shop findOneByCity(string $city) Return the first Shop filtered by the city column
 * @method     Shop findOneByProvince(string $province) Return the first Shop filtered by the province column
 * @method     Shop findOneByCountry(string $country) Return the first Shop filtered by the country column
 * @method     Shop findOneByPostal(string $postal) Return the first Shop filtered by the postal column
 * @method     Shop findOneByPhone(string $phone) Return the first Shop filtered by the phone column
 * @method     Shop findOneByFax(string $fax) Return the first Shop filtered by the fax column
 * @method     Shop findOneByEmail(string $email) Return the first Shop filtered by the email column
 * @method     Shop findOneByOwnerId(int $owner_id) Return the first Shop filtered by the owner_id column
 * @method     Shop findOneByNotes(string $notes) Return the first Shop filtered by the notes column
 *
 * @method     array findById(int $id) Return Shop objects filtered by the id column
 * @method     array findByChainId(int $chain_id) Return Shop objects filtered by the chain_id column
 * @method     array findByName(string $name) Return Shop objects filtered by the name column
 * @method     array findByAddress(string $address) Return Shop objects filtered by the address column
 * @method     array findByCity(string $city) Return Shop objects filtered by the city column
 * @method     array findByProvince(string $province) Return Shop objects filtered by the province column
 * @method     array findByCountry(string $country) Return Shop objects filtered by the country column
 * @method     array findByPostal(string $postal) Return Shop objects filtered by the postal column
 * @method     array findByPhone(string $phone) Return Shop objects filtered by the phone column
 * @method     array findByFax(string $fax) Return Shop objects filtered by the fax column
 * @method     array findByEmail(string $email) Return Shop objects filtered by the email column
 * @method     array findByOwnerId(int $owner_id) Return Shop objects filtered by the owner_id column
 * @method     array findByNotes(string $notes) Return Shop objects filtered by the notes column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseShopQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseShopQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Shop', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ShopQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ShopQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ShopQuery) {
			return $criteria;
		}
		$query = new ShopQuery();
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
	 * @return    Shop|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ShopPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ShopPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ShopPeer::ID, $keys, Criteria::IN);
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
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ShopPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the chain_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByChainId(1234); // WHERE chain_id = 1234
	 * $query->filterByChainId(array(12, 34)); // WHERE chain_id IN (12, 34)
	 * $query->filterByChainId(array('min' => 12)); // WHERE chain_id > 12
	 * </code>
	 *
	 * @param     mixed $chainId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByChainId($chainId = null, $comparison = null)
	{
		if (is_array($chainId)) {
			$useMinMax = false;
			if (isset($chainId['min'])) {
				$this->addUsingAlias(ShopPeer::CHAIN_ID, $chainId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($chainId['max'])) {
				$this->addUsingAlias(ShopPeer::CHAIN_ID, $chainId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShopPeer::CHAIN_ID, $chainId, $comparison);
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
	 * @return    ShopQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ShopPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the address column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
	 * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $address The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByAddress($address = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($address)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $address)) {
				$address = str_replace('*', '%', $address);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShopPeer::ADDRESS, $address, $comparison);
	}

	/**
	 * Filter the query on the city column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
	 * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $city The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByCity($city = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($city)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $city)) {
				$city = str_replace('*', '%', $city);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShopPeer::CITY, $city, $comparison);
	}

	/**
	 * Filter the query on the province column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByProvince('fooValue');   // WHERE province = 'fooValue'
	 * $query->filterByProvince('%fooValue%'); // WHERE province LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $province The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByProvince($province = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($province)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $province)) {
				$province = str_replace('*', '%', $province);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShopPeer::PROVINCE, $province, $comparison);
	}

	/**
	 * Filter the query on the country column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
	 * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $country The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByCountry($country = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($country)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $country)) {
				$country = str_replace('*', '%', $country);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShopPeer::COUNTRY, $country, $comparison);
	}

	/**
	 * Filter the query on the postal column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPostal('fooValue');   // WHERE postal = 'fooValue'
	 * $query->filterByPostal('%fooValue%'); // WHERE postal LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $postal The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByPostal($postal = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($postal)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $postal)) {
				$postal = str_replace('*', '%', $postal);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShopPeer::POSTAL, $postal, $comparison);
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
	 * @return    ShopQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ShopPeer::PHONE, $phone, $comparison);
	}

	/**
	 * Filter the query on the fax column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByFax('fooValue');   // WHERE fax = 'fooValue'
	 * $query->filterByFax('%fooValue%'); // WHERE fax LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $fax The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByFax($fax = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fax)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fax)) {
				$fax = str_replace('*', '%', $fax);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShopPeer::FAX, $fax, $comparison);
	}

	/**
	 * Filter the query on the email column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
	 * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $email The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByEmail($email = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($email)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $email)) {
				$email = str_replace('*', '%', $email);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShopPeer::EMAIL, $email, $comparison);
	}

	/**
	 * Filter the query on the owner_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByOwnerId(1234); // WHERE owner_id = 1234
	 * $query->filterByOwnerId(array(12, 34)); // WHERE owner_id IN (12, 34)
	 * $query->filterByOwnerId(array('min' => 12)); // WHERE owner_id > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $ownerId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByOwnerId($ownerId = null, $comparison = null)
	{
		if (is_array($ownerId)) {
			$useMinMax = false;
			if (isset($ownerId['min'])) {
				$this->addUsingAlias(ShopPeer::OWNER_ID, $ownerId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ownerId['max'])) {
				$this->addUsingAlias(ShopPeer::OWNER_ID, $ownerId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ShopPeer::OWNER_ID, $ownerId, $comparison);
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
	 * @return    ShopQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ShopPeer::NOTES, $notes, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(ShopPeer::OWNER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ShopPeer::OWNER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    ShopQuery The current query, for fluid interface
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
	 * Filter the query by a related Customer object
	 *
	 * @param     Customer $customer  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function filterByCustomer($customer, $comparison = null)
	{
		if ($customer instanceof Customer) {
			return $this
				->addUsingAlias(ShopPeer::ID, $customer->getShopId(), $comparison);
		} elseif ($customer instanceof PropelCollection) {
			return $this
				->useCustomerQuery()
					->filterByPrimaryKeys($customer->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByCustomer() only accepts arguments of type Customer or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Customer relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function joinCustomer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Customer');
		
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
			$this->addJoinObject($join, 'Customer');
		}
		
		return $this;
	}

	/**
	 * Use the Customer relation Customer object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CustomerQuery A secondary query class using the current class as primary query
	 */
	public function useCustomerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCustomer($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Customer', 'CustomerQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Shop $shop Object to remove from the list of results
	 *
	 * @return    ShopQuery The current query, for fluid interface
	 */
	public function prune($shop = null)
	{
		if ($shop) {
			$this->addUsingAlias(ShopPeer::ID, $shop->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseShopQuery
