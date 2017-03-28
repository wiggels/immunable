<?hh // strict

// Message Header Segment
//   Defines intent, source, destination, and specifics of message

namespace Immunable\Messages\VXU\V04\Segments;

class MSH extends \Immunable\Messages\Segments\MSH {

  public function __construct(): void {
    // Set type and profile for VXU message
    $this->messageType = 'VXU^V04^VXU_V04';
    $this->messageProfileId = 'Z22^CDCPHINVS';
    // Set dateTime to right now
    $this->dateTime = new \DateTime();
    // Set controlId to DateTime plus random number for now
    // Can be retrieved or set using getControlId() / setControlId() methods
    $this->messageControlId = sprintf(
      "%.14s%06d",
      $this->dateTime->format('YmdHis'),
      mt_rand(1, 999999)
    );
  }

}
