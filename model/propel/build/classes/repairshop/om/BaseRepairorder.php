<?php


/**
 * Base class that represents a row from the 'RepairOrder' table.
 *
 * 
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseRepairorder extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'RepairorderPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepairorderPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the vehicle_id field.
	 * @var        int
	 */
	protected $vehicle_id;

	/**
	 * The value for the tag field.
	 * @var        string
	 */
	protected $tag;

	/**
	 * The value for the repair_order_status_id field.
	 * @var        int
	 */
	protected $repair_order_status_id;

	/**
	 * The value for the time_in field.
	 * @var        string
	 */
	protected $time_in;

	/**
	 * The value for the expected field.
	 * @var        string
	 */
	protected $expected;

	/**
	 * The value for the tech field.
	 * @var        string
	 */
	protected $tech;

	/**
	 * @var        Vehicle
	 */
	protected $aVehicle;

	/**
	 * @var        Repairorderstatus
	 */
	protected $aRepairorderstatus;

	/**
	 * @var        array Repairorderitem[] Collection to store aggregation of Repairorderitem objects.
	 */
	protected $collRepairorderitems;

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
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [vehicle_id] column value.
	 * 
	 * @return     int
	 */
	public function getVehicleId()
	{
		return $this->vehicle_id;
	}

	/**
	 * Get the [tag] column value.
	 * 
	 * @return     string
	 */
	public function getTag()
	{
		return $this->tag;
	}

	/**
	 * Get the [repair_order_status_id] column value.
	 * 
	 * @return     int
	 */
	public function getRepairOrderStatusId()
	{
		return $this->repair_order_status_id;
	}

	/**
	 * Get the [optionally formatted] temporal [time_in] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getTimeIn($format = 'Y-m-d H:i:s')
	{
		if ($this->time_in === null) {
			return null;
		}


		if ($this->time_in === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->time_in);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->time_in, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [expected] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getExpected($format = 'Y-m-d H:i:s')
	{
		if ($this->expected === null) {
			return null;
		}


		if ($this->expected === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->expected);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->expected, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [tech] column value.
	 * 
	 * @return     string
	 */
	public function getTech()
	{
		return $this->tech;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Repairorder The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RepairorderPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [vehicle_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Repairorder The current object (for fluent API support)
	 */
	public function setVehicleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->vehicle_id !== $v) {
			$this->vehicle_id = $v;
			$this->modifiedColumns[] = RepairorderPeer::VEHICLE_ID;
		}

		if ($this->aVehicle !== null && $this->aVehicle->getId() !== $v) {
			$this->aVehicle = null;
		}

		return $this;
	} // setVehicleId()

	/**
	 * Set the value of [tag] column.
	 * 
	 * @param      string $v new value
	 * @return     Repairorder The current object (for fluent API support)
	 */
	public function setTag($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tag !== $v) {
			$this->tag = $v;
			$this->modifiedColumns[] = RepairorderPeer::TAG;
		}

		return $this;
	} // setTag()

	/**
	 * Set the value of [repair_order_status_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Repairorder The current object (for fluent API support)
	 */
	public function setRepairOrderStatusId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->repair_order_status_id !== $v) {
			$this->repair_order_status_id = $v;
			$this->modifiedColumns[] = RepairorderPeer::REPAIR_ORDER_STATUS_ID;
		}

		if ($this->aRepairorderstatus !== null && $this->aRepairorderstatus->getId() !== $v) {
			$this->aRepairorderstatus = null;
		}

		return $this;
	} // setRepairOrderStatusId()

	/**
	 * Sets the value of [time_in] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Repairorder The current object (for fluent API support)
	 */
	public function setTimeIn($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->time_in !== null || $dt !== null) {
			$currentDateAsString = ($this->time_in !== null && $tmpDt = new DateTime($this->time_in)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->time_in = $newDateAsString;
				$this->modifiedColumns[] = RepairorderPeer::TIME_IN;
			}
		} // if either are not null

		return $this;
	} // setTimeIn()

	/**
	 * Sets the value of [expected] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Repairorder The current object (for fluent API support)
	 */
	public function setExpected($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->expected !== null || $dt !== null) {
			$currentDateAsString = ($this->expected !== null && $tmpDt = new DateTime($this->expected)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->expected = $newDateAsString;
				$this->modifiedColumns[] = RepairorderPeer::EXPECTED;
			}
		} // if either are not null

		return $this;
	} // setExpected()

	/**
	 * Set the value of [tech] column.
	 * 
	 * @param      string $v new value
	 * @return     Repairorder The current object (for fluent API support)
	 */
	public function setTech($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tech !== $v) {
			$this->tech = $v;
			$this->modifiedColumns[] = RepairorderPeer::TECH;
		}

		return $this;
	} // setTech()

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
			$this->vehicle_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->tag = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->repair_order_status_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->time_in = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->expected = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->tech = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = RepairorderPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Repairorder object", $e);
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

		if ($this->aVehicle !== null && $this->vehicle_id !== $this->aVehicle->getId()) {
			$this->aVehicle = null;
		}
		if ($this->aRepairorderstatus !== null && $this->repair_order_status_id !== $this->aRepairorderstatus->getId()) {
			$this->aRepairorderstatus = null;
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
			$con = Propel::getConnection(RepairorderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RepairorderPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aVehicle = null;
			$this->aRepairorderstatus = null;
			$this->collRepairorderitems = null;

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
			$con = Propel::getConnection(RepairorderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				RepairorderQuery::create()
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
			$con = Propel::getConnection(RepairorderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				RepairorderPeer::addInstanceToPool($this);
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

			if ($this->aVehicle !== null) {
				if ($this->aVehicle->isModified() || $this->aVehicle->isNew()) {
					$affectedRows += $this->aVehicle->save($con);
				}
				$this->setVehicle($this->aVehicle);
			}

			if ($this->aRepairorderstatus !== null) {
				if ($this->aRepairorderstatus->isModified() || $this->aRepairorderstatus->isNew()) {
					$affectedRows += $this->aRepairorderstatus->save($con);
				}
				$this->setRepairorderstatus($this->aRepairorderstatus);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = RepairorderPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(RepairorderPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.RepairorderPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += RepairorderPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collRepairorderitems !== null) {
				foreach ($this->collRepairorderitems as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->aVehicle !== null) {
				if (!$this->aVehicle->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVehicle->getValidationFailures());
				}
			}

			if ($this->aRepairorderstatus !== null) {
				if (!$this->aRepairorderstatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepairorderstatus->getValidationFailures());
				}
			}


			if (($retval = RepairorderPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRepairorderitems !== null) {
					foreach ($this->collRepairorderitems as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = RepairorderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getVehicleId();
				break;
			case 2:
				return $this->getTag();
				break;
			case 3:
				return $this->getRepairOrderStatusId();
				break;
			case 4:
				return $this->getTimeIn();
				break;
			case 5:
				return $this->getExpected();
				break;
			case 6:
				return $this->getTech();
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
		if (isset($alreadyDumpedObjects['Repairorder'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Repairorder'][$this->getPrimaryKey()] = true;
		$keys = RepairorderPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getVehicleId(),
			$keys[2] => $this->getTag(),
			$keys[3] => $this->getRepairOrderStatusId(),
			$keys[4] => $this->getTimeIn(),
			$keys[5] => $this->getExpected(),
			$keys[6] => $this->getTech(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aVehicle) {
				$result['Vehicle'] = $this->aVehicle->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aRepairorderstatus) {
				$result['Repairorderstatus'] = $this->aRepairorderstatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collRepairorderitems) {
				$result['Repairorderitems'] = $this->collRepairorderitems->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = RepairorderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setVehicleId($value);
				break;
			case 2:
				$this->setTag($value);
				break;
			case 3:
				$this->setRepairOrderStatusId($value);
				break;
			case 4:
				$this->setTimeIn($value);
				break;
			case 5:
				$this->setExpected($value);
				break;
			case 6:
				$this->setTech($value);
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
		$keys = RepairorderPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setVehicleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTag($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRepairOrderStatusId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTimeIn($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setExpected($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTech($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RepairorderPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepairorderPeer::ID)) $criteria->add(RepairorderPeer::ID, $this->id);
		if ($this->isColumnModified(RepairorderPeer::VEHICLE_ID)) $criteria->add(RepairorderPeer::VEHICLE_ID, $this->vehicle_id);
		if ($this->isColumnModified(RepairorderPeer::TAG)) $criteria->add(RepairorderPeer::TAG, $this->tag);
		if ($this->isColumnModified(RepairorderPeer::REPAIR_ORDER_STATUS_ID)) $criteria->add(RepairorderPeer::REPAIR_ORDER_STATUS_ID, $this->repair_order_status_id);
		if ($this->isColumnModified(RepairorderPeer::TIME_IN)) $criteria->add(RepairorderPeer::TIME_IN, $this->time_in);
		if ($this->isColumnModified(RepairorderPeer::EXPECTED)) $criteria->add(RepairorderPeer::EXPECTED, $this->expected);
		if ($this->isColumnModified(RepairorderPeer::TECH)) $criteria->add(RepairorderPeer::TECH, $this->tech);

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
		$criteria = new Criteria(RepairorderPeer::DATABASE_NAME);
		$criteria->add(RepairorderPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Repairorder (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setVehicleId($this->getVehicleId());
		$copyObj->setTag($this->getTag());
		$copyObj->setRepairOrderStatusId($this->getRepairOrderStatusId());
		$copyObj->setTimeIn($this->getTimeIn());
		$copyObj->setExpected($this->getExpected());
		$copyObj->setTech($this->getTech());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getRepairorderitems() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepairorderitem($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)

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
	 * @return     Repairorder Clone of current object.
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
	 * @return     RepairorderPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepairorderPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Vehicle object.
	 *
	 * @param      Vehicle $v
	 * @return     Repairorder The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setVehicle(Vehicle $v = null)
	{
		if ($v === null) {
			$this->setVehicleId(NULL);
		} else {
			$this->setVehicleId($v->getId());
		}

		$this->aVehicle = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Vehicle object, it will not be re-added.
		if ($v !== null) {
			$v->addRepairorder($this);
		}

		return $this;
	}


	/**
	 * Get the associated Vehicle object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Vehicle The associated Vehicle object.
	 * @throws     PropelException
	 */
	public function getVehicle(PropelPDO $con = null)
	{
		if ($this->aVehicle === null && ($this->vehicle_id !== null)) {
			$this->aVehicle = VehicleQuery::create()->findPk($this->vehicle_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aVehicle->addRepairorders($this);
			 */
		}
		return $this->aVehicle;
	}

	/**
	 * Declares an association between this object and a Repairorderstatus object.
	 *
	 * @param      Repairorderstatus $v
	 * @return     Repairorder The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRepairorderstatus(Repairorderstatus $v = null)
	{
		if ($v === null) {
			$this->setRepairOrderStatusId(NULL);
		} else {
			$this->setRepairOrderStatusId($v->getId());
		}

		$this->aRepairorderstatus = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Repairorderstatus object, it will not be re-added.
		if ($v !== null) {
			$v->addRepairorder($this);
		}

		return $this;
	}


	/**
	 * Get the associated Repairorderstatus object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Repairorderstatus The associated Repairorderstatus object.
	 * @throws     PropelException
	 */
	public function getRepairorderstatus(PropelPDO $con = null)
	{
		if ($this->aRepairorderstatus === null && ($this->repair_order_status_id !== null)) {
			$this->aRepairorderstatus = RepairorderstatusQuery::create()->findPk($this->repair_order_status_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aRepairorderstatus->addRepairorders($this);
			 */
		}
		return $this->aRepairorderstatus;
	}

	/**
	 * Clears out the collRepairorderitems collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepairorderitems()
	 */
	public function clearRepairorderitems()
	{
		$this->collRepairorderitems = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepairorderitems collection.
	 *
	 * By default this just sets the collRepairorderitems collection to an empty array (like clearcollRepairorderitems());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initRepairorderitems($overrideExisting = true)
	{
		if (null !== $this->collRepairorderitems && !$overrideExisting) {
			return;
		}
		$this->collRepairorderitems = new PropelObjectCollection();
		$this->collRepairorderitems->setModel('Repairorderitem');
	}

	/**
	 * Gets an array of Repairorderitem objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Repairorder is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Repairorderitem[] List of Repairorderitem objects
	 * @throws     PropelException
	 */
	public function getRepairorderitems($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collRepairorderitems || null !== $criteria) {
			if ($this->isNew() && null === $this->collRepairorderitems) {
				// return empty collection
				$this->initRepairorderitems();
			} else {
				$collRepairorderitems = RepairorderitemQuery::create(null, $criteria)
					->filterByRepairorder($this)
					->find($con);
				if (null !== $criteria) {
					return $collRepairorderitems;
				}
				$this->collRepairorderitems = $collRepairorderitems;
			}
		}
		return $this->collRepairorderitems;
	}

	/**
	 * Returns the number of related Repairorderitem objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Repairorderitem objects.
	 * @throws     PropelException
	 */
	public function countRepairorderitems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collRepairorderitems || null !== $criteria) {
			if ($this->isNew() && null === $this->collRepairorderitems) {
				return 0;
			} else {
				$query = RepairorderitemQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByRepairorder($this)
					->count($con);
			}
		} else {
			return count($this->collRepairorderitems);
		}
	}

	/**
	 * Method called to associate a Repairorderitem object to this object
	 * through the Repairorderitem foreign key attribute.
	 *
	 * @param      Repairorderitem $l Repairorderitem
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepairorderitem(Repairorderitem $l)
	{
		if ($this->collRepairorderitems === null) {
			$this->initRepairorderitems();
		}
		if (!$this->collRepairorderitems->contains($l)) { // only add it if the **same** object is not already associated
			$this->collRepairorderitems[]= $l;
			$l->setRepairorder($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Repairorder is new, it will return
	 * an empty collection; or if this Repairorder has previously
	 * been saved, it will retrieve related Repairorderitems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Repairorder.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Repairorderitem[] List of Repairorderitem objects
	 */
	public function getRepairorderitemsJoinRepairordercode($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RepairorderitemQuery::create(null, $criteria);
		$query->joinWith('Repairordercode', $join_behavior);

		return $this->getRepairorderitems($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->vehicle_id = null;
		$this->tag = null;
		$this->repair_order_status_id = null;
		$this->time_in = null;
		$this->expected = null;
		$this->tech = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
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
			if ($this->collRepairorderitems) {
				foreach ($this->collRepairorderitems as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collRepairorderitems instanceof PropelCollection) {
			$this->collRepairorderitems->clearIterator();
		}
		$this->collRepairorderitems = null;
		$this->aVehicle = null;
		$this->aRepairorderstatus = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(RepairorderPeer::DEFAULT_STRING_FORMAT);
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

} // BaseRepairorder
