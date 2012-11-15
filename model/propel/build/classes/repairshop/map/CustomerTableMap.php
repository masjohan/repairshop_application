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
		$this->addColumn('TITLE', 'Title', 'CHAR', false, null, null);
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 45, null);
		$this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 45, null);
		$this->addColumn('PHONE', 'Phone', 'VARCHAR', false, 25, null);
		$this->addColumn('CELL', 'Cell', 'VARCHAR', false, 25, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 45, null);
		$this->addColumn('ADDRESS', 'Address', 'VARCHAR', false, 100, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', false, 25, null);
		$this->addColumn('PROVINCE', 'Province', 'VARCHAR', false, 25, null);
		$this->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 25, null);
		$this->addColumn('POSTAL', 'Postal', 'VARCHAR', false, 12, null);
		$this->addColumn('COMPANY', 'Company', 'VARCHAR', false, 45, null);
		$this->addColumn('NOTES', 'Notes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('VIP_SCORE', 'VipScore', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // CustomerTableMap
