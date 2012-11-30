<?php



/**
 * This class defines the structure of the 'Calendar' table.
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
class CalendarTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.CalendarTableMap';

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
		$this->setName('Calendar');
		$this->setPhpName('Calendar');
		$this->setClassname('Calendar');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addForeignKey('RESOURCE_ID', 'ResourceId', 'INTEGER', 'CalendarResource', 'ID', true, 10, null);
		$this->addForeignKey('SLOT_ID', 'SlotId', 'INTEGER', 'CalendarSlot', 'ID', true, 10, null);
		$this->addForeignKey('EVENT_ID', 'EventId', 'INTEGER', 'CalendarEvent', 'ID', true, 10, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Calendarresource', 'Calendarresource', RelationMap::MANY_TO_ONE, array('resource_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('Calendarslot', 'Calendarslot', RelationMap::MANY_TO_ONE, array('slot_id' => 'id', ), null, null);
    $this->addRelation('Calendarevent', 'Calendarevent', RelationMap::MANY_TO_ONE, array('event_id' => 'id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // CalendarTableMap
