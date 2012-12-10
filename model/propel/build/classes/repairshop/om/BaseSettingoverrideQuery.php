<?php


/**
 * Base class that represents a query for the 'SettingOverride' table.
 *
 * 
 *
 * @method     SettingoverrideQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SettingoverrideQuery orderBySettingId($order = Criteria::ASC) Order by the setting_id column
 * @method     SettingoverrideQuery orderByRoleTypeId($order = Criteria::ASC) Order by the role_type_id column
 * @method     SettingoverrideQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     SettingoverrideQuery groupById() Group by the id column
 * @method     SettingoverrideQuery groupBySettingId() Group by the setting_id column
 * @method     SettingoverrideQuery groupByRoleTypeId() Group by the role_type_id column
 * @method     SettingoverrideQuery groupByValue() Group by the value column
 *
 * @method     SettingoverrideQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SettingoverrideQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SettingoverrideQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SettingoverrideQuery leftJoinSetting($relationAlias = null) Adds a LEFT JOIN clause to the query using the Setting relation
 * @method     SettingoverrideQuery rightJoinSetting($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Setting relation
 * @method     SettingoverrideQuery innerJoinSetting($relationAlias = null) Adds a INNER JOIN clause to the query using the Setting relation
 *
 * @method     Settingoverride findOne(PropelPDO $con = null) Return the first Settingoverride matching the query
 * @method     Settingoverride findOneOrCreate(PropelPDO $con = null) Return the first Settingoverride matching the query, or a new Settingoverride object populated from the query conditions when no match is found
 *
 * @method     Settingoverride findOneById(int $id) Return the first Settingoverride filtered by the id column
 * @method     Settingoverride findOneBySettingId(int $setting_id) Return the first Settingoverride filtered by the setting_id column
 * @method     Settingoverride findOneByRoleTypeId(int $role_type_id) Return the first Settingoverride filtered by the role_type_id column
 * @method     Settingoverride findOneByValue(string $value) Return the first Settingoverride filtered by the value column
 *
 * @method     array findById(int $id) Return Settingoverride objects filtered by the id column
 * @method     array findBySettingId(int $setting_id) Return Settingoverride objects filtered by the setting_id column
 * @method     array findByRoleTypeId(int $role_type_id) Return Settingoverride objects filtered by the role_type_id column
 * @method     array findByValue(string $value) Return Settingoverride objects filtered by the value column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseSettingoverrideQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSettingoverrideQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Settingoverride', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SettingoverrideQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SettingoverrideQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SettingoverrideQuery) {
			return $criteria;
		}
		$query = new SettingoverrideQuery();
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
	 * @return    Settingoverride|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SettingoverridePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SettingoverrideQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SettingoverridePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SettingoverrideQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SettingoverridePeer::ID, $keys, Criteria::IN);
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
	 * @return    SettingoverrideQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SettingoverridePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the setting_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySettingId(1234); // WHERE setting_id = 1234
	 * $query->filterBySettingId(array(12, 34)); // WHERE setting_id IN (12, 34)
	 * $query->filterBySettingId(array('min' => 12)); // WHERE setting_id > 12
	 * </code>
	 *
	 * @see       filterBySetting()
	 *
	 * @param     mixed $settingId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingoverrideQuery The current query, for fluid interface
	 */
	public function filterBySettingId($settingId = null, $comparison = null)
	{
		if (is_array($settingId)) {
			$useMinMax = false;
			if (isset($settingId['min'])) {
				$this->addUsingAlias(SettingoverridePeer::SETTING_ID, $settingId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($settingId['max'])) {
				$this->addUsingAlias(SettingoverridePeer::SETTING_ID, $settingId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SettingoverridePeer::SETTING_ID, $settingId, $comparison);
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
	 * @return    SettingoverrideQuery The current query, for fluid interface
	 */
	public function filterByRoleTypeId($roleTypeId = null, $comparison = null)
	{
		if (is_array($roleTypeId)) {
			$useMinMax = false;
			if (isset($roleTypeId['min'])) {
				$this->addUsingAlias(SettingoverridePeer::ROLE_TYPE_ID, $roleTypeId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roleTypeId['max'])) {
				$this->addUsingAlias(SettingoverridePeer::ROLE_TYPE_ID, $roleTypeId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SettingoverridePeer::ROLE_TYPE_ID, $roleTypeId, $comparison);
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
	 * @return    SettingoverrideQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SettingoverridePeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query by a related Setting object
	 *
	 * @param     Setting|PropelCollection $setting The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SettingoverrideQuery The current query, for fluid interface
	 */
	public function filterBySetting($setting, $comparison = null)
	{
		if ($setting instanceof Setting) {
			return $this
				->addUsingAlias(SettingoverridePeer::SETTING_ID, $setting->getId(), $comparison);
		} elseif ($setting instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SettingoverridePeer::SETTING_ID, $setting->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterBySetting() only accepts arguments of type Setting or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Setting relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SettingoverrideQuery The current query, for fluid interface
	 */
	public function joinSetting($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Setting');
		
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
			$this->addJoinObject($join, 'Setting');
		}
		
		return $this;
	}

	/**
	 * Use the Setting relation Setting object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SettingQuery A secondary query class using the current class as primary query
	 */
	public function useSettingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSetting($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Setting', 'SettingQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Settingoverride $settingoverride Object to remove from the list of results
	 *
	 * @return    SettingoverrideQuery The current query, for fluid interface
	 */
	public function prune($settingoverride = null)
	{
		if ($settingoverride) {
			$this->addUsingAlias(SettingoverridePeer::ID, $settingoverride->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSettingoverrideQuery
