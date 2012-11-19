<?php



/**
 * This class defines the structure of the 'User' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.repairshop.map
 */
class UserTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.UserTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('User');
		$this->setPhpName('User');
		$this->setClassname('User');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('USERNAME', 'Username', 'VARCHAR', false, 15, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 45, null);
		$this->addColumn('PASSWD', 'Passwd', 'VARCHAR', false, 45, null);
		$this->addColumn('GREETING', 'Greeting', 'CHAR', false, null, null);
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 45, null);
		$this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 45, null);
		$this->addColumn('PHONE', 'Phone', 'VARCHAR', false, 25, null);
		$this->addColumn('CELL', 'Cell', 'VARCHAR', false, 25, null);
		$this->addColumn('ADDRESS', 'Address', 'VARCHAR', false, 100, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', false, 25, null);
		$this->addColumn('PROVINCE', 'Province', 'VARCHAR', false, 25, null);
		$this->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 25, null);
		$this->addColumn('POSTAL', 'Postal', 'VARCHAR', false, 12, null);
		$this->addForeignKey('ROLE_ID', 'RoleId', 'INTEGER', 'Role', 'ID', true, 10, null);
		$this->addForeignKey('CUSTOMER_ID', 'CustomerId', 'INTEGER', 'Customer', 'ID', false, 10, null);
		$this->addForeignKey('SHOP_ID', 'ShopId', 'INTEGER', 'Shop', 'ID', false, 10, null);
		$this->addForeignKey('MARKET_ID', 'MarketId', 'INTEGER', 'Market', 'ID', false, 10, null);
		$this->addColumn('RECOVERY_TOKEN', 'RecoveryToken', 'VARCHAR', false, 45, null);
		$this->addColumn('RECOVERY_SENT', 'RecoverySent', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Customer', 'Customer', RelationMap::MANY_TO_ONE, array('customer_id' => 'id', ), null, null);
    $this->addRelation('Shop', 'Shop', RelationMap::MANY_TO_ONE, array('shop_id' => 'id', ), null, null);
    $this->addRelation('Market', 'Market', RelationMap::MANY_TO_ONE, array('market_id' => 'id', ), null, null);
    $this->addRelation('Role', 'Role', RelationMap::MANY_TO_ONE, array('role_id' => 'id', ), null, null);
	} // buildRelations()

} // UserTableMap