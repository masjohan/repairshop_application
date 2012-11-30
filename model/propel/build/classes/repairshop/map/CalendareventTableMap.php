<?php



/**
 * This class defines the structure of the 'CalendarEvent' table.
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
class CalendareventTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.CalendareventTableMap';

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
		$this->setName('CalendarEvent');
		$this->setPhpName('Calendarevent');
		$this->setClassname('Calendarevent');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', true, 45, null);
		$this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', true, 45, null);
		$this->addColumn('PHONE', 'Phone', 'VARCHAR', true, 45, null);
		$this->addColumn('NOTES', 'Notes', 'LONGVARCHAR', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Calendar', 'Calendar', RelationMap::ONE_TO_MANY, array('id' => 'event_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // CalendareventTableMap
