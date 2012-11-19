<?php


/**
 * Base class that represents a row from the 'User' table.
 *
 * 
 *
 * @package    propel.generator.repairshop.om
 */
abstract class BaseUser extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'UserPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UserPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the username field.
	 * @var        string
	 */
	protected $username;

	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;

	/**
	 * The value for the passwd field.
	 * @var        string
	 */
	protected $passwd;

	/**
	 * The value for the greeting field.
	 * @var        string
	 */
	protected $greeting;

	/**
	 * The value for the first_name field.
	 * @var        string
	 */
	protected $first_name;

	/**
	 * The value for the last_name field.
	 * @var        string
	 */
	protected $last_name;

	/**
	 * The value for the phone field.
	 * @var        string
	 */
	protected $phone;

	/**
	 * The value for the cell field.
	 * @var        string
	 */
	protected $cell;

	/**
	 * The value for the address field.
	 * @var        string
	 */
	protected $address;

	/**
	 * The value for the city field.
	 * @var        string
	 */
	protected $city;

	/**
	 * The value for the province field.
	 * @var        string
	 */
	protected $province;

	/**
	 * The value for the country field.
	 * @var        string
	 */
	protected $country;

	/**
	 * The value for the postal field.
	 * @var        string
	 */
	protected $postal;

	/**
	 * The value for the role_id field.
	 * @var        int
	 */
	protected $role_id;

	/**
	 * The value for the customer_id field.
	 * @var        int
	 */
	protected $customer_id;

	/**
	 * The value for the shop_id field.
	 * @var        int
	 */
	protected $shop_id;

	/**
	 * The value for the market_id field.
	 * @var        int
	 */
	protected $market_id;

	/**
	 * The value for the recovery_token field.
	 * @var        string
	 */
	protected $recovery_token;

	/**
	 * The value for the recovery_sent field.
	 * @var        string
	 */
	protected $recovery_sent;

	/**
	 * @var        Customer
	 */
	protected $aCustomer;

	/**
	 * @var        Shop
	 */
	protected $aShop;

	/**
	 * @var        Market
	 */
	protected $aMarket;

	/**
	 * @var        Role
	 */
	protected $aRole;

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
	 * Get the [username] column value.
	 * 
	 * @return     string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the [passwd] column value.
	 * 
	 * @return     string
	 */
	public function getPasswd()
	{
		return $this->passwd;
	}

	/**
	 * Get the [greeting] column value.
	 * 
	 * @return     string
	 */
	public function getGreeting()
	{
		return $this->greeting;
	}

	/**
	 * Get the [first_name] column value.
	 * 
	 * @return     string
	 */
	public function getFirstName()
	{
		return $this->first_name;
	}

	/**
	 * Get the [last_name] column value.
	 * 
	 * @return     string
	 */
	public function getLastName()
	{
		return $this->last_name;
	}

	/**
	 * Get the [phone] column value.
	 * 
	 * @return     string
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * Get the [cell] column value.
	 * 
	 * @return     string
	 */
	public function getCell()
	{
		return $this->cell;
	}

	/**
	 * Get the [address] column value.
	 * 
	 * @return     string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Get the [city] column value.
	 * 
	 * @return     string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * Get the [province] column value.
	 * 
	 * @return     string
	 */
	public function getProvince()
	{
		return $this->province;
	}

	/**
	 * Get the [country] column value.
	 * 
	 * @return     string
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * Get the [postal] column value.
	 * 
	 * @return     string
	 */
	public function getPostal()
	{
		return $this->postal;
	}

	/**
	 * Get the [role_id] column value.
	 * 
	 * @return     int
	 */
	public function getRoleId()
	{
		return $this->role_id;
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
	 * Get the [shop_id] column value.
	 * 
	 * @return     int
	 */
	public function getShopId()
	{
		return $this->shop_id;
	}

	/**
	 * Get the [market_id] column value.
	 * 
	 * @return     int
	 */
	public function getMarketId()
	{
		return $this->market_id;
	}

	/**
	 * Get the [recovery_token] column value.
	 * 
	 * @return     string
	 */
	public function getRecoveryToken()
	{
		return $this->recovery_token;
	}

	/**
	 * Get the [optionally formatted] temporal [recovery_sent] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getRecoverySent($format = 'Y-m-d H:i:s')
	{
		if ($this->recovery_sent === null) {
			return null;
		}


		if ($this->recovery_sent === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->recovery_sent);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->recovery_sent, true), $x);
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UserPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [username] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = UserPeer::USERNAME;
		}

		return $this;
	} // setUsername()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

		return $this;
	} // setEmail()

	/**
	 * Set the value of [passwd] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPasswd($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->passwd !== $v) {
			$this->passwd = $v;
			$this->modifiedColumns[] = UserPeer::PASSWD;
		}

		return $this;
	} // setPasswd()

	/**
	 * Set the value of [greeting] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setGreeting($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->greeting !== $v) {
			$this->greeting = $v;
			$this->modifiedColumns[] = UserPeer::GREETING;
		}

		return $this;
	} // setGreeting()

	/**
	 * Set the value of [first_name] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setFirstName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = UserPeer::FIRST_NAME;
		}

		return $this;
	} // setFirstName()

	/**
	 * Set the value of [last_name] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setLastName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = UserPeer::LAST_NAME;
		}

		return $this;
	} // setLastName()

	/**
	 * Set the value of [phone] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPhone($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = UserPeer::PHONE;
		}

		return $this;
	} // setPhone()

	/**
	 * Set the value of [cell] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCell($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->cell !== $v) {
			$this->cell = $v;
			$this->modifiedColumns[] = UserPeer::CELL;
		}

		return $this;
	} // setCell()

	/**
	 * Set the value of [address] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = UserPeer::ADDRESS;
		}

		return $this;
	} // setAddress()

	/**
	 * Set the value of [city] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCity($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = UserPeer::CITY;
		}

		return $this;
	} // setCity()

	/**
	 * Set the value of [province] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setProvince($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->province !== $v) {
			$this->province = $v;
			$this->modifiedColumns[] = UserPeer::PROVINCE;
		}

		return $this;
	} // setProvince()

	/**
	 * Set the value of [country] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = UserPeer::COUNTRY;
		}

		return $this;
	} // setCountry()

	/**
	 * Set the value of [postal] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPostal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->postal !== $v) {
			$this->postal = $v;
			$this->modifiedColumns[] = UserPeer::POSTAL;
		}

		return $this;
	} // setPostal()

	/**
	 * Set the value of [role_id] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setRoleId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->role_id !== $v) {
			$this->role_id = $v;
			$this->modifiedColumns[] = UserPeer::ROLE_ID;
		}

		if ($this->aRole !== null && $this->aRole->getId() !== $v) {
			$this->aRole = null;
		}

		return $this;
	} // setRoleId()

	/**
	 * Set the value of [customer_id] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCustomerId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->customer_id !== $v) {
			$this->customer_id = $v;
			$this->modifiedColumns[] = UserPeer::CUSTOMER_ID;
		}

		if ($this->aCustomer !== null && $this->aCustomer->getId() !== $v) {
			$this->aCustomer = null;
		}

		return $this;
	} // setCustomerId()

	/**
	 * Set the value of [shop_id] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setShopId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->shop_id !== $v) {
			$this->shop_id = $v;
			$this->modifiedColumns[] = UserPeer::SHOP_ID;
		}

		if ($this->aShop !== null && $this->aShop->getId() !== $v) {
			$this->aShop = null;
		}

		return $this;
	} // setShopId()

	/**
	 * Set the value of [market_id] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setMarketId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->market_id !== $v) {
			$this->market_id = $v;
			$this->modifiedColumns[] = UserPeer::MARKET_ID;
		}

		if ($this->aMarket !== null && $this->aMarket->getId() !== $v) {
			$this->aMarket = null;
		}

		return $this;
	} // setMarketId()

	/**
	 * Set the value of [recovery_token] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setRecoveryToken($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->recovery_token !== $v) {
			$this->recovery_token = $v;
			$this->modifiedColumns[] = UserPeer::RECOVERY_TOKEN;
		}

		return $this;
	} // setRecoveryToken()

	/**
	 * Sets the value of [recovery_sent] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     User The current object (for fluent API support)
	 */
	public function setRecoverySent($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->recovery_sent !== null || $dt !== null) {
			$currentDateAsString = ($this->recovery_sent !== null && $tmpDt = new DateTime($this->recovery_sent)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->recovery_sent = $newDateAsString;
				$this->modifiedColumns[] = UserPeer::RECOVERY_SENT;
			}
		} // if either are not null

		return $this;
	} // setRecoverySent()

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
			$this->username = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->email = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->passwd = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->greeting = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->first_name = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->last_name = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->phone = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->cell = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->address = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->city = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->province = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->country = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->postal = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->role_id = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->customer_id = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->shop_id = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
			$this->market_id = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
			$this->recovery_token = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->recovery_sent = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 20; // 20 = UserPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
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

		if ($this->aRole !== null && $this->role_id !== $this->aRole->getId()) {
			$this->aRole = null;
		}
		if ($this->aCustomer !== null && $this->customer_id !== $this->aCustomer->getId()) {
			$this->aCustomer = null;
		}
		if ($this->aShop !== null && $this->shop_id !== $this->aShop->getId()) {
			$this->aShop = null;
		}
		if ($this->aMarket !== null && $this->market_id !== $this->aMarket->getId()) {
			$this->aMarket = null;
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCustomer = null;
			$this->aShop = null;
			$this->aMarket = null;
			$this->aRole = null;
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				UserQuery::create()
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				UserPeer::addInstanceToPool($this);
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

			if ($this->aShop !== null) {
				if ($this->aShop->isModified() || $this->aShop->isNew()) {
					$affectedRows += $this->aShop->save($con);
				}
				$this->setShop($this->aShop);
			}

			if ($this->aMarket !== null) {
				if ($this->aMarket->isModified() || $this->aMarket->isNew()) {
					$affectedRows += $this->aMarket->save($con);
				}
				$this->setMarket($this->aMarket);
			}

			if ($this->aRole !== null) {
				if ($this->aRole->isModified() || $this->aRole->isNew()) {
					$affectedRows += $this->aRole->save($con);
				}
				$this->setRole($this->aRole);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = UserPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(UserPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
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

			if ($this->aShop !== null) {
				if (!$this->aShop->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aShop->getValidationFailures());
				}
			}

			if ($this->aMarket !== null) {
				if (!$this->aMarket->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMarket->getValidationFailures());
				}
			}

			if ($this->aRole !== null) {
				if (!$this->aRole->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRole->getValidationFailures());
				}
			}


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsername();
				break;
			case 2:
				return $this->getEmail();
				break;
			case 3:
				return $this->getPasswd();
				break;
			case 4:
				return $this->getGreeting();
				break;
			case 5:
				return $this->getFirstName();
				break;
			case 6:
				return $this->getLastName();
				break;
			case 7:
				return $this->getPhone();
				break;
			case 8:
				return $this->getCell();
				break;
			case 9:
				return $this->getAddress();
				break;
			case 10:
				return $this->getCity();
				break;
			case 11:
				return $this->getProvince();
				break;
			case 12:
				return $this->getCountry();
				break;
			case 13:
				return $this->getPostal();
				break;
			case 14:
				return $this->getRoleId();
				break;
			case 15:
				return $this->getCustomerId();
				break;
			case 16:
				return $this->getShopId();
				break;
			case 17:
				return $this->getMarketId();
				break;
			case 18:
				return $this->getRecoveryToken();
				break;
			case 19:
				return $this->getRecoverySent();
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
		if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getEmail(),
			$keys[3] => $this->getPasswd(),
			$keys[4] => $this->getGreeting(),
			$keys[5] => $this->getFirstName(),
			$keys[6] => $this->getLastName(),
			$keys[7] => $this->getPhone(),
			$keys[8] => $this->getCell(),
			$keys[9] => $this->getAddress(),
			$keys[10] => $this->getCity(),
			$keys[11] => $this->getProvince(),
			$keys[12] => $this->getCountry(),
			$keys[13] => $this->getPostal(),
			$keys[14] => $this->getRoleId(),
			$keys[15] => $this->getCustomerId(),
			$keys[16] => $this->getShopId(),
			$keys[17] => $this->getMarketId(),
			$keys[18] => $this->getRecoveryToken(),
			$keys[19] => $this->getRecoverySent(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aCustomer) {
				$result['Customer'] = $this->aCustomer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aShop) {
				$result['Shop'] = $this->aShop->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aMarket) {
				$result['Market'] = $this->aMarket->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aRole) {
				$result['Role'] = $this->aRole->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsername($value);
				break;
			case 2:
				$this->setEmail($value);
				break;
			case 3:
				$this->setPasswd($value);
				break;
			case 4:
				$this->setGreeting($value);
				break;
			case 5:
				$this->setFirstName($value);
				break;
			case 6:
				$this->setLastName($value);
				break;
			case 7:
				$this->setPhone($value);
				break;
			case 8:
				$this->setCell($value);
				break;
			case 9:
				$this->setAddress($value);
				break;
			case 10:
				$this->setCity($value);
				break;
			case 11:
				$this->setProvince($value);
				break;
			case 12:
				$this->setCountry($value);
				break;
			case 13:
				$this->setPostal($value);
				break;
			case 14:
				$this->setRoleId($value);
				break;
			case 15:
				$this->setCustomerId($value);
				break;
			case 16:
				$this->setShopId($value);
				break;
			case 17:
				$this->setMarketId($value);
				break;
			case 18:
				$this->setRecoveryToken($value);
				break;
			case 19:
				$this->setRecoverySent($value);
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
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPasswd($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setGreeting($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFirstName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPhone($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCell($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAddress($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCity($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setProvince($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCountry($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPostal($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setRoleId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCustomerId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setShopId($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setMarketId($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setRecoveryToken($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setRecoverySent($arr[$keys[19]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::USERNAME)) $criteria->add(UserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::PASSWD)) $criteria->add(UserPeer::PASSWD, $this->passwd);
		if ($this->isColumnModified(UserPeer::GREETING)) $criteria->add(UserPeer::GREETING, $this->greeting);
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UserPeer::PHONE)) $criteria->add(UserPeer::PHONE, $this->phone);
		if ($this->isColumnModified(UserPeer::CELL)) $criteria->add(UserPeer::CELL, $this->cell);
		if ($this->isColumnModified(UserPeer::ADDRESS)) $criteria->add(UserPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(UserPeer::CITY)) $criteria->add(UserPeer::CITY, $this->city);
		if ($this->isColumnModified(UserPeer::PROVINCE)) $criteria->add(UserPeer::PROVINCE, $this->province);
		if ($this->isColumnModified(UserPeer::COUNTRY)) $criteria->add(UserPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(UserPeer::POSTAL)) $criteria->add(UserPeer::POSTAL, $this->postal);
		if ($this->isColumnModified(UserPeer::ROLE_ID)) $criteria->add(UserPeer::ROLE_ID, $this->role_id);
		if ($this->isColumnModified(UserPeer::CUSTOMER_ID)) $criteria->add(UserPeer::CUSTOMER_ID, $this->customer_id);
		if ($this->isColumnModified(UserPeer::SHOP_ID)) $criteria->add(UserPeer::SHOP_ID, $this->shop_id);
		if ($this->isColumnModified(UserPeer::MARKET_ID)) $criteria->add(UserPeer::MARKET_ID, $this->market_id);
		if ($this->isColumnModified(UserPeer::RECOVERY_TOKEN)) $criteria->add(UserPeer::RECOVERY_TOKEN, $this->recovery_token);
		if ($this->isColumnModified(UserPeer::RECOVERY_SENT)) $criteria->add(UserPeer::RECOVERY_SENT, $this->recovery_sent);

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
		$criteria = new Criteria(UserPeer::DATABASE_NAME);
		$criteria->add(UserPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of User (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUsername($this->getUsername());
		$copyObj->setEmail($this->getEmail());
		$copyObj->setPasswd($this->getPasswd());
		$copyObj->setGreeting($this->getGreeting());
		$copyObj->setFirstName($this->getFirstName());
		$copyObj->setLastName($this->getLastName());
		$copyObj->setPhone($this->getPhone());
		$copyObj->setCell($this->getCell());
		$copyObj->setAddress($this->getAddress());
		$copyObj->setCity($this->getCity());
		$copyObj->setProvince($this->getProvince());
		$copyObj->setCountry($this->getCountry());
		$copyObj->setPostal($this->getPostal());
		$copyObj->setRoleId($this->getRoleId());
		$copyObj->setCustomerId($this->getCustomerId());
		$copyObj->setShopId($this->getShopId());
		$copyObj->setMarketId($this->getMarketId());
		$copyObj->setRecoveryToken($this->getRecoveryToken());
		$copyObj->setRecoverySent($this->getRecoverySent());
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
	 * @return     User Clone of current object.
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
	 * @return     UserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Customer object.
	 *
	 * @param      Customer $v
	 * @return     User The current object (for fluent API support)
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
			$v->addUser($this);
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
				$this->aCustomer->addUsers($this);
			 */
		}
		return $this->aCustomer;
	}

	/**
	 * Declares an association between this object and a Shop object.
	 *
	 * @param      Shop $v
	 * @return     User The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setShop(Shop $v = null)
	{
		if ($v === null) {
			$this->setShopId(NULL);
		} else {
			$this->setShopId($v->getId());
		}

		$this->aShop = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Shop object, it will not be re-added.
		if ($v !== null) {
			$v->addUser($this);
		}

		return $this;
	}


	/**
	 * Get the associated Shop object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Shop The associated Shop object.
	 * @throws     PropelException
	 */
	public function getShop(PropelPDO $con = null)
	{
		if ($this->aShop === null && ($this->shop_id !== null)) {
			$this->aShop = ShopQuery::create()->findPk($this->shop_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aShop->addUsers($this);
			 */
		}
		return $this->aShop;
	}

	/**
	 * Declares an association between this object and a Market object.
	 *
	 * @param      Market $v
	 * @return     User The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMarket(Market $v = null)
	{
		if ($v === null) {
			$this->setMarketId(NULL);
		} else {
			$this->setMarketId($v->getId());
		}

		$this->aMarket = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Market object, it will not be re-added.
		if ($v !== null) {
			$v->addUser($this);
		}

		return $this;
	}


	/**
	 * Get the associated Market object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Market The associated Market object.
	 * @throws     PropelException
	 */
	public function getMarket(PropelPDO $con = null)
	{
		if ($this->aMarket === null && ($this->market_id !== null)) {
			$this->aMarket = MarketQuery::create()->findPk($this->market_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aMarket->addUsers($this);
			 */
		}
		return $this->aMarket;
	}

	/**
	 * Declares an association between this object and a Role object.
	 *
	 * @param      Role $v
	 * @return     User The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRole(Role $v = null)
	{
		if ($v === null) {
			$this->setRoleId(NULL);
		} else {
			$this->setRoleId($v->getId());
		}

		$this->aRole = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Role object, it will not be re-added.
		if ($v !== null) {
			$v->addUser($this);
		}

		return $this;
	}


	/**
	 * Get the associated Role object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Role The associated Role object.
	 * @throws     PropelException
	 */
	public function getRole(PropelPDO $con = null)
	{
		if ($this->aRole === null && ($this->role_id !== null)) {
			$this->aRole = RoleQuery::create()->findPk($this->role_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aRole->addUsers($this);
			 */
		}
		return $this->aRole;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->username = null;
		$this->email = null;
		$this->passwd = null;
		$this->greeting = null;
		$this->first_name = null;
		$this->last_name = null;
		$this->phone = null;
		$this->cell = null;
		$this->address = null;
		$this->city = null;
		$this->province = null;
		$this->country = null;
		$this->postal = null;
		$this->role_id = null;
		$this->customer_id = null;
		$this->shop_id = null;
		$this->market_id = null;
		$this->recovery_token = null;
		$this->recovery_sent = null;
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

		$this->aCustomer = null;
		$this->aShop = null;
		$this->aMarket = null;
		$this->aRole = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
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

} // BaseUser
