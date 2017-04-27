<?hh // strict

// PID-3 Patient Identifier List
//   The field contains the list of identifiers (one or more) used by the
//   healthcare facility to uniquely identify a patient

namespace Immunable\Messages\Segments;

class PID_3 {

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
    $assigningAuthority  = sprintf("%.20s", $namespaceId);
    $assigningAuthority .= sprintf("&");
    if (!is_null($universalId)){
      $assigningAuthority .= sprintf("%.199s", $universalId);
    }
    $assigningAuthority .= sprintf("&");
    if (!is_null($universalIdType)){
      $assigningAuthority .= sprintf("%.6s", $universalIdType);
    }
    $assigningAuthority .= sprintf("&");
    $this->assigningAuthority = rtrim($assigningAuthority, "&");
  }

  public function getHL7(): string {
    $out  = sprintf("%.15s^", $this->idNumber);
    $out .= sprintf("%.1s^", $this->checkDigit);
    $out .= sprintf("%.3s^", $this->checkDigitScheme);
    $out .= sprintf("%.227s^", $this->assigningAuthority);
    $out .= sprintf("%.5s^", $this->idTypeCode);
    $out .= sprintf("%.227s^", $this->assigningFacility);
    $out .= sprintf("%.8s^", $this->effectiveDate);
    $out .= sprintf("%.8s^", $this->expirationDate);
    $out .= sprintf("%.705s^", $this->assigningJurisdiction);
    $out .= sprintf("%.705s^", $this->assigningAgency);
    return rtrim($out, "^");
  }

}
