<?php



/**
 * This class defines the structure of the 'Shop' table.
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
class ShopTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.ShopTableMap';

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
		$this->setName('Shop');
		$this->setPhpName('Shop');
		$this->setClassname('Shop');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('CHAIN_ID', 'ChainId', 'INTEGER', true, 10, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 45, null);
		$this->addColumn('ADDRESS', 'Address', 'VARCHAR', true, 45, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', true, 45, null);
		$this->addColumn('PROVINCE', 'Province', 'VARCHAR', true, 45, null);
		$this->addColumn('COUNTRY', 'Country', 'VARCHAR', true, 45, null);
		$this->addColumn('POSTAL', 'Postal', 'VARCHAR', true, 45, null);
		$this->addColumn('PHONE', 'Phone', 'VARCHAR', true, 45, null);
		$this->addColumn('FAX', 'Fax', 'VARCHAR', true, 45, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 45, null);
		$this->addForeignKey('OWNER_ID', 'OwnerId', 'INTEGER', 'User', 'ID', false, 10, null);
		$this->addColumn('NOTES', 'Notes', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('owner_id' => 'id', ), null, null);
    $this->addRelation('Customer', 'Customer', RelationMap::ONE_TO_MANY, array('id' => 'shop_id', ), null, null);
	} // buildRelations()

} // ShopTableMap
