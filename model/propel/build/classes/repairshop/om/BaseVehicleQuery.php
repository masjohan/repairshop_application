<?php


/**
 * Base class that represents a query for the 'Vehicle' table.
 *
 * 
 *
 * @method     VehicleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     VehicleQuery orderByCustomerId($order = Criteria::ASC) Order by the customer_id column
 * @method     VehicleQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     VehicleQuery orderByMake($order = Criteria::ASC) Order by the make column
 * @method     VehicleQuery orderByModel($order = Criteria::ASC) Order by the model column
 * @method     VehicleQuery orderBySubmodel($order = Criteria::ASC) Order by the submodel column
 * @method     VehicleQuery orderByVin($order = Criteria::ASC) Order by the vin column
 * @method     VehicleQuery orderByCylinders($order = Criteria::ASC) Order by the cylinders column
 * @method     VehicleQuery orderByVolume($order = Criteria::ASC) Order by the volume column
 * @method     VehicleQuery orderByOdometerUnit($order = Criteria::ASC) Order by the odometer_unit column
 * @method     VehicleQuery orderByGasUnit($order = Criteria::ASC) Order by the gas_unit column
 * @method     VehicleQuery orderByTransmission($order = Criteria::ASC) Order by the transmission column
 * @method     VehicleQuery orderByColor($order = Criteria::ASC) Order by the color column
 * @method     VehicleQuery orderByLicensePlate($order = Criteria::ASC) Order by the license_plate column
 * @method     VehicleQuery orderByIniOdometer($order = Criteria::ASC) Order by the ini_odometer column
 * @method     VehicleQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 *
 * @method     VehicleQuery groupById() Group by the id column
 * @method     VehicleQuery groupByCustomerId() Group by the customer_id column
 * @method     VehicleQuery groupByYear() Group by the year column
 * @method     VehicleQuery groupByMake() Group by the make column
 * @method     VehicleQuery groupByModel() Group by the model column
 * @method     VehicleQuery groupBySubmodel() Group by the submodel column
 * @method     VehicleQuery groupByVin() Group by the vin column
 * @method     VehicleQuery groupByCylinders() Group by the cylinders column
 * @method     VehicleQuery groupByVolume() Group by the volume column
 * @method     VehicleQuery groupByOdometerUnit() Group by the odometer_unit column
 * @method     VehicleQuery groupByGasUnit() Group by the gas_unit column
 * @method     VehicleQuery groupByTransmission() Group by the transmission column
 * @method     VehicleQuery groupByColor() Group by the color column
 * @method     VehicleQuery groupByLicensePlate() Group by the license_plate column
 * @method     VehicleQuery groupByIniOdometer() Group by the ini_odometer column
 * @method     VehicleQuery groupByNotes() Group by the notes column
 *
 * @method     VehicleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     VehicleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     VehicleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     VehicleQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     VehicleQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     VehicleQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     Vehicle findOne(PropelPDO $con = null) Return the first Vehicle matching the query
 * @method     Vehicle findOneOrCreate(PropelPDO $con = null) Return the first Vehicle matching the query, or a new Vehicle object populated from the query conditions when no match is found
 *
 * @method     Vehicle findOneById(int $id) Return the first Vehicle filtered by the id column
 * @method     Vehicle findOneByCustomerId(int $customer_id) Return the first Vehicle filtered by the customer_id column
 * @method     Vehicle findOneByYear(string $year) Return the first Vehicle filtered by the year column
 * @method     Vehicle findOneByMake(string $make) Return the first Vehicle filtered by the make column
 * @method     Vehicle findOneByModel(string $model) Return the first Vehicle filtered by the model column
 * @method     Vehicle findOneBySubmodel(string $submodel) Return the first Vehicle filtered by the submodel column
 * @method     Vehicle findOneByVin(string $vin) Return the first Vehicle filtered by the vin column
 * @method     Vehicle findOneByCylinders(string $cylinders) Return the first Vehicle filtered by the cylinders column
 * @method     Vehicle findOneByVolume(string $volume) Return the first Vehicle filtered by the volume column
 * @method     Vehicle findOneByOdometerUnit(string $odometer_unit) Return the first Vehicle filtered by the odometer_unit column
 * @method     Vehicle findOneByGasUnit(string $gas_unit) Return the first Vehicle filtered by the gas_unit column
 * @method     Vehicle findOneByTransmission(string $transmission) Return the first Vehicle filtered by the transmission column
 * @method     Vehicle findOneByColor(string $color) Return the first Vehicle filtered by the color column
 * @method     Vehicle findOneByLicensePlate(string $license_plate) Return the first Vehicle filtered by the license_plate column
 * @method     Vehicle findOneByIniOdometer(int $ini_odometer) Return the first Vehicle filtered by the ini_odometer column
 * @method     Vehicle findOneByNotes(string $notes) Return the first Vehicle filtered by the notes column
 *
 * @method     array findById(int $id) Return Vehicle objects filtered by the id column
 * @method     array findByCustomerId(int $customer_id) Return Vehicle objects filtered by the customer_id column
 * @method     array findByYear(string $year) Return Vehicle objects filtered by the year column
 * @method     array findByMake(string $make) Return Vehicle objects filtered by the make column
 * @method     array findByModel(string $model) Return Vehicle objects filtered by the model column
 * @method     array findBySubmodel(string $submodel) Return Vehicle objects filtered by the submodel column
 * @method     array findByVin(string $vin) Return Vehicle objects filtered by the vin column
 * @method     array findByCylinders(string $cylinders) Return Vehicle objects filtered by the cylinders column
 * @method     array findByVolume(string $volume) Return Vehicle objects filtered by the volume column
 * @method     array findByOdometerUnit(string $odometer_unit) Return Vehicle objects filtered by the odometer_unit column
 * @method     array findByGasUnit(string $gas_unit) Return Vehicle objects filtered by the gas_unit column
 * @method     array findByTransmission(string $transmission) Return Vehicle objects filtered by the transmission column
 * @method     array findByColor(string $color) Return Vehicle objects filtered by the color column
 * @method     array findByLicensePlate(string $license_plate) Return Vehicle objects filtered by the license_plate column
 * @method     array findByIniOdometer(int $ini_odometer) Return Vehicle objects filtered by the ini_odometer column
 * @method     array findByNotes(string $notes) Return Vehicle objects filtered by the notes column
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseVehicleQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseVehicleQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'repairshop', $modelName = 'Vehicle', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new VehicleQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    VehicleQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof VehicleQuery) {
			return $criteria;
		}
		$query = new VehicleQuery();
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
	 * @return    Vehicle|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = VehiclePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(VehiclePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(VehiclePeer::ID, $keys, Criteria::IN);
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
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(VehiclePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the customer_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCustomerId(1234); // WHERE customer_id = 1234
	 * $query->filterByCustomerId(array(12, 34)); // WHERE customer_id IN (12, 34)
	 * $query->filterByCustomerId(array('min' => 12)); // WHERE customer_id > 12
	 * </code>
	 *
	 * @see       filterByCustomer()
	 *
	 * @param     mixed $customerId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByCustomerId($customerId = null, $comparison = null)
	{
		if (is_array($customerId)) {
			$useMinMax = false;
			if (isset($customerId['min'])) {
				$this->addUsingAlias(VehiclePeer::CUSTOMER_ID, $customerId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($customerId['max'])) {
				$this->addUsingAlias(VehiclePeer::CUSTOMER_ID, $customerId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VehiclePeer::CUSTOMER_ID, $customerId, $comparison);
	}

	/**
	 * Filter the query on the year column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByYear('fooValue');   // WHERE year = 'fooValue'
	 * $query->filterByYear('%fooValue%'); // WHERE year LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $year The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByYear($year = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($year)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $year)) {
				$year = str_replace('*', '%', $year);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::YEAR, $year, $comparison);
	}

	/**
	 * Filter the query on the make column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByMake('fooValue');   // WHERE make = 'fooValue'
	 * $query->filterByMake('%fooValue%'); // WHERE make LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $make The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByMake($make = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($make)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $make)) {
				$make = str_replace('*', '%', $make);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::MAKE, $make, $comparison);
	}

	/**
	 * Filter the query on the model column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByModel('fooValue');   // WHERE model = 'fooValue'
	 * $query->filterByModel('%fooValue%'); // WHERE model LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $model The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByModel($model = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($model)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $model)) {
				$model = str_replace('*', '%', $model);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::MODEL, $model, $comparison);
	}

	/**
	 * Filter the query on the submodel column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySubmodel('fooValue');   // WHERE submodel = 'fooValue'
	 * $query->filterBySubmodel('%fooValue%'); // WHERE submodel LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $submodel The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterBySubmodel($submodel = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($submodel)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $submodel)) {
				$submodel = str_replace('*', '%', $submodel);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::SUBMODEL, $submodel, $comparison);
	}

	/**
	 * Filter the query on the vin column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByVin('fooValue');   // WHERE vin = 'fooValue'
	 * $query->filterByVin('%fooValue%'); // WHERE vin LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $vin The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByVin($vin = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($vin)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $vin)) {
				$vin = str_replace('*', '%', $vin);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::VIN, $vin, $comparison);
	}

	/**
	 * Filter the query on the cylinders column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCylinders('fooValue');   // WHERE cylinders = 'fooValue'
	 * $query->filterByCylinders('%fooValue%'); // WHERE cylinders LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cylinders The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByCylinders($cylinders = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cylinders)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cylinders)) {
				$cylinders = str_replace('*', '%', $cylinders);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::CYLINDERS, $cylinders, $comparison);
	}

	/**
	 * Filter the query on the volume column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByVolume(1234); // WHERE volume = 1234
	 * $query->filterByVolume(array(12, 34)); // WHERE volume IN (12, 34)
	 * $query->filterByVolume(array('min' => 12)); // WHERE volume > 12
	 * </code>
	 *
	 * @param     mixed $volume The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByVolume($volume = null, $comparison = null)
	{
		if (is_array($volume)) {
			$useMinMax = false;
			if (isset($volume['min'])) {
				$this->addUsingAlias(VehiclePeer::VOLUME, $volume['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($volume['max'])) {
				$this->addUsingAlias(VehiclePeer::VOLUME, $volume['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VehiclePeer::VOLUME, $volume, $comparison);
	}

	/**
	 * Filter the query on the odometer_unit column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByOdometerUnit('fooValue');   // WHERE odometer_unit = 'fooValue'
	 * $query->filterByOdometerUnit('%fooValue%'); // WHERE odometer_unit LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $odometerUnit The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByOdometerUnit($odometerUnit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($odometerUnit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $odometerUnit)) {
				$odometerUnit = str_replace('*', '%', $odometerUnit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::ODOMETER_UNIT, $odometerUnit, $comparison);
	}

	/**
	 * Filter the query on the gas_unit column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByGasUnit('fooValue');   // WHERE gas_unit = 'fooValue'
	 * $query->filterByGasUnit('%fooValue%'); // WHERE gas_unit LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $gasUnit The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByGasUnit($gasUnit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($gasUnit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $gasUnit)) {
				$gasUnit = str_replace('*', '%', $gasUnit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::GAS_UNIT, $gasUnit, $comparison);
	}

	/**
	 * Filter the query on the transmission column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTransmission('fooValue');   // WHERE transmission = 'fooValue'
	 * $query->filterByTransmission('%fooValue%'); // WHERE transmission LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $transmission The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByTransmission($transmission = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($transmission)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $transmission)) {
				$transmission = str_replace('*', '%', $transmission);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::TRANSMISSION, $transmission, $comparison);
	}

	/**
	 * Filter the query on the color column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByColor('fooValue');   // WHERE color = 'fooValue'
	 * $query->filterByColor('%fooValue%'); // WHERE color LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $color The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByColor($color = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($color)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $color)) {
				$color = str_replace('*', '%', $color);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::COLOR, $color, $comparison);
	}

	/**
	 * Filter the query on the license_plate column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLicensePlate('fooValue');   // WHERE license_plate = 'fooValue'
	 * $query->filterByLicensePlate('%fooValue%'); // WHERE license_plate LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $licensePlate The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByLicensePlate($licensePlate = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($licensePlate)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $licensePlate)) {
				$licensePlate = str_replace('*', '%', $licensePlate);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VehiclePeer::LICENSE_PLATE, $licensePlate, $comparison);
	}

	/**
	 * Filter the query on the ini_odometer column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByIniOdometer(1234); // WHERE ini_odometer = 1234
	 * $query->filterByIniOdometer(array(12, 34)); // WHERE ini_odometer IN (12, 34)
	 * $query->filterByIniOdometer(array('min' => 12)); // WHERE ini_odometer > 12
	 * </code>
	 *
	 * @param     mixed $iniOdometer The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByIniOdometer($iniOdometer = null, $comparison = null)
	{
		if (is_array($iniOdometer)) {
			$useMinMax = false;
			if (isset($iniOdometer['min'])) {
				$this->addUsingAlias(VehiclePeer::INI_ODOMETER, $iniOdometer['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($iniOdometer['max'])) {
				$this->addUsingAlias(VehiclePeer::INI_ODOMETER, $iniOdometer['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VehiclePeer::INI_ODOMETER, $iniOdometer, $comparison);
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
	 * @return    VehicleQuery The current query, for fluid interface
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
		return $this->addUsingAlias(VehiclePeer::NOTES, $notes, $comparison);
	}

	/**
	 * Filter the query by a related Customer object
	 *
	 * @param     Customer|PropelCollection $customer The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function filterByCustomer($customer, $comparison = null)
	{
		if ($customer instanceof Customer) {
			return $this
				->addUsingAlias(VehiclePeer::CUSTOMER_ID, $customer->getId(), $comparison);
		} elseif ($customer instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(VehiclePeer::CUSTOMER_ID, $customer->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function joinCustomer($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useCustomerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinCustomer($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Customer', 'CustomerQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Vehicle $vehicle Object to remove from the list of results
	 *
	 * @return    VehicleQuery The current query, for fluid interface
	 */
	public function prune($vehicle = null)
	{
		if ($vehicle) {
			$this->addUsingAlias(VehiclePeer::ID, $vehicle->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseVehicleQuery
