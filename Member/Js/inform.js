/*8/21 memberInform.html解讀*/
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

function where() {
    var URLs = "../../MemberController.php?action=connectInformData";

    return $.ajax({
        url: URLs,
        data: {ID: showID()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            switch (showID()) {
                case 'BuyerChat':
                    $(".table").append(
                        $("<tr>").append(
                            $("<th style='width: 20%'>").html("書名"),
                            $("<th>").html("對話內容"),
                            $("<th>").html("買家名稱"),
                            $("<th>").html("")
                        )
                    )
                    for (var i = 0; i < data.length; i++) {
                        $(".table").append(
                            $("<tr>").append(
                                $("<td>").html(data[i]['book_name']),
                                $("<td class='chattext'>").html(data[i]['chat_content']),
                                $("<td>").html(data[i]['member_name']),
                                $("<td>").html($("<input>").attr({'value': "進入交易頁面", "type": "button","onclick":"goToTradePage("+data[i]['book_id']+")"}))
                            )
                        )
                    }
                    break;
                case 'SellerChat':
                    $(".table").append(
                        $("<tr>").append(
                            $("<th style='width: 20%'>").html("書名"),
                            $("<th>").html("對話內容"),
                            $("<th>").html("賣家名稱"),
                            $("<th>").html("")
                        )
                    )
                    for (var i = 0; i < data.length; i++) {
                        $(".table").append(
                            $("<tr>").append(
                                $("<td>").html(data[i]['book_name']),
                                $("<td class='chattext'>").html(data[i]['chat_content']),
                                $("<td>").html(data[i]['member_name']),
                                $("<td>").html($("<input>").attr({'value': "進入交易頁面", "type": "button","onclick":"goToTradePage("+data[i]['book_id']+")"}))
                            )
                        )
                    }
                    break;
                case 'EvalNew':
                    $(".table").append(
                        $("<tr>").append(
                            $("<th style='width: 20%'>").html("書名"),
                            $("<th>").html("評分"),
                            $("<th>").html("評價建議"),
                            $("<th>").html("交易狀況"),
                            $("<th>").html("交易對象")
                        )
                    )
                    for (var i = 0; i < data.length; i++) {
                        $(".table").append(
                            $("<tr>").append(
                                $("<td>").html(data[i]['book_name']),
                                $("<td>").html(data[i]['evaluation_score']),
                                $("<td>").html(data[i]['evaluation_advise']),
                                $("<td>").html(data[i]['evaluation_condition']),
                                $("<td>").html(data[i]['member_name'])
                            )
                        )
                    }
                    break;
                case 'EvalNot':
                    $(".table").append(
                        $("<tr>").append(
                            $("<th style='width: 20%'>").html("書名"),
                            $("<th>").html("交易對象"),
                            $("<th>").html("評價截止日"),
                            $("<th>").html("")
                        )
                    )
                    for (var i = 0; i < data.length; i++) {
                        $(".table").append(
                            $("<tr>").append(
                                $("<td>").html(data[i]['book_name']),
                                $("<td>").html(data[i]['member_name']),
                                $("<td>").html(data[i]['trade.trade_end+INTERVAL 2 DAY']),
                                $("<td>").html($("<input>").attr({'value': "評價去 !", "type": "button","onclick":"goToEvalPage("+data[i]['book_id']+")"}))

                            )
                        )
                    }

                    break;

            }

        },
        error: function () {
        }
    });
}

function goToTradePage(bookID) {
    location = "../../../Chat/View/chatroomConfirm.html?value="+bookID
}

function goToEvalPage(bookID) {
    location = "../../../Evaluate/View/evaluate.html?value="+bookID
}