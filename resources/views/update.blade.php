<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }


    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    form button {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin-top: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    form button:hover {
        background-color: #45a049;
    }

    p {
        margin-top: 20px;
        color: #666;
    }

    p a {
        color: #4CAF50;
        text-decoration: none;
    }

    p a:hover {
        text-decoration: underline;
    }

</style>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    
<form action="{{ route('update_user') }}" method="POST">
        @csrf
        <input type="hidden" id="id" name="id" value="{{$id}}" required>
        <label for="name">New Name:</label>
        <input type="text" id="Newname" name="Newname" value="{{$name}}" required>
        <br>
        <label for="email">New Email:</label>
        <input type="email" id="Newemail" name="Newemail" value="{{$email}}" required>
        <br>
        <button type="submit"> Update</button>
    </form>
</body>
</html>

