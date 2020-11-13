<?php

const FLAG = 'thc-flag-';

function match($pass) {

    // Une qui marche :
    // /^thcregexexex<-x<-->oe\/^t🍕2021£|€/

    $regexes = [
        'thc',
        '\d{4}',
        '^\/\^',
        '[🍕-🍺]',
        '£.€.$',
        '^(...).+\1',
        '(?=[lo][ve])[co][de]',
        '(?1)(reg|ex|are|hard)(?=\1)..(?<=r.{6})\1',
        '(?<=[help])(x(?(?=-..-)(-->)|(<-)))(?(2)\2|\1)->o',
        '^.{36}$',
        'self'
    ];

    foreach ($regexes as $i => $regex) {

        if ($regex === 'self') {
            if (preg_match($pass . 'u', null) === false) {
                echo '<p class="error">Erreur ! Le mot de passe doit être une regex valide.</p>';
                echo '<p><progress></progress></p>';
                return;
            }
            if (! preg_match($pass . 'u', $pass)) {
                echo '<p class="error">Erreur ! Le mot de passe doit vérifier la regex<br><code>' . htmlentities($pass) . '</code>.</p>';
                echo '<p><progress></progress></p>';
                return;
            }
        } elseif (! preg_match('/' . $regex . '/u', $pass)) {
            echo '<p class="error">Erreur ! Le mot de passe doit vérifier la regex<br><code>/' . htmlentities($regex) . '/</code>.</p>';
            echo '<p><progress value="' . $i . '" max="' . count($regexes) . '"></progress></p>';
            return;
        }

    }

    echo '<p class="success">Vous êtes connecté ! Le flag est ' . FLAG . '</p>';
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: inherit;
        }

        html {
            box-sizing: border-box;
        }

        body {
            background-color: rgb(77, 79, 153);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        main {
            padding: 0 1em;
            max-width: 400px;
            background-color: #fff;
            border: 1px solid rgb(179, 179, 179);
            box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.171);
            overflow: hidden;
        }

        h1 {
            font-size: 2.5em;
            line-height: 1;
        }

        h1 img {
            height: 1.25em;
            width: auto;
            vertical-align: bottom;
        }

        input, progress {
            width: 400px;
            max-width: 100%;
        }

        input {
            padding: .5em;
        }

        button {
            padding: .25em .5em;
        }

        code {
            font-family: Consolas, 'Courier New', Courier, monospace;
            color: rgb(18, 0, 85);
        }

        .center {
            text-align: center;
        }

        .error {
            padding: .5em;
            border: 1px solid rgb(255, 171, 171);
            background-color: rgb(255, 232, 232);
        }

        .success {
            padding: .5em;
            border: 1px solid rgb(171, 255, 178);
            background-color: rgb(232, 255, 233);
        }
    </style>
</head>

<body>
    <main>
        <h1><img src="https://thcon.party/assets/png/thcon_logo.png" alt="Logo"> Connexion</h1>
        <p><label for="password">Mot de passe administrateur&nbsp;:</label></p>
        <form method="POST" action="?">
            <p><input type="password" name="password" id="password"></p>
            <p class="center"><button type="submit">Se connecter</button></p>
        </form>
        <?php if (isset($_POST['password'])) {match($_POST['password']);} ?>
        <!-- Toutes les regex sont compilées avec le flag u (unicode), et seulement celui-là -->
    </main>
</body>

</html>
