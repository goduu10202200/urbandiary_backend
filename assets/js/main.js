// 點擊跳轉畫面
$(document).ready(function(){
    //跳轉至使用者
    // var $users = $(".col-sm-3");
    // $users.click(function(){
    //     window.location.href="user.html";
    // });

    //上一頁
    var $backing = $("#back_pic");
    $backing.click(function(){
        history.go(-1);
    });

    //跳轉至使用日記列表
    var $diary = $(".col-sm-2");
    $diary.click(function(){
        window.location.href="diary_analysis.html";
    });
});