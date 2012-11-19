<?php



/**
 * This class defines the structure of the '_audit' table.
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
class AuditTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.AuditTableMap';

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
		$this->setName('_audit');
		$this->setPhpName('Audit');
		$this->setClassname('Audit');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('WHEN', 'When', 'TIMESTAMP', true, null, null);
		$this->addColumn('ACTION', 'Action', 'CHAR', true, null, null);
		$this->addColumn('TABLE_NAME', 'TableName', 'VARCHAR', true, 45, null);
		$this->addColumn('TABLE_ID', 'TableId', 'INTEGER', true, 10, null);
		$this->addColumn('USER_ID', 'UserId', 'INTEGER', false, 10, null);
		$this->addColumn('MYSQL_UID', 'MysqlUid', 'VARCHAR', false, 45, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // AuditTableMap
