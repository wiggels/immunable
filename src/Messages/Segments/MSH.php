<?hh // strict

// Abstract Message Header Segment
//   Defines intent, source, destination, and specifics of message
//   *Must be extended by more specific implimentation

namespace Immunable\Messages\Segments;

abstract class MSH {
  // Protected variables -- only changed by class or extending class
  protected string $encodingCharacters = '^~\&';
  protected string $sendingApplication = 'Immunable';
  protected string $messageControlId;
  protected string $messageType;
  protected \DateTime $dateTime;
  protected string $versionId = "2.5.1";
  protected string $characterSet = 'ASCII';
  protected string $messageProfileId;

  // Public variables -- must be set/changed with every MSH seg
  public string $sendingFacility = 'ediHQ';
  public string $receivingApplication = '1.4.2-SNAPSHOT';
  public string $receivingFacility = 'NIST Test Iz Reg';
  public string $security = '';
  public string $processingId = 'P';
  public string $sequenceNumber = '';
  public string $continuationPointer = '';
  public string $acceptAcknowledgmentType = 'ER';
  public string $applicationAcknowledgmentType = 'AL';
  public string $countryCode = 'USA';
  public string $principalLanguage = 'en^English^639-1^eng^English^639-2';
  public string $alternateCharacterSetHandling = '';
  public string $sendingResponsibleOrganization = '';
  public string $receivingResponsibleOrganization = '';
  public string $sendingNetworkAddress = '';
  public string $receivingNetworkAddress = '';

  // Concrete class must define contruct function that returns void
  // Constructor MUST set messageControlId string!
  //  > It was left abstracted so extending methods/implimentations can use it
  //  > in their own way but needs to remain immutable from outside the method.
  abstract public function __construct(): void;

  // Provide public function to get the messageControlId from class instance
  public function getControlId(): string {
    return $this->messageControlId;
  }

  // Provide public function to set the messageControlId from class instance
  public function setControlId(string $controlId): void {
    $this->messageControlId = sprintf(
      "%.20s",
      $controlId
    );
  }

  // Define function to create MSH segment
  //  > Could change in future to add more values and checking
  public function generateSegment(): string {
    $segment = sprintf(
      "MSH|%s|%s|%s|%s|%s|%s|%s|%s|%.20s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s",
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
            $this->messageProfileId,
            $this->sendingResponsibleOrganization,
            $this->receivingResponsibleOrganization,
            $this->sendingNetworkAddress,
            $this->receivingNetworkAddress
    );
    $segment = rtrim($segment, '|') . "\r";
    return $segment;
  }
}
