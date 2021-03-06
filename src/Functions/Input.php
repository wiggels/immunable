<?hh // strict

namespace Immunable\Functions;

class Input {

  public static function stripHL7Char(string $input): string {
    $hl7Characters = Vector {'|', '^', '~', '\\', '&'};
    return str_replace($hl7Characters, '', $input);
  }

}
