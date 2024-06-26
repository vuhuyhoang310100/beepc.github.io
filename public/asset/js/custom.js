$(document).ready(function(){
  
    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function(){
      var onStar = parseInt($(this).data('value'), 10); 
     
      // Now highlight all the stars that's not after the current hovered star
      $(this).parent().children('li.star').each(function(e){
        if (e < onStar) {
          $(this).addClass('hover');
        }
        else {
          $(this).removeClass('hover');
        }
      });
      
    }).on('mouseout', function(){
      $(this).parent().children('li.star').each(function(e){
        $(this).removeClass('hover');
      });
    });
    
    
    /* 2. Action to perform on click */
    $('#stars li').on('click', function(){
      var onStar = parseInt($(this).data('value'), 10); // The star currently selected
      var stars = $(this).parent().children('li.star');
      var product_id = $(this).data("product_id");
      var userId = window.userId;

      
      for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
      }
      
      for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
      }
      
      // JUST RESPONSE (Not needed)
      var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);

      var msg = "";
      if (!userId) {
        responseMessage("Hãy đăng nhập để đánh giá");
        return;}
    else{
      if (ratingValue > 1) {
          msg = "Căm ơn bạn đã đánh giá " + ratingValue + " sao.";
      }
      else {
          msg = "Chỉ được " + ratingValue + " sao, chúng tôi sẽ cải thiện sản phẩm và dịch vụ.";
      }}
      responseMessage(msg);
      
      $.ajax({
        url:"index.php?act=rating",
        method:"POST",
        data:{product_id: product_id,user_id: userId, ratingValue: ratingValue},
        success:function(data){
            if(data=='done'){
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            }
            else {
                msg="Lỗi đánh giá";
            }
        } 
      });
    });
    
    
  });
  
  
  function responseMessage(msg) {
    $('.success-box').fadeIn(200);  
    $('.success-box div.text-message').addClass("alert alert-warning").html("<span>" + msg + "</span>");
    setTimeout(function() {
        $('.success-box').fadeOut(200);
    }, 3000);
  }