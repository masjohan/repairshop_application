<?php


/**
 * Base static class for performing query and update operations on the 'Vehicle' table.
 *
 * 
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseVehiclePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'repairshop';

	/** the table name for this class */
	const TABLE_NAME = 'Vehicle';

	/** the related Propel class for this table */
	const OM_CLASS = 'Vehicle';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'repairshop.Vehicle';

	/** the related TableMap class for this table */
	const TM_CLASS = 'VehicleTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 16;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 16;

	/** the column name for the ID field */
	const ID = 'Vehicle.ID';

	/** the column name for the CUSTOMER_ID field */
	const CUSTOMER_ID = 'Vehicle.CUSTOMER_ID';

	/** the column name for the YEAR field */
	const YEAR = 'Vehicle.YEAR';

	/** the column name for the MAKE field */
	const MAKE = 'Vehicle.MAKE';

	/** the column name for the MODEL field */
	const MODEL = 'Vehicle.MODEL';

	/** the column name for the SUBMODEL field */
	const SUBMODEL = 'Vehicle.SUBMODEL';

	/** the column name for the VIN field */
	const VIN = 'Vehicle.VIN';

	/** the column name for the CYLINDERS field */
	const CYLINDERS = 'Vehicle.CYLINDERS';

	/** the column name for the VOLUME field */
	const VOLUME = 'Vehicle.VOLUME';

	/** the column name for the ODOMETER_UNIT field */
	const ODOMETER_UNIT = 'Vehicle.ODOMETER_UNIT';

	/** the column name for the GAS_UNIT field */
	const GAS_UNIT = 'Vehicle.GAS_UNIT';

	/** the column name for the TRANSMISSION field */
	const TRANSMISSION = 'Vehicle.TRANSMISSION';

	/** the column name for the COLOR field */
	const COLOR = 'Vehicle.COLOR';

	/** the column name for the LICENSE_PLATE field */
	const LICENSE_PLATE = 'Vehicle.LICENSE_PLATE';

	/** the column name for the INI_ODOMETER field */
	const INI_ODOMETER = 'Vehicle.INI_ODOMETER';

	/** the column name for the NOTES field */
	const NOTES = 'Vehicle.NOTES';

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';
	
	/**
	 * An identiy map to hold any loaded instances of Vehicle objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Vehicle[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CustomerId', 'Year', 'Make', 'Model', 'Submodel', 'Vin', 'Cylinders', 'Volume', 'OdometerUnit', 'GasUnit', 'Transmission', 'Color', 'LicensePlate', 'IniOdometer', 'Notes', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'customerId', 'year', 'make', 'model', 'submodel', 'vin', 'cylinders', 'volume', 'odometerUnit', 'gasUnit', 'transmission', 'color', 'licensePlate', 'iniOdometer', 'notes', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::CUSTOMER_ID, self::YEAR, self::MAKE, self::MODEL, self::SUBMODEL, self::VIN, self::CYLINDERS, self::VOLUME, self::ODOMETER_UNIT, self::GAS_UNIT, self::TRANSMISSION, self::COLOR, self::LICENSE_PLATE, self::INI_ODOMETER, self::NOTES, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID', 'CUSTOMER_ID', 'YEAR', 'MAKE', 'MODEL', 'SUBMODEL', 'VIN', 'CYLINDERS', 'VOLUME', 'ODOMETER_UNIT', 'GAS_UNIT', 'TRANSMISSION', 'COLOR', 'LICENSE_PLATE', 'INI_ODOMETER', 'NOTES', ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'customer_id', 'year', 'make', 'model', 'submodel', 'vin', 'cylinders', 'volume', 'odometer_unit', 'gas_unit', 'transmission', 'color', 'license_plate', 'ini_odometer', 'notes', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CustomerId' => 1, 'Year' => 2, 'Make' => 3, 'Model' => 4, 'Submodel' => 5, 'Vin' => 6, 'Cylinders' => 7, 'Volume' => 8, 'OdometerUnit' => 9, 'GasUnit' => 10, 'Transmission' => 11, 'Color' => 12, 'LicensePlate' => 13, 'IniOdometer' => 14, 'Notes' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'customerId' => 1, 'year' => 2, 'make' => 3, 'model' => 4, 'submodel' => 5, 'vin' => 6, 'cylinders' => 7, 'volume' => 8, 'odometerUnit' => 9, 'gasUnit' => 10, 'transmission' => 11, 'color' => 12, 'licensePlate' => 13, 'iniOdometer' => 14, 'notes' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::CUSTOMER_ID => 1, self::YEAR => 2, self::MAKE => 3, self::MODEL => 4, self::SUBMODEL => 5, self::VIN => 6, self::CYLINDERS => 7, self::VOLUME => 8, self::ODOMETER_UNIT => 9, self::GAS_UNIT => 10, self::TRANSMISSION => 11, self::COLOR => 12, self::LICENSE_PLATE => 13, self::INI_ODOMETER => 14, self::NOTES => 15, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'CUSTOMER_ID' => 1, 'YEAR' => 2, 'MAKE' => 3, 'MODEL' => 4, 'SUBMODEL' => 5, 'VIN' => 6, 'CYLINDERS' => 7, 'VOLUME' => 8, 'ODOMETER_UNIT' => 9, 'GAS_UNIT' => 10, 'TRANSMISSION' => 11, 'COLOR' => 12, 'LICENSE_PLATE' => 13, 'INI_ODOMETER' => 14, 'NOTES' => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'customer_id' => 1, 'year' => 2, 'make' => 3, 'model' => 4, 'submodel' => 5, 'vin' => 6, 'cylinders' => 7, 'volume' => 8, 'odometer_unit' => 9, 'gas_unit' => 10, 'transmission' => 11, 'color' => 12, 'license_plate' => 13, 'ini_odometer' => 14, 'notes' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. VehiclePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(VehiclePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      Criteria $criteria object containing the columns to add.
	 * @param      string   $alias    optional table alias
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $alias = null)
	{
		if (null === $alias) {
			$criteria->addSelectColumn(VehiclePeer::ID);
			$criteria->addSelectColumn(VehiclePeer::CUSTOMER_ID);
			$criteria->addSelectColumn(VehiclePeer::YEAR);
			$criteria->addSelectColumn(VehiclePeer::MAKE);
			$criteria->addSelectColumn(VehiclePeer::MODEL);
			$criteria->addSelectColumn(VehiclePeer::SUBMODEL);
			$criteria->addSelectColumn(VehiclePeer::VIN);
			$criteria->addSelectColumn(VehiclePeer::CYLINDERS);
			$criteria->addSelectColumn(VehiclePeer::VOLUME);
			$criteria->addSelectColumn(VehiclePeer::ODOMETER_UNIT);
			$criteria->addSelectColumn(VehiclePeer::GAS_UNIT);
			$criteria->addSelectColumn(VehiclePeer::TRANSMISSION);
			$criteria->addSelectColumn(VehiclePeer::COLOR);
			$criteria->addSelectColumn(VehiclePeer::LICENSE_PLATE);
			$criteria->addSelectColumn(VehiclePeer::INI_ODOMETER);
			$criteria->addSelectColumn(VehiclePeer::NOTES);
		} else {
			$criteria->addSelectColumn($alias . '.ID');
			$criteria->addSelectColumn($alias . '.CUSTOMER_ID');
			$criteria->addSelectColumn($alias . '.YEAR');
			$criteria->addSelectColumn($alias . '.MAKE');
			$criteria->addSelectColumn($alias . '.MODEL');
			$criteria->addSelectColumn($alias . '.SUBMODEL');
			$criteria->addSelectColumn($alias . '.VIN');
			$criteria->addSelectColumn($alias . '.CYLINDERS');
			$criteria->addSelectColumn($alias . '.VOLUME');
			$criteria->addSelectColumn($alias . '.ODOMETER_UNIT');
			$criteria->addSelectColumn($alias . '.GAS_UNIT');
			$criteria->addSelectColumn($alias . '.TRANSMISSION');
			$criteria->addSelectColumn($alias . '.COLOR');
			$criteria->addSelectColumn($alias . '.LICENSE_PLATE');
			$criteria->addSelectColumn($alias . '.INI_ODOMETER');
			$criteria->addSelectColumn($alias . '.NOTES');
		}
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(VehiclePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			VehiclePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     Vehicle
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = VehiclePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return VehiclePeer::populateObjects(VehiclePeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			VehiclePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      Vehicle $value A Vehicle object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A Vehicle object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Vehicle) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Vehicle object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     Vehicle Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to Vehicle
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * Retrieves the primary key from the DB resultset row 
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, an array of the primary key columns will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     mixed The primary key of the row
	 */
	public static function getPrimaryKeyFromRow($row, $startcol = 0)
	{
		return (int) $row[$startcol];
	}
	
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = VehiclePeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = VehiclePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = VehiclePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				VehiclePeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Populates an object of the default type or an object that inherit from the default.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     array (Vehicle object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = VehiclePeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = VehiclePeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + VehiclePeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = VehiclePeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			VehiclePeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Customer table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCustomer(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(VehiclePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			VehiclePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(VehiclePeer::CUSTOMER_ID, CustomerPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of Vehicle objects pre-filled with their Customer objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Vehicle objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCustomer(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		VehiclePeer::addSelectColumns($criteria);
		$startcol = VehiclePeer::NUM_HYDRATE_COLUMNS;
		CustomerPeer::addSelectColumns($criteria);

		$criteria->addJoin(VehiclePeer::CUSTOMER_ID, CustomerPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = VehiclePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = VehiclePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = VehiclePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				VehiclePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = CustomerPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CustomerPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = CustomerPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CustomerPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Vehicle) to $obj2 (Customer)
				$obj2->addVehicle($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(VehiclePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			VehiclePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(VehiclePeer::CUSTOMER_ID, CustomerPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of Vehicle objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Vehicle objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		VehiclePeer::addSelectColumns($criteria);
		$startcol2 = VehiclePeer::NUM_HYDRATE_COLUMNS;

		CustomerPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + CustomerPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(VehiclePeer::CUSTOMER_ID, CustomerPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = VehiclePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = VehiclePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = VehiclePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				VehiclePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Customer rows

			$key2 = CustomerPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CustomerPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = CustomerPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CustomerPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (Vehicle) to the collection in $obj2 (Customer)
				$obj2->addVehicle($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseVehiclePeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseVehiclePeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new VehicleTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean $withPrefix Whether or not to return the path with the class name
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? VehiclePeer::CLASS_DEFAULT : VehiclePeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Vehicle or Criteria object.
	 *
	 * @param      mixed $values Criteria or Vehicle object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Vehicle object
		}

		if ($criteria->containsKey(VehiclePeer::ID) && $criteria->keyContainsValue(VehiclePeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.VehiclePeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Vehicle or Criteria object.
	 *
	 * @param      mixed $values Criteria or Vehicle object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(VehiclePeer::ID);
			$value = $criteria->remove(VehiclePeer::ID);
			if ($value) {
				$selectCriteria->add(VehiclePeer::ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(VehiclePeer::TABLE_NAME);
			}

		} else { // $values is Vehicle object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the Vehicle table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(VehiclePeer::TABLE_NAME, $con, VehiclePeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			VehiclePeer::clearInstancePool();
			VehiclePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Vehicle or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Vehicle object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			VehiclePeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Vehicle) { // it's a model object
			// invalidate the cache for this single object
			VehiclePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(VehiclePeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				VehiclePeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			VehiclePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Vehicle object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Vehicle $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VehiclePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VehiclePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(VehiclePeer::DATABASE_NAME, VehiclePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Vehicle
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = VehiclePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(VehiclePeer::DATABASE_NAME);
		$criteria->add(VehiclePeer::ID, $pk);

		$v = VehiclePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(VehiclePeer::DATABASE_NAME);
			$criteria->add(VehiclePeer::ID, $pks, Criteria::IN);
			$objs = VehiclePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseVehiclePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseVehiclePeer::buildTableMap();

