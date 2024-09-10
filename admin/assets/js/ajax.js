$(document).ready(function() {
    // Xử lý sự kiện thay đổi cho phần tử danh mục trong form chính
    $("#category").change(function() {
        var idcate = $(this).val();

        // Gửi yêu cầu AJAX
        $.ajax({
            url: "index.php?admin=product",
            method: "POST",
            data: { idcate: idcate },
            success: function(data) {
                $("#load").html(data);
            },
            error: function() {
                alert("Đã xảy ra lỗi khi tải dữ liệu");
            }
        });
    });

    // Đảm bảo sự kiện change trên modal được gán đúng khi modal hiển thị
    $('#myModal').on('shown.bs.modal', function() {
        $("#modal_category").change(function() {
            var idcate = $(this).val();

            // Gửi yêu cầu AJAX
            $.ajax({
                url: "index.php?admin=product",
                method: "POST",
                data: { idcate: idcate },
                success: function(data) {
                    $("#modal_category_details").html(data);
                },
                error: function() {
                    alert("Đã xảy ra lỗi khi tải dữ liệu");
                }
            });
        });
    });
});