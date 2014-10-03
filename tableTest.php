<?php
require_once('table.php');
class TableTest extends PHPUnit_Framework_TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

	var $tabler;

	public function __construct(){
		$this->tabler = new Tabler();
	}

	public function _getSubject(){
		return $this->tabler;
	}

	public function _getTestRow(){
		return array(
        'Name' => 'Trixie',
        'Color' => 'Green',
        'Element' => 'Earth',
        'Likes' => 'Flowers'
        );
	}

	public function testGenerateDoesNotAcceptANonArray()
	{
		$t = $this->_getSubject();
		$this->assertFalse($t->generate('not an array'));
	}

	public function testGenerateDoesNotAcceptAnEmptyArray(){
		$t = $this->_getSubject();
		$this->assertFalse($t->generate(array()));
	}

	public function testGetBreakReturnsALineBreak(){
		$t = $this->_getSubject();
		$this->assertEquals($t->getBreak(), "\n");
	}

	public function testGetStringFromRowShouldStartwithTheDelimiter(){
		$t = $this->_getSubject();
		$delimiter = "|";
		$this->assertStringStartsWith($delimiter, $t->getStringFromRow($this->_getTestRow(), $delimiter));
	}

	public function testGetStringFromRowShouldEndwithTheDelimiter(){
		$t = $this->_getSubject();
		$delimiter = "|";
		$this->assertStringEndsWith($delimiter, $t->getStringFromRow($this->_getTestRow(), $delimiter));
	}
	public function testGetStringFromRowShouldNotStartwithASpace(){
		$t = $this->_getSubject();
		$delimiter = " | ";
		$this->assertStringStartsNotWith(' ', $t->getStringFromRow($this->_getTestRow(), $delimiter));
	}

	public function testGetStringFromRowShouldNotEndwithASpace(){
		$t = $this->_getSubject();
		$delimiter = " | ";
		$this->assertStringEndsNotWith(' ', $t->getStringFromRow($this->_getTestRow(), $delimiter));
	}

	public function testGeneratedStringMustStartWithALineFromGetLine(){
		$t = $this->_getSubject();
		$delimiter = " | ";
		$arr = array($this->_getTestRow());
		$this->assertStringStartsWith($t->getLine($t->getColumnNamesFromArray($arr)), $t->generate($arr));

	}

	public function testArrangeRowToColumnsMustReturnAnArrayWithOnlyTheOriginalColumns(){
		$t = $this->_getSubject();
		$original_row = $this->_getTestRow();
		$extra = array('wrong', 'column');
		$extra_row = array_merge($original_row, $extra);

		$original_columns = $t->getColumnNamesFromArray(array($original_row));
		$extra_row = $t->arrangeRowToColumns($original_row, $original_columns);

		$this->assertNotContains('wrong', array_keys($extra_row));

	}


}
