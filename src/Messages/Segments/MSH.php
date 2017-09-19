<?hh // strict

// Abstract Message Header Segment
//   Defines intent, source, destination, and specifics of message
//   *Must be extended by more specific implimentation
// comment

namespace Immunable\Messages\Segments;

abstract class MSH {
  // Protected variables -- only changed by class methods or extending class
  // All variables MUST be set by method or extending class to ensure compliance
  // with the HL7 v2.5.1 standard
  protected string $encodingCharacters = '^~\&';
  protected string $sendingApplication = 'Immunable';
  protected string $sendingFacility = 'ediHQ';
  protected string $receivingApplication = '1.4.2-SNAPSHOT';
  protected string $receivingFacility = 'NIST Test Iz Reg';
  protected \DateTime $dateTime;
  protected string $security = '';
  protected string $messageType;
  protected string $messageControlId;
  protected string $processingId = 'P';
  protected string $versionId = "2.5.1";
  protected string $sequenceNumber = '';
  protected string $continuationPointer = '';
  protected string $acceptAcknowledgmentType = 'ER';
  protected string $applicationAcknowledgmentType = 'AL';
  protected string $countryCode = 'USA';
  protected string $characterSet = 'ASCII';
  protected string $principalLanguage = 'en^English^639-1^eng^English^639-2';
  protected string $alternateCharacterSetHandling = '';
  protected string $messageProfileId;

  // Concrete class must define contruct function that returns void
  // Constructor MUST set messageControlId string!
  //  > It was left abstracted so extending methods/implimentations can use it
  //  > in their own way but needs to remain immutable from outside the method.
  abstract public function __construct(): void;

  // Provide public function to get the messageControlId from class instance
  public function getControlId(): string {
    return sprintf(
      "%.20s",
      $this->messageControlId
    );
  }

  // Provide public function to set the messageControlId from class instance
  public function setControlId(string $controlId): void {
    $this->messageControlId = sprintf(
      "%.20s",
      $controlId
    );
  }

  public function setSendingApplication(
  string $namespaceId,
  ?string $universalId = null,
  ?string $universalIdType = null): void {
    $sendingApplication = sprintf(
      "%.227s^",
      $namespaceId
    );
    if ($universalId !== null){
      $sendingApplication .= sprintf(
        "%.226s^",
        $universalId
      );
    } else {
      $sendingApplication .= "^";
    }
    if ($universalIdType !== null){
      $sendingApplication .= sprintf(
        "%.225s^",
        $universalIdType
      );
    } else {
      $sendingApplication .= "^";
    }
    $this->sendingApplication = sprintf(
      "%.227s",
      rtrim($sendingApplication, '^')
    );
  }

  public function setSendingFacility(
  string $namespaceId,
  ?string $universalId = null,
  ?string $universalIdType = null): void {
    $sendingFacility = sprintf(
      "%.227s^",
      $namespaceId
    );
    if ($universalId !== null){
      $sendingFacility .= sprintf(
        "%.226s^",
        $universalId
      );
    } else {
      $sendingFacility .= "^";
    }
    if ($universalIdType !== null){
      $sendingFacility .= sprintf(
        "%.225s^",
        $universalIdType
      );
    } else {
      $sendingFacility .= "^";
    }
    $this->sendingFacility = sprintf(
      "%.227s",
      rtrim($sendingFacility, '^')
    );
  }

  public function setReceivingApplication(
  string $namespaceId,
  ?string $universalId = null,
  ?string $universalIdType = null): void {
    $receivingApplication = sprintf(
      "%.227s^",
      $namespaceId
    );
    if ($universalId !== null){
      $receivingApplication .= sprintf(
        "%.226s^",
        $universalId
      );
    } else {
      $receivingApplication .= "^";
    }
    if ($universalIdType !== null){
      $receivingApplication .= sprintf(
        "%.225s^",
        $universalIdType
      );
    } else {
      $receivingApplication .= "^";
    }
    $this->receivingApplication = sprintf(
      "%.227s",
      rtrim($receivingApplication, '^')
    );
  }

  public function setReceivingFacility(
  string $namespaceId,
  ?string $universalId = null,
  ?string $universalIdType = null): void {
    $receivingFacility = sprintf(
      "%.227s^",
      $namespaceId
    );
    if ($universalId !== null){
      $receivingFacility .= sprintf(
        "%.226s^",
        $universalId
      );
    } else {
      $receivingFacility .= "^";
    }
    if ($universalIdType !== null){
      $receivingFacility .= sprintf(
        "%.225s^",
        $universalIdType
      );
    } else {
      $receivingFacility .= "^";
    }
    $this->receivingFacility = sprintf(
      "%.227s",
      rtrim($receivingFacility, '^')
    );
  }

  // Define function to create MSH segment
  //  > Could change in future to add more values and checking
  public function generateSegment(): string {
    $segment = sprintf(
      "MSH|%.4s|%.227s|%.227s|%.227s|%.227s|%.26s|%.40s|%.15s|%.20s|%.3s|" .
      "%.60s|%.15s|%.180s|%.2s|%.2s|%.3s|%.16s|%.250s|%.20s|%.427s",
            $this->encodingCharacters,
            $this->sendingApplication,
            $this->sendingFacility,
            $this->receivingApplication,
            $this->receivingFacility,
            $this->dateTime->format('YmdHisO'),
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
    $segment = rtrim($segment, '|') . "\r";
    return $segment;
  }

  // Provide public function to get the MSH creation date/time (usually for tests)
  public function getDateTime(): string {
    return sprintf(
      "%.26s",
      $this->dateTime->format('YmdHisO')
    );
  }

}
