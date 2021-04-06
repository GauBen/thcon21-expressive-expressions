<?php

function login($pass) {

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

    echo '<p class="success">Vous êtes connecté ! Le flag est ' . file_get_contents('./flag.txt') . '</p>';
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

        h1 svg {
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
        <h1><svg width="213.721" height="269.299" viewBox="0 0 56.547 71.252" xmlns="http://www.w3.org/2000/svg"><defs><clipPath id="a"><path d="M0 224.706h350.588V0H0z"/></clipPath></defs><path d="M25.17 21.22h-2.612V15h2.612zM34.86 21.22h-2.612V15h2.612zM56.55 53.99l-4.58-4.68-1.226 1.227 5.806 5.933zM50.7 10.18h-1.797v31.911l1.797-1.797zM54.24 47.04l-1.47 1.47 3.78 3.862v-2.97zM45.82 10.18v34.999l1.956-1.957V10.18z" fill="#e52622"/><g clip-path="url(#a)" transform="matrix(.35278 0 0 -.35278 -5.563 76.45)"><path d="M157.33 71.189l-2.543-2.543-14.569 14.569 2.221 2.22v102.41h-17.675v-54.499H67.057v60.915l-51.291 22.456v-27.606l33.168-22.897v-7.53a4.307 4.307 0 002.7-5.343 4.315 4.315 0 10-8.241 2.564 4.288 4.288 0 002.335 2.628v5.996l-29.962 20.687v-8.501l22.223-15.342v-7.528l.011-.002a4.316 4.316 0 10-5.402-2.839 4.294 4.294 0 002.185 2.568v6.117l-19.017 13.13V14.739h51.291v67.313h57.707V14.739h51.291v37.307zM171.78 85.632l4.282-4.377v8.659z" fill="#e52622"/><path d="M162.7 104.91l13.36-13.36v96.295H162.7z" fill="#e52622"/></g></svg> Connexion</h1>
        <p><label for="password">Mot de passe administrateur&nbsp;:</label></p>
        <form method="POST" action="?">
            <p><input type="password" name="password" id="password"></p>
            <p class="center"><button type="submit">Se connecter</button></p>
        </form>
        <?php if (isset($_POST['password'])) {login($_POST['password']);} ?>

        <!-- Toutes les regex sont compilées avec le flag u (unicode), et seulement celui-là -->
    </main>
</body>

</html>
