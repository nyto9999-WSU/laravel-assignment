<!DOCTYPE html>
<html>
<head>
    <title>Aircon Order</title>
</head>
<body>
    <h1>You can download Order PDF file here.</h1>
    <p>{{ url("/pdf/". $data['filename']) }}</p>
   
    <p>Thank you</p>
</body>
</html>