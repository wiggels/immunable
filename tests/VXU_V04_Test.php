<?hh

class VXU_V04_Test extends PHPUnit_Framework_TestCase {

  public function testValidFloridaShotsMSH() {
    // Create & verify typical FloridaShots MSH Segment with no bad characters
    $test = new Immunable\Messages\VXU\V04\Segments\MSH();
    $test->setSendingApplication('Immunable', 'ediHQ');
    $test->setSendingFacility('Assigned ID', 'Office Location Name');
    $test->setReceivingApplication('');
    $test->setReceivingFacility('');
    $test->setControlId('TEST');
    $this->assertEquals('TEST', $test->getControlId());
    $this->assertEquals("MSH|^~\&|Immunable^ediHQ|Assigned ID^Office Location Name|||" . $test->getDateTime() . "||VXU^V04^VXU_V04|TEST|P|2.5.1|||ER|AL|USA|ASCII|en^English^639-1^eng^English^639-2||Z22^CDCPHINVS\r", $test->generateSegment());
  }

}
