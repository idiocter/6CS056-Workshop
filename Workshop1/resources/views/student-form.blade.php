<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
</head>
<body>
    <h1>Student Registration</h1>

    <form method="POST" action="/student">
        @csrf

        <label for="name">Name:</label>
        <input id="name" type="text" name="name">

        <br><br>

        <label for="email">Email:</label>
        <input id="email" type="email" name="email">

        <br><br>

        <label for="age">Age:</label>
        <input id="age" type="number" name="age">

        <br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
