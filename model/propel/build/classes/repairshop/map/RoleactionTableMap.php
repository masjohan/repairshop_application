<?php



/**
 * This class defines the structure of the 'RoleAction' table.
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
class RoleactionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.RoleactionTableMap';

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
		$this->setName('RoleAction');
		$this->setPhpName('Roleaction');
		$this->setClassname('Roleaction');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addForeignKey('ROLE_ID', 'RoleId', 'INTEGER', 'Role', 'ID', false, 10, null);
		$this->addForeignKey('ACTION_ID', 'ActionId', 'INTEGER', 'Action', 'ID', true, 10, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Role', 'Role', RelationMap::MANY_TO_ONE, array('role_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('Action', 'Action', RelationMap::MANY_TO_ONE, array('action_id' => 'id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // RoleactionTableMap