<?hh // strict

// Message Header Segment
//   Defines intent, source, destination, and specifics of message

namespace Immunable\Messages\VXU\V04\Segments;

class MSH extends \Immunable\Messages\Segments\MSH {

  public function __construct(): void {
    $this->messageType = 'VXU^V04^VXU_V04';
    $this->messageProfileId = 'Z22^CDCPHINVS';
    $this->dateTime = new \DateTime();
    $this->messageControlId = sprintf(
      "%s%06d",
      $this->dateTime->format('YmdHis'),
      mt_rand(1, 999999)
    );
  }

}
