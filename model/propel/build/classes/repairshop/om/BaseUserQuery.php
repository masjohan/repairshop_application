<?php


/**
 * Base class that represents a query for the 'User' table.
 *
 * 
 *
 * @method     UserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     UserQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     UserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     UserQuery orderByPasswd($order = Criteria::ASC) Order by the passwd column
 * @method     UserQuery orderByGreeting($order = Criteria::ASC) Order by the greeting column
 * @method     UserQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     UserQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     UserQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     UserQuery orderByCell($order = Criteria::ASC) Order by the cell column
 * @method     UserQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     UserQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     UserQuery orderByProvince($order = Criteria::ASC) Order by the province column
 * @method     UserQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     UserQuery orderByPostal($order = Criteria::ASC) Order by the postal column
 * @method     UserQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     UserQuery orderByRoleTypeId($order = Criteria::ASC) Order by the role_type_id column
 * @method     UserQuery orderByRecoveryToken($order = Criteria::ASC) Order by the recovery_token column
 * @method     UserQuery orderByRecoverySent($order = Criteria::ASC) Order by the recovery_sent column
 *
 * @method     UserQuery groupById() Group by the id column
 * @method     UserQuery groupByUsername() Group by the username column
 * @method     UserQuery groupByEmail() Group by the email column
 * @method     UserQuery groupByPasswd() Group by the passwd column
 * @method     UserQuery groupByGreeting() Group by the greeting column
 * @method     UserQuery groupByFirstName() Group by the first_name column
 * @method     UserQuery groupByLastName() Group by the last_name column
 * @method     UserQuery groupByPhone() Group by the phone column
 * @method     UserQuery groupByCell() Group by the cell column
 * @method     UserQuery groupByAddress() Group by the address column
 * @method     UserQuery groupByCity() Group by the city column
 * @method     UserQuery groupByProvince() Group by the province column
 * @method     UserQuery groupByCountry() Group by the country column
 * @method     UserQuery groupByPostal() Group by the postal column
 * @method     UserQuery groupByRoleId() Group by the role_id column
 * @method     UserQuery groupByRoleTypeId() Group by the role_type_id column
 * @method     UserQuery groupByRecoveryToken() Group by the recovery_token column
 * @method     UserQuery groupByRecoverySent() Group by the recovery_sent column
 *
 * @method     UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     UserQuery leftJoinRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the Role relation
 * @method     UserQuery rightJoinRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Role relation
 * @method     UserQuery innerJoinRole($relationAlias = null) Adds a INNER JOIN clause to the query using the Role relation
 *
 * @method     User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method     User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method     User findOneById(int $id) Return the first User filtered by the id column
 * @method     User findOneByUsername(string $username) Return the first User filtered by the username column
 * @method     User findOneByEmail(string $email) Return the first User filtered by the email column
 * @method     User findOneByPasswd(string $passwd) Return the first User filtered by the passwd column
 * @method     User findOneByGreeting(string $greeting) Return the first User filtered by the greeting column
 * @method     User findOneByFirstName(string $first_name) Return the first User filtered by the first_name column
 * @method     User findOneByLastName(string $last_name) Return the first User filtered by the last_name column
 * @method     User findOneByPhone(string $phone) Return the first User filtered by the phone column
 * @method     User findOneByCell(string $cell) Return the first User filtered by the cell column
 * @method     User findOneByAddress(string $address) Return the first User filtered by the address column
 * @method     User findOneByCity(string $city) Return the first User filtered by the city column
 * @method     User findOneByProvince(string $province) Return the first User filtered by the province column
 * @method     User findOneByCountry(string $country) Return the first User filtered by the country column
 * @method     User findOneByPostal(string $postal) Return the first User filtered by the postal column
 * @method     User findOneByRoleId(int $role_id) Return the first User filtered by the role_id column
 * @method     User findOneByRoleTypeId(int $role_type_id) Return the first User filtered by the role_type_id column
 * @method     User findOneByRecoveryToken(string $recovery_token) Return the first User filtered by the recovery_token column
 * @method     User findOneByRecoverySent(string $recovery_sent) Return the first User filtered by the recovery_sent column
 *
 * @method     array findById(int $id) Return User objects filtered by the id column
 * @method     array findByUsername(string $username) Return User objects filtered by the username column
 * @method     array findByEmail(string $email) Return User objects filtered by the email column
 * @method     array findByPasswd(string $passwd) Return User objects filtered by the passwd column
 * @method     array findByGreeting(string $greeting) Return User objects filtered by the greeting column
 * @method     array findByFirstName(string $first_name) Return User objects filtered by the first_name column
 * @method     array findByLastName(string $last_name) Return User objects filtered by the last_name column
 * @method     array findByPhone(string $phone) Return User objects filtered by the phone column
 * @method     array findByCell(string $cell) Return User objects filtered by the cell column
 * @method     array findByAddress(string $address) Return User objects filtered by the address column
 * @method     array findByCity(string $city) Return User objects filtered by the city column
 * @method     array findByProvince(string $province) Return User objects filtered by the province column
 * @method     array findByCountry(string $country) Return User objects filtered by the country column
 * @method     array findByPostal(string $postal) Return User objects filtered by the postal column
 * @method     array findByRoleId(int $role_id) Return User objects filtered by the role_id column
 * @method     array findByRoleTypeId(int $role_type_id) Return User objects filtered by the role_type_id column
 * @method     array findByRecoveryToken(string $recovery_token) Return User objects filtered by the recovery_token column
 * @method     array findByRecoverySent(string $recovery_sent) Return User objects filtered by the recovery_sent column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseUserQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseUserQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'User', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new UserQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    UserQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof UserQuery) {
			return $criteria;
		}
		$query = new UserQuery();
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
	 * @return    User|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(UserPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(UserPeer::ID, $keys, Criteria::IN);
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
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(UserPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the username column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
	 * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $username The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByUsername($username = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($username)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $username)) {
				$username = str_replace('*', '%', $username);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::USERNAME, $username, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::EMAIL, $email, $comparison);
	}

	/**
	 * Filter the query on the passwd column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPasswd('fooValue');   // WHERE passwd = 'fooValue'
	 * $query->filterByPasswd('%fooValue%'); // WHERE passwd LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $passwd The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPasswd($passwd = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($passwd)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $passwd)) {
				$passwd = str_replace('*', '%', $passwd);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::PASSWD, $passwd, $comparison);
	}

	/**
	 * Filter the query on the greeting column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByGreeting('fooValue');   // WHERE greeting = 'fooValue'
	 * $query->filterByGreeting('%fooValue%'); // WHERE greeting LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $greeting The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByGreeting($greeting = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($greeting)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $greeting)) {
				$greeting = str_replace('*', '%', $greeting);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::GREETING, $greeting, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::FIRST_NAME, $firstName, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::LAST_NAME, $lastName, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::PHONE, $phone, $comparison);
	}

	/**
	 * Filter the query on the cell column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCell('fooValue');   // WHERE cell = 'fooValue'
	 * $query->filterByCell('%fooValue%'); // WHERE cell LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cell The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByCell($cell = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cell)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cell)) {
				$cell = str_replace('*', '%', $cell);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::CELL, $cell, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::ADDRESS, $address, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::CITY, $city, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::PROVINCE, $province, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::COUNTRY, $country, $comparison);
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
	 * @return    UserQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserPeer::POSTAL, $postal, $comparison);
	}

	/**
	 * Filter the query on the role_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRoleId(1234); // WHERE role_id = 1234
	 * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
	 * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
	 * </code>
	 *
	 * @see       filterByRole()
	 *
	 * @param     mixed $roleId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByRoleId($roleId = null, $comparison = null)
	{
		if (is_array($roleId)) {
			$useMinMax = false;
			if (isset($roleId['min'])) {
				$this->addUsingAlias(UserPeer::ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roleId['max'])) {
				$this->addUsingAlias(UserPeer::ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::ROLE_ID, $roleId, $comparison);
	}

	/**
	 * Filter the query on the role_type_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRoleTypeId(1234); // WHERE role_type_id = 1234
	 * $query->filterByRoleTypeId(array(12, 34)); // WHERE role_type_id IN (12, 34)
	 * $query->filterByRoleTypeId(array('min' => 12)); // WHERE role_type_id > 12
	 * </code>
	 *
	 * @param     mixed $roleTypeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByRoleTypeId($roleTypeId = null, $comparison = null)
	{
		if (is_array($roleTypeId)) {
			$useMinMax = false;
			if (isset($roleTypeId['min'])) {
				$this->addUsingAlias(UserPeer::ROLE_TYPE_ID, $roleTypeId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roleTypeId['max'])) {
				$this->addUsingAlias(UserPeer::ROLE_TYPE_ID, $roleTypeId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::ROLE_TYPE_ID, $roleTypeId, $comparison);
	}

	/**
	 * Filter the query on the recovery_token column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRecoveryToken('fooValue');   // WHERE recovery_token = 'fooValue'
	 * $query->filterByRecoveryToken('%fooValue%'); // WHERE recovery_token LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $recoveryToken The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByRecoveryToken($recoveryToken = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($recoveryToken)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $recoveryToken)) {
				$recoveryToken = str_replace('*', '%', $recoveryToken);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::RECOVERY_TOKEN, $recoveryToken, $comparison);
	}

	/**
	 * Filter the query on the recovery_sent column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRecoverySent('2011-03-14'); // WHERE recovery_sent = '2011-03-14'
	 * $query->filterByRecoverySent('now'); // WHERE recovery_sent = '2011-03-14'
	 * $query->filterByRecoverySent(array('max' => 'yesterday')); // WHERE recovery_sent > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $recoverySent The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByRecoverySent($recoverySent = null, $comparison = null)
	{
		if (is_array($recoverySent)) {
			$useMinMax = false;
			if (isset($recoverySent['min'])) {
				$this->addUsingAlias(UserPeer::RECOVERY_SENT, $recoverySent['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($recoverySent['max'])) {
				$this->addUsingAlias(UserPeer::RECOVERY_SENT, $recoverySent['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::RECOVERY_SENT, $recoverySent, $comparison);
	}

	/**
	 * Filter the query by a related Role object
	 *
	 * @param     Role|PropelCollection $role The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByRole($role, $comparison = null)
	{
		if ($role instanceof Role) {
			return $this
				->addUsingAlias(UserPeer::ROLE_ID, $role->getId(), $comparison);
		} elseif ($role instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(UserPeer::ROLE_ID, $role->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByRole() only accepts arguments of type Role or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Role relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinRole($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Role');
		
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
			$this->addJoinObject($join, 'Role');
		}
		
		return $this;
	}

	/**
	 * Use the Role relation Role object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RoleQuery A secondary query class using the current class as primary query
	 */
	public function useRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRole($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Role', 'RoleQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     User $user Object to remove from the list of results
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function prune($user = null)
	{
		if ($user) {
			$this->addUsingAlias(UserPeer::ID, $user->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseUserQuery
