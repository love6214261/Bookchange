
var peopleNum;//現在有幾人


//回傳用戶身分

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

function getOldMSG() {

    var $$ = function (id) {
        return document.getElementById(id) || null;
    };

    var URLs = "../ChatController.php?action=connectChatDB";//this one
    $('#message').val(' ');
    return $.ajax({
        url: URLs,
        data: {book_id: showID()},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {

            //var row = data.length;//增加的列數
            for (var i = 0; i < data.length; i++) {
                // alert(data[i]['name']);
                var text = data[i]['member_name'] + '  說:\n' + data[i]['chat_content'] + '\n\n';
                $$('message').value += text;
                $$('message').scrollTop = $$('message').scrollHeight;
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });

}


$(document).ready(function (e) {

    getOldMSG();//每次打開都會自動載入舊的訊息
    var $$ = function (id) {
        return document.getElementById(id) || null;
    };
    var wsServer = 'ws://140.115.80.226:8080';
    var ws = new WebSocket(wsServer);
    var isConnect = false;
    ws.onopen = function (evt) {
        onOpen(evt)
    };
    ws.onclose = function (evt) {
        onClose(evt)
    };
    ws.onmessage = function (evt) {
        onMessage(evt)
    };
    ws.onerror = function (evt) {
        onError(evt)
    };

    //為了Get用戶名字
    var Name;//用戶名稱
    var ID;
    getUserData();
    function getUserData() {

        var URLs = "../../showSession.php";

        return $.ajax({
            url: URLs,
            data: null,
            type: "POST",
            dataType: "JSON",//回傳資料用json檔
            success: function (data) {
                Name = data['session'];
                ID = data['userID'];
                peopleID();
            },
            error: function () {
            }
        });
    }

    function onOpen(evt) {
        console.log("連結伺服器成功");
        isConnect = true;
    }

    function onClose(evt) {
        //console.log("Disconnected");
    }

    function onMessage(evt) {

        var data = JSON.parse(evt.data);
        switch (data.type) {
            case 'text':
                getOldMSG();//在這邊拿出資料庫的訊息，才會即時更新
                document.getElementById('message').scrollTop =   document.getElementById('message').scrollHeight;
                break;
            case 'num' :
                updataUserNum(data.msg);
                break;
        }

        console.log('Retrieved data from server: ' + evt.data);
    }

    function onError(evt) {
        //console.log('Error occured: ' + evt.data);
    }

    function sendMsg() {
        if (isConnect) {
            saveMsg($$('input').value);//在這邊儲存訊息，就只會存一次
            ws.send($$('input').value);
            $$('input').value = "";
        }
    }
/*
    function addMsg(msg) {

        msg = JSON.parse(msg);
        $$('message').scrollTop = $$('message').scrollHeight;
    }
*/
    function updataUserNum(msg) {
        peopleNum = msg;
        $$('userNum').innerText = msg;
    }

//儲存訊息用
    function saveMsg(msg) {
        var URLs = "../ChatController.php?action=connectChatUploadDB";//this one
        return $.ajax({
            url: URLs,
            data: {msg: msg,userID:ID,book_id: showID(),peopleNum:peopleNum,peopleID:peopleIDentity},
            type: "post",
            dataType: "json",//回傳資料用json檔
            success: function (data) {
            },
            error: function (err) {
                // alert(err.responseText);
            }
        });

    }

    $$('sub').addEventListener("click", sendMsg, false);


});



