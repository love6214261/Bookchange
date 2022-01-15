/**
 * Created by AllenHsu on 2016/7/10.
 */
var bookISBN, bookSearch, upload;
var count = 0;

function confirmDeal() {//確認使用者是否登入
    var URLs = "../../showSession.php";

    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            //alert("AJAX SUCCESS!");

            if (data["session"] != null && data['acNum'] != 0) {
                swal({
                    title: '確定要上傳?',
                    text: "按下確定表示您同意上傳書籍。",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '無怨無悔',
                    cancelButtonText: '考慮一下',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function (isConfirm) {
                    if (isConfirm == true) {
                        uploadBook();
                    }
                })
            } else {
                swal('會員驗證程序', '您好，請先完成會員驗證程序才能租書，感謝您的配合!', 'warning');
            }
        },
        error: function () {
            swal('請先登入!', '請先登入才可以使用書城，感謝您的配合!!', 'warning');
            location.assign("../../AccountActivity/loginController.php?action=ShowLoginPage");
        }
    });
}

function uploadBook() {
    var checkISBN = document.getElementById("bookISBN");
    if(checkISBN.value==""){
        swal('Oops!', '尚未輸入isbn!', 'warning');
    }

    var URLs = "../BookController.php?action=connectUploadDB";//this one
    // var URLs = "../Model/connectUploadDB.php";//this one
    var bookClassE;

    book_picture = document.getElementById("book_picture").getAttribute("src");
    publishingHouse = document.getElementsByName("publishingHouse");
    bname = document.getElementsByName("bname");
    author = document.getElementsByName("author");
    bookClass = document.getElementById("bookClass");
    twoprice = document.getElementsByName("twoprice");
    ISBN = document.getElementsByName("ISBN");
    bookcon = document.getElementById("bookcon");

    switch (bookClass.value) {
        case "教科書":
            bookClassE = "textbook";
            break;
        case "文學小說":
            bookClassE = "literature";
            break;
        case "心靈勵志":
            bookClassE = "soul";
            break;
        case "語言/電腦":
            bookClassE = "language";
            break;
        case "商業類":
            bookClassE = "business";
            break;
        case "藝術設計":
            bookClassE = "art";
            break;
        default:
            alert("你沒有選類別!");
    }
    ;

    if (count != 0) {
        if (bookClass.value == "" || twoprice[0].value == null || bookcon.value == "") {
            alert("請再次確認你的欄位是否都填滿!!");
        } else {
            $.ajax({
                url: URLs,
                data: {
                    bookPicture:book_picture,
                    publishingHouse: publishingHouse[0].value,
                    bname: bname[0].value,
                    author: author[0].value,
                    bookClass: bookClassE,
                    ISBN: ISBN[0].value,
                    twoprice: twoprice[0].value,
                    bookcon: $('#bookcon').val()
                },
                type: "post",
                dataType: "json",//回傳資料用json檔
                success: function (data) {
                    alert("ho");
                },
                error: function (err) {
                    swal(  '上傳成功',  '您可以在會員中心管理您的書籍!',   'success' ).then(function (isConfirm) {
                        if (isConfirm == true) {
                            GotoThatPage();
                        }
                    })
                }
            });

            count = 0;
        }

    }
    else {
        alert("尚未選擇or已經上傳過了!")
    }

}
/*
function getBookArray() {
    bookISBN = document.getElementById("bookISBN");

    var URLs = "../OtherBookController.php?action=connectSearchBookDB";//this one

    return $.ajax({
        url: URLs,
        data: {bookISBN: bookISBN.value},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            if (count != 0) {
                $('table tr:last').remove();
                count = 0;
            }
            //var row = data.length;//增加的列數
            for (var i = 0; i < data.length; i++) {
                if (bookISBN.value == parseInt(data[i]['isbn'])) {
                    // alert(data[i]['name']);
                    $("#table").append(
                        $("<tr>").append(
                            $("<td width='15%'>").html($("<img>").attr({
                                'id': "book_picture",
                                "src": '../../assets/image/bookPic/' + data[i]['coverlink'],
                                'width': "40%",
                                "height": "30%"
                            })),
                            $("<td>").html($("<input>").attr({
                                'name': "bname",
                                'value': data[i]['title'],
                                'type': "text",
                                'style': "border:1px  #FFD382 groove"
                            })),
                            $("<td>").html($("<input>").attr({
                                'name': "ISBN",
                                'value': data[i]['isbn'],
                                'type': "text",
                                'style': "border:1px  #FFD382 groove",
                                'size': data[i]['isbn'].length
                            })),
                            $("<td>").html($("<input>").attr({
                                'name': "author",
                                'value': data[i]['author'],
                                'type': "text",
                                'style': "border:1px  #FFD382 groove",
                                'size': data[i]['author'].length
                            })),
                            $("<td>").html($("<input>").attr({
                                'name': "publishingHouse",
                                'value': data[i]['publisher'],
                                'type': "text",
                                'style': "border:1px  #FFD382 groove"
                            })),
                            $("<td>").html($("<select>").append($("<option> </option>"),
                                $("<option>管理學院</option>"),
                                $("<option>資訊電機學院</option>"),
                                $("<option>文學院</option>"),
                                $("<option>工學院</option>"),
                                $("<option>地球科學學院</option>"),
                                $("<option>理學院</option>"),
                                $("<option>客家學院</option>"),
                                $("<option>生醫理工學院</option>"),
                                $("<option>其他學院</option>")
                            ).attr({'id': "bookClass", 'style': "border:1px  #FFD382 groove"})),
                            $("<td>").html($("<input>").attr({
                                'name': "twoprice",
                                'type': "text",
                                'placeholder': "請輸入",
                                'style': "border:1px  #FFD382 groove",
                                'size': "5"
                            })),
                            $("<td>").html($("<select>").append($("<option> </option>"),
                                $("<option>接近全新</option>"),
                                $("<option>保存極佳</option>"),
                                $("<option>保存良好</option>"),
                                $("<option>尚可接受</option>")
                            ).attr({'id': "bookcon", 'style': "border:1px  #FFD382 groove"}))

                        )
                    );
                    count++;
                }
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });

}
*/
function searchWorldCat() {

        bookISBN = document.getElementById("bookISBN");

        if (bookISBN.value==""){
            swal('Oops!', '請輸入isbn!', 'warning');
        }
        else {
            var xhttp = new XMLHttpRequest();
            var proxyURL = 'https://cors-anywhere.herokuapp.com/';
            var URLs = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + bookISBN.value;
            xhttp.open("GET", proxyURL + URLs, true);
            xhttp.onload = function () {
                if (xhttp.status >= 200 && xhttp.status < 400) {

                    var jsonDoc = JSON.parse(xhttp.responseText);

                    if (jsonDoc.totalItems == 0) {
                        swal('沒有書籍資料!', '請使用其他isbn或選擇手動上傳，感謝您的配合!!', 'warning');
                    } else {
                        if (jsonDoc.items[0].volumeInfo.authors == null||jsonDoc.items[0].volumeInfo.imageLinks==null) {
                            swal('沒有書籍資料!', '請使用其他isbn或選擇手動上傳，感謝您的配合!!', 'warning');
                        }
                        else{
                        console.log(jsonDoc.totalItems);
                        var url = jsonDoc.items[0].volumeInfo.imageLinks.smallThumbnail;
                        var bname = jsonDoc.items[0].volumeInfo.title;
                        var author = jsonDoc.items[0].volumeInfo.authors[0];
                        var publisher = jsonDoc.items[0].volumeInfo.publisher;

                        if (count > 0) {
                            $("#onlyAtt").remove();
                            count = 0;
                        }

                        $("#table").append(
                            $("<tr id='onlyAtt'>").append(
                                $("<td width='100'>").html($("<img>").attr({
                                    'id': "book_picture",
                                    "src": url,
                                    'width': "100",
                                    "height": "100"
                                })),
                                $("<td>").html($("<input>").attr({
                                    'name': "bname",
                                    'value': bname,
                                    'type': "text",
                                    'style': "border:1px  #FFD382 groove"
                                })),
                                $("<td>").html($("<input>").attr({
                                    'name': "ISBN",
                                    'value': bookISBN.value,
                                    'type': "text",
                                    'style': "border:1px  #FFD382 groove",
                                    'size': bookISBN.length
                                })),
                                $("<td>").html($("<input>").attr({
                                    'name': "author",
                                    'value': author,
                                    'type': "text",
                                    'style': "border:1px  #FFD382 groove",
                                    'size': author.length
                                })),
                                $("<td>").html($("<input>").attr({
                                    'name': "publishingHouse",
                                    'value': publisher,
                                    'type': "text",
                                    'style': "border:1px  #FFD382 groove"
                                })),
                                $("<td>").html($("<select>").append($("<option> </option>"),
                                    $("<option>教科書</option>"),
                                    $("<option>文學小說</option>"),
                                    $("<option>心靈勵志</option>"),
                                    $("<option>語言/電腦</option>"),
                                    $("<option>商業類</option>"),
                                    $("<option>藝術設計</option>")
                                ).attr({'id': "bookClass", 'style': "border:1px  #FFD382 groove"})),
                                $("<td>").html($("<input>").attr({
                                    'name': "twoprice",
                                    'type': "text",
                                    'placeholder': "請輸入",
                                    'style': "border:1px  #FFD382 groove",
                                    'size': "5"
                                })),
                                $("<td>").html($("<select>").append($("<option> </option>"),
                                    $("<option>接近全新</option>"),
                                    $("<option>保存極佳</option>"),
                                    $("<option>保存良好</option>"),
                                    $("<option>尚可接受</option>")
                                ).attr({'id': "bookcon", 'style': "border:1px  #FFD382 groove"}))
                            )
                        );
                        count++;
                    }
                    }
                }
            };
            xhttp.setRequestHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept,Authorization');
            xhttp.setRequestHeader('Access-Control-Allow-Origin', '*');
            xhttp.setRequestHeader('Access-Control-Allow-Methods', 'Get');
            xhttp.send();

        }
    /*
    bookISBN = document.getElementById("bookISBN");
    var xhttp = new XMLHttpRequest();
    var proxyURL = 'https://cors-anywhere.herokuapp.com/';
    var URLs="http://xisbn.worldcat.org/webservices/xid/isbn/"+bookISBN.value+"?method=getMetadata&format=xml&fl=*";
    xhttp.open("GET", proxyURL +URLs, true);
    xhttp.onload = function() {
        if (xhttp.status >= 200 && xhttp.status < 400) {
            console.log(xhttp.responseText);
            var xmlDoc=xhttp.responseXML;
            var x = xmlDoc.getElementsByTagName("isbn")[0];
            var url = x.getAttribute("url");
            var bname = x.getAttribute("title");
            var author = x.getAttribute("author");
            var publisher = x.getAttribute("publisher");
                console.log(bc);
                $("#table").append(
                    $("<tr>").append(
                        $("<td width='20%'>").html($("<img>").attr({
                            'id': "book_picture",
                            "src": bc,
                            'width': "40%",
                            "height": "30%"
                        })),
                        $("<td>").html($("<input>").attr({
                            'name': "bname",
                            'value': bname,
                            'type': "text",
                            'style': "border:1px  #FFD382 groove"
                        })),
                        $("<td>").html($("<input>").attr({
                            'name': "ISBN",
                            'value': bookISBN.value,
                            'type': "text",
                            'style': "border:1px  #FFD382 groove",
                            'size': bookISBN.length
                        })),
                        $("<td>").html($("<input>").attr({
                            'name': "author",
                            'value': author,
                            'type': "text",
                            'style': "border:1px  #FFD382 groove",
                            'size': author.length
                        })),
                        $("<td>").html($("<input>").attr({
                            'name': "publishingHouse",
                            'value': publisher,
                            'type': "text",
                            'style': "border:1px  #FFD382 groove"
                        })),
                        $("<td>").html($("<input>").attr({
                            'name': "price",
                            'value': '200',
                            'type': "text",
                            'style': "border:1px  #FFD382 groove"
                        })),
                        $("<td>").html($("<select>").append($("<option> </option>"),
                            $("<option>管理學院</option>"),
                            $("<option>資訊電機學院</option>"),
                            $("<option>文學院</option>"),
                            $("<option>工學院</option>"),
                            $("<option>地球科學學院</option>"),
                            $("<option>理學院</option>"),
                            $("<option>客家學院</option>"),
                            $("<option>生醫理工學院</option>"),
                            $("<option>其他學院</option>")
                        ).attr({'id': "bookClass", 'style': "border:1px  #FFD382 groove"})),
                        $("<td>").html($("<input>").attr({
                            'name': "twoprice",
                            'type': "text",
                            'placeholder': "請輸入",
                            'style': "border:1px  #FFD382 groove",
                            'size': "5"
                        })),
                        $("<td>").html($("<select>").append($("<option> </option>"),
                            $("<option>接近全新</option>"),
                            $("<option>保存極佳</option>"),
                            $("<option>保存良好</option>"),
                            $("<option>尚可接受</option>")
                        ).attr({'id': "bookcon", 'style': "border:1px  #FFD382 groove"})),
                        $("<td>").html($("<select>").append($("<option> </option>"),
                            $("<option>是</option>"),
                            $("<option>否</option>")
                        ).attr({'id': "rent", 'style': "border:1px  #FFD382 groove"}))
                    )
                );

        }
    };
    xhttp.setRequestHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept,Authorization');
    xhttp.setRequestHeader('Access-Control-Allow-Origin', '*');
    xhttp.setRequestHeader('Access-Control-Allow-Methods', 'Get');
    xhttp.send();


*/
}

function searchBugBook() {
    var URLs = "../OtherBookController.php?action=connectOtherBook";//this one
    $.ajax({
        url: URLs,
        data: {
            bookISBN: bookISBN.value
        },
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            alert("ho");
        },
        error: function (err) {
            swal('上傳成功', '您可以在會員中心管理您的書籍!', 'success');
        }
    });

}

function uploadBookTwo() {

    var URLs = "../BookController.php?action=connectUploadDB2";//this one
    var bookClassE;

    bookCover=document.getElementById("InputFile");
    bookpublisher = document.getElementById("bookpublisher");
    bookname = document.getElementById("bookname");
    bookauthor = document.getElementById("bookauthor");
    bookcategory = document.getElementById("bookcategory");
    twoprice = document.getElementById("twoprice");
    bookcondition = document.getElementById("bookcondition");

    switch (bookcategory.value) {
        case "教科書":
            bookClassE = "textbook";
            break;
        case "文學小說":
            bookClassE = "literature";
            break;
        case "心靈勵志":
            bookClassE = "soul";
            break;
        case "語言/電腦":
            bookClassE = "language";
            break;
        case "商業類":
            bookClassE = "business";
            break;
        case "藝術設計":
            bookClassE = "art";
            break;
        default:
            alert("你沒有選類別!");
    }


        if (bookcategory.value == "" || twoprice.value == "" || bookcondition.value == ""||bookname.value==""||bookpublisher.value==""||bookauthor.value=="") {
            alert("請再次確認你的欄位是否都填滿!!");
        } else {
            $.ajax({
                url: URLs,
                data: {
                    publishingHouse: bookpublisher.value,
                    bname: bookname.value,
                    author: bookauthor.value,
                    bookClass: bookClassE,
                    twoprice: twoprice.value,
                    bookcon: bookcondition.value
                },
                type: "post",
                dataType: "json",//回傳資料用json檔
                success: function (data) {
                    alert("ho");
                },
                error: function (err) {
                    swal(  '上傳成功',  '您可以在會員中心管理您的書籍!',   'success' ).then(function (isConfirm) {
                        if (isConfirm == true) {
                            GotoThatPage();
                        }
                    })
                }
            });

        }


}

function handleFiles(file){

}

function GotoThatPage() {

    location = "../../Member/View/seller/book_management.html";

}
