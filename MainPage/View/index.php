<!doctype html>
<?php 
    session_start();
    require_once('../../libraries/language.php');
    $lang = new Language();
    $lang2 = new Language();
    $lang->load("select");
    $lang2->load("mainPage");
?>

<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>BookChange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../Css/schoolName.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/css/animate.css">
    <link href="../../assets/css/sweetalert2.css" rel="stylesheet" type="text/css"/>
</head>
<script src="../../assets/Js/sweetalert2.js"></script>
<script src="../../assets/Js/JQuery.js"></script>
<script src="../../assets/Js/JQuery2.0.js"></script>
<script src="../../assets/Js/commonJS2.js"></script>
<script src="../Js/Main.js"></script>
<script src="../../assets/Js/bootstrap.min.js"></script>
<body>
<br>
<!--Navbar-->
<div id="header"></div>
<div class="row">
    <form id="searchbox" align="center" action="">
        <ul>
            <select id="select" name="select">
                <?php
                    echo'<option value="book_name">'. $lang->line("select.bookName"). '</option>';
                    echo'<option value="publishingHouse">'. $lang->line("select.publishingHouse"). '</option>';
                    echo'<option value="author">'. $lang->line("select.author"). '</option>';
                ?>
            </select>
            <?php
            echo'<input id="search" type="text" placeholder="'. $lang->line("select.search"). '?">';
            ?>
            <input type="button" class="btn-danger" value="search" onclick="Search()">
        </ul>
    </form>
</div>
<div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <a><img class="eventIMG"
                        src="http://www.taaze.tw/static_act/201712/workplace_weary/images/index_02.jpg"
                        alt="..."></a>
                <div class="carousel-caption">
                    <b></b>
                </div>
            </div>
            <div class="item">
                <a><img class="eventIMG"
                        src="http://media.taaze.tw/showBanaerImage.html?pk=1000359434&amp%3Bwidth=810&amp%3Bheight=326"
                        alt="..."></a>
                <div class="carousel-caption">
                    <b></b>
                </div>
            </div>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <hr>
    <div>
        <h1 class="animated changeColor infinite " align="center">BookChange<br/></h1>
    </div>
    <div>
        <?php
            echo'<h1 align="center">'. $lang2->line("mainPage.declaration"). '!<br/></h1>';
        ?>
        <hr>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-4">
            <div class="schoolCard">
                <div class="port-1 effect-1">
                    <div class="image-box">
                        <img src="../../assets/image/schoolImage.png" alt="Image-1">
                    </div>
                    <div class="text-desc hidden-xs">
                        <?php
                        echo"<h3><b>". $lang2->line("mainPage.textbook"). "</b></h3>";
                        echo"<h4>各院系所上課用書</h4>";
                        echo'<a onclick="showBookPage(this.id)" id="textbook" class="btnSchool">'. $lang2->line("mainPage.buy"). '</a>';
                        ?>
                    </div>
                    <div class="schoolName">
                        <?php
                        echo"<a onclick='showBookPage(this.id)' id='textbook'><h3>". $lang2->line("mainPage.textbook"). "</h3></a>";
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-4">
            <div class="schoolCard">
                <div class="port-1 effect-1">
                    <div class="imageBox">
                        <img src="../../assets/image/schoolImage.png" alt="Image-1">
                    </div>
                    <div class="text-desc hidden-xs">
                        <h3><b>【文學小說】</b></h3>
                        <h4>翻譯文學/懸疑推理/科幻奇幻</h4>
                        <h4>恐怖驚悚/溫馨療癒/歷史武俠/愛情小說</h4>
                        <a onclick="showBookPage(this.id)" id="literature" class="btnSchool">我要買書</a>
                    </div>
                    <div class="schoolName">
                        <?php
                        echo"<a onclick='showBookPage(this.id)' id='literature'><h3>". $lang2->line("mainPage.literature"). "</h3></a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-4">
            <div class="schoolCard">
                <div class="port-1 effect-1">
                    <div class="image-box">
                        <img src="../../assets/image/schoolImage.png" alt="Image-1">
                    </div>
                    <div class="text-desc hidden-xs">
                        <h3><b>【心靈勵志】</b></h3>
                        <h4>心靈成長/勵志故事/潛能開發</h4>
                        <!-- <h4>兩性與家庭/環境所/營管所/材料所</h4> -->
                        <a onclick="showBookPage(this.id)" id="soul" class="btnSchool">我要買書</a>
                    </div>
                    <div class="schoolName">
                        <?php
                        echo"<a onclick='showBookPage(this.id)' id='soul'><h3>". $lang2->line("mainPage.spiritual"). "</h3></a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-4">
            <div class="schoolCard">
                <div class="port-1 effect-1">
                    <div class="image-box">
                        <img src="../../assets/image/schoolImage.png" alt="Image-1">
                    </div>
                    <div class="text-desc hidden-xs">
                        <h3><b>【語言/電腦】</b></h3>
                        <h4>英/日/韓語</h4>
                        <h4>程式設計/影像編修</h4>
                        <a onclick="showBookPage(this.id)" id="language" class="btnSchool">我要買書</a>
                    </div>
                    <div class="schoolName">
                        <?php
                        echo"<a onclick='showBookPage(this.id)' id='language'><h3>". $lang2->line("mainPage.language"). "</h3></a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-4">
            <div class="schoolCard">
                <div class="port-1 effect-1">
                    <div class="image-box">
                        <img src="../../assets/image/schoolImage.png" alt="Image-1">
                    </div>
                    <div class="text-desc hidden-xs">
                        <h3><b>【商業類】</b></h3>
                        <h4>熱門商業書</h4>
                        <h4>投資理財/管理領導/經濟趨勢</h4>
                        <a onclick="showBookPage(this.id)" id="business" class="btnSchool">我要買書</a>
                    </div>
                    <div class="schoolName">
                        <?php
                        echo"<a onclick='showBookPage(this.id)' id='business'><h3>". $lang2->line("mainPage.business"). "</h3></a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-4">
            <div class="schoolCard">
                <div class="port-1 effect-1">
                    <div class="image-box">
                        <img src="../../assets/image/schoolImage.png" alt="Image-1">
                    </div>
                    <div class="text-desc hidden-xs">
                        <h3><b>【藝術設計】</b></h3>
                        <h4>繪畫/攝影/室內設計</h4>
                        <h4>音樂/電影/戲劇</h4>
                        <a onclick="showBookPage(this.id)" id="art" class="btnSchool">我要買書</a>
                    </div>
                    <div class="schoolName">
                        <?php
                        echo"<a onclick='showBookPage(this.id)' id='art'><h3>". $lang2->line("mainPage.art"). "</h3></a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer"></div>
</body>
</html>