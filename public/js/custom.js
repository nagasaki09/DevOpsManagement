$(document).ready(function () {


    $(".submenu > a").click(function (e) {
        e.preventDefault();
        var $li = $(this).parent("li");
        var $ul = $(this).next("ul");

        if ($li.hasClass("open")) {
            $ul.slideUp(350);
            $li.removeClass("open");
        } else {
            $(".nav > li > ul").slideUp(350);
            $(".nav > li").removeClass("open");
            $ul.slideDown(350);
            $li.addClass("open");
        }
    });

});

//予定削除の確認ダイアログ
function deploycheck() {
     var myRet = confirm("本当にデプロイしてもよろしいですか？");
    if (myRet === true) {
        $.ajax({
            type: "GET",
            url: "/deploy/execution"
        });
        success: function () {
            console.log("デプロイを行いました");
        };

    }};