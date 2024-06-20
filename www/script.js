$(document).ready(function () {
  $("#fileUploadForm").submit(function (event) {
    event.preventDefault()

    // Create a FormData object to send the file
    var formData = new FormData(this)

    $.ajax({
      url: "upload.php", // Replace with your server-side script URL
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Display the uploaded image
        $("#imageContainer").html(
          '<img src="' + response + '" alt="Uploaded Image">'
        )
      },
    })
  })
})
