<?hh // strict

// Patient Identification Segment
//   Primary means of communicating patient identification information

namespace Immunable\Message\VXU\V04\Segment;

class PID {
  protected int $setId;
  public string $patientId = '';
  public string $patientIdentifierList = '1234567890^^^Test Office^MR';
  public string $alternatePatientId = '';
  public string $patientName = 'Snow^Madelynn^Ainsley^^^^L';
  public string $mothersMaidenName = 'Lam^Morgan^^^^^M';
  public string $birthDateTime = '20070706';
  public string $administrativeSex = 'F';
  public string $patientAlias = '';


  public function __construct(int $count): void {
    $this->setId = $count;
  }
/**
  public function return(): string {
    return sprintf(
      "MSH|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s\r",
            $this->encodingCharacters,
            $this->sendingApplication,
            $this->sendingFacility,
            $this->receivingApplication,
            $this->receivingFacility,
            $this->dateTime->format('YmdHis-0500'),
            $this->security,
            $this->messageType,
            $this->messageControlId,
            $this->processingId,
            $this->versionId,
            $this->sequenceNumber,
            $this->continuationPointer,
            $this->acceptAcknowledgmentType,
            $this->applicationAcknowledgmentType,
            $this->countryCode,
            $this->characterSet,
            $this->principalLanguage,
            $this->alternateCharacterSetHandling,
            $this->messageProfileId
    );
  }
  **/
}
