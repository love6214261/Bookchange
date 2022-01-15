/**
 * Created by HanLing Shen on 2016/7/4.
 */
window.onload = ADchose();

function showIndex() {
    location.assign("../../MainPage/MainPageController.php?action=ShowMainPage");
}
function ShowSignUpPage() {
    location.assign("../../AccountActivity/loginController.php?action=ShowSignUpPage");
}
function ShowLoginPage() {
    location.assign("../../AccountActivity/loginController.php?action=ShowLoginPage");
}
function ShowLogoutPage() {
    location.assign("../../AccountActivity/loginController.php?action=ShowLogoutPage");
}
function ShowMemberCenter() {
    location.assign("../../Member/MemberController.php?action=ShowFollowList");
}
function ShowPoolPage() {
    location.assign("../../WishingPool/WishingPoolController.php?action=ShowPoolPage");
}
function ShowUploadBookPage() {
    location.assign("../../BookManagement/BookController.php?action=ShowUploadBookPage");
}
function ShowChatRoomPage() {
    location = "../../Chat/ChatController.php?action=ShowChatRoomPage";
}
function ShowFreshManArea() {
    location = "../../Activity/ActivityController.php?action=ShowFreshmanPage";
}

function ShowHotSales() {
    location = "../MainPageController.php?action=ShowHotSales";
}
function ShowActivity() {
    location = "../MainPageController.php?action=ShowActivity";
}
function introduction() {
    location = "../../Activity/ActivityController.php?action=ShowWelcomePage";
}
function connectService() {//連絡客服人員
    location.assign("../../ContactUs/ContactUsController.php?action=ShowContactForm");
}
function ShowUserLaw() {
    location.assign("../MainPageController.php?action=ShowUserLaw");
}
function showPrivacy() {
    location.assign("../MainPageController.php?action=ShowPrivacy");
}
function showIntroSeller() {
    location.assign("../../MainPage/MainPageController.php?action=ShowIntroSeller");
}
function showIntroBuyer() {
    location.assign("../../MainPage/MainPageController.php?action=ShowIntroBuyer");
}
function showIntroRent() {
    location.assign("../../MainPage/MainPageController.php?action=ShowIntroRent");
}
function showWelcomePage() {
    location.assign("../MainPageController.php?action=ShowWelcomePage");
}
//Created by Peng 7/20 12:27 首頁導覽頁

$(document).ready(function () {

    $("#header").load("../../MainPage/View/header3.php #navigation",function getSession() {
        var URLs = "../../showSession.php";

        return $.ajax({
            url: URLs,
            data: null,
            type: "POST",
            async: true,
            dataType: "JSON",//回傳資料用json檔
            success: function (data) {
                //alert("AJAX SUCCESS!");

                if (data["session"] != null) {
                    $("#name").text("哈囉! " + data["session"] + " 您好!");
                    //chatNum();
                    //setInterval("chatNum()",5000);
                    /*$("#loginButton").text("登出");
                     $("#loginButton").attr("href","../../MainPage/MainPageController.php?action=connectLogout");

                     $("#signUpButton").text("會員中心");
                     $("#signUpButton").attr("href","../../MainPage/MainPageController.php?action=ShowMemberAreaPage");*/
                    $("#loginButton").text("登出");
                    $("#loginButton").attr("onclick", "ShowLogoutPage()");

                    $("#signUpButton").text("會員中心");
                    $("#signUpButton").attr("onclick", "ShowMemberCenter()");

                }
            },
            error: function () {

                $("#loginButton").text("登入");
                $("#loginButton").attr("onclick", "ShowLoginPage()");

                $("#signUpButton").text("註冊");
                $("#signUpButton").attr("onclick", "ShowSignUpPage()");


            }
        });

    });
    $("#footer").load("../../MainPage/View/footer.php #footer");

});

function getSessionAgain(){
    getSession();
}

//找書，以value傳值
function ShowSearchResultPage($keyword, $category) {
    location.assign("../../Search/View/SearchResultPage.html?key=" + encodeURIComponent($keyword) + "&cate=" + $category);
}
function Search() {
    var category = select.options[select.selectedIndex].value;
    var keyword = $('#search').val();

    ShowSearchResultPage(encodeURIComponent(keyword), category);

}
//右上角追蹤功能
function Love() {
    var URLs = "../../MyLove/MyLoveController.php?action=showMyLove";
    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            if (data.length == 0) {
                swal("尚未追蹤", "趕快追蹤您喜愛的書吧 ! ", "info").then(function (isConfirm) {
                });
            } else {
                $("#myLoveList").empty();
                for (var i = 0; i < data.length; i++) {
                    $bookName = data[i]['book_name'];
                    $book2price = data[i]['book_twoprice'];
                    $picNum = data[i]['book_picture'];
                    $bookID = data[i]['book_id'];
                    $("#myLoveList").append(
                        $("<li>").wrapInner('<span class="item"<span class="item-left"><img style="width: 20px; height: 30px;" src='+$picNum+' >' +
                            '<span class="item-info"> ' +
                            '<span><a onclick="GotoThatPage(' + $bookID + ')">' + $bookName + '</a></span>' +
                            '<span>$' + $book2price + '</span>' +
                            '</span>' +
                            '</span>' +
                            '<span class="item-right">' +
                            '<button class="btn btn-xs btn-danger pull-right " onclick="removeTrace()">x</button>' +
                            '</span>' +
                            '</span>'
                        ),
                        $("<td>").html($("<input>").attr({
                            "hidden": 'hidden',
                            'value': data[i]['trace_id'],
                            'id': 'traceID'
                        }))
                    )
                }
            }
        },
        error: function () {
            swal('尚未登入', '請先登入才能使用BookChange的功能喔!', "warning");
        }
    });

}

//右上角聊天功能
function Chat() {
    var URLs = "../../MainPage/MainPageController.php?action=connectChat";
    return $.ajax({
        url: URLs,
        data: {do: "content"},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            if (data.length == 0) {

            } else {
                $("#myChatList").empty();
                for (var i = 0; i < data.length; i++) {
                    $book_name = data[i]['book_name'];
                    $book_picture = data[i]['book_picture'];
                    $chat_content = data[i]['chat_content'];
                    $member_name = data[i]['member_name'];
                    $bookID = data[i]['book_id'];
                    $("#myChatList").append(
                        $("<li onclick='goToTradePage($bookID)'>").wrapInner(
                            '<span class="item"<span class="item"><img style="width: 20px; height: 30px;" src="../../assets/image/bookPic/' + $book_picture + '">' +
                            '<span  style="color: #00019a;text-decoration:underline;font-weight:bold;">' + $book_name + '</a></span>' +
                            '<br class="item-info"> ' +
                            '<span style="color: #2b669a; font-weight:bold;">' + $member_name + '</a></span></br>' +
                            '<span><span class="chatspan" >' + $chat_content + '</span></span>' +
                            '</span>' +
                            '</span>' +
                            '<HR color="black" size="1" >' +
                            '</span>'
                        )
                    )
                }
            }
        },
        error: function () {
            swal('尚未登入', '請先登入才能使用BookChange的功能喔!', "warning");
        }
    });

}
//右上角聊天數字
function chatNum() {
    var URLs = "../../MainPage/MainPageController.php?action=connectChat";
    return $.ajax({
        url: URLs,
        data: {do: "Num"},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            if (data == 0) {

            } else {
               return $("#chatNum").html(data);
            }
        },
        error: function () {

        }
    });
}
function removeTrace() {
    var URLs = "../../MyLove/MyLoveController.php?action=removeMyLove";

    return $.ajax({
        url: URLs,
        data: {traceID: $("#traceID").val()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            window.history.go(0);
        },
        error: function () {
            swal('請先登入!', '請先登入才可以租書，感謝您的配合!!', 'warning');
        }
    });
}

function GotoThatPage(page) {
    location.href = "../../BookManagement/View/bookInfo.html?value=" + page;
}
//
//廣告
$(window).load(function () {
    var $win = $(window),
        $ad = $('#abgne_float_ad').css('opacity', 0).show(),	// 讓廣告區塊變透明且顯示出來
        _width = $ad.width(),
        _height = $ad.height(),
        _diffY = 20, _diffX = 20,	// 距離右及下方邊距
        _moveSpeed = 800;	// 移動的速度

    // 先把 #abgne_float_ad 移動到定點
    $ad.css({
        top: $(document).height(),
        left: $win.width() - _width - _diffX,
        opacity: 1
    });

    // 幫網頁加上 scroll 及 resize 事件
    $win.bind('scroll resize', function () {
        var $this = $(this);

        // 控制 #abgne_float_ad 的移動
        $ad.stop().animate({
            top: $this.scrollTop() + $this.height() - _height - _diffY,
            left: $this.scrollLeft() + $this.width() - _width - _diffX
        }, _moveSpeed);
    }).scroll();	// 觸發一次 scroll()

    var close = 0;
    $('#abgne_float_ad .abgne_close_ad').click(function () {
        if (close == 0) {
            close = 1;
            $(".abgne_close_ad").html("放大廣告 [+]");
            $("#ADPicDIV").hide();
            ;
        } else {
            close = 0;
            $(".abgne_close_ad").html("縮小廣告 [-]");
            $("#ADPicDIV").show();
        }

    });
});

function ADchose() {
    var URLs = "../../MainPage/MainPageController.php?action=connectAD";

    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            $("#ADPic").attr({
                "src": "../../assets/image/bookPic/" + data['book_picture'],
                "onclick": "GotoThatPage(" + data['book_id'] + ")"
            });
        },
        error: function () {

        }
    });

}
function goToTradePage(bookID) {
    location = "../../Chat/View/chatroomConfirm.html?value=" + bookID
}

//三十分鐘後，自動登出
var oTimerId;
function Timeout(){
    window.open("../../AccountActivity/loginController.php?action=ShowLogoutPage","_top");
}
function ReCalculate(){
    clearTimeout(oTimerId);
    oTimerId = setTimeout('Timeout()', 30*60*1000);
}

document.onmousedown = ReCalculate;
document.onmousemove = ReCalculate;
ReCalculate();
