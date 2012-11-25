<?php



/**
 * This class defines the structure of the 'Vehicle' table.
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
class VehicleTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'repairshop.map.VehicleTableMap';

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
		$this->setName('Vehicle');
		$this->setPhpName('Vehicle');
		$this->setClassname('Vehicle');
		$this->setPackage('repairshop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10, null);
		$this->addForeignKey('CUSTOMER_ID', 'CustomerId', 'INTEGER', 'Customer', 'ID', false, 10, null);
		$this->addColumn('YEAR', 'Year', 'CHAR', true, 4, null);
		$this->addColumn('MAKE', 'Make', 'VARCHAR', true, 45, null);
		$this->addColumn('MODEL', 'Model', 'VARCHAR', true, 45, null);
		$this->addColumn('SUBMODEL', 'Submodel', 'VARCHAR', false, 45, null);
		$this->addColumn('VIN', 'Vin', 'VARCHAR', false, 45, null);
		$this->addColumn('CYLINDERS', 'Cylinders', 'CHAR', false, null, null);
		$this->addColumn('VOLUME', 'Volume', 'DECIMAL', false, 2, null);
		$this->addColumn('ODOMETER_UNIT', 'OdometerUnit', 'CHAR', true, null, 'km');
		$this->addColumn('GAS_UNIT', 'GasUnit', 'CHAR', true, null, 'L');
		$this->addColumn('TRANSMISSION', 'Transmission', 'VARCHAR', false, 45, null);
		$this->addColumn('COLOR', 'Color', 'VARCHAR', false, 45, null);
		$this->addColumn('LICENSE_PLATE', 'LicensePlate', 'VARCHAR', false, 45, null);
		$this->addColumn('INI_ODOMETER', 'IniOdometer', 'INTEGER', true, 10, null);
		$this->addColumn('NOTES', 'Notes', 'LONGVARCHAR', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Customer', 'Customer', RelationMap::MANY_TO_ONE, array('customer_id' => 'id', ), null, null);
	} // buildRelations()

} // VehicleTableMap
