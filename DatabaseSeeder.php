<?php
$servername = "localhost";
$username = "parp";
$password = "b@2@PARP";
$dbName = "parp";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully\n";

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
} else {
    printf("Current character set: %s\n", $conn->character_set_name());
}

echo "Seeding sfz_rola table" . "\n";
$roleQueries = array(
  'INSERT INTO sfz_rola VALUES (DEFAULT, "ROLE_KOORDYNATOR_TECHNICZNY", "Administrator techniczny")',
  'INSERT INTO sfz_rola VALUES (DEFAULT, "ROLE_KOORDYNATOR_MERYTORYCZNY", "Administrator merytoryczny")',
  'INSERT INTO sfz_rola VALUES (DEFAULT, "ROLE_PRACOWNIK_PARP", "Pracownik PARP")',
  'INSERT INTO sfz_rola VALUES (DEFAULT, "ROLE_BENEFICJENT", "Beneficjent")'
);
foreach ($roleQueries as $query) {
  if ($conn->query($query) === TRUE) {
      echo "New record created successfully\n";
  } else {
      echo "Error: " . $query . " " . $conn->error . "\n";
  }
}

echo "Seeding sfz_okresy_konfiguracja table" . "\n";
$okresyKonfiguracjaQueries = array(
  'INSERT INTO sfz_okresy_konfiguracja VALUES (DEFAULT, "2016", 0, 0)',
  'INSERT INTO sfz_okresy_konfiguracja VALUES (DEFAULT, "2017", 0, 0)',
  'INSERT INTO sfz_okresy_konfiguracja VALUES (DEFAULT, "2018", 0, 0)',
  'INSERT INTO sfz_okresy_konfiguracja VALUES (DEFAULT, "2019", 0, 0)'
);
foreach ($okresyKonfiguracjaQueries as $query) {
  if ($conn->query($query) === TRUE) {
      echo "New record created successfully\n";
  } else {
      echo "Error: " . $query . " " . $conn->error . "\n";
  }
}

echo "Seeding sfz_wojewodztwo table" . "\n";
$wojewodztwaQueries = array(
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "DOLNOŚLĄSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "KUJAWSKO-POMORSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "LUBELSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "LUBUSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "ŁÓDZKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "MAŁOPOLSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "MAZOWIECKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "OPOLSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "PODKARPACKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "PODLASKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "POMORSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "ŚLĄSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "ŚWIĘTOKRZYSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "WARMIŃSKO-MAZURSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "WIELKOPOLSKIE")',
  'INSERT INTO sfz_wojewodztwo VALUES (DEFAULT, "ZACHODNIOPOMORSKIE")'
);
foreach ($wojewodztwaQueries as $query) {
  if ($conn->query($query) === TRUE) {
      echo "New record created successfully\n";
  } else {
      echo "Error: " . $query . " " . $conn->error . "\n";
  }
}

echo "Seeding sfz_beneficjent_forma_prawna table" . "\n";
$beneficjentFormaPrawnaQueries = array(
  'INSERT INTO sfz_beneficjent_forma_prawna VALUES (DEFAULT, "Spółka z o.o.")',
  'INSERT INTO sfz_beneficjent_forma_prawna VALUES (DEFAULT, "Spółka akcyjna")',
  'INSERT INTO sfz_beneficjent_forma_prawna VALUES (DEFAULT, "Spółka komandytowa / SKA")',
  'INSERT INTO sfz_beneficjent_forma_prawna VALUES (DEFAULT, "Inna forma prawna")',
  'INSERT INTO sfz_beneficjent_forma_prawna VALUES (DEFAULT, "Spółka w likwidacji / zlikwidowana")'
);
foreach ($beneficjentFormaPrawnaQueries as $query) {
  if ($conn->query($query) === TRUE) {
      echo "New record created successfully\n";
  } else {
      echo "Error: " . $query . " " . $conn->error . "\n";
  }
}

echo "Seeding sfz_gospodarka_dzial table" . "\n";
$gospodarkaDzialQueries = array(
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "ICT (Hardware)")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "ICT (Software)")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "ICT (Big Data)")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "ICT (Smart Technologies")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Medycyna")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Chemia")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Biotechnologia")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Energetyka")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Lotnictwo / Przemysł Kosmiczny")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Automotive")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Przemysł")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Ochrona środowiska")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Fintech")',
  'INSERT INTO sfz_gospodarka_dzial VALUES (DEFAULT, "Inne")'
);
foreach ($gospodarkaDzialQueries as $query) {
  if ($conn->query($query) === TRUE) {
      echo "New record created successfully\n";
  } else {
      echo "Error: " . $query . " " . $conn->error . "\n";
  }
}

echo "Seeding sfz_uzytkownik table" . "\n";
$koordynatorTechnicznyRoleId = $conn->query('SELECT id FROM sfz_rola WHERE nazwa like "ROLE_KOORDYNATOR_TECHNICZNY"')->fetch_assoc()['id'];
//Values (ID, ROLA_ID, BENEFICJENT_ID, LOGIN, HASLO, EMAIL, KOD_ZAPOMNIANE_HASLO, UTWORZONY, ZMODYFIKOWANY, BAN, STATUS, KOD_AKTYWACJA_KONTA)
$adminQuery = 'INSERT INTO sfz_uzytkownik VALUES (DEFAULT, ' . $koordynatorTechnicznyRoleId . ', null, "admin", "' . password_hash("domyslne_haslo", PASSWORD_BCRYPT) . '", "email@example.com", null, now(), now(), 0, 1, null)';
if ($conn->query($adminQuery) === TRUE) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $adminQuery . " " . $conn->error . "\n";
}
$conn->close();

?>
