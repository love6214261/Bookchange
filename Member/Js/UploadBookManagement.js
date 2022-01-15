/**
 * Created by AllenHsu on 2016/8/6.
 */
window.onload= getUploadBookArray();
function getUploadBookArray() {

    var URLs = "../../MemberController.php?action=connectShowUploadBook";//this one

    return $.ajax({
        url: URLs,
        data:null,
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {

            $("#table").empty();
            $("#table").append(

                $("<tr>").append(
                    $("<th>").html("上架時間"),
                    $("<th>").html("書籍封面"),
                    $("<th>").html("書名"),
                    $("<th>").html("作者"),
                    $("<th>").html("出版社"),
                    $("<th>").html("書籍分類"),
                    $("<th>").html("二手價"),
                    $("<th>").html("狀態"),
                    $("<th>").html(" "),
                    $("<th>").html(" ")
                )
            );

            c=0;
            //var row = data.length;//增加的列數
            for (var i = 0; i < data.length; i++) {
                if(data[i]['book_upcondition']=="上架中") {
                    c++;
                    // alert(data[i]['name']);
                    $("#table").append(
                        $("<tr>").append(
                            $("<td>").html(data[i]['book_time']).attr({'id': "book_time"}),
                            $("<td width='20%'>").html($("<img>").attr({
                                'id': "book_picture",
                                "src": data[i]['book_picture'],
                                'width': "40%",
                                "height": "30%"
                            })),
                            $("<td>").html(data[i]['book_name']).attr({'id': "book_name"}),
                            $("<td>").html(data[i]['book_author']).attr({'id': "book_author"}),
                            $("<td>").html(data[i]['book_publishinghouse']).attr({'id': "book_publishinghouse"}),
                            $("<td>").html(data[i]['book_class']).attr({'id': "book_class"}),
                            $("<td>").html(data[i]['book_twoprice']).attr({'id': "book_twoprice"}),
                            $("<td>").html(data[i]['book_upcondition']).attr({'id': "book_upcondition"}),
                            $("<td>").html($("<input>").attr({
                                'value': "下架",
                                "type": "button",
                                "onclick":"downsheff("+c+")",
                                "name":"count"
                            })),
                            $("<td>").html($("<button>").attr({
                                'class':"btn",
                                'name':"down",
                                'id':c,
                                'style': " display:none ",
                                'value':data[i]['book_id']
                            }))
                        )
                    );
                }
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function downsheff(c) {
    down=document.getElementsByName("down");


    var URLs = "../../MemberController.php?action=connectDownBook";//this one

    return $.ajax({
        url: URLs,
        data: {
            downbook: down[c-1].value,
        },
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            alert("下架成功");
            document.getElementById("table").deleteRow(c);
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function notUp() {
    var URLs = "../../appBookController.php?action=connectNotUpload";//this one

    return $.ajax({
        url: URLs,
        data:null,
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {

            $("#table").empty();
            $("#table").append(

                $("<tr>").append(
                    $("<th>").html("ISBN"),
                    $("<th>").html("書籍封面"),
                    $("<th>").html("書名"),
                    $("<th>").html("作者"),
                    $("<th>").html("出版社"),
                    $("<th>").html("原價"),
                    $("<th>").html("書籍分類"),
                    $("<th>").html("二手價"),
                    $("<th>").html("狀態"),
                    $("<th>").html("是否出租"),
                    $("<th>").html(" "),
                    $("<th>").html(" ")
                )
            );

            j=0;
            for (var i = 0; i < data.length; i++) {
                j++;
                $("#table").append(
                    $("<tr>").append(
                        $("<td>").html($("<input>").attr({'name':"ISBN",'value':data[i]['isbn'],'type':"text",'style':"border:1px  #FFD382 groove",'size':data[i]['isbn'].length})),
                        $("<td width='20%'>").html($("<img>").attr({
                            'id': "allbook_picture",
                            "src": '../../../assets/image/bookPic/' + data[i]['coverlink'],
                            'width': "40%",
                            "height": "30%"
                        })),
                        $("<td>").html($("<input>").attr({'name':"bname",'value':data[i]['title'],'type':"text",'style':"border:1px  #FFD382 groove"})),
                        $("<td>").html($("<input>").attr({'name':"author",'value':data[i]['author'],'type':"text",'style':"border:1px  #FFD382 groove",'size':data[i]['author'].length})),
                        $("<td>").html($("<input>").attr({'name':"publishingHouse",'value':data[i]['publisher'],'type':"text",'style':"border:1px  #FFD382 groove"})),
                        $("<td>").html($("<input>").attr({'name':"price",'value':data[i]['ogprice'],'type':"text",'style':"border:1px  #FFD382 groove",'size':data[i]['ogprice'].length})),
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
                        ).attr({'name':"bookClass",'style':"border:1px  #FFD382 groove"})),
                        $("<td>").html($("<input>").attr({'name':"twoprice",'type':"text",'placeholder':"請輸入",'style':"border:1px  #FFD382 groove",'size':"5"})),
                        $("<td>").html($("<select>").append($("<option> </option>"),
                            $("<option>接近全新</option>"),
                            $("<option>保存極佳</option>"),
                            $("<option>保存良好</option>"),
                            $("<option>尚可接受</option>")
                        ).attr({'name':"bookcon",'style':"border:1px  #FFD382 groove"})),
                        $("<td>").html($("<select>").append($("<option> </option>"),
                            $("<option>是</option>"),
                            $("<option>否</option>")
                        ).attr({'name':"rent",'style':"border:1px  #FFD382 groove"})),
                        $("<td>").html($("<input>").attr({
                            'value': "上架",
                            "type": "button",
                            "onclick":"confirmDeal("+j+")",
                            "name":"count"
                        })),
                        $("<td>").html($("<button>").attr({
                            'class':"btn",
                            'name':"up",
                            'id':j,
                            'style': " display:none ",
                            'value':data[i]['allbook_id']
                        }))
                    )
                )

            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function confirmDeal(j) {//確認使用者是否登入
    var URLs = "../../../showSession.php";

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
                }).then(function(isConfirm) {
                    if (isConfirm == true) {
                        uploadBook(j);
                    }
                })
            } else {
                swal(   '會員驗證程序',  '您好，請先完成會員驗證程序才能租書，感謝您的配合!',   'warning' );
            }
        },
        error: function () {
            swal(   '請先登入!',  '請先登入才可以使用書城，感謝您的配合!!',   'warning' );
            location.assign("../../AccountActivity/loginController.php?action=ShowLoginPage");
        }
    });
}

function uploadBook(j) {

    up=document.getElementsByName("up");

    var URLs = "../../MemberController.php?action=connectUploadNot";//this one
    var bookClassE;

    publishingHouse=document.getElementsByName("publishingHouse");
    bname=document.getElementsByName("bname");
    author=document.getElementsByName("author");
    price=document.getElementsByName("price");
    bookClass=document.getElementsByName("bookClass");
    twoprice=document.getElementsByName("twoprice");
    ISBN=document.getElementsByName("ISBN");
    rentbook=document.getElementsByName("rent");
    bookcon=document.getElementsByName("bookcon");

    switch (bookClass[j-1].value)
    {
        case "管理學院":
            bookClassE="management";
            break;
        case "資訊電機學院":
            bookClassE="electric";
            break;
        case "文學院":
            bookClassE="languagement";
            break;
        case "工學院":
            bookClassE="engineering";
            break;
        case "地球科學學院":
            bookClassE="earth";
            break;
        case "理學院":
            bookClassE="science";
            break;
        case "客家學院":
            bookClassE="hakka";
            break;
        case "生醫理工學院":
            bookClassE="health";
            break;
        case "其他學院":
            bookClassE="others";
            break;
        default:
            alert("你沒有選學院!");
    };


    if(bookClass[j-1].value==""||twoprice[j-1].value==null||rentbook[j-1].value==""||bookcon[j-1].value=="") {
        alert("請再次確認你的欄位是否都填滿!!");
    }else {

        $.ajax({
            url: URLs,
            data: {
                publishingHouse: publishingHouse[j-1].value,
                bname: bname[j-1].value,
                author: author[j-1].value,
                price: price[j-1].value,
                bookClass: bookClassE,
                ISBN: ISBN[j-1].value,
                rent: rentbook[j-1].value,
                twoprice: twoprice[j-1].value,
                bookcon: bookcon[j-1].value
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
function GotoThatPage() {

    location.href = "book_management.html";

}



