/**
 * Created by admin on 2016/8/14.
 */
window.onload= uploading();

function uploading() {
    var URLs = "../../MemberController.php?action=connectWaitChoice";//this one

    return $.ajax({
        url: URLs,
        data:{book_id:showID()},
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            
            for (var i = 0; i < data.length; i++) {
               
                    $("#table").append(
                        $("<tr>").append(
                            $("<td>").html(data[i]['book_name']),
                            $("<td>").html(data[i]['member_name']),
                            $("<td>").html(data[i]['member_score']),
                            $("<td>").html(data[i]['waitlist_RorB']),
                            $("<td>").html($("<input>").attr({
                                'value': "進入交易",
                                "type": "button",
                                "onclick": "dealok("+data[i]['member_id']+")"
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

function dealok(id) {
    var URLs = "../../../Trade/TradeController.php?action=connectUploadTradeDB";//this one

    $.ajax({
        url: URLs,
        data: {
            book_id: showID(),
            RorB:'buy',
            buyer_id:id
        },
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            alert("ho");
        },
        error: function (err) {
            alert(err.responseText);
            GotoThatPage(showID());
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

function GotoThatPage(page) {
    location.href = "../../../Chat/View/chatroomConfirm.html?value="+page;
}