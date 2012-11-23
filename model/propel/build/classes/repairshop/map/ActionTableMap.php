<?php



/**
 * This class defines the structure of the 'Action' table.
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
class ActionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.ActionTableMap';

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
		$this->setName('Action');
		$this->setPhpName('Action');
		$this->setClassname('Action');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('PATH', 'Path', 'VARCHAR', true, 99, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 99, null);
		$this->addForeignKey('ACTION_CATEGORY_ID', 'ActionCategoryId', 'INTEGER', 'ActionCategory', 'ID', false, 10, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Actioncategory', 'Actioncategory', RelationMap::MANY_TO_ONE, array('action_category_id' => 'id', ), null, null);
    $this->addRelation('Roleaction', 'Roleaction', RelationMap::ONE_TO_MANY, array('id' => 'action_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // ActionTableMap
