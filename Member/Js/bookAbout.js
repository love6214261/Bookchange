/**
 * Created by HanLing Shen on 2016/8/8.
 */
function getFollowList() {
    var URLs = "../../MemberController.php?action=connectFollowList";

    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            for (var i = 0; i < data.length; i++) {

                $bookName = data[i]['book_name'];
                $bookSeller = data[i]['member_name'];
                $bookUpcondition = data[i]['book_upcondition'];
                $picNum = data[i]['book_picture'];

                $(".table").append(
                    $("<tr>").append(
                        $("<td>").wrapInner(
                            '<div class="media">' +
                            '<a class="thumbnail pull-left" href="#">' +
                            '<img class="bookPic" style="width: 72px; height: 72px;" src="' + $picNum + '">' +
                            '</a><div class="media-body">' +
                            '<h4 class="media-heading">書籍名稱:<a href="#">' + $bookName + '</a></h4>' +
                            '<h5 class="media-heading">賣家: <a href="#">' + $bookSeller + '</a></h5>' +
                            '<span>交易狀態: </span><span class="text-success"><strong>' + $bookUpcondition + '</strong></span></div></div>'
                        ),
                        $("<td>").html(data[i]['book_price']),
                        $("<td>").html(data[i]['book_twoprice']),
                        $("<td>").wrapInner('<button type="button" onclick="removeTrace()" class="btn btn-danger">' +
                            '<span class="glyphicon glyphicon-remove"></span> 取消追蹤</button>'),
                       $("<td>").html($("<input>").attr({"hidden":'hidden','value':data[i]['book_id'],'id':'bookID'})),
                        $("<td>").html($("<input>").attr({"hidden":'hidden','value':data[i]['trace_id'],'id':'traceID'}))
                    )
                )
            }
        },
        error: function () {
        }
    });
}

function removeTrace() {
    var URLs = "../../../MyLove/MyLoveController.php?action=removeMyLove";

    return $.ajax({
        url: URLs,
        data: {traceID: $("#traceID").val()},
        type: "POST",
        dataType: "JSON",//回傳資料用json檔
        success: function (data) {
            //alert("AJAX SUCCESS!");
        window.history.go(0);
        },
        error: function () {
            swal('請先登入!', '請先登入才可以租書，感謝您的配合!!', 'warning');

        }
    });


}