/**
 * Created by HanLing Shen on 2016/7/7.
 */
//可以用迴圈顯示

window.onload = getBookArray(1);
function getBookArray(num) {
    var URLs = "../BookController.php?action=connectBookPage";//this one

    return $.ajax({
        url: URLs,
        data:{page:showPage(),num:num},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            j=num;
            $("#page").empty();

            $("#page").append(
                $("<li>").html("<a onclick='getBookArray(" + (j-1)  + ")'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>"),
                $("<li>").html("<a onclick='getBookArray(" + j + ")'>" + j + "</a>").attr({'class':"active"}),
                $("<li>").html("<a onclick='getBookArray(" + (j+1) + ")'>" +(j+1)+ "</a>"),
                $("<li>").html("<a onclick='getBookArray(" + (j+2)+ ")'>" + (j+2) + "</a>"),
                $("<li>").html("<a onclick='getBookArray(" + (j+3) + ")'>" + (j+3) + "</a>"),
                $("<li>").html("<a onclick='getBookArray(" + (j+4)+ ")'>" + (j+4)+ "</a>"),
                $("<li>").html("<a onclick='getBookArray(" + (j+1)  + ")'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a>")
            );
            //var row = data.length;//增加的列數
            // document.getElementById("table").insertRow(row);
            //alert(data.length);
            $(".table").empty();
            $(".table").append(

                $("<tr>").append(
                    $("<th>").html("書籍封面"),
                    $("<th>").html("書籍名稱"),
                    $("<th>").html("書籍作者"),
                    $("<th>").html("出版社"),
                    $("<th>").html("二手價格"),
                    $("<th>").html("             ")
                )
            );
            for (var i = 0; i < data.length; i++) {
                if(data[i]['book_upcondition']=="上架中") {

                    $(".table").append(
                        $("<tr>").append(
                            $("<td>").html($("<img>").attr({
                                'src': data[i]['book_picture'],
                                "style": "height: auto; width:50px;"
                            })),
                            $("<td>").html(data[i]['book_name']),
                            $("<td>").html(data[i]['book_author']),
                            $("<td>").html(data[i]['book_publishinghouse']),
                            $("<td>").html(data[i]['book_twoprice']),
                            $("<td>").html($("<input>").attr({
                                'value': "查看詳情",
                                "type": "button",
                                "onclick": "GotoThatPage(" + data[i]['book_id'] + ")",
                                "id": data[i]['book_id']
                            }))
                            //$("#ISBN").attr("value", data[i]['ISBN']);
                            //$("#author").attr("value", data[i]['author']);
                            // $("#price").attr("value", data[i]['price']);
                        )
                    );

                }
            }

        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}

function ShowSignUpPage() {
    location = "../../MainPage/MainPageController.php?action=ShowSignUpPage";
}

function GotoThatPage(page) {

    location.href = "../View/bookInfo.html?value="+page;


}


function showPage() {//
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


