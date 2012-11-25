<?php



/**
 * This class defines the structure of the 'Customer' table.
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
class CustomerTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.CustomerTableMap';

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
		$this->setName('Customer');
		$this->setPhpName('Customer');
		$this->setClassname('Customer');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('REWARD_POINT', 'RewardPoint', 'INTEGER', false, null, null);
		$this->addColumn('REFERER_ID', 'RefererId', 'INTEGER', false, 10, null);
		$this->addColumn('NOTES', 'Notes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('FAMILY_ID', 'FamilyId', 'INTEGER', false, 10, null);
		$this->addForeignKey('SHOP_ID', 'ShopId', 'INTEGER', 'Shop', 'ID', true, 10, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Shop', 'Shop', RelationMap::MANY_TO_ONE, array('shop_id' => 'id', ), null, null);
    $this->addRelation('Vehicle', 'Vehicle', RelationMap::ONE_TO_MANY, array('id' => 'customer_id', ), null, null);
	} // buildRelations()

} // CustomerTableMap
