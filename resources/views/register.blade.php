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
<body>
    <div id="#register">
        <form id="myForm" method="POST" action="{{ route('save_user') }}" enctype="multipart/form-data">
            @csrf
            
            @isset($user)
                Name: <input type="text" id="name" name="name" value="{{ $user->name }}"><br><br>

                Email: <input type="email" id="email" name="email" value="{{ $user->email }}" required><br><br>

                Password: <input type="password" id="password" name="password" required><br><br>

                <label for="image">Choisir une nouvelle image :</label>
                <input type="file" class="form-control-file" id="image" name="image"><br><br>

                @if ($user->image)
                    <div class="form-group">
                        <label>Image actuelle :</label><br>
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Image de profil" style="width:100px;height:100px;">
                    </div>
                @endif
            @else
                <!-- Formulaire pour créer un nouvel utilisateur -->
                Name: <input type="text" id="name" name="name"><br><br>

                Email: <input type="email" id="email" name="email" required><br><br>

                Password: <input type="password" id="password" name="password" required><br><br>

                <label for="image">Choisir une image :</label>
                <input type="file" class="form-control-file" id="image" name="image"><br><br>
            @endisset

            <button class="btn btn-default" type="submit">Register</button>
        </form>
    </div>
</body>

        
    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function submitForm(event) {
        event.preventDefault(); // Prevent the default form submission

        var form = document.getElementById('myForm');
        var formData = new FormData(form);
        
        $.ajax({
            url: form.action,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            
            success: function(data) {
                console.log('Success:', data);
                resetForm(form);
                var email=$('#email').val();
                console.log(email);
                window.location.href = "{{ route('login_view', ['email' => 'email']) }}";
               
                           
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function resetForm(form) {
        form.reset(); // Reset the form fields
    }

    // Optionally, reset the form when #register is shown or made visible
    $('#register').on('shown.bs', function () {
        resetForm(document.getElementById('myForm'));
    });
</script>



</html>
