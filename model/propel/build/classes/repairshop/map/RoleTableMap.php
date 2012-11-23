<?php



/**
 * This class defines the structure of the 'Role' table.
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
class RoleTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.RoleTableMap';

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
		$this->setName('Role');
		$this->setPhpName('Role');
		$this->setClassname('Role');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 45, null);
		$this->addColumn('NOTES', 'Notes', 'VARCHAR', true, 99, null);
		$this->addColumn('TYPE', 'Type', 'CHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('User', 'User', RelationMap::ONE_TO_MANY, array('id' => 'role_id', ), null, null);
	} // buildRelations()

} // RoleTableMap
