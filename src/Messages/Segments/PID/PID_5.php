<?hh // strict

// PID-5 Patient name
//   The field contains the names for the patient

namespace Immunable\Messages\Segments;
use \Immunable\Functions\Input as IFI;

class PID_5 {

  protected string $idNumber;
  protected ?string $checkDigit;
  protected ?string $checkDigitScheme;
  protected ?string $assigningAuthority;
  protected ?string $idTypeCode;
  protected ?string $assigningFacility;
  protected ?string $effectiveDate;
  protected ?string $expirationDate;
  protected ?string $assigningJurisdiction;
  protected ?string $assigningAgency;

  public function __construct(string $idNumber): void {
    $this->idNumber = $idNumber;
  }

  public function setIdType(string $idTypeCode): void {
    $this->idTypeCode = $idTypeCode;
  }

  public function setAssigningAuthority(
    string $namespaceId,
    ?string $universalId = null,
    ?string $universalIdType = null
  ): void {
    $assigningAuthority  = sprintf("%s", $namespaceId);
    $assigningAuthority .= sprintf("&");
    if (!is_null($universalId)){
      $assigningAuthority .= sprintf("%s", $universalId);
    }
    $assigningAuthority .= sprintf("&");
    if (!is_null($universalIdType)){
      $assigningAuthority .= sprintf("%s", $universalIdType);
    }
    $assigningAuthority .= sprintf("&");
    $this->assigningAuthority = rtrim($assigningAuthority, "&");
  }

  public function getHL7(): string {
    $out  = sprintf("%s", $this->idNumber);
    $out .= sprintf("^");
    if (!is_null($this->checkDigit)){
      $out .= sprintf("%s", $this->checkDigit);
    }
    $out .= sprintf("^");
    if (!is_null($this->checkDigitScheme)){
      $out .= sprintf("%s", $this->checkDigitScheme);
    }
    $out .= sprintf("^");
    if (!is_null($this->assigningAuthority)){
      $out .= sprintf("%s", $this->assigningAuthority);
    }
    $out .= sprintf("^");
    if (!is_null($this->idTypeCode)){
      $out .= sprintf("%s", $this->idTypeCode);
    }
    $out .= sprintf("^");
    if (!is_null($this->assigningFacility)){
      $out .= sprintf("%s", $this->assigningFacility);
    }
    $out .= sprintf("^");
    if (!is_null($this->effectiveDate)){
      $out .= sprintf("%s", $this->effectiveDate);
    }
    $out .= sprintf("^");
    if (!is_null($this->expirationDate)){
      $out .= sprintf("%s", $this->expirationDate);
    }
    $out .= sprintf("^");
    if (!is_null($this->assigningJurisdiction)){
      $out .= sprintf("%s", $this->assigningJurisdiction);
    }
    $out .= sprintf("^");
    if (!is_null($this->assigningAgency)){
      $out .= sprintf("%s", $this->assigningAgency);
    }
    $out .= sprintf("^");
    return rtrim($out, "^");
  }

}
