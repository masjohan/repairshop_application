<?php



/**
 * This class defines the structure of the 'Setting' table.
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
class SettingTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.SettingTableMap';

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
		$this->setName('Setting');
		$this->setPhpName('Setting');
		$this->setClassname('Setting');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('ROLE_TYPE', 'RoleType', 'SMALLINT', true, 5, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 45, null);
		$this->addColumn('VALUE', 'Value', 'VARCHAR', true, 45, null);
		$this->addColumn('MEMO', 'Memo', 'VARCHAR', true, 255, null);
		$this->addColumn('SYS_OVERRIDE', 'SysOverride', 'BOOLEAN', true, null, true);
		$this->addColumn('USR_OVERRIDE', 'UsrOverride', 'BOOLEAN', true, null, false);
		$this->addColumn('USR_VALIDATOR', 'UsrValidator', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Settingoverride', 'Settingoverride', RelationMap::ONE_TO_MANY, array('id' => 'setting_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // SettingTableMap
