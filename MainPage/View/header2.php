<?php
require_once('../../libraries/language.php');
$lang = new Language();
$lang->load("header");
?>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>BookChange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/css/sweetalert2.css" rel="stylesheet" type="text/css"/>
</head>
<script src="../../assets/Js/sweetalert2.js"></script>
<script src="../../assets/Js/JQuery.js"></script>
<script src="../../assets/Js/JQuery2.0.js"></script>
<script src="../../assets/Js/commonJS.js"></script>
<script src="../Js/Main.js"></script>
<script src="../../assets/Js/bootstrap.min.js"></script>
<body>
<div id="header">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <img src="../../../assets/image/bookChangeLogo.PNG" class="brandIMG"  onclick="showIndex()">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right">
                <ul class="newMenu nav navbar-nav">
                    <li><a id="name" style=" color:#0261ff;"></a></li>
                    <?php
                    echo'<li><a onclick="ShowPoolPage()">'. $lang->line("header.pool"). '</a></li>';
                    echo'<li><a onclick="ShowUploadBookPage()">'. $lang->line("header.sellBook"). '</a></li>';
                    echo'<li><a onload="getSession()" onclick="ShowLoginPage()" id="loginButton">'.$lang->line("header.login").'</a></li>';
                    echo'<li><a onclick="ShowMemberCenter()">'. $lang->line("header.memberCenter"). '</a></li>';
                    echo"<li><a href='./index.php?lang=zh-TW'>Chinese</a></li>";
                    echo"<li><a href='./index.php?lang=en-US'>English</a></li>";
                    ?>
                    <li class="dropdown" >
                        <a onclick="Love()" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-plus"></span></a>
                        <ul class="dropdown-menu dropdown-plus" id="myLoveList" role="menu">
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>

</body>
</html>