/**
 * Created by AllenHsu on 2016/8/9.
 */
window.onload= uploading();

function uploading() {
    var URLs = "../../MemberController.php?action=connectOnsale";//this one

    return $.ajax({
        url: URLs,
        data:null,
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            $("#table").empty();
            $("#table").append(

                $("<tr>").append(
                    $("<th>").html("書籍封面"),
                    $("<th>").html("書籍名稱"),
                    $("<th>").html("書籍作者"),
                    $("<th>").html("二手價格"),
                    $("<th>").html("             ")
                )
            );
            for (var i = 0; i < data.length; i++) {
                if(data[i]['book_upcondition']=="上架中") {
                    $(".table").append(
                        $("<tr>").append(
                            $("<td>").html($("<img>").attr({
                                'src': "../../../assets/image/bookPic/" + data[i]['book_picture'],
                                "style": "height: auto; width:50px;"
                            })),
                            $("<td>").html(data[i]['book_name']),
                            $("<td>").html(data[i]['book_author']),
                            $("<td>").html(data[i]['book_twoprice']),
                            $("<td>").html($("<input>").attr({
                                'value': "查看排隊清單",
                                "type": "button",
                                "onclick": "GotoWaitPage(" + data[i]['book_id'] + ")"
                            }))
                        )
                    )
                }
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function trading() {
    var URLs = "../../MemberController.php?action=connectTrading";//this one

    return $.ajax({
        url: URLs,
        data:null,
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            $("#table").empty();
            $("#table").append(

                $("<tr>").append(
                    $("<th>").html("書籍封面"),
                    $("<th>").html("書籍名稱"),
                    $("<th>").html("書籍作者"),
                    $("<th>").html("二手價格"),
                    $("<th>").html("交易對象"),
                    $("<th>").html("             "),
                    $("<th>").html("             ")
                )
            );
            for (var i = 0; i < data.length; i++) {
                if(data[i]['book_upcondition']=="交易中") {
                    $(".table").append(
                        $("<tr>").append(
                            $("<td>").html($("<img>").attr({
                                'src': "../../../assets/image/bookPic/" + data[i]['book_picture'],
                                "style": "height: auto; width:50px;"
                            })),
                            $("<td>").html(data[i]['book_name']),
                            $("<td>").html(data[i]['book_author']),
                            $("<td>").html(data[i]['book_twoprice']),
                            $("<td>").html(data[i]['member_name']),
                            $("<td>").html($("<input>").attr({'value':"聊天室","type":"button","onclick":"GotoEndPage("+data[i]['book_id']+")"})),
                            $("<td>").html($("<input>").attr({'value':"結束交易","type":"button","onclick":"endtrade("+data[i]['book_id']+")"}))
                        )
                    )
                }
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function evaluating() {
    var URLs = "../../MemberController.php?action=connectBookAndTrade";//this one

    return $.ajax({
        url: URLs,
        data:null,
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            $("#table").empty();
            $("#table").append(

                $("<tr>").append(
                    $("<th>").html("書籍封面"),
                    $("<th>").html("書籍名稱"),
                    $("<th>").html("書籍作者"),
                    $("<th>").html("二手價格"),
                    $("<th>").html("交易截止日期"),
                    $("<th>").html("             ")
                )
            );
            for (var i = 0; i < data.length; i++) {
                if(data[i]['book_upcondition']=="評價中") {
                    $(".table").append(
                        $("<tr>").append(
                            $("<td>").html($("<img>").attr({
                                'src': "../../../assets/image/bookPic/" + data[i]['book_picture'],
                                "style": "height: auto; width:50px;"
                            })),
                            $("<td>").html(data[i]['book_name']),
                            $("<td>").html(data[i]['book_author']),
                            $("<td>").html(data[i]['book_twoprice']),
                            $("<td>").html(data[i]['trade_end']),
                            $("<td>").html($("<input>").attr({'value':"我要評價","type":"button","onclick":"GotoEvaluatePage("+data[i]['book_id']+")",'id':data[i]['book_id']}))
                        )
                    );
                    checkEvaluation(data[i]['book_id']);
                }
            }

        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function checkEvaluation(book_id) {
    var URLs = "../../MemberController.php?action=connectCheckEvaluation";//this one

    return $.ajax({
        url: URLs,
        data:{
            book_id: book_id
        },
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                if(data[i]['member_id']==data[i]['buyer_id']){
                    $("#"+book_id).attr("hidden", "hidden");
                };
            };
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}


function successtrade() {
    var URLs = "../../MemberController.php?action=connectOnsale";//this one

    return $.ajax({
        url: URLs,
        data:null,
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            $("#table").empty();
            $("#table").append(

                $("<tr>").append(
                    $("<th>").html("書籍封面"),
                    $("<th>").html("書籍名稱"),
                    $("<th>").html("書籍作者"),
                    $("<th>").html("二手價格"),
                    $("<th>").html("             ")
                )
            );
            for (var i = 0; i < data.length; i++) {
                if(data[i]['book_upcondition']=="交易成功") {
                    $(".table").append(
                        $("<tr>").append(
                            $("<td>").html($("<img>").attr({
                                'src': "../../../assets/image/bookPic/" + data[i]['book_picture'],
                                "style": "height: auto; width:50px;"
                            })),
                            $("<td>").html(data[i]['book_name']),
                            $("<td>").html(data[i]['book_author']),
                            $("<td>").html(data[i]['book_twoprice'])
                        )
                    )
                }
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function failtrade() {
    var URLs = "../../MemberController.php?action=connectOnsale";//this one

    return $.ajax({
        url: URLs,
        data:null,
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            $("#table").empty();
            $("#table").append(

                $("<tr>").append(
                    $("<th>").html("書籍封面"),
                    $("<th>").html("書籍名稱"),
                    $("<th>").html("書籍作者"),
                    $("<th>").html("二手價格"),
                    $("<th>").html("             ")
                )
            );
            for (var i = 0; i < data.length; i++) {
                if(data[i]['book_upcondition']=="交易失敗") {
                    $(".table").append(
                        $("<tr>").append(
                            $("<td>").html($("<img>").attr({
                                'src': "../../../assets/image/bookPic/" + data[i]['book_picture'],
                                "style": "height: auto; width:50px;"
                            })),
                            $("<td>").html(data[i]['book_name']),
                            $("<td>").html(data[i]['book_author']),
                            $("<td>").html(data[i]['book_twoprice'])
                        )
                    )
                }
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function endtrade(book_id) {


    swal({
        title: '確定完成交易?',
        text: "按下確定表示您已完成交易。\n交易完成將會關閉您的聊天室!!",
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
            dealend(book_id);
        }
    })

};

function dealend(book_id) {
    var URLs = "../../../Trade/TradeController.php?action=connectUploadEvaluateDB";//this one

    $.ajax({
        url: URLs,
        data: {
            book_id: book_id
        },
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            alert("ho");
        },
        error: function (err) {
            GotoEvaluatePage(book_id);
        }
    });
}

function GotoEndPage(page) {
    location.href = "../../../Chat/View/chatroomConfirm.html?value="+page;
}

function GotoEvaluatePage(page) {
    location.href = "../../../Evaluate/View/evaluate.html?value="+page;
}

function GotoWaitPage(page) {
    location.href = "../seller/sellChoose.html?value="+page;
}

