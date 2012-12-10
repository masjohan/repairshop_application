<?php



/**
 * This class defines the structure of the 'RepairOrderItem' table.
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
class RepairorderitemTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.RepairorderitemTableMap';

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
		$this->setName('RepairOrderItem');
		$this->setPhpName('Repairorderitem');
		$this->setClassname('Repairorderitem');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addForeignKey('REPAIRE_ORDER_ID', 'RepaireOrderId', 'INTEGER', 'RepairOrder', 'ID', true, 10, null);
		$this->addForeignKey('RO_CODE_ID', 'RoCodeId', 'INTEGER', 'RepairOrderCode', 'ID', true, 10, null);
		$this->addColumn('TECH', 'Tech', 'VARCHAR', false, 45, null);
		$this->addColumn('DESC', 'Desc', 'VARCHAR', true, 255, null);
		$this->addColumn('PRICE', 'Price', 'DECIMAL', false, 9, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Repairordercode', 'Repairordercode', RelationMap::MANY_TO_ONE, array('ro_code_id' => 'id', ), null, null);
    $this->addRelation('Repairorder', 'Repairorder', RelationMap::MANY_TO_ONE, array('repaire_order_id' => 'id', ), null, null);
	} // buildRelations()

} // RepairorderitemTableMap
