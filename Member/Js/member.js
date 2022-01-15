/*8/22 會員開通帳號*/
window.onload = getEmail();
function getEmail() {
    var URLs = "../../MemberController.php?action=connectEmail";
    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            $("#email2").attr({"value": data['email']});
            $("#password").attr({"value": data['password']});
        },
        error: function () {
        }
    });

}
function active() {
    var URLs = "../../MemberController.php?action=connectActive";
    return $.ajax({
        url: URLs,
        data: {num: $("#veryNum").val()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            if (data == "success") {
                swal('驗證成功', '趕快使用書城的超多功能吧! :D', 'success').then(function (isConfirm) {
                    if (isConfirm == true) {
                        location.assign("../../../MainPage/MainPageController.php?action=ShowMainPage");
                    }
                });
            } else {
                swal('驗證失敗', '您可能輸入錯誤 :(', 'error');
            }

        },
        error: function () {
        }
    });
}
/**
 * Created by HanLing Shen on 2016/8/22.
 */
