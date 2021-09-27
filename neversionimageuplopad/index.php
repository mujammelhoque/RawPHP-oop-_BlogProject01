<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>PHP implementation : Multiple File Upload</h1>
<br><br><br>
<form action="upload.php" method="post" enctype="multipart/form-data">
<label for="">Select Files:</label>
<input type="file" name="fileUpload[]" multiple>
<input type="submit" name="submit" value="Upload">



</form>
</body>
</html>