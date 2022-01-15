<?php
    require_once('../../libraries/language.php');
    $lang = new Language();
    $lang->load("footer");
?>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/Js/JQuery.js"></script>
    <script src="../../assets/Js/commonJS.js"></script>
    <script src="../Js/Main.js"></script>
    <script src="../../assets/Js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="inner " id="footer">
        <section>

            <?php
            echo"<h2>". $lang->line("footer.tradeprocess"). "</h2>";
            ?>
            <div class="tradeprocess">
                <?php
                echo'<li><a href="">'. $lang->line("footer.firstbuy"). '</a></li>';
                echo'<li><a href="">'. $lang->line("footer.firstsell"). '</a></li>';
                ?>
            </div>
        </section>
        <section>
            <?php
                echo"<h2>". $lang->line("footer.aboutus"). "</h2>";
            ?>
            <ul class="aboutus">
                <?php
                    echo'<button  id="collapsebutton" type="button" class="btn btn-link"  data-toggle="collapse" data-target="#serversmail" aria-expanded="true" aria-controls="serversmail">'. $lang->line("footer.serviceemail"). '</button>';
                echo'<div id="serversmail" class="collapse ">bookChange@gmail.com</div>';
                echo'<br>';
                    echo'<button id="collapsebutton" type="button" class="btn btn-link" data-toggle="collapse" data-target="#serverstime" aria-expanded="true" aria-controls="serverstime">'. $lang->line("footer.servicetime"). '</button>';
                echo'<div id="serverstime" class="collapse ">09:00-17:00</div>';
                echo'<li><a href="../../ContactUs/ContactUsController.php?action=ShowContactForm">'. $lang->line("footer.contact"). '</a></li>';
                ?>
            </ul>
        </section>
        <ul class="copyright" align="center">
            <li>&copy; Book Change. All rights reserved</li>
        </ul>
    </div>
</div>
</body>
</html>