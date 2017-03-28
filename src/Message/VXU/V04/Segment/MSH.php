<?hh // strict

// Message Header Segment
//   Defines intent, source, destination, and specifics of message

namespace Immunable\Message\VXU\V04\Segment;

class MSH {
  // Protected variables -- only changed by class or extending class
  protected string $encodingCharacters = '^~\&amp;';
  protected string $sendingApplication = 'Immunable';
  protected string $messageType = 'VXU^V04^VXU_V04';
  protected \DateTime $dateTime;
  protected string $versionId = "2.5.1";
  protected string $characterSet = 'ASCII';

  // Public variables -- must me set/changed with every MSH seg
  // Attempted to add defaults to allow CDC testing compliance -- but not promised
  public string $sendingFacility = 'ediHQ';
  public string $receivingApplication = '1.4.2-SNAPSHOT';
  public string $receivingFacility = 'NIST Test Iz Reg';
  public string $security = '';
  public string $messageControlId;
  public string $processingId = "P";
  public string $sequenceNumber = '';
  public string $continuationPointer = '';
  public string $acceptAcknowledgmentType = 'ER';
  public string $applicationAcknowledgmentType = 'AL';
  public string $countryCode = 'USA';
  public string $principalLanguage = 'en^English^639-1^eng^English^639-2';
  public string $alternateCharacterSetHandling = '';
  public string $messageProfileId = 'Z22^CDCPHINVS';

  public function __construct(): void {
    $this->dateTime = new \DateTime();
    $this->messageControlId = sprintf(
      "%s%06d",
      $this->dateTime->format('YmdHis'),
      mt_rand(1, 999999)
    );
  }

  public function generateSegment(): string {
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
}
