/**
 * Created by HanLing Shen on 2016/7/11.
 */


window.onload = allWishings();
function allWishings() {
    var URLs = "../WishingPoolController.php?action=connectPool";//this one

    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                $(".table").append(
                    $("<tr>").append(
                        $("<td>").html(data[i]['wishpool_date']),
                        $("<td>").html("      "),
                        $("<td>").html(data[i]['wishpool_bookname']),
                        $("<td>").html(data[i]['wishpool_author']),
                        $("<td>").html(data[i]['wishpool_condition']),
                        // $("<td>").html($("<input>").attr({
                        //     'value': "聯絡買家",
                        //     "type": "button",
                        //     "onclick": "GotoThatPage(" + data[i]['id_book'] + ")",
                        //     "id": data[i]['id_book']
                        // }))
                        $("<td>").html($("<input>").attr({
                            'value': "聯絡買家",
                            "type": "button",
                            "onclick": "getBuyerLink(this.id)",
                            "id": data[i]['member_profile']
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
function getBuyerLink($member_profile){
    location = $member_profile;
}
function wish() {
    
    location.href = "../WishingPoolController.php?action=ShowWishPage";
}

function wishExec() {
    var URLs = "../WishingPoolController.php?action=connectWish";//this one

    return $.ajax({
        url: URLs,
        data: {
            book_name: $("#book_name").val(),
            book_author: $("#book_author").val(),
            book_isbn: $("#book_isbn").val(),
            book_publishinghouse: $("#book_publishinghouse").val(),
            book_condition: $("#book_condition").val(),
            book_twoprice: $("#book_twoprice").val(),
        },
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            if (data == 'success') {
                swal('許願完成','天公伯聽到你的心願囉!','success').then(function(isConfirm) {
                    if (isConfirm == true) {
                       location.assign("../WishingPoolController.php?action=ShowPoolPage")
                    }
                });
            } else {
                swal('許願失敗','天公伯覺得少了些東西!','error').then(function(isConfirm) {
                    if (isConfirm == true) {
                        location.assign("../WishingPoolController.php?action=ShowWishPage")
                    }
                });
            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });

}

function test() {
    var URLs = "../WishingPoolController.php?action=getPoolSit";//this one

    return $.ajax({
        url: URLs,
        data: null,
        type: "POST",
        dataType: "json",//回傳資料用json檔
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                $(".table").append(
                    $("<tr>").append(
                        $("<td>").html(data[i]['wishpool_bookname']),
                        $("<td>").html(data[i]['wishpool_author']),
                        $("<td>").html(data[i]['wishpool_isbn'])
                    )
                )

            }
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}