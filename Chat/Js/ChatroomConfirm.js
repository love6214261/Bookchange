/**
 * Created by AllenHsu on 2016/8/3.
 */
var end;
window.onload=function() {
    end=document.getElementById("end");
};

$(document).on('click', '#end', function (e) {
    swal({
        title: '確定完成交易?',
        text: "按下確定表示您已完成交易。\n交易完成將會關閉您的聊天室!!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '無怨無悔',
        cancelButtonText: '考慮一下',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function(isConfirm) {
        if (isConfirm == true) {
            dealend();
        }
    })
    
});

function GotoThatPage() {
    location.href = "../../Evaluate/View/evaluate.html?value="+showID();
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

//改trade到交易完成
function dealend() {
    var URLs = "../../Trade/TradeController.php?action=connectUploadEvaluateDB";//this one

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
            GotoThatPage();
        }
    });
}
