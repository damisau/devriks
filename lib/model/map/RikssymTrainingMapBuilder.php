<?php


/**
 * This class adds structure of 'rikssym_training' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Thu May 27 16:34:57 2010
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class RikssymTrainingMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.RikssymTrainingMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(RikssymTrainingPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RikssymTrainingPeer::TABLE_NAME);
		$tMap->setPhpName('RikssymTraining');
		$tMap->setClassname('RikssymTraining');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('COUNTRY_ID', 'CountryId', 'INTEGER', 'rikssym_country', 'ID', false, null);

		$tMap->addColumn('INSTITUTE', 'Institute', 'VARCHAR', false, 255);

		$tMap->addColumn('PROGRAM_TITLE', 'ProgramTitle', 'VARCHAR', false, 255);

		$tMap->addColumn('URL', 'Url', 'VARCHAR', false, 255);

	} // doBuild()

} // RikssymTrainingMapBuilder
