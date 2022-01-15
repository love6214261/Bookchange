/**
 * Created by HanLing Shen on 2016/7/10.
 */
/**
 * Created by HanLing Shen on 2016/7/7.
 */
//可以用迴圈顯示
window.onload = getBookInfo();
// window.onload = ifAddedInRentList();
function getBookInfo() {
    var URLs = "../BookController.php?action=connectBookInfo";//this one
    return $.ajax({
        url: URLs,
        data: {book_id: showID()},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            for (var i = 0; i < data.length; i++) {

                $("#book_picture").attr("src", data[i]["book_picture"]);
                $("#book_name").text("書名 : " + data[i]["book_name"]);
                $("#book_isbn").text("ISBN : " + data[i]["book_isbn"]);
                $("#book_author").text("作者 : " + data[i]["book_author"]);
                $("#book_publishinghouse").text("出版社 : " + data[i]["book_publishinghouse"]);
                $("#book_twoprice").text("定價 : " + data[i]["book_twoprice"]);
                $("#book_category").text(data[i]["book_class"]);
                $(".book_sellerID").text(data[i]["member_name"]);
                $("#seller_score").text(data[i]["member_score"] + '( ' + data[i]["member_tradeNum"] + ' )');
                //$(".book_sellerID").attr("id", data[i]["member_profile"]);
                if (data[i]["book_upcondition"] == "交易中") {
                    $("#i_buy").attr({'style': " display:none "});
                }
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
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
function confirmDeal() {//確認使用者是否登入
    var URLs = "../../showSession.php";

    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            //alert("AJAX SUCCESS!");

            if (data["session"] != null ) {
                swal({
                    title: '確定要買書嗎?',
                    text: "按下確定表示您同意使用者條約。\n若媒合成功，請勿任意棄租，感謝您的配合!",
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
                        deal(data["userID"]);
                    }
                })
            } else {
                swal('會員驗證程序', '您好，請先完成會員驗證程序才能租書，感謝您的配合!', 'warning');
            }
        },
        error: function () {
            swal('請先登入!', '請先登入才可以使用書城，感謝您的配合!!', 'warning').then(function (isConfirm) {
                if (isConfirm == true) {
                    location.assign("../../AccountActivity/loginController.php?action=ShowLoginPage");
                }
            });

        }
    });
}


function deal($userID) {//將使用者加入追蹤名單
    var URLs = "../../Trade/TradeController.php?action=connectWaitList";

    return $.ajax({
        url: URLs,
        data: {userID: $userID, bookID: showID(), RorB: "buy", allowtime: "0"},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            swal('已通知賣家', '請耐心等候賣家回應!', 'success')
            $("#i_buy").attr({'style': " display:none "});
        },
        error: function () {
        }
    });
}

function addMyLove() {
    var URLs = "../../showSession.php";

    return $.ajax({
        url: URLs,
        data: {page: showID()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            //alert("AJAX SUCCESS!");

            if (data["session"] != null ) {

                var URLs2 = "../../MyLove/MyLoveController.php?action=connectMyLove";//this one
                return $.ajax({
                    url: URLs2,
                    data: {page: showID()},
                    type: "post",
                    dataType: "json",//回傳資料用json檔
                    success: function (data) {
                        swal('加入成功!', '成功加入最愛名單囉!', 'success');
                    },
                    error: function (err) {
                        alert(err.responseText);
                    }
                });

            } else {
                swal('會員驗證程序', '您好，請先完成會員驗證程序才能使用書城，感謝您的配合!', 'warning');
            }
        },
        error: function () {
            swal('請先登入!', '請先登入才可以使用書城，感謝您的配合!!', 'warning').then(function (isConfirm) {
                if (isConfirm == true) {
                    location.assign("../../AccountActivity/loginController.php?action=ShowLoginPage");
                }
            });
        }
    });

    return $.ajax({
        url: URLs,
        data: {page: showID()},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            swal('加入成功!', '成功加入最愛名單囉!', 'success');
        },
        error: function (err) {
            alert(err.responseText);
        }
    });

}

function RentBook() {//租書檢查
    var URLs = "../../showSession.php";

    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            //alert("AJAX SUCCESS!");

            if (data["session"] != null ) {
                // alert(data["userID"]);
                swal({
                    title: '確定要租書嗎?',
                    text: "按下確定表示您同意使用者條約。\n若媒合成功，請勿任意棄租，感謝您的配合!",
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
                        rent(data["userID"]);
                    }
                })

            } else {
                swal('會員驗證程序', '您好，請先完成會員驗證程序才能租書，感謝您的配合!', 'warning');
            }
        },
        error: function () {
            swal('請先登入!', '請先登入才可以使用BookChange，感謝您的配合!!', 'warning').then(function (isConfirm) {
                if (isConfirm == true) {
                    location.assign("../../AccountActivity/loginController.php?action=ShowLoginPage");
                }
            });
        }
    });
}

function dealok() {
    var URLs = "../../Trade/TradeController.php?action=connectUploadTradeDB";//this one

    $.ajax({
        url: URLs,
        data: {
            book_id: showID()
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
}

function rent($userID) {//將使用者加入租書候補
    var URLs = "../../Trade/TradeController.php?action=connectWaitList";
    var rentday;
    rentD = document.getElementById("rentday");

    switch (rentD.value) {
        case "兩個禮拜":
            rentday = "14";
            break;
        case "一個月":
            rentday = "30";
            break;
        case "一學期":
            rentday = "120";
            break;
        case "一學年":
            rentday = "365";
            break;
        default:
            alert("你沒有選時間!");
    }
    ;

    return $.ajax({
        url: URLs,
        data: {userID: $userID, bookID: showID(), RorB: "rent", allowtime: rentday},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            $("#rentButton").attr("hidden", "hidden");
            swal('已通知賣家了!', data["msg"], 'success');

        },
        error: function () {

        }
    });
}

function ifAddedInRentList() {
    var URLs = "../../RentBook/RentBookController.php?action=ifAddedInRentlist";

    return $.ajax({
        url: URLs,
        data: {bookID: showID()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            $("#rentButton").attr("hidden", "hidden");
        },
        error: function () {

        }
    });

}

function goToPublicPage($sellerID) {
    location = "../../PublicPage/View/MemberPage.html?value=" + $sellerID;
}

function sellerProfile($sellerProfile) {

    location = $sellerProfile;
}

/*function sellerProfile($sellerProfile) {
    var URLs = "../Control/ShowSellerProfile.php";

    return $.ajax({
        url: URLs,
        data: {page: showID()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            //alert("AJAX SUCCESS!");

            if (data["session"] != null ) {

                var URLs2 = "../../MyLove/MyLoveController.php?action=connectMyLove";//this one
                return $.ajax({
                    url: URLs2,
                    data: {page: showID()},
                    type: "post",
                    dataType: "json",//回傳資料用json檔
                    success: function (data) {
                        swal('加入成功!', '成功加入最愛名單囉!', 'success');
                    },
                    error: function (err) {
                        alert(err.responseText);
                    }
                });

            } else {
                swal('會員驗證程序', '您好，請先完成會員驗證程序才能使用書城，感謝您的配合!', 'warning');
            }
        },
        error: function () {
            swal('請先登入!', '請先登入才可以使用BookChange，感謝您的配合!!', 'warning').then(function (isConfirm) {
                if (isConfirm == true) {
                    location.assign("../../AccountActivity/loginController.php?action=ShowLoginPage");
                }
            });
        }
    });
}*/