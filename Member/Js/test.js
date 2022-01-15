/**
 * Created by HanLing Shen on 2016/9/1.
 */
function test() {
    var obj = '{"Email":"hazel910159@gmail.com","password":"ciu199559"}';
    var URLs = "../../MemberController.php?action=connectAPP";

    return $.ajax({
        url: URLs,
        data: JSON.parse(obj),
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        complete: function (data) {
            location.assign("./active_before.html");
        }
    });
}
//有兩種解法: 1.連到../../MemberController.php?action=connectAPP"然後我自己做一個連結跳轉
//2.AJAX回傳，再跳轉到另外一個頁面(我有用SESSION做紀錄)