// live search
$(document).ready(function(){
  $(".search").on('keyup', function(){
    var searchUser = $(this).val();
  
    $.ajax({
      url: "../include/ajax_search.php",
      type: "POST",
      data: { search: searchUser },
      success: function(data) {
        $(".left-chat-list ul").html(data);
      }
    });
  });
});