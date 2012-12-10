<?php


/**
 * Base class that represents a row from the 'Setting' table.
 *
 * 
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseSetting extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'SettingPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SettingPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the role_type field.
	 * @var        int
	 */
	protected $role_type;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the value field.
	 * @var        string
	 */
	protected $value;

	/**
	 * The value for the memo field.
	 * @var        string
	 */
	protected $memo;

	/**
	 * The value for the sys_override field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $sys_override;

	/**
	 * The value for the usr_override field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $usr_override;

	/**
	 * The value for the usr_validator field.
	 * @var        string
	 */
	protected $usr_validator;

	/**
	 * @var        array Settingoverride[] Collection to store aggregation of Settingoverride objects.
	 */
	protected $collSettingoverrides;

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
		$this->sys_override = true;
		$this->usr_override = false;
	}

	/**
	 * Initializes internal state of BaseSetting object.
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
	 * Get the [role_type] column value.
	 * 
	 * @return     int
	 */
	public function getRoleType()
	{
		return $this->role_type;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [value] column value.
	 * 
	 * @return     string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Get the [memo] column value.
	 * 
	 * @return     string
	 */
	public function getMemo()
	{
		return $this->memo;
	}

	/**
	 * Get the [sys_override] column value.
	 * 
	 * @return     boolean
	 */
	public function getSysOverride()
	{
		return $this->sys_override;
	}

	/**
	 * Get the [usr_override] column value.
	 * 
	 * @return     boolean
	 */
	public function getUsrOverride()
	{
		return $this->usr_override;
	}

	/**
	 * Get the [usr_validator] column value.
	 * 
	 * @return     string
	 */
	public function getUsrValidator()
	{
		return $this->usr_validator;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SettingPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [role_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setRoleType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->role_type !== $v) {
			$this->role_type = $v;
			$this->modifiedColumns[] = SettingPeer::ROLE_TYPE;
		}

		return $this;
	} // setRoleType()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = SettingPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [value] column.
	 * 
	 * @param      string $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setValue($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = SettingPeer::VALUE;
		}

		return $this;
	} // setValue()

	/**
	 * Set the value of [memo] column.
	 * 
	 * @param      string $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setMemo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->memo !== $v) {
			$this->memo = $v;
			$this->modifiedColumns[] = SettingPeer::MEMO;
		}

		return $this;
	} // setMemo()

	/**
	 * Sets the value of the [sys_override] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setSysOverride($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->sys_override !== $v || $this->isNew()) {
			$this->sys_override = $v;
			$this->modifiedColumns[] = SettingPeer::SYS_OVERRIDE;
		}

		return $this;
	} // setSysOverride()

	/**
	 * Sets the value of the [usr_override] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setUsrOverride($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->usr_override !== $v || $this->isNew()) {
			$this->usr_override = $v;
			$this->modifiedColumns[] = SettingPeer::USR_OVERRIDE;
		}

		return $this;
	} // setUsrOverride()

	/**
	 * Set the value of [usr_validator] column.
	 * 
	 * @param      string $v new value
	 * @return     Setting The current object (for fluent API support)
	 */
	public function setUsrValidator($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->usr_validator !== $v) {
			$this->usr_validator = $v;
			$this->modifiedColumns[] = SettingPeer::USR_VALIDATOR;
		}

		return $this;
	} // setUsrValidator()

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
			if ($this->sys_override !== true) {
				return false;
			}

			if ($this->usr_override !== false) {
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
			$this->role_type = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->value = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->memo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->sys_override = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->usr_override = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->usr_validator = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 8; // 8 = SettingPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Setting object", $e);
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
			$con = Propel::getConnection(SettingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SettingPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collSettingoverrides = null;

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
			$con = Propel::getConnection(SettingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SettingQuery::create()
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
			$con = Propel::getConnection(SettingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SettingPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SettingPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(SettingPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.SettingPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows = 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows = SettingPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSettingoverrides !== null) {
				foreach ($this->collSettingoverrides as $referrerFK) {
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


			if (($retval = SettingPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSettingoverrides !== null) {
					foreach ($this->collSettingoverrides as $referrerFK) {
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
		$pos = SettingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRoleType();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getValue();
				break;
			case 4:
				return $this->getMemo();
				break;
			case 5:
				return $this->getSysOverride();
				break;
			case 6:
				return $this->getUsrOverride();
				break;
			case 7:
				return $this->getUsrValidator();
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
		if (isset($alreadyDumpedObjects['Setting'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Setting'][$this->getPrimaryKey()] = true;
		$keys = SettingPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRoleType(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getValue(),
			$keys[4] => $this->getMemo(),
			$keys[5] => $this->getSysOverride(),
			$keys[6] => $this->getUsrOverride(),
			$keys[7] => $this->getUsrValidator(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collSettingoverrides) {
				$result['Settingoverrides'] = $this->collSettingoverrides->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = SettingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRoleType($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setValue($value);
				break;
			case 4:
				$this->setMemo($value);
				break;
			case 5:
				$this->setSysOverride($value);
				break;
			case 6:
				$this->setUsrOverride($value);
				break;
			case 7:
				$this->setUsrValidator($value);
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
		$keys = SettingPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRoleType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setValue($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMemo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSysOverride($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUsrOverride($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUsrValidator($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SettingPeer::DATABASE_NAME);

		if ($this->isColumnModified(SettingPeer::ID)) $criteria->add(SettingPeer::ID, $this->id);
		if ($this->isColumnModified(SettingPeer::ROLE_TYPE)) $criteria->add(SettingPeer::ROLE_TYPE, $this->role_type);
		if ($this->isColumnModified(SettingPeer::NAME)) $criteria->add(SettingPeer::NAME, $this->name);
		if ($this->isColumnModified(SettingPeer::VALUE)) $criteria->add(SettingPeer::VALUE, $this->value);
		if ($this->isColumnModified(SettingPeer::MEMO)) $criteria->add(SettingPeer::MEMO, $this->memo);
		if ($this->isColumnModified(SettingPeer::SYS_OVERRIDE)) $criteria->add(SettingPeer::SYS_OVERRIDE, $this->sys_override);
		if ($this->isColumnModified(SettingPeer::USR_OVERRIDE)) $criteria->add(SettingPeer::USR_OVERRIDE, $this->usr_override);
		if ($this->isColumnModified(SettingPeer::USR_VALIDATOR)) $criteria->add(SettingPeer::USR_VALIDATOR, $this->usr_validator);

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
		$criteria = new Criteria(SettingPeer::DATABASE_NAME);
		$criteria->add(SettingPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Setting (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setRoleType($this->getRoleType());
		$copyObj->setName($this->getName());
		$copyObj->setValue($this->getValue());
		$copyObj->setMemo($this->getMemo());
		$copyObj->setSysOverride($this->getSysOverride());
		$copyObj->setUsrOverride($this->getUsrOverride());
		$copyObj->setUsrValidator($this->getUsrValidator());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getSettingoverrides() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSettingoverride($relObj->copy($deepCopy));
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
	 * @return     Setting Clone of current object.
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
	 * @return     SettingPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SettingPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collSettingoverrides collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSettingoverrides()
	 */
	public function clearSettingoverrides()
	{
		$this->collSettingoverrides = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSettingoverrides collection.
	 *
	 * By default this just sets the collSettingoverrides collection to an empty array (like clearcollSettingoverrides());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initSettingoverrides($overrideExisting = true)
	{
		if (null !== $this->collSettingoverrides && !$overrideExisting) {
			return;
		}
		$this->collSettingoverrides = new PropelObjectCollection();
		$this->collSettingoverrides->setModel('Settingoverride');
	}

	/**
	 * Gets an array of Settingoverride objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Setting is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Settingoverride[] List of Settingoverride objects
	 * @throws     PropelException
	 */
	public function getSettingoverrides($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSettingoverrides || null !== $criteria) {
			if ($this->isNew() && null === $this->collSettingoverrides) {
				// return empty collection
				$this->initSettingoverrides();
			} else {
				$collSettingoverrides = SettingoverrideQuery::create(null, $criteria)
					->filterBySetting($this)
					->find($con);
				if (null !== $criteria) {
					return $collSettingoverrides;
				}
				$this->collSettingoverrides = $collSettingoverrides;
			}
		}
		return $this->collSettingoverrides;
	}

	/**
	 * Returns the number of related Settingoverride objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Settingoverride objects.
	 * @throws     PropelException
	 */
	public function countSettingoverrides(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collSettingoverrides || null !== $criteria) {
			if ($this->isNew() && null === $this->collSettingoverrides) {
				return 0;
			} else {
				$query = SettingoverrideQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBySetting($this)
					->count($con);
			}
		} else {
			return count($this->collSettingoverrides);
		}
	}

	/**
	 * Method called to associate a Settingoverride object to this object
	 * through the Settingoverride foreign key attribute.
	 *
	 * @param      Settingoverride $l Settingoverride
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSettingoverride(Settingoverride $l)
	{
		if ($this->collSettingoverrides === null) {
			$this->initSettingoverrides();
		}
		if (!$this->collSettingoverrides->contains($l)) { // only add it if the **same** object is not already associated
			$this->collSettingoverrides[]= $l;
			$l->setSetting($this);
		}
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->role_type = null;
		$this->name = null;
		$this->value = null;
		$this->memo = null;
		$this->sys_override = null;
		$this->usr_override = null;
		$this->usr_validator = null;
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
			if ($this->collSettingoverrides) {
				foreach ($this->collSettingoverrides as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collSettingoverrides instanceof PropelCollection) {
			$this->collSettingoverrides->clearIterator();
		}
		$this->collSettingoverrides = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(SettingPeer::DEFAULT_STRING_FORMAT);
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

} // BaseSetting
