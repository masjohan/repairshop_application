<?php



/**
 * This class defines the structure of the 'RepairOrderCode' table.
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
class RepairordercodeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.RepairordercodeTableMap';

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
		$this->setName('RepairOrderCode');
		$this->setPhpName('Repairordercode');
		$this->setClassname('Repairordercode');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('CODE', 'Code', 'VARCHAR', true, 45, null);
		$this->addColumn('SYSTEM', 'System', 'VARCHAR', true, 45, null);
		$this->addColumn('DESC', 'Desc', 'VARCHAR', true, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Repairorderitem', 'Repairorderitem', RelationMap::ONE_TO_MANY, array('id' => 'ro_code_id', ), null, null);
	} // buildRelations()

} // RepairordercodeTableMap
