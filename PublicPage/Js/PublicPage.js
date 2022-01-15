/**
 * Created by HanLing Shen on 2016/8/10.
 */
window.onload = getProfile();
window.onload = getEvalution();

function getProfile() {
    var URLs = "../PublicPageController.php?action=connectMemberPage";

    return $.ajax({
        url: URLs,
        data: {member_id: showMemberID()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            $("#member_name").html("會員名稱 : " + data['member_name']);
            $("#member_department").html("系級 : " + data['member_department']);
            $("#member_school").html("學校 : " + data['member_school']);
            $("#member_score").html("評價 : " + data['member_score']);
        },
        error: function () {
        }
    });

}

function getEvalution() {
    var URLs = "../PublicPageController.php?action=connectMemberPageEval";

    return $.ajax({
        url: URLs,
        data: {member_id: showMemberID()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                $(".table").append(
                    $("<tr>").append(
                        $("<td>").html(data[i]['evaluation_score']),
                        $("<td>").html(data[i]['evaluation_advise']),
                        $("<td>").html(data[i]['trade_condition']),
                        $("<td>").html(data[i]['evaluation_date'])
                    )
                )
            }
        },
        error: function () {
        }
    });

}
function showMemberID() {//取得book_id

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