<?hh // strict

type floridaShotsSettings = shape(
  'soap' => shape(
    'username' => string,
    'password' => string
  ),
  'location' => shape(
    'name' => string,
    'id' => string,
    'secondaryId' => string
  )
);
