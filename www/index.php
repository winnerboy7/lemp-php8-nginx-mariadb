<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>File Upload with Ajax</title>
  <link rel="stylesheet" href="app.css" />
</head>

<body>
  <main>
    <div class="upload-form">
      <div class="form">
        <h1>File Upload</h1>
        <form class="form-controll" id="fileUploadForm" enctype="multipart/form-data">
          <input type="file" id="fileInput" name="fileInput" accept="image/*" required />
          <button class="btnUpload" type="submit">Upload</button>
        </form>
      </div>
      <div class="output">
        <div id="imageContainer">
          <!-- Uploaded image will be displayed here -->
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>