<?php


/**
 * Base class that represents a row from the 'Vehicle' table.
 *
 * 
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseVehicle extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'VehiclePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        VehiclePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the customer_id field.
	 * @var        int
	 */
	protected $customer_id;

	/**
	 * The value for the year field.
	 * @var        string
	 */
	protected $year;

	/**
	 * The value for the make field.
	 * @var        string
	 */
	protected $make;

	/**
	 * The value for the model field.
	 * @var        string
	 */
	protected $model;

	/**
	 * The value for the submodel field.
	 * @var        string
	 */
	protected $submodel;

	/**
	 * The value for the vin field.
	 * @var        string
	 */
	protected $vin;

	/**
	 * The value for the cylinders field.
	 * @var        string
	 */
	protected $cylinders;

	/**
	 * The value for the volume field.
	 * @var        string
	 */
	protected $volume;

	/**
	 * The value for the odometer_unit field.
	 * Note: this column has a database default value of: 'km'
	 * @var        string
	 */
	protected $odometer_unit;

	/**
	 * The value for the gas_unit field.
	 * Note: this column has a database default value of: 'L'
	 * @var        string
	 */
	protected $gas_unit;

	/**
	 * The value for the transmission field.
	 * @var        string
	 */
	protected $transmission;

	/**
	 * The value for the color field.
	 * @var        string
	 */
	protected $color;

	/**
	 * The value for the license_plate field.
	 * @var        string
	 */
	protected $license_plate;

	/**
	 * The value for the ini_odometer field.
	 * @var        int
	 */
	protected $ini_odometer;

	/**
	 * The value for the notes field.
	 * @var        string
	 */
	protected $notes;

	/**
	 * @var        Customer
	 */
	protected $aCustomer;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->odometer_unit = 'km';
		$this->gas_unit = 'L';
	}

	/**
	 * Initializes internal state of BaseVehicle object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [customer_id] column value.
	 * 
	 * @return     int
	 */
	public function getCustomerId()
	{
		return $this->customer_id;
	}

	/**
	 * Get the [year] column value.
	 * 
	 * @return     string
	 */
	public function getYear()
	{
		return $this->year;
	}

	/**
	 * Get the [make] column value.
	 * 
	 * @return     string
	 */
	public function getMake()
	{
		return $this->make;
	}

	/**
	 * Get the [model] column value.
	 * 
	 * @return     string
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * Get the [submodel] column value.
	 * 
	 * @return     string
	 */
	public function getSubmodel()
	{
		return $this->submodel;
	}

	/**
	 * Get the [vin] column value.
	 * 
	 * @return     string
	 */
	public function getVin()
	{
		return $this->vin;
	}

	/**
	 * Get the [cylinders] column value.
	 * 
	 * @return     string
	 */
	public function getCylinders()
	{
		return $this->cylinders;
	}

	/**
	 * Get the [volume] column value.
	 * 
	 * @return     string
	 */
	public function getVolume()
	{
		return $this->volume;
	}

	/**
	 * Get the [odometer_unit] column value.
	 * 
	 * @return     string
	 */
	public function getOdometerUnit()
	{
		return $this->odometer_unit;
	}

	/**
	 * Get the [gas_unit] column value.
	 * 
	 * @return     string
	 */
	public function getGasUnit()
	{
		return $this->gas_unit;
	}

	/**
	 * Get the [transmission] column value.
	 * 
	 * @return     string
	 */
	public function getTransmission()
	{
		return $this->transmission;
	}

	/**
	 * Get the [color] column value.
	 * 
	 * @return     string
	 */
	public function getColor()
	{
		return $this->color;
	}

	/**
	 * Get the [license_plate] column value.
	 * 
	 * @return     string
	 */
	public function getLicensePlate()
	{
		return $this->license_plate;
	}

	/**
	 * Get the [ini_odometer] column value.
	 * 
	 * @return     int
	 */
	public function getIniOdometer()
	{
		return $this->ini_odometer;
	}

	/**
	 * Get the [notes] column value.
	 * 
	 * @return     string
	 */
	public function getNotes()
	{
		return $this->notes;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = VehiclePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [customer_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setCustomerId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->customer_id !== $v) {
			$this->customer_id = $v;
			$this->modifiedColumns[] = VehiclePeer::CUSTOMER_ID;
		}

		if ($this->aCustomer !== null && $this->aCustomer->getId() !== $v) {
			$this->aCustomer = null;
		}

		return $this;
	} // setCustomerId()

	/**
	 * Set the value of [year] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setYear($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->year !== $v) {
			$this->year = $v;
			$this->modifiedColumns[] = VehiclePeer::YEAR;
		}

		return $this;
	} // setYear()

	/**
	 * Set the value of [make] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setMake($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->make !== $v) {
			$this->make = $v;
			$this->modifiedColumns[] = VehiclePeer::MAKE;
		}

		return $this;
	} // setMake()

	/**
	 * Set the value of [model] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setModel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->model !== $v) {
			$this->model = $v;
			$this->modifiedColumns[] = VehiclePeer::MODEL;
		}

		return $this;
	} // setModel()

	/**
	 * Set the value of [submodel] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setSubmodel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->submodel !== $v) {
			$this->submodel = $v;
			$this->modifiedColumns[] = VehiclePeer::SUBMODEL;
		}

		return $this;
	} // setSubmodel()

	/**
	 * Set the value of [vin] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setVin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->vin !== $v) {
			$this->vin = $v;
			$this->modifiedColumns[] = VehiclePeer::VIN;
		}

		return $this;
	} // setVin()

	/**
	 * Set the value of [cylinders] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setCylinders($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->cylinders !== $v) {
			$this->cylinders = $v;
			$this->modifiedColumns[] = VehiclePeer::CYLINDERS;
		}

		return $this;
	} // setCylinders()

	/**
	 * Set the value of [volume] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setVolume($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->volume !== $v) {
			$this->volume = $v;
			$this->modifiedColumns[] = VehiclePeer::VOLUME;
		}

		return $this;
	} // setVolume()

	/**
	 * Set the value of [odometer_unit] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setOdometerUnit($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->odometer_unit !== $v || $this->isNew()) {
			$this->odometer_unit = $v;
			$this->modifiedColumns[] = VehiclePeer::ODOMETER_UNIT;
		}

		return $this;
	} // setOdometerUnit()

	/**
	 * Set the value of [gas_unit] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setGasUnit($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->gas_unit !== $v || $this->isNew()) {
			$this->gas_unit = $v;
			$this->modifiedColumns[] = VehiclePeer::GAS_UNIT;
		}

		return $this;
	} // setGasUnit()

	/**
	 * Set the value of [transmission] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setTransmission($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->transmission !== $v) {
			$this->transmission = $v;
			$this->modifiedColumns[] = VehiclePeer::TRANSMISSION;
		}

		return $this;
	} // setTransmission()

	/**
	 * Set the value of [color] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setColor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->color !== $v) {
			$this->color = $v;
			$this->modifiedColumns[] = VehiclePeer::COLOR;
		}

		return $this;
	} // setColor()

	/**
	 * Set the value of [license_plate] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setLicensePlate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->license_plate !== $v) {
			$this->license_plate = $v;
			$this->modifiedColumns[] = VehiclePeer::LICENSE_PLATE;
		}

		return $this;
	} // setLicensePlate()

	/**
	 * Set the value of [ini_odometer] column.
	 * 
	 * @param      int $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setIniOdometer($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ini_odometer !== $v) {
			$this->ini_odometer = $v;
			$this->modifiedColumns[] = VehiclePeer::INI_ODOMETER;
		}

		return $this;
	} // setIniOdometer()

	/**
	 * Set the value of [notes] column.
	 * 
	 * @param      string $v new value
	 * @return     Vehicle The current object (for fluent API support)
	 */
	public function setNotes($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->notes !== $v) {
			$this->notes = $v;
			$this->modifiedColumns[] = VehiclePeer::NOTES;
		}

		return $this;
	} // setNotes()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->odometer_unit !== 'km') {
				return false;
			}

			if ($this->gas_unit !== 'L') {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->customer_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->year = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->make = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->model = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->submodel = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->vin = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->cylinders = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->volume = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->odometer_unit = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->gas_unit = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->transmission = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->color = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->license_plate = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ini_odometer = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->notes = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 16; // 16 = VehiclePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Vehicle object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aCustomer !== null && $this->customer_id !== $this->aCustomer->getId()) {
			$this->aCustomer = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = VehiclePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCustomer = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				VehicleQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VehiclePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				VehiclePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCustomer !== null) {
				if ($this->aCustomer->isModified() || $this->aCustomer->isNew()) {
					$affectedRows += $this->aCustomer->save($con);
				}
				$this->setCustomer($this->aCustomer);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = VehiclePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(VehiclePeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.VehiclePeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += VehiclePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCustomer !== null) {
				if (!$this->aCustomer->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCustomer->getValidationFailures());
				}
			}


			if (($retval = VehiclePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VehiclePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCustomerId();
				break;
			case 2:
				return $this->getYear();
				break;
			case 3:
				return $this->getMake();
				break;
			case 4:
				return $this->getModel();
				break;
			case 5:
				return $this->getSubmodel();
				break;
			case 6:
				return $this->getVin();
				break;
			case 7:
				return $this->getCylinders();
				break;
			case 8:
				return $this->getVolume();
				break;
			case 9:
				return $this->getOdometerUnit();
				break;
			case 10:
				return $this->getGasUnit();
				break;
			case 11:
				return $this->getTransmission();
				break;
			case 12:
				return $this->getColor();
				break;
			case 13:
				return $this->getLicensePlate();
				break;
			case 14:
				return $this->getIniOdometer();
				break;
			case 15:
				return $this->getNotes();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Vehicle'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Vehicle'][$this->getPrimaryKey()] = true;
		$keys = VehiclePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCustomerId(),
			$keys[2] => $this->getYear(),
			$keys[3] => $this->getMake(),
			$keys[4] => $this->getModel(),
			$keys[5] => $this->getSubmodel(),
			$keys[6] => $this->getVin(),
			$keys[7] => $this->getCylinders(),
			$keys[8] => $this->getVolume(),
			$keys[9] => $this->getOdometerUnit(),
			$keys[10] => $this->getGasUnit(),
			$keys[11] => $this->getTransmission(),
			$keys[12] => $this->getColor(),
			$keys[13] => $this->getLicensePlate(),
			$keys[14] => $this->getIniOdometer(),
			$keys[15] => $this->getNotes(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aCustomer) {
				$result['Customer'] = $this->aCustomer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VehiclePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCustomerId($value);
				break;
			case 2:
				$this->setYear($value);
				break;
			case 3:
				$this->setMake($value);
				break;
			case 4:
				$this->setModel($value);
				break;
			case 5:
				$this->setSubmodel($value);
				break;
			case 6:
				$this->setVin($value);
				break;
			case 7:
				$this->setCylinders($value);
				break;
			case 8:
				$this->setVolume($value);
				break;
			case 9:
				$this->setOdometerUnit($value);
				break;
			case 10:
				$this->setGasUnit($value);
				break;
			case 11:
				$this->setTransmission($value);
				break;
			case 12:
				$this->setColor($value);
				break;
			case 13:
				$this->setLicensePlate($value);
				break;
			case 14:
				$this->setIniOdometer($value);
				break;
			case 15:
				$this->setNotes($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VehiclePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCustomerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setYear($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMake($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setModel($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSubmodel($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setVin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCylinders($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setVolume($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setOdometerUnit($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setGasUnit($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTransmission($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setColor($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setLicensePlate($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIniOdometer($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setNotes($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(VehiclePeer::DATABASE_NAME);

		if ($this->isColumnModified(VehiclePeer::ID)) $criteria->add(VehiclePeer::ID, $this->id);
		if ($this->isColumnModified(VehiclePeer::CUSTOMER_ID)) $criteria->add(VehiclePeer::CUSTOMER_ID, $this->customer_id);
		if ($this->isColumnModified(VehiclePeer::YEAR)) $criteria->add(VehiclePeer::YEAR, $this->year);
		if ($this->isColumnModified(VehiclePeer::MAKE)) $criteria->add(VehiclePeer::MAKE, $this->make);
		if ($this->isColumnModified(VehiclePeer::MODEL)) $criteria->add(VehiclePeer::MODEL, $this->model);
		if ($this->isColumnModified(VehiclePeer::SUBMODEL)) $criteria->add(VehiclePeer::SUBMODEL, $this->submodel);
		if ($this->isColumnModified(VehiclePeer::VIN)) $criteria->add(VehiclePeer::VIN, $this->vin);
		if ($this->isColumnModified(VehiclePeer::CYLINDERS)) $criteria->add(VehiclePeer::CYLINDERS, $this->cylinders);
		if ($this->isColumnModified(VehiclePeer::VOLUME)) $criteria->add(VehiclePeer::VOLUME, $this->volume);
		if ($this->isColumnModified(VehiclePeer::ODOMETER_UNIT)) $criteria->add(VehiclePeer::ODOMETER_UNIT, $this->odometer_unit);
		if ($this->isColumnModified(VehiclePeer::GAS_UNIT)) $criteria->add(VehiclePeer::GAS_UNIT, $this->gas_unit);
		if ($this->isColumnModified(VehiclePeer::TRANSMISSION)) $criteria->add(VehiclePeer::TRANSMISSION, $this->transmission);
		if ($this->isColumnModified(VehiclePeer::COLOR)) $criteria->add(VehiclePeer::COLOR, $this->color);
		if ($this->isColumnModified(VehiclePeer::LICENSE_PLATE)) $criteria->add(VehiclePeer::LICENSE_PLATE, $this->license_plate);
		if ($this->isColumnModified(VehiclePeer::INI_ODOMETER)) $criteria->add(VehiclePeer::INI_ODOMETER, $this->ini_odometer);
		if ($this->isColumnModified(VehiclePeer::NOTES)) $criteria->add(VehiclePeer::NOTES, $this->notes);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(VehiclePeer::DATABASE_NAME);
		$criteria->add(VehiclePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Vehicle (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setCustomerId($this->getCustomerId());
		$copyObj->setYear($this->getYear());
		$copyObj->setMake($this->getMake());
		$copyObj->setModel($this->getModel());
		$copyObj->setSubmodel($this->getSubmodel());
		$copyObj->setVin($this->getVin());
		$copyObj->setCylinders($this->getCylinders());
		$copyObj->setVolume($this->getVolume());
		$copyObj->setOdometerUnit($this->getOdometerUnit());
		$copyObj->setGasUnit($this->getGasUnit());
		$copyObj->setTransmission($this->getTransmission());
		$copyObj->setColor($this->getColor());
		$copyObj->setLicensePlate($this->getLicensePlate());
		$copyObj->setIniOdometer($this->getIniOdometer());
		$copyObj->setNotes($this->getNotes());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Vehicle Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     VehiclePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new VehiclePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Customer object.
	 *
	 * @param      Customer $v
	 * @return     Vehicle The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCustomer(Customer $v = null)
	{
		if ($v === null) {
			$this->setCustomerId(NULL);
		} else {
			$this->setCustomerId($v->getId());
		}

		$this->aCustomer = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Customer object, it will not be re-added.
		if ($v !== null) {
			$v->addVehicle($this);
		}

		return $this;
	}


	/**
	 * Get the associated Customer object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Customer The associated Customer object.
	 * @throws     PropelException
	 */
	public function getCustomer(PropelPDO $con = null)
	{
		if ($this->aCustomer === null && ($this->customer_id !== null)) {
			$this->aCustomer = CustomerQuery::create()->findPk($this->customer_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aCustomer->addVehicles($this);
			 */
		}
		return $this->aCustomer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->customer_id = null;
		$this->year = null;
		$this->make = null;
		$this->model = null;
		$this->submodel = null;
		$this->vin = null;
		$this->cylinders = null;
		$this->volume = null;
		$this->odometer_unit = null;
		$this->gas_unit = null;
		$this->transmission = null;
		$this->color = null;
		$this->license_plate = null;
		$this->ini_odometer = null;
		$this->notes = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

		$this->aCustomer = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(VehiclePeer::DEFAULT_STRING_FORMAT);
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		if (preg_match('/get(\w+)/', $name, $matches)) {
			$virtualColumn = $matches[1];
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
			// no lcfirst in php<5.3...
			$virtualColumn[0] = strtolower($virtualColumn[0]);
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
		}
		return parent::__call($name, $params);
	}

} // BaseVehicle
