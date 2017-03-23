<?hh // strict

namespace Immunable\Interfaces\FloridaShots;

abstract class SOAP {

  protected string $url;
  protected string $username;
  protected string $password;
  protected string $action;
  protected string $soapXmlns = 'http://www.w3.org/2003/05/soap-envelope';
  protected string $urnXmlns = 'urn:cdc:iisb:2011';
  protected ?string $message = NULL;
  protected ?string $facilityId = NULL;

  abstract public function __construct(string $username, string $password, ?string $facilityId);

  abstract public function generateMessage(string $data): void;

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

}
