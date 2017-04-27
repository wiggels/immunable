<?hh // strict

// PID-6 Mother's Maiden Name
//   Family name under which mother was born (i.e. before marriage)

namespace Immunable\Messages\Segments;

class PID_6 {

  protected string $familyName;
  protected string $givenName;
  protected ?string $secondName;
  protected ?string $suffix;
  protected ?string $prefix;
  protected ?string $degree;
  protected string $nameTypeCode = 'M'; // Set as L for Legal Name as default
  protected string $nameRepresentationCode = 'A'; // Set as A as default
  protected ?string $nameContext;
  protected ?string $nameValidityRange;
  protected ?string $nameAssemblyOrder;
  protected ?string $effectiveDate;
  protected ?string $expirationDate;
  protected ?string $professionalSuffix;

  public function __construct(
    string $familyName,
    string $givenName,
    ?string $secondName = null,
    ?string $suffix = null,
    ?string $prefix = null
  ): void {
    $this->familyName = $familyName;
    $this->givenName = $givenName;
    $this->secondName = $secondName;
    $this->suffix = $suffix;
    $this->prefix = $prefix;
  }

  public function getHL7(): string {
    $out  = sprintf("%.194s^", $this->familyName);
    $out .= sprintf("%.30s^", $this->givenName);
    $out .= sprintf("%.30s^", $this->secondName);
    $out .= sprintf("%.20s^", $this->suffix);
    $out .= sprintf("%.20s^", $this->prefix);
    $out .= sprintf("%.6s^", $this->degree);
    $out .= sprintf("%.1s^", $this->nameTypeCode);
    $out .= sprintf("%.1s^", $this->nameRepresentationCode);
    $out .= sprintf("%.483s^", $this->nameContext);
    $out .= sprintf("%.53s^", $this->nameValidityRange);
    $out .= sprintf("%.1s^", $this->nameAssemblyOrder);
    $out .= sprintf("%.26s^", $this->effectiveDate);
    $out .= sprintf("%.26s^", $this->expirationDate);
    $out .= sprintf("%.199s^", $this->professionalSuffix);
    return rtrim($out, "^");
  }

}
