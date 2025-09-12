 $(document).ajaxSend(function() {
  $('#loader-overlayAjax').fadeIn();
});

// Hide loader overlay when AJAX request is complete
$(document).ajaxComplete(function() {
  $('#loader-overlayAjax').fadeOut();
});

