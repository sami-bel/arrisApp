$(document).ready(function() {

  $('#extract-email').click(function () {
      let filename = $('#eml-file-name').val().replace("C:\\fakepath\\", "");
      extractEmail(filename, $('#eml-file-name').attr('data-url'));
  })

});

function extractEmail(filename, url) {

  if (filename === 'undefined' || filename === '')
  {
    return;
  }

  let data = {
    filename: filename
  };

  console.log(data,url);
  $.post(url, data)
    .done(function(emails) {
      $('#email-list').empty();
      $('#email-list').append(emails);
    })
    .fail(function (result) {
      alert('error');
    });
}