<?hh // strict

// PID-5 Patient name
//   The field contains the names for the patient

namespace Immunable\Messages\Segments;

class PID_5 {

  protected string $familyName;
  protected string $givenName;
  protected ?string $secondName;
  protected ?string $suffix;
  protected ?string $prefix;
  protected ?string $degree;
  protected string $nameTypeCode = 'L'; // Set as L for Legal Name as default
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

  public function setNameTypeCode(string $value): void {
    invariant(
      \Immunable\DataTables\NameType::isValid($value),
      'Value passed to setNameTypeCode is not valid (HL7 Table 0200)'
    );
  }

  public function getHL7(): string {
    $out = sprintf("test^");
    return rtrim($out, "^");
  }

}
