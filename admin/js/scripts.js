// Initialize text editor
tinymce.init({ selector:'textarea' });

$(document).ready(function () {
  // Initialize select all checkbox
  $('#selectAllBoxes').click(function (event) {

    if (this.checked) {
      $('.checkBoxes').each(function () {
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function () {
        this.checked = false;
      });
    }
  });

  // loader
  var div_box = "<div id='load-screen'><div id='loading'></div></div>";

  $("body").prepend(div_box);

  $("#load-screen").delay(400).fadeOut(500, function () {
    $(this).remove();
  });
});
