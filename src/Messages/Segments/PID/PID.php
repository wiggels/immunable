<?hh // strict

// Patient Identification Segment
//   Primary means of communicating patient identification information

namespace Immunable\Messages\Segments;
use \Immunable\Functions\Input as IFI;

abstract class PID {

  protected int $setId;
  protected Vector<PID_3> $patientId;
  protected int $patientIdCount = 0;
  protected Vector<PID_5> $patientName;
  protected int $patientNameCount = 0;
  protected ?PID_6 $mothersMaidenName;

  public function __construct(?int $setId = null): void {
    if (is_null($setId)){
      $this->setId = 1;
    } else {
      $this->setId = $setId;
    }
    $this->patientId = Vector{};
    $this->patientName = Vector{};

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

  public function addPatientName(
    string $familyName,
    string $givenName,
    ?string $secondName = null,
    ?string $suffix = null,
    ?string $prefix = null,
    ?string $nameType = null
  ): void {
    $this->patientName[] = new PID_5($familyName, $givenName, $secondName, $suffix, $prefix);
    if (!is_null($nameType)){
      $this->patientName[$this->patientNameCount]->setNameTypeCode($nameType);
    }
    $this->patientNameCount++;
  }

  public function setMothersMaidenName(
    string $familyName,
    string $givenName,
    ?string $secondName = null,
    ?string $suffix = null,
    ?string $prefix = null
  ): void {
    $this->mothersMaidenName = new PID_6($familyName, $givenName, $secondName, $suffix, $prefix);
  }

  protected function getPID_3(): string {
      $out = '';
      foreach ($this->patientId as $patientId){
        $out .= sprintf("%s~", $patientId->getHL7());
      }
      return rtrim($out, '~');
  }

  protected function getPID_5(): string {
      $out = '';
      foreach ($this->patientName as $patientName){
        $out .= sprintf("%s~", $patientName->getHL7());
      }
      return rtrim($out, '~');
  }

  protected function getPID_6(): ?string {
    return $this->mothersMaidenName?->getHL7();
  }

  public function getHL7(): string {
    $out  = sprintf('PID|');

    // Set ID - PID
    // SEQ_1 LEN_4  DT_SI OPT_O RP_ TBL_ ITEM_00104
    $out .= sprintf("%.4s|", $this->setId);

    // Patient ID
    // SEQ_2 LEN_20 DT_CX OPT_B RP_ TBL_ ITEM_00105
    // Unused - retained for backwards compatibility only
    $out .= sprintf("%.20s|", '');

    // Patient Identifier List
    // SEQ_3 LEN_250 DT_CX OPT_R RP_Y TBL_ ITEM_00106
    $out .= sprintf("%.250s|", $this->getPID_3());

    // Alternate Patient ID - PID
    // SEQ_4 LEN_20 DT_CX OPT_B RP_Y TBL_ ITEM_00107
    // Unused - retained since v2.3.1 for backwards compatibility only
    $out .= sprintf("%.20s|", '');

    // Patient Name
    // SEQ_5 LEN_250 DT_XPN OPT_R RP_Y TBL_ ITEM_00108
    $out .= sprintf("%.250s|", $this->getPID_5());

    // Mother's Maiden Name
    // SEQ_6 LEN_250 DT_XPN OPT_O RP_Y TBL_ ITEM_00109
    $out .= sprintf("%.250s|", $this->getPID_6());

    // Date/Time of Birth
    // SEQ_7 LEN_26 DT_TS OPT_O RP_ TBL_ ITEM_00110
    $out .= sprintf("%.26s|", '');

    // Administrative Sex
    // SEQ_8 LEN_1 DT_IS OPT_O RP_ TBL_0001 ITEM_00111
    $out .= sprintf("%.1s|", '');

    // Patient Alias
    // SEQ_9 LEN_250 DT_XPN OPT_B RP_Y TBL_ ITEM_00112
    // Unused - retained since v2.4 for backwards compatibility only
    $out .= sprintf("%.250s|", '');

    // Race
    // SEQ_10 LEN_250 DT_CE OPT_O RP_Y TBL_0005 ITEM_00113
    $out .= sprintf("%.250s|", '');

    // Patient Address
    // SEQ_11 LEN_250 DT_XAD OPT_O RP_Y TBL_ ITEM_00114
    $out .= sprintf("%.250s|", '');

    // Country Code
    // SEQ_12 LEN_4 DT_IS OPT_B RP_ TBL_0289 ITEM_00115
    // Unused - retained since v2.3 for backwards compatibility only
    $out .= sprintf("%.4s|", '');

    // Phone Number - Home
    // SEQ_13 LEN_250 DT_XTN OPT_O RP_Y TBL_ ITEM_00116
    $out .= sprintf("%.250s|", '');

    // Phone Number - Business
    // SEQ_14 LEN_250 DT_XPN OPT_O RP_Y TBL_ ITEM_00117
    $out .= sprintf("%.250s|", '');

    // Primary Language
    // SEQ_15 LEN_250 DT_CE OPT_O RP_ TBL_0296 ITEM_00118
    $out .= sprintf("%.250s|", '');

    return rtrim($out, '|');
  }

}
