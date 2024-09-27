<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    
</head>
<body>
    <div class="container mt-5">
        <h1>Dashboard</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            <tbody id="users-list-container">
                @foreach($data as $user)
                    <tr>
                        <td>{{ $user ->id }}</td>
                        <td><!-- Afficher l'image si elle existe -->
                           
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Image" style="width:100px;height:100px;">     
                            
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>>
                        
                        <td><button class='a.btn.btn.default' type='submit'><a href="{{ route('update_view', ['id' => $user->id,'name' => $user->name, 'email' => $user->email]) }}"> update</a></button></td>
                        <form action="{{ route('delete_user', ['email' => $user->email]) }}" method="GET" style="display:inline;">
                                @csrf
                               
                                <td><button type="submit" class="btn btn-danger">Delete</button></td></form>

                    </tr>
                @endforeach
            </tbody>
        </table>
      
    </div>
</body>
</html>
