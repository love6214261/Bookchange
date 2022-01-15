$(document).ready( function (e) {
    $(function(){
         $("#addClass").click(function () {
            $('#qnimate').addClass('popup-box-on');
             peopleID();
             document.getElementById('message').scrollTop =   document.getElementById('message').scrollHeight;
        });
        $("#removeClass").click(function () {
            $('#qnimate').removeClass('popup-box-on');
        });
    });
});

var peopleIDentity;// 用戶的身分
function peopleID(){
    var URLs = "../ChatController.php?action=connectChatCheckID";//this one
    return $.ajax({
        url: URLs,
        data: {book_id:showID()},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            switch (data){
                case 'buyer':
                    peopleIDentity = 'buyer';
                    break;
                case 'seller':
                    peopleIDentity = 'seller';
                    break;
            }
        },
        error: function (err) {
            // alert(err.responseText);
        }
    });
}