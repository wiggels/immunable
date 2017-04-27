<?hh // strict

namespace Immunable\DataTables;

class NameType {

  private static ImmMap<string,string> $nameTypeTable = ImmMap {
    'A' => 'Alias Name',
    'B' => 'Name at Birth',
    'C' => 'Adopted Name',
    'D' => 'Display Name',
    'I' => 'Licensing Name',
    'L' => 'Legal Name',
    'M' => 'Maiden Name',
    'N' => 'Nickname/Call Me/Street Name',
    'P' => 'Name of Partner/Spouse (Depreciated)', // Depreciated
    'R' => 'Registered Name (Animals Only)',
    'S' => 'Coded Pseudo-Name (for Anonymity)',
    'T' => 'Indigenous/Tribal/Community Name',
    'U' => 'Unspecified'
  };

  public static function isValid(string $value): bool {
    return self::$nameTypeTable->containsKey($value);
  }

}
