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
    $this->url = 'https://www.flshots.com/staging/interop/InterOp.Service.HL7IISMethods.cls';
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
      '<urn:hl7Message><![CDATA[%s]]></urn:hl7Message>' .
      '</urn:%s>' .
      '</soap:Body>' .
      '</soap:Envelope>',
      $this->soapXmlns,
      $this->urnXmlns,
      $this->action,
      $this->username,
      $this->password,
      $this->facilityId,
      trim($data),
      $this->action
    );
  }

  public function getResponse(): string {
    if ($this->message !== NULL){
      return \HH\Asio\join($this->sendMessage());
    } else {
      return 'CANNOT SEND NULL MESSAGE!';
    }
  }

  protected async function sendMessage(): Awaitable<string> {
    $headers = Vector{};
    $headers[] = 'Accept-Encoding: gzip,deflate';
    $headers[] = 'Content-Type: application/soap+xml;charset=UTF-8;action="urn:cdc:iisb:2011:connectivityTestFL"';
    $headers[] = 'Connection: Keep-Alive';
    $headers[] = 'Content-Length: ' . strlen($this->message);
    $ch = curl_init($this->url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->message);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    return await \HH\Asio\curl_exec($ch);
  }

  public function printMessage(): string {
    if ($this->message !== NULL){
      return $this->message;
    } else {
      return 'CANNOT PRINT NULL MESSAGE!';
    }
  }

}
