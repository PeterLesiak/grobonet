<?php

session_start();

if (!isset($_SESSION["logged"]) || !isset($_SESSION["PESEL"])) {
    header('Location: ./login.php');
    die("no chyba nie");
}

require_once __DIR__ . '/php/connection.php';

$PESEL = $_SESSION["PESEL"];

$stmt = $mysqli->prepare('SELECT * FROM Users WHERE PESEL = ?');
$stmt->bind_param('s', $PESEL);
$stmt->execute();

$result = $stmt->get_result()->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Grobonet - Konto</title>
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="./assets/favicon/apple-touch-icon.png"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="./assets/favicon/favicon-32x32.png"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="./assets/favicon/favicon-16x16.png"
        />
        <link rel="manifest" href="./assets/favicon/site.webmanifest" />

        <link href="./style.css" rel="stylesheet" />

        <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
        <script src="./js/account.js" type="module"></script>
    </head>
    <body>
        <nav class="navbar">
            <a href="./index.php" class="item">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-user-search"
                >
                    <circle cx="10" cy="7" r="4" />
                    <path d="M10.3 15H7a4 4 0 0 0-4 4v2" />
                    <circle cx="17" cy="17" r="3" />
                    <path d="m21 21-1.9-1.9" />
                </svg>
            </a>

            <a href="./login.php" class="item">GROBONET</a>

            <a href="./login.php" class="item"
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-user-plus"
                >
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <line x1="19" x2="19" y1="8" y2="14" />
                    <line x1="22" x2="16" y1="11" y2="11" />
                </svg>
            </a>
        </nav>

        <div class="container">
            <form class="form account-page">
                <div title="Kliknij aby zmienić obraz" class="account-image">
                    <img id="image-source" />
                </div>

                <div class="account-data">
                    <div class="input-group">
                        <input type="text" name="name" id="name" value="<?= $result['name'] ?>" />
                        <label for="name">Imię</label>
                        <span class="input-highlight"></span>
                    </div>
                    <div class="input-group">
                        <input type="text" name="surname" id="surname" value="<?= $result['surname'] ?>" />
                        <label for="surname">Nazwisko</label>
                        <span class="input-highlight"></span>
                    </div>

                    <div class="input-group">
                        <input type="date" name="dateOfBirth" id="dateOfBirth" value="<?= $result['dateOfBirth'] ?>" />
                        <label for="dateOfBirth">Data urodzenia</label>
                        <span class="input-highlight"></span>
                    </div>
                    <div class="input-group">
                        <input type="date" name="dateOfDeath" id="dateOfDeath" value="<?= $result['dateOfDeath'] ?>" />
                        <label for="dateOfDeath">Data śmierci</label>
                        <span class="input-highlight"></span>
                    </div>

                    <div class="input-group">
                    <select name="cemetery" id="cemetery">
                        <?php

                        require_once __DIR__ . '/php/connection.php';

                        $stmt = $mysqli->prepare('SELECT id, name FROM Cemeteries');
                        $stmt->execute();

                        $data = $stmt->get_result();
                        while ($row = $data->fetch_assoc()) {
                            $id = $row['id'];                          
                            $name = htmlspecialchars($row['name']);
                            $selected = $id == $result['cemetery'];

                            if ($selected) {
                              echo "<option value=\"$id\" selected>$name</option>";
                            } else {
                              echo "<option value=\"$id\">$name</option>";
                            }
                        }

                        ?>
                    </select>
                    <label for="cemetery">Cmentarz</label>
                    <span class="input-highlight"></span>
                    </div>
                    <div class="input-group">
                        <div id="recaptcha" class="g-recaptcha" data-sitekey="6LcglpkqAAAAAPeXsGe689VDrkBK0KB_hpCl-_y7" data-action="LOGIN"></div>
                    </div>

                    <button type="submit">Zaktualizuj</button>
                    <button type="button" class="random logout">Wyloguj</button>
                </div>
            </form>
        </div>
    </body>
</html>
