<?hh // strict

// Message Header Segment
//   Defines intent, source, destination, and specifics of message

namespace Immunable\Message\VXU\V04\Segment;

class MSH {
  protected string $encodingCharacters = '^~\&';
  protected string $sendingApplication = 'Immunable';
  protected string $sendingFacility = 'ediHQ';
  public string $receivingApplication = '1.4.2-SNAPSHOT';
  public string $receivingFacility = 'NIST Test Iz Reg';
  protected \DateTime $dateTime;
  public string $security = '';
  protected string $messageType = 'VXU^V04^VXU_V04';
  public string $messageControlId;
  public string $processingId = "P";
  protected string $versionId = "2.5.1";
  public string $sequenceNumber = '';
  public string $continuationPointer = '';
  public string $acceptAcknowledgmentType = 'ER';
  public string $applicationAcknowledgmentType = 'AL';
  public string $countryCode = 'USA';
  protected string $characterSet = 'ASCII';
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
}
