<?hh // strict

namespace Immunable\Interfaces\FloridaShots\Testing;

class submitSingleMessage extends \Immunable\Interfaces\FloridaShots\SOAP {

  public function __construct(string $username, string $password, ?string $facilityId): void {
    $this->username = $username;
    $this->password = $password;
    if ($facilityId === NULL){
      $this->facilityId = '';
    } else {
      $this->facilityId = $facilityId;
    }
    $this->url = 'http://www.flshots.com/staging/interop/InterOp.Service.HL7IISMethods.cls';
    $this->action = 'submitSingleMessage';
  }

  public function generateMessage(string $data): void {
    $this->message = sprintf(
      '<soap:Envelope xmlns:soap="%s" xmlns:urn="%s">' .
      '<soap:Header/>' .
      '<soap:Body>' .
      '<urn:%s>' .
      '<urn:username>%s</urn:username>' .
      '<urn:password>%s</urn:password>' .
      '<urn:facilityID>%s</urn:facilityID>' .
      '<urn:hl7Message>%s</urn:hl7Message>' .
      '</urn:%s>' .
      '</soap:Body>' .
      '</soap:Envelope>',
      $this->soapXmlns,
      $this->urnXmlns,
      $this->action,
      $this->username,
      $this->password,
      $this->facilityId,
      $data,
      $this->action
    );
  }
  
}
