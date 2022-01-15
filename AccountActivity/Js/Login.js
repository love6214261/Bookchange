
var validator = $("#Signupform").validate({
    rules: { account: { required: true }  }
});
$("#submitB").click(function () {
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
});

