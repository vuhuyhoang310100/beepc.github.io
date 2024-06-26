$(document).ready(function(){
    $("#category").change(function(){
        var idcate = $(this).val();
        
    
        // Gửi yêu cầu AJAX
        $.ajax({
            url: "index.php?admin=product",
            method: "POST",
            data: { idcate: idcate },
            success: function(data){ 
                // Cập nhật phần tử có id "load" với dữ liệu trả về từ action.php
                $("#load").html(data);
            },
            error: function(){
                // Xử lý lỗi nếu có
                alert("Đã xảy ra lỗi khi tải dữ liệu");
            }
        });
    });
});
