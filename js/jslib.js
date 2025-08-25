$(function () {
    $(".card .row.mt-2 .col-md-4 a").mouseover(function () {
        let imgsrc = $(this).children("img").attr("src");
        $("#showGoods").attr({
            "src": imgsrc
        });
    });
});
$(".fancybox").fancybox();

function addcart(p_id) {
    let qty = $('#qty').val();
    if (qty <= 0) {
        alert('產品數量不得為0或負數');
        return (false);
    }
    if (qty == undefined) {
        qty = 1;
    } else if (qty >= 50) {
        alert('由於採購限制，產品數量限制在50以下');
        return (false);
    }
    //ajax call addcart.php
    $.ajax({
        url: 'addcart.php',
        type: 'get',
        dataType: 'json',
        data: {
            p_id: p_id,
            qty: qty,
        },
        success: function (data) {
            if (data.c == true) {
                alert(data.m);
                window.location.reload();
            } else {
                alert(data.m);
            }
        },
        error: function (data) {
            alert("目前無法連接到資料庫。");
        }
    });
}