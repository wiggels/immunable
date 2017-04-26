<?hh // strict

// Patient Identification Segment
//   Primary means of communicating patient identification information

namespace Immunable\Messages\Segments;
use \Immunable\Functions\Input as IFI;

abstract class PID {

  protected int $setId;
  protected Vector<PID_3> $patientId;
  protected int $patientIdCount = 0;

  public function __construct(?int $setId = null): void {
    if (is_null($setId)){
      $this->setId = 1;
    } else {
      $this->setId = $setId;
    }
    $this->patientId = Vector{};

  }

  public function addPatientId(
    string $idNumber,
    string $assigningAuthority,
    string $idType
  ): void {
    $this->patientId[] = new PID_3($idNumber);
    $this->patientId[$this->patientIdCount]->setIdType($idType);
    $this->patientId[$this->patientIdCount]->setAssigningAuthority($assigningAuthority);
    $this->patientIdCount++;
  }

  protected function getPID_3(): string {
    if ($this->patientIdCount > 0){
      $out = '';
      foreach ($this->patientId as $patientId){
        $out .= sprintf("%s~", $patientId->getHL7());
      }
      return rtrim($out, '~');
    } else {
      return '';
    }
  }

  public function getHL7(): string {
    $out  = sprintf('PID|');
    $out .= sprintf("%s|", $this->setId);
    $out .= sprintf("%s|", ''); // Unused
    $out .= sprintf("%s|", $this->getPID_3());
    $out .= sprintf("%s|", ''); // Unused
    
    return rtrim($out, '|');
  }

}
