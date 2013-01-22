<?php


/**
 * This class adds structure of 'rikssym_document_entity' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Thu May 27 16:34:58 2010
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class RikssymDocumentEntityMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.RikssymDocumentEntityMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RikssymDocumentEntityPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RikssymDocumentEntityPeer::TABLE_NAME);
		$tMap->setPhpName('RikssymDocumentEntity');
		$tMap->setClassname('RikssymDocumentEntity');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('DOCUMENT_ID', 'DocumentId', 'INTEGER', 'rikssym_document', 'ID', true, null);

		$tMap->addForeignKey('ARRANGEMENT_ID', 'ArrangementId', 'INTEGER', 'rikssym_arrangement', 'ID', false, null);

		$tMap->addForeignKey('COUNTRY_ID', 'CountryId', 'INTEGER', 'rikssym_country', 'ID', false, null);

	} // doBuild()

} // RikssymDocumentEntityMapBuilder
