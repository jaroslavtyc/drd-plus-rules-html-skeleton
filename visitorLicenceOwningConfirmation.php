<?php
if (!empty($_POST['buy'])) {
    header('Location: http://obchod.altar.cz', true, 302);
    exit;
}
if (!empty($_POST['confirm'])) {
    $usagePolicy->confirmOwnershipOfVisitor();

    return true;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Drd+ <?= basename($documentRoot) ?></title>
    <!--suppress HtmlUnknownTarget -->
    <link rel="shortcut icon" href="favicon.ico">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/generic/graphics.css">
    <style type="text/css">
        body {
            font-size: 20px;
            font-family: "Times New Roman", Times, serif;
        }

        input[type=submit] {
            font-size: inherit;
        }

        .vertical-centered-wrapper {
            position: absolute;
            width: 98%;
            height: 98%;
            display: table;
        }

        .vertical-centered {
            display: table-cell;
            vertical-align: middle;
        }

        .horizontal-centered-wrapper {
            text-align: center;
        }

        .horizontal-centered {
            display: inline-block;
            text-align: left;
        }

        .content {
            padding: 1em;
        }

        h1 {
            font-style: italic;
        }

        .manifest a {
            color: black;
        }

        input[type=submit], label {
            cursor: pointer;
        }

        label:hover {
            text-shadow: 1px 1px 3px #424242;
        }

        label:hover input[type=submit] {
            text-shadow: 1px 1px 3px #424242;
        }

        .upper-index {
            position: relative;
            top: -0.5em;
            font-size: 80%;
        }

        .footer {
            font-size: 15px;
            margin-top: 2em;
            font-style: italic;
        }
    </style
</head>
<body>
<div class="vertical-centered-wrapper">
    <div class="vertical-centered">
        <div class="horizontal-centered-wrapper">
            <div class="horizontal-centered">
                <div class="content">
                    <div>
                        <h1>Prohlášení</h1>
                        <?php if (is_readable($documentRoot . '/name.txt')) {
                            $name = file_get_contents($documentRoot . '/name.txt');
                        } else {
                            $name = basename($documentRoot);
                        }
                        $eShop = 'http://obchod.altar.cz';
                        if (is_readable($documentRoot . '/eshop.txt')) {
                            $eShop = file_get_contents($documentRoot . '/eshop.txt');
                        }
                        ?>
                        <form class="manifest" action="<?= $eShop ?>" method="get">
                            <p>
                                <label>
                                    <input type="submit" name="buy" value="Koupím <?= $name ?>">
                                    Zatím nemám <strong><?= $name ?></strong>, tak si je od Altaru
                                    <a href="<?= $eShop ?>">koupím (doporučujeme PDF verzi)</a>
                                </label>
                            </p>
                        </form>
                        <form class="manifest" action="" method="post"
                              onsubmit="return window.confirm('A klidně to potvrdím dvakrát')">
                            <p>
                                <label>
                                    <input type="submit" name="confirm" value="Vlastním <?= $name ?>">
                                    Prohlašuji na svou čest, že vlastním
                                    legální kopii <a href="<?= $eShop ?>"><strong><?= $name ?></strong></a>
                                </label>
                            </p>
                        </form>
                        <div class="footer">
                            <p>Dračí doupě<span class="upper-index">®</span>, DrD<span class="upper-index">TM</span> a
                                ALTAR<span
                                        class="upper-index">®</span> jsou zapsané ochranné známky nakladatelství <a
                                        href="http://www.altar.cz/">ALTAR</a>.</p>
                            <p>Hledáš-li živou komunitu kolem RPG, mrkni na <a
                                        href="https://rpgforum.cz">rpgforum.cz</a>, nebo rovnou na
                                <a href="https://rpgforum.cz/forum/viewforum.php?f=238&sid=a8a110335d3b47d604ad0ab10b630ba4">
                                    sekci pro DrD+.
                                </a>
                            </p>

                            <div>Pokud nevlastníš pravidla DrD+, prosím, <a href="http://obchod.altar.cz">kup si je</a>
                                - podpoříš autory a
                                budoucnost DrD. Děkujeme.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>