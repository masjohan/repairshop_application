<?php


/**
 * Base class that represents a row from the 'RepairOrderItem' table.
 *
 * 
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseRepairorderitem extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'RepairorderitemPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepairorderitemPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the repaire_order_id field.
	 * @var        int
	 */
	protected $repaire_order_id;

	/**
	 * The value for the ro_code_id field.
	 * @var        int
	 */
	protected $ro_code_id;

	/**
	 * The value for the tech field.
	 * @var        string
	 */
	protected $tech;

	/**
	 * The value for the desc field.
	 * @var        string
	 */
	protected $desc;

	/**
	 * The value for the price field.
	 * @var        string
	 */
	protected $price;

	/**
	 * @var        Repairordercode
	 */
	protected $aRepairordercode;

	/**
	 * @var        Repairorder
	 */
	protected $aRepairorder;

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
	 * Get the [repaire_order_id] column value.
	 * 
	 * @return     int
	 */
	public function getRepaireOrderId()
	{
		return $this->repaire_order_id;
	}

	/**
	 * Get the [ro_code_id] column value.
	 * 
	 * @return     int
	 */
	public function getRoCodeId()
	{
		return $this->ro_code_id;
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
	 * Get the [desc] column value.
	 * 
	 * @return     string
	 */
	public function getDesc()
	{
		return $this->desc;
	}

	/**
	 * Get the [price] column value.
	 * 
	 * @return     string
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Repairorderitem The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RepairorderitemPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [repaire_order_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Repairorderitem The current object (for fluent API support)
	 */
	public function setRepaireOrderId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->repaire_order_id !== $v) {
			$this->repaire_order_id = $v;
			$this->modifiedColumns[] = RepairorderitemPeer::REPAIRE_ORDER_ID;
		}

		if ($this->aRepairorder !== null && $this->aRepairorder->getId() !== $v) {
			$this->aRepairorder = null;
		}

		return $this;
	} // setRepaireOrderId()

	/**
	 * Set the value of [ro_code_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Repairorderitem The current object (for fluent API support)
	 */
	public function setRoCodeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ro_code_id !== $v) {
			$this->ro_code_id = $v;
			$this->modifiedColumns[] = RepairorderitemPeer::RO_CODE_ID;
		}

		if ($this->aRepairordercode !== null && $this->aRepairordercode->getId() !== $v) {
			$this->aRepairordercode = null;
		}

		return $this;
	} // setRoCodeId()

	/**
	 * Set the value of [tech] column.
	 * 
	 * @param      string $v new value
	 * @return     Repairorderitem The current object (for fluent API support)
	 */
	public function setTech($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tech !== $v) {
			$this->tech = $v;
			$this->modifiedColumns[] = RepairorderitemPeer::TECH;
		}

		return $this;
	} // setTech()

	/**
	 * Set the value of [desc] column.
	 * 
	 * @param      string $v new value
	 * @return     Repairorderitem The current object (for fluent API support)
	 */
	public function setDesc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->desc !== $v) {
			$this->desc = $v;
			$this->modifiedColumns[] = RepairorderitemPeer::DESC;
		}

		return $this;
	} // setDesc()

	/**
	 * Set the value of [price] column.
	 * 
	 * @param      string $v new value
	 * @return     Repairorderitem The current object (for fluent API support)
	 */
	public function setPrice($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = RepairorderitemPeer::PRICE;
		}

		return $this;
	} // setPrice()

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
			$this->repaire_order_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ro_code_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->tech = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->desc = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->price = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 6; // 6 = RepairorderitemPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Repairorderitem object", $e);
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

		if ($this->aRepairorder !== null && $this->repaire_order_id !== $this->aRepairorder->getId()) {
			$this->aRepairorder = null;
		}
		if ($this->aRepairordercode !== null && $this->ro_code_id !== $this->aRepairordercode->getId()) {
			$this->aRepairordercode = null;
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
			$con = Propel::getConnection(RepairorderitemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RepairorderitemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aRepairordercode = null;
			$this->aRepairorder = null;
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
			$con = Propel::getConnection(RepairorderitemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				RepairorderitemQuery::create()
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
			$con = Propel::getConnection(RepairorderitemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				RepairorderitemPeer::addInstanceToPool($this);
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

			if ($this->aRepairordercode !== null) {
				if ($this->aRepairordercode->isModified() || $this->aRepairordercode->isNew()) {
					$affectedRows += $this->aRepairordercode->save($con);
				}
				$this->setRepairordercode($this->aRepairordercode);
			}

			if ($this->aRepairorder !== null) {
				if ($this->aRepairorder->isModified() || $this->aRepairorder->isNew()) {
					$affectedRows += $this->aRepairorder->save($con);
				}
				$this->setRepairorder($this->aRepairorder);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = RepairorderitemPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(RepairorderitemPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.RepairorderitemPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += RepairorderitemPeer::doUpdate($this, $con);
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

			if ($this->aRepairordercode !== null) {
				if (!$this->aRepairordercode->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepairordercode->getValidationFailures());
				}
			}

			if ($this->aRepairorder !== null) {
				if (!$this->aRepairorder->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepairorder->getValidationFailures());
				}
			}


			if (($retval = RepairorderitemPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RepairorderitemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRepaireOrderId();
				break;
			case 2:
				return $this->getRoCodeId();
				break;
			case 3:
				return $this->getTech();
				break;
			case 4:
				return $this->getDesc();
				break;
			case 5:
				return $this->getPrice();
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
		if (isset($alreadyDumpedObjects['Repairorderitem'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Repairorderitem'][$this->getPrimaryKey()] = true;
		$keys = RepairorderitemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRepaireOrderId(),
			$keys[2] => $this->getRoCodeId(),
			$keys[3] => $this->getTech(),
			$keys[4] => $this->getDesc(),
			$keys[5] => $this->getPrice(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aRepairordercode) {
				$result['Repairordercode'] = $this->aRepairordercode->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aRepairorder) {
				$result['Repairorder'] = $this->aRepairorder->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = RepairorderitemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRepaireOrderId($value);
				break;
			case 2:
				$this->setRoCodeId($value);
				break;
			case 3:
				$this->setTech($value);
				break;
			case 4:
				$this->setDesc($value);
				break;
			case 5:
				$this->setPrice($value);
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
		$keys = RepairorderitemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRepaireOrderId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRoCodeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTech($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDesc($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPrice($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RepairorderitemPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepairorderitemPeer::ID)) $criteria->add(RepairorderitemPeer::ID, $this->id);
		if ($this->isColumnModified(RepairorderitemPeer::REPAIRE_ORDER_ID)) $criteria->add(RepairorderitemPeer::REPAIRE_ORDER_ID, $this->repaire_order_id);
		if ($this->isColumnModified(RepairorderitemPeer::RO_CODE_ID)) $criteria->add(RepairorderitemPeer::RO_CODE_ID, $this->ro_code_id);
		if ($this->isColumnModified(RepairorderitemPeer::TECH)) $criteria->add(RepairorderitemPeer::TECH, $this->tech);
		if ($this->isColumnModified(RepairorderitemPeer::DESC)) $criteria->add(RepairorderitemPeer::DESC, $this->desc);
		if ($this->isColumnModified(RepairorderitemPeer::PRICE)) $criteria->add(RepairorderitemPeer::PRICE, $this->price);

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
		$criteria = new Criteria(RepairorderitemPeer::DATABASE_NAME);
		$criteria->add(RepairorderitemPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Repairorderitem (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setRepaireOrderId($this->getRepaireOrderId());
		$copyObj->setRoCodeId($this->getRoCodeId());
		$copyObj->setTech($this->getTech());
		$copyObj->setDesc($this->getDesc());
		$copyObj->setPrice($this->getPrice());
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
	 * @return     Repairorderitem Clone of current object.
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
	 * @return     RepairorderitemPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepairorderitemPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Repairordercode object.
	 *
	 * @param      Repairordercode $v
	 * @return     Repairorderitem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRepairordercode(Repairordercode $v = null)
	{
		if ($v === null) {
			$this->setRoCodeId(NULL);
		} else {
			$this->setRoCodeId($v->getId());
		}

		$this->aRepairordercode = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Repairordercode object, it will not be re-added.
		if ($v !== null) {
			$v->addRepairorderitem($this);
		}

		return $this;
	}


	/**
	 * Get the associated Repairordercode object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Repairordercode The associated Repairordercode object.
	 * @throws     PropelException
	 */
	public function getRepairordercode(PropelPDO $con = null)
	{
		if ($this->aRepairordercode === null && ($this->ro_code_id !== null)) {
			$this->aRepairordercode = RepairordercodeQuery::create()->findPk($this->ro_code_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aRepairordercode->addRepairorderitems($this);
			 */
		}
		return $this->aRepairordercode;
	}

	/**
	 * Declares an association between this object and a Repairorder object.
	 *
	 * @param      Repairorder $v
	 * @return     Repairorderitem The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRepairorder(Repairorder $v = null)
	{
		if ($v === null) {
			$this->setRepaireOrderId(NULL);
		} else {
			$this->setRepaireOrderId($v->getId());
		}

		$this->aRepairorder = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Repairorder object, it will not be re-added.
		if ($v !== null) {
			$v->addRepairorderitem($this);
		}

		return $this;
	}


	/**
	 * Get the associated Repairorder object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Repairorder The associated Repairorder object.
	 * @throws     PropelException
	 */
	public function getRepairorder(PropelPDO $con = null)
	{
		if ($this->aRepairorder === null && ($this->repaire_order_id !== null)) {
			$this->aRepairorder = RepairorderQuery::create()->findPk($this->repaire_order_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aRepairorder->addRepairorderitems($this);
			 */
		}
		return $this->aRepairorder;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->repaire_order_id = null;
		$this->ro_code_id = null;
		$this->tech = null;
		$this->desc = null;
		$this->price = null;
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
		} // if ($deep)

		$this->aRepairordercode = null;
		$this->aRepairorder = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(RepairorderitemPeer::DEFAULT_STRING_FORMAT);
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

} // BaseRepairorderitem
