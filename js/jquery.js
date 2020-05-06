$(function(){
    $('#logout').on('click', function(){
        if(confirm('ログアウトしますか？')) {
            location.href = 'staff_logout.php';
        }else {
            return false;
        }
    });

    $('body.shop-page #shopLogout').on('click', function(){
        if(confirm('ログアウトしますか？')) {
            location.href = 'member_logout.php';
        }else {
            return false;
        }
    });

    $('body.shop-page #delete').on('click', function(){
        if(confirm('この商品をカートから削除しますか？')) {
            location.href = 'product_delete.php';
        }else {
            return false;
        }
    });
    
    $('#count-change').on('change', function(){
        $(this).parent().parent().append('<p style="color: red; font-weight: bold;">数量を変更した場合は必ず数量変更ボタンを押してください</p>');
    });
})