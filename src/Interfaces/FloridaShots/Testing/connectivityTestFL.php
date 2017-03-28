<?hh // strict

namespace Immunable\Interfaces\FloridaShots\Testing;

class connectivityTestFL extends \Immunable\Interfaces\FloridaShots\SOAP {

  public function __construct(string $username, string $password, ?string $facilityId): void {
    $this->username = $username;
    $this->password = $password;
    $this->url = 'https://www.flshots.com/staging/interop/InterOp.Service.HL7IISMethods.cls';
    $this->action = 'connectivityTestFL';
  }

  public function generateMessage(string $data): void {
    $this->message = sprintf(
      '<soap:Envelope xmlns:soap="%s" xmlns:urn="%s">' .
      '<soap:Header/>' .
      '<soap:Body>' .
      '<urn:%s>' .
      '<urn:echoBack>%s</urn:echoBack>' .
      '<urn:username>%s</urn:username>' .
      '<urn:password>%s</urn:password>' .
      '</urn:%s>' .
      '</soap:Body>' .
      '</soap:Envelope>',
      $this->soapXmlns,
      $this->urnXmlns,
      $this->action,
      htmlspecialchars(trim($data)),
      $this->username,
      $this->password,
      $this->action
    );
  }
  
}
