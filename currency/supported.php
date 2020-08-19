<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="supported.css">
    <link rel="stylesheet" href="common.css">
    <title>Exchange App</title>
</head>

<body>
    <!-- PHP CODE -->
    <!-- PHP CODE -->
    <!-- PHP CODE -->
    <?php 
    // CURL codes
    include "handles.php";
    ?>
    <!-- PHP CODE -->
    <!-- PHP CODE -->
    <!-- PHP CODE -->

    <div id="wrap">
        <div id="menu">
            <a href="index.php">Top</a>
            <a href="supported.php">Rates</a>
        </div>
        <div id="header">
            <h1><a href="index.php#amount">Yogi's Money Exchange</a></h1>
        </div>
        <div id="main">
            <div class="php">updated as of: <?php 
                 date_default_timezone_set('Europe/Kiev');
                echo date("F d Y",filemtime("$file")). " " .date("H:i",filemtime("$file")) ?></div>
            <br>
            <h2 id="title">Currency Rates</h2>
            <table border="1">
                <?php 
                    
                        foreach ($ratearray as $key => $name){
                            echo "<tr><td>".$name."</td><td>" . round($rates->rates->$key,2) .$name. "</td></tr>";
                        }
                    
                ?>
            </table>
            <br>
        </div>
        <div id="footer">
            <div id="container">
                <div>
                    &copy; 2020 Currency Exchange.
                </div>
                <div class="clear"></div>
            </div>
        </div>
</body>

</html>
