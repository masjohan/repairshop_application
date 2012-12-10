<?php


/**
 * Base class that represents a query for the 'Setting' table.
 *
 * 
 *
 * @method     SettingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SettingQuery orderByRoleType($order = Criteria::ASC) Order by the role_type column
 * @method     SettingQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SettingQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     SettingQuery orderByMemo($order = Criteria::ASC) Order by the memo column
 * @method     SettingQuery orderBySysOverride($order = Criteria::ASC) Order by the sys_override column
 * @method     SettingQuery orderByUsrOverride($order = Criteria::ASC) Order by the usr_override column
 * @method     SettingQuery orderByUsrValidator($order = Criteria::ASC) Order by the usr_validator column
 *
 * @method     SettingQuery groupById() Group by the id column
 * @method     SettingQuery groupByRoleType() Group by the role_type column
 * @method     SettingQuery groupByName() Group by the name column
 * @method     SettingQuery groupByValue() Group by the value column
 * @method     SettingQuery groupByMemo() Group by the memo column
 * @method     SettingQuery groupBySysOverride() Group by the sys_override column
 * @method     SettingQuery groupByUsrOverride() Group by the usr_override column
 * @method     SettingQuery groupByUsrValidator() Group by the usr_validator column
 *
 * @method     SettingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SettingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SettingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SettingQuery leftJoinSettingoverride($relationAlias = null) Adds a LEFT JOIN clause to the query using the Settingoverride relation
 * @method     SettingQuery rightJoinSettingoverride($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Settingoverride relation
 * @method     SettingQuery innerJoinSettingoverride($relationAlias = null) Adds a INNER JOIN clause to the query using the Settingoverride relation
 *
 * @method     Setting findOne(PropelPDO $con = null) Return the first Setting matching the query
 * @method     Setting findOneOrCreate(PropelPDO $con = null) Return the first Setting matching the query, or a new Setting object populated from the query conditions when no match is found
 *
 * @method     Setting findOneById(int $id) Return the first Setting filtered by the id column
 * @method     Setting findOneByRoleType(int $role_type) Return the first Setting filtered by the role_type column
 * @method     Setting findOneByName(string $name) Return the first Setting filtered by the name column
 * @method     Setting findOneByValue(string $value) Return the first Setting filtered by the value column
 * @method     Setting findOneByMemo(string $memo) Return the first Setting filtered by the memo column
 * @method     Setting findOneBySysOverride(boolean $sys_override) Return the first Setting filtered by the sys_override column
 * @method     Setting findOneByUsrOverride(boolean $usr_override) Return the first Setting filtered by the usr_override column
 * @method     Setting findOneByUsrValidator(string $usr_validator) Return the first Setting filtered by the usr_validator column
 *
 * @method     array findById(int $id) Return Setting objects filtered by the id column
 * @method     array findByRoleType(int $role_type) Return Setting objects filtered by the role_type column
 * @method     array findByName(string $name) Return Setting objects filtered by the name column
 * @method     array findByValue(string $value) Return Setting objects filtered by the value column
 * @method     array findByMemo(string $memo) Return Setting objects filtered by the memo column
 * @method     array findBySysOverride(boolean $sys_override) Return Setting objects filtered by the sys_override column
 * @method     array findByUsrOverride(boolean $usr_override) Return Setting objects filtered by the usr_override column
 * @method     array findByUsrValidator(string $usr_validator) Return Setting objects filtered by the usr_validator column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseSettingQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSettingQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Setting', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SettingQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SettingQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SettingQuery) {
			return $criteria;
		}
		$query = new SettingQuery();
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
	 * @return    Setting|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SettingPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SettingPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SettingPeer::ID, $keys, Criteria::IN);
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
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SettingPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the role_type column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRoleType(1234); // WHERE role_type = 1234
	 * $query->filterByRoleType(array(12, 34)); // WHERE role_type IN (12, 34)
	 * $query->filterByRoleType(array('min' => 12)); // WHERE role_type > 12
	 * </code>
	 *
	 * @param     mixed $roleType The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterByRoleType($roleType = null, $comparison = null)
	{
		if (is_array($roleType)) {
			$useMinMax = false;
			if (isset($roleType['min'])) {
				$this->addUsingAlias(SettingPeer::ROLE_TYPE, $roleType['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roleType['max'])) {
				$this->addUsingAlias(SettingPeer::ROLE_TYPE, $roleType['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SettingPeer::ROLE_TYPE, $roleType, $comparison);
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
	 * @return    SettingQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SettingPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the value column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
	 * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $value The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterByValue($value = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($value)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $value)) {
				$value = str_replace('*', '%', $value);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SettingPeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query on the memo column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByMemo('fooValue');   // WHERE memo = 'fooValue'
	 * $query->filterByMemo('%fooValue%'); // WHERE memo LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $memo The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterByMemo($memo = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($memo)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $memo)) {
				$memo = str_replace('*', '%', $memo);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SettingPeer::MEMO, $memo, $comparison);
	}

	/**
	 * Filter the query on the sys_override column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySysOverride(true); // WHERE sys_override = true
	 * $query->filterBySysOverride('yes'); // WHERE sys_override = true
	 * </code>
	 *
	 * @param     boolean|string $sysOverride The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterBySysOverride($sysOverride = null, $comparison = null)
	{
		if (is_string($sysOverride)) {
			$sys_override = in_array(strtolower($sysOverride), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SettingPeer::SYS_OVERRIDE, $sysOverride, $comparison);
	}

	/**
	 * Filter the query on the usr_override column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUsrOverride(true); // WHERE usr_override = true
	 * $query->filterByUsrOverride('yes'); // WHERE usr_override = true
	 * </code>
	 *
	 * @param     boolean|string $usrOverride The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterByUsrOverride($usrOverride = null, $comparison = null)
	{
		if (is_string($usrOverride)) {
			$usr_override = in_array(strtolower($usrOverride), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SettingPeer::USR_OVERRIDE, $usrOverride, $comparison);
	}

	/**
	 * Filter the query on the usr_validator column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUsrValidator('fooValue');   // WHERE usr_validator = 'fooValue'
	 * $query->filterByUsrValidator('%fooValue%'); // WHERE usr_validator LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $usrValidator The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterByUsrValidator($usrValidator = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($usrValidator)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $usrValidator)) {
				$usrValidator = str_replace('*', '%', $usrValidator);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SettingPeer::USR_VALIDATOR, $usrValidator, $comparison);
	}

	/**
	 * Filter the query by a related Settingoverride object
	 *
	 * @param     Settingoverride $settingoverride  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function filterBySettingoverride($settingoverride, $comparison = null)
	{
		if ($settingoverride instanceof Settingoverride) {
			return $this
				->addUsingAlias(SettingPeer::ID, $settingoverride->getSettingId(), $comparison);
		} elseif ($settingoverride instanceof PropelCollection) {
			return $this
				->useSettingoverrideQuery()
					->filterByPrimaryKeys($settingoverride->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterBySettingoverride() only accepts arguments of type Settingoverride or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Settingoverride relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function joinSettingoverride($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Settingoverride');
		
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
			$this->addJoinObject($join, 'Settingoverride');
		}
		
		return $this;
	}

	/**
	 * Use the Settingoverride relation Settingoverride object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SettingoverrideQuery A secondary query class using the current class as primary query
	 */
	public function useSettingoverrideQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSettingoverride($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Settingoverride', 'SettingoverrideQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Setting $setting Object to remove from the list of results
	 *
	 * @return    SettingQuery The current query, for fluid interface
	 */
	public function prune($setting = null)
	{
		if ($setting) {
			$this->addUsingAlias(SettingPeer::ID, $setting->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSettingQuery
