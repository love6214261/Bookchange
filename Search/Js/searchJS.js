/**
 * Created by HanLing Shen on 2016/7/20.
 */
window.onload=showkeyword();
function search($keyword,$category){
    var URLs = "../SearchController.php?action=connectSearchResultPage";//this one

    return $.ajax({
        url: URLs,
        data:{keyword:decodeURIComponent($keyword),category:$category},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {

            
                for (var i = 0; i < data.length; i++) {
                    $(".table").append(
                        $("<tr>").append(
                            $("<td width='20%'>").html($("<img>").attr({"src":data[i]['book_picture'],'width':"40%","height":"30%"})),
                            $("<td>").html(data[i]['book_name']),
                            $("<td>").html(data[i]['book_author']),
                            $("<td>").html(data[i]['book_publishinghouse']),
                            $("<td>").html(data[i]['book_twoprice']),
                            $("<td>").html($("<input>").attr({'value':"查看詳情","type":"button","onclick":"GotoThatPage("+data[i]['book_id']+")","id":data[i]['book_id']}))
                            // $("#bookName").attr("value", data[i]['name']);
                        //$("#ISBN").attr("value", data[i]['ISBN']);
                        //$("#author").attr("value", data[i]['author']);
                        // $("#price").attr("value", data[i]['price']);
                    )
                )

            }

        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function showkeyword() {//
    //URL
    var url = location.href;

    //取得問號之後的值
    var temp = url.split("?");
    //將值再度分開
    var vars = temp[1].split("&");
    //一一顯示出來
    var key = vars[0].split("=");
    var con = vars[1].split("=");
    search(decodeURIComponent(key[1]),con[1]);


}


function GotoThatPage(page) {

    location.href = "../../BookManagement/View/bookInfo.html?value="+page;


}