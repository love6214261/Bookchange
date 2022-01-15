window.onload = getEvaluateInfo();
var memberid;


function getEvaluateInfo() {
    var URLs = "../EvaluateController.php?action=connectEvaluate";//this one

    return $.ajax({
        url: URLs,
        data: {book_id: showID()},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {

            $("#bookName").html(data[0]['book_name']).attr({'id': "book_name"});
            $("#buyerName").html(data[1][0]['member_name']).attr({'id': "buyer_name"});
            $("#sellerName").html(data[0]['member_name']).attr({'id': "seller_name"});
            $("#seller_id").attr({'value': data[0]['member_id']});
            $("#buyer_id").attr({'value': data[1][0]['buyer_id']});
            memberid = data[3];
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}


$(document).on('click', '#pin', function (e) {

    var URLs = "../../Trade/TradeController.php?action=connectUploadEndDB";//this one
    var R;

    buyer_id=document.getElementById("buyer_id");
    seller_id=document.getElementById("seller_id");
    score=document.getElementsByName("score");
    result=document.getElementsByName("result");
    advise=document.getElementsByName("advise");

    for (var i = 0; i < 4; i++)
    {
        if (result[i].checked)
        {
            R=result[i].value;
        }
    }

    if(score[0].value>10||score[0].value==null||score[0].value<=0)
    {
        alert("請輸入1~10的評分(0.5為間距)!!");
    }
    else {

        swal({
            title: '確定完成評價?',
            text: "按下確認後將回送出評價!",
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
                if (memberid == seller_id.value) {
                    if (R == "正常完成") {
                        for (var i = 0; i < 2; i++) {
                            queue = i;

                            switch (queue) {

                                case 0:
                                    upload();
                                    break;
                                case 1:
                                    $.ajax({
                                        url: URLs,
                                        data: {
                                            userID: buyer_id.value,
                                            book_id: showID(),
                                        },
                                        type: "post",
                                        dataType: "json",//回傳資料用json檔
                                        success: function (data) {
                                            alert("ho");
                                        },
                                        error: function (err) {
                                            alert(err.responseText);
                                        }
                                    });
                                    break;
                            }
                        }
                    }
                    else {

                        var queue;
                        for (var i = 0; i < 2; i++)
                        {
                            queue=i;
                            switch (queue)
                            {
                                case 0:
                                    upload();
                                    break;
                                case 1:
                                    $.ajax({
                                        url: URLs,
                                        data: {
                                            userID: buyer_id.value,
                                            book_id: showID(),
                                        },
                                        type: "post",
                                        dataType: "json",//回傳資料用json檔
                                        success: function (data) {
                                            alert("ho");
                                        },
                                        error: function (err) {
                                            alert(err.responseText);
                                        }
                                    });
                                    break;
                            }

                        }
                    }
                }
                else if (memberid == buyer_id.value) {
                    if (R.value == "正常完成") {

                        var queue;
                        for (var i = 0; i < 2; i++)
                        {
                            queue=i;
                            switch (queue)
                            {
                                case 0:
                                    upload();
                                    break;
                                case 1:
                                    $.ajax({
                                        url: URLs,
                                        data: {
                                            userID: seller_id.value,
                                            book_id: showID(),
                                        },
                                        type: "post",
                                        dataType: "json",//回傳資料用json檔
                                        success: function (data) {
                                            alert("ho");
                                        },
                                        error: function (err) {
                                            alert(err.responseText);
                                        }
                                    });
                                    break;
                            }

                        }
                    }
                    else {

                        var queue;

                        for (var i = 0; i < 2; i++)
                        {
                            queue=i;
                            switch (queue)
                            {
                                case 0:
                                    upload();
                                    break;
                                case 1:
                                    $.ajax({
                                        url: URLs,
                                        data: {
                                            userID: seller_id.value,
                                            book_id: showID(),
                                        },
                                        type: "post",
                                        dataType: "json",//回傳資料用json檔
                                        success: function (data) {
                                            alert("ho");
                                        },
                                        error: function (err) {
                                            alert(err.responseText);
                                        }
                                    });
                                    break;
                            }

                        }

                    }
                }
            }
        })
    }

});

function upload() {
    var URLs = "../EvaluateController.php?action=connectUploadEvaluate";//this one
    var R;

    buyer_id=document.getElementById("buyer_id");
    seller_id=document.getElementById("seller_id");
    for (var i = 0; i < 4; i++)
    {
        if (result[i].checked)
        {
            R=result[i].value;
        }
    }


    if(memberid==seller_id.value) {
        $.ajax({
            url: URLs,
            data: {
                userID:buyer_id.value,
                score: score[0].value,
                result: R,
                advise: advise[0].value,
                book_id: showID()
            },
            type: "post",
            dataType: "json",//回傳資料用json檔
            success: function (data) {
                alert("ho");
            },
            error: function (err) {
                //alert(err.responseText);
            }
        });
    }
    else if(memberid==buyer_id.value){
        $.ajax({
            url: URLs,
            data: {
                userID:seller_id.value,
                score: score[0].value,
                result:  R,
                advise: advise[0].value,
                book_id: showID()
            },
            type: "post",
            dataType: "json",//回傳資料用json檔
            success: function (data) {
                alert("ho");
            },
            error: function (err) {
                //alert(err.responseText);
            }
        });
    }

}


function showID() {//取得book_id

    //URL
    var url = location.href;
    //取得問號之後的值
    var temp = url.split("?");
    //將值再度分開
    var vars = temp[1].split("=");
    // vars[1]就是id_book
    //一一顯示出來
    return vars[1];

}



