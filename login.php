<?php

session_start();

if (isset($_SESSION['logged']) && isset($_SESSION['PESEL'])) {
  header('Location: ./account.php');
  die();
}

?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Grobonet - Zaloguj</title>
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

        <script src="./js/login.js" type="module"></script>
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
            <form action="./php/login.php" method="post" autocomplete="off" class="form">
                <div class="input-group">
                    <input type="text" name="PESEL" id="PESEL" <?php
                    
                    if (isset($_SESSION['invalid']) && $_SESSION['invalid'] == 'all') {
                        echo "class=\"invalid\"";
                    }

                    ?> />
                    <label for="PESEL">PESEL</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" <?php
                    
                    if (isset($_SESSION['invalid'])) {
                        echo "class=\"invalid\"";
                    }

                    ?> />
                    <label for="password">Hasło</label>
                    <span class="input-highlight"></span>
                    <div class="visibility">
                        <div style="display: none" class="visible">
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
                                class="lucide lucide-eye"
                            >
                                <path
                                    d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"
                                />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </div>
                        <div class="invisible">
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
                                class="lucide lucide-eye-off"
                            >
                                <path
                                    d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"
                                />
                                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                                <path
                                    d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"
                                />
                                <path d="m2 2 20 20" />
                            </svg>
                        </div>
                    </div>
                </div>
                <button type="submit">Zaloguj</button>
            </form>
        </div>
    </body>
</html>
