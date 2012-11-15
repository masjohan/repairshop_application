<?php


/**
 * Base class that represents a query for the 'Customer' table.
 *
 * 
 *
 * @method     CustomerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CustomerQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     CustomerQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     CustomerQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     CustomerQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     CustomerQuery orderByCell($order = Criteria::ASC) Order by the cell column
 * @method     CustomerQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     CustomerQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     CustomerQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     CustomerQuery orderByProvince($order = Criteria::ASC) Order by the province column
 * @method     CustomerQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     CustomerQuery orderByPostal($order = Criteria::ASC) Order by the postal column
 * @method     CustomerQuery orderByCompany($order = Criteria::ASC) Order by the company column
 * @method     CustomerQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     CustomerQuery orderByVipScore($order = Criteria::ASC) Order by the vip_score column
 *
 * @method     CustomerQuery groupById() Group by the id column
 * @method     CustomerQuery groupByTitle() Group by the title column
 * @method     CustomerQuery groupByFirstName() Group by the first_name column
 * @method     CustomerQuery groupByLastName() Group by the last_name column
 * @method     CustomerQuery groupByPhone() Group by the phone column
 * @method     CustomerQuery groupByCell() Group by the cell column
 * @method     CustomerQuery groupByEmail() Group by the email column
 * @method     CustomerQuery groupByAddress() Group by the address column
 * @method     CustomerQuery groupByCity() Group by the city column
 * @method     CustomerQuery groupByProvince() Group by the province column
 * @method     CustomerQuery groupByCountry() Group by the country column
 * @method     CustomerQuery groupByPostal() Group by the postal column
 * @method     CustomerQuery groupByCompany() Group by the company column
 * @method     CustomerQuery groupByNotes() Group by the notes column
 * @method     CustomerQuery groupByVipScore() Group by the vip_score column
 *
 * @method     CustomerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CustomerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CustomerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Customer findOne(PropelPDO $con = null) Return the first Customer matching the query
 * @method     Customer findOneOrCreate(PropelPDO $con = null) Return the first Customer matching the query, or a new Customer object populated from the query conditions when no match is found
 *
 * @method     Customer findOneById(int $id) Return the first Customer filtered by the id column
 * @method     Customer findOneByTitle(string $title) Return the first Customer filtered by the title column
 * @method     Customer findOneByFirstName(string $first_name) Return the first Customer filtered by the first_name column
 * @method     Customer findOneByLastName(string $last_name) Return the first Customer filtered by the last_name column
 * @method     Customer findOneByPhone(string $phone) Return the first Customer filtered by the phone column
 * @method     Customer findOneByCell(string $cell) Return the first Customer filtered by the cell column
 * @method     Customer findOneByEmail(string $email) Return the first Customer filtered by the email column
 * @method     Customer findOneByAddress(string $address) Return the first Customer filtered by the address column
 * @method     Customer findOneByCity(string $city) Return the first Customer filtered by the city column
 * @method     Customer findOneByProvince(string $province) Return the first Customer filtered by the province column
 * @method     Customer findOneByCountry(string $country) Return the first Customer filtered by the country column
 * @method     Customer findOneByPostal(string $postal) Return the first Customer filtered by the postal column
 * @method     Customer findOneByCompany(string $company) Return the first Customer filtered by the company column
 * @method     Customer findOneByNotes(string $notes) Return the first Customer filtered by the notes column
 * @method     Customer findOneByVipScore(int $vip_score) Return the first Customer filtered by the vip_score column
 *
 * @method     array findById(int $id) Return Customer objects filtered by the id column
 * @method     array findByTitle(string $title) Return Customer objects filtered by the title column
 * @method     array findByFirstName(string $first_name) Return Customer objects filtered by the first_name column
 * @method     array findByLastName(string $last_name) Return Customer objects filtered by the last_name column
 * @method     array findByPhone(string $phone) Return Customer objects filtered by the phone column
 * @method     array findByCell(string $cell) Return Customer objects filtered by the cell column
 * @method     array findByEmail(string $email) Return Customer objects filtered by the email column
 * @method     array findByAddress(string $address) Return Customer objects filtered by the address column
 * @method     array findByCity(string $city) Return Customer objects filtered by the city column
 * @method     array findByProvince(string $province) Return Customer objects filtered by the province column
 * @method     array findByCountry(string $country) Return Customer objects filtered by the country column
 * @method     array findByPostal(string $postal) Return Customer objects filtered by the postal column
 * @method     array findByCompany(string $company) Return Customer objects filtered by the company column
 * @method     array findByNotes(string $notes) Return Customer objects filtered by the notes column
 * @method     array findByVipScore(int $vip_score) Return Customer objects filtered by the vip_score column
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
	 * Filter the query on the title column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CustomerPeer::TITLE, $title, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::FIRST_NAME, $firstName, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::LAST_NAME, $lastName, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::PHONE, $phone, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::CELL, $cell, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::EMAIL, $email, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::ADDRESS, $address, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::CITY, $city, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::PROVINCE, $province, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::COUNTRY, $country, $comparison);
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
	 * @return    CustomerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CustomerPeer::POSTAL, $postal, $comparison);
	}

	/**
	 * Filter the query on the company column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCompany('fooValue');   // WHERE company = 'fooValue'
	 * $query->filterByCompany('%fooValue%'); // WHERE company LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $company The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByCompany($company = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($company)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $company)) {
				$company = str_replace('*', '%', $company);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CustomerPeer::COMPANY, $company, $comparison);
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
	 * Filter the query on the vip_score column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByVipScore(1234); // WHERE vip_score = 1234
	 * $query->filterByVipScore(array(12, 34)); // WHERE vip_score IN (12, 34)
	 * $query->filterByVipScore(array('min' => 12)); // WHERE vip_score > 12
	 * </code>
	 *
	 * @param     mixed $vipScore The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CustomerQuery The current query, for fluid interface
	 */
	public function filterByVipScore($vipScore = null, $comparison = null)
	{
		if (is_array($vipScore)) {
			$useMinMax = false;
			if (isset($vipScore['min'])) {
				$this->addUsingAlias(CustomerPeer::VIP_SCORE, $vipScore['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($vipScore['max'])) {
				$this->addUsingAlias(CustomerPeer::VIP_SCORE, $vipScore['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CustomerPeer::VIP_SCORE, $vipScore, $comparison);
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
