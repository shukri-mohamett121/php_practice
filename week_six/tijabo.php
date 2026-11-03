<!DOCTYPE html>
<html>
<head>
    <title>jQuery Events</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <h2 id="title">Hello Student</h2>

    <button id="saveBtn">Click Me</button>

    <script>

        $('#saveBtn').on('click', function() {

            $('#title').text('Button Clicked!');

        });

    </script>

</body>
</html>