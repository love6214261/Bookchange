<?php
require_once('../../libraries/language.php');
$lang = new Language();
$lang->load("mainPage");
$lang2 = new Language();
$lang2->load("select");


?>
<!doctype html>
<html>
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
<script src="../../assets/Js/bootstrap.min.js"></script>
<script src="../../assets/Js/commonJS.js";></script>
<script src="../Js/WishingPool.js";></script>

<body>
<!--Navbar-->
<div id="header"></div>
<form id="searchbox" align="center" action="">
    <ul>
        <select id="select" name="select">
            <?php
            echo'<option value="book_name">'. $lang2->line("select.bookName"). '</option>';
            echo'<option value="publishingHouse">'. $lang2->line("select.publishingHouse"). '</option>';
            echo'<option value="author">'. $lang2->line("select.author"). '</option>';
            ?>
        </select>
        <?php
        echo'<input id="search" type="text" placeholder="'. $lang2->line("select.search"). '?">';
        ?>
        <input type="button" class="btn-danger" value="search" onclick="Search()">
    </ul>
</form>
<h1 align="center">為了環保，請支持二手書流通!<br/></h1>
<!-- <p align="center">沒事多喝水，有事多上廁所</p><hr> -->
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <caption>許願池</caption>
            <tr>
                <td>許願日期</td>
                <td>書籍封面</td>
                <td>書籍名稱</td>
                <td>作者</td>
                <td>要求書況</td>
                <td>提供書本</td>
            </tr>
        </table>
        <div align="center"><button class="btn" onclick="wish()">我要許願</button></div>
    </div>
</div>
<!-- 舊的許願清單
<div>
    <button onclick="wish()">我要許願!</button>
</div>
<div class="table-responsive">
    <table class="table" id="table">
        <tr>
            <th>書籍封面</th>
            <th>書籍名稱</th>
            <th>作者</th>
            <th>出版社</th>
            <th>希望價格</th>
            <th></th>

        </tr>

    </table>
</div>-->
<div id="footer"></div>
</body>
</html>