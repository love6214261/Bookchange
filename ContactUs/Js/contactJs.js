/**
 * Created by Ma on 2016/7/22.
 */
function submitt() {
    $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#00FFFF',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#0000AA'
    } });
    setTimeout($.unblockUI, 3000);
    var URLs = "../ContactUsController.php?action=connectContact";//this one
    var select = document.getElementById("ProblemSelect");
    var category = select.options[select.selectedIndex].value;
    return $.ajax({
        url: URLs,
        data:{select:category,subject:$("#subject").val(),body:$("#body").val()},
        type: "post",
        dataType: "json",//回傳資料用json檔
        success: function (data) {

            swal('天公伯通訊',"天公伯聽到您的怨言了!",'success');
        },
        error: function (err) {
            swal('天公伯通訊',"天公伯聽到您的怨言了!",'success');
        }
    });
    
}
