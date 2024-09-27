<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
</head>
<style>
   
/* General styles */
body {
    font-family: 'Helvetica Neue', sans-serif;
    background-color: #eef2f3;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

form {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 100%;
    max-width: 400px;
}

/* Label and input styles */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
}

.form-control-plaintext {
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 20px;
    width: calc(100% - 16px);
}

.form-control {
    width: calc(100% - 22px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 20px;
}

.form-control:focus {
    border-color: #66afe9;
    outline: none;
    box-shadow: 0 0 5px rgba(102, 175, 233, 0.5);
}

/* Button styles */
button[type="submit"] {
    background-color: #28a745;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    margin-top: 10px;
}

button[type="submit"]:hover {
    background-color: #218838;
}

/* Link styles */
p {
    margin-top: 15px;
    text-align: center;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .col-sm-2, .col-sm-10 {
        flex: 100%;
        max-width: 100%;
    }

    .col-sm-2 {
        text-align: left;
        margin-bottom: 10px;
    }
}

</style>
<form  id="loginForm"    method="get" action="{{ route('login_user') }}">
    @csrf
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
    </div>
    <button type="submit"  id="submit">Login</button>
    <p>I don't have an account <a href="{{ route('register_view') }}">register here</a></p>
    
    

</form>

  
</body>



</html>