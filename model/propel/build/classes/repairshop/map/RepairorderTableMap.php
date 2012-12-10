<?php



/**
 * This class defines the structure of the 'RepairOrder' table.
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
class RepairorderTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.RepairorderTableMap';

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
		$this->setName('RepairOrder');
		$this->setPhpName('Repairorder');
		$this->setClassname('Repairorder');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addForeignKey('VEHICLE_ID', 'VehicleId', 'INTEGER', 'Vehicle', 'ID', true, 10, null);
		$this->addColumn('TAG', 'Tag', 'VARCHAR', true, 45, null);
		$this->addForeignKey('REPAIR_ORDER_STATUS_ID', 'RepairOrderStatusId', 'INTEGER', 'RepairOrderStatus', 'ID', true, 10, null);
		$this->addColumn('TIME_IN', 'TimeIn', 'TIMESTAMP', true, null, null);
		$this->addColumn('EXPECTED', 'Expected', 'TIMESTAMP', true, null, null);
		$this->addColumn('TECH', 'Tech', 'VARCHAR', true, 45, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Vehicle', 'Vehicle', RelationMap::MANY_TO_ONE, array('vehicle_id' => 'id', ), null, null);
    $this->addRelation('Repairorderstatus', 'Repairorderstatus', RelationMap::MANY_TO_ONE, array('repair_order_status_id' => 'id', ), null, null);
    $this->addRelation('Repairorderitem', 'Repairorderitem', RelationMap::ONE_TO_MANY, array('id' => 'repaire_order_id', ), null, null);
	} // buildRelations()

} // RepairorderTableMap
