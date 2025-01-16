<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Grobonet - Wyszukaj</title>
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

        <script type="importmap">
            {
                "imports": {
                    "three": "https:cdn.jsdelivr.net/npm/three@0.171.0/build/three.module.js",
                    "three/examples/jsm/": "https:cdn.jsdelivr.net/npm/three@0.171.0/examples/jsm/",
                    "animejs": "https:cdn.jsdelivr.net/npm/animejs@3.2.2/lib/anime.es.js"
                }
            }
        </script>
        <script src="./js/search.js" type="module"></script>
    </head>
    <body>
        <canvas id="canvas"></canvas>

        <nav class="navbar">
            <a href="./index.php" class="item">
                <svg
                    xmlns="http:www.w3.org/2000/svg"
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

            <a href="./index.php" class="item">GROBONET</a>

            <a href="./login.php" class="item"
                ><svg
                    xmlns="http:www.w3.org/2000/svg"
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
            <form autocomplete="off" class="form">
                <div class="input-group">
                    <input type="text" name="name" id="name" />
                    <label for="name">Imię</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-group">
                    <input type="text" name="surname" id="surname" />
                    <label for="surname">Nazwisko</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-group">
                    <select name="cemetery" id="cemetery">
                        <option value="0">Dowolny</option>
                        <?php

                        require_once __DIR__ . '/php/connection.php';

                        $stmt = $mysqli->prepare('SELECT id, name FROM Cemeteries');
                        $stmt->execute();

                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $name = htmlspecialchars($row['name']);

                            echo "<option value=\"$id\">$name</option>";
                        }

                        ?>
                    </select>
                    <label for="cemetery">Cmentarz</label>
                    <span class="input-highlight"></span>
                </div>
                <button type="submit">Wyszukaj</button>
                <button type="button" class="random">Losowanie</button>
            </form>
        </div>
        <div class="no-records hidden">
            <h1 class="message">Zmarły nie znaleziony!</h1>
            <a href="./index.php" class="go-back">
                <svg
                    xmlns="http:www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-undo-2"
                >
                    <path d="M9 14 4 9l5-5" />
                    <path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11" />
                </svg>
            </a>
        </div>

        <div class="record-display hidden">
            <h1 class="name"></h1>
            <h2 class="date"></h2>
            <h2 class="location"></h2>
        </div>

        <div class="record-controls hidden">
            <div class="previous control">
                <svg
                    xmlns="http:www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-chevron-left"
                >
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </div>

            <div class="next control">
                <svg
                    xmlns="http:www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-chevron-right"
                >
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </div>
        </div>
    </body>
</html>
