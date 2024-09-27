<!-- resources/views/table.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list_users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
      <hr>
        <h3 style="text-align:center;">LIST USERS</h3>
        <button type="submit" style="float: right;"><a href="{{ route('logout') }}">logout</a></button>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Ajouter
        </button>

<!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Client </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                       
                    <div class="modal-body">
                        <!-- Modal form content goes here -->
                        
                        <form id="myForm" method="POST" action="{{ route('add_user') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                           
                                <label for="image">Choose an image:</label>
                                <input type="file" name="image" id="image" required>
                               
                           
                            <button type="submit" class="btn btn-primary" >Submit</button>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
        <form id="search_form" method="GET" action="{{ route('listUsers') }}" onsubmit="event.preventDefault(); search();" >
            @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="query" aria-label="Search"  oninput="search();">
                    <div class="input-group-append">
                        
                    </div>
                </div>  
                @if(isset($results))
                    <h3>Search Results:</h3>
                    <ul class="list-group">
                        @foreach($results as $result)
                            <li class="list-group-item">{{ $result->name }}</li>
                            <li class="list-group-item">{{ $result->email }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </form>
                
<hr>@php echo ' session email: '.session('email'); @endphp
        <table id="table_user" class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>image</th>
                    <th>Name</th>
                    <th>Email</th>
                    

                </tr>
            </thead>
            <tbody id="users-list-container">
                @foreach($data as $user)
                    <tr>
                        <td>{{ $user ->id }}</td>
                        <td><!-- Afficher l'image si elle existe -->
                           
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Image" style="width:100px;height:100px;">     
                            
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>>
                        
                        <td><button class='a.btn.btn.default' type='submit'><a href="{{ route('update_view', parameters: ['id' => $user->id,'name' => $user->name, 'email' => $user->email]) }}"> update</a></button></td>
                        <form action="{{ route('delete_user', ['email' => $user->email]) }}" method="GET" style="display:inline;">
                                @csrf
                               
                                <td><button type="submit" class="btn btn-danger">Delete</button></td></form>

                    </tr>
                @endforeach
            </tbody>
        </table>
      
    </div>
</body>
<script>

        $('#myModal').on('shown.bs.modal', function () {
                document.getElementById('myForm').reset();
            });

            // Reset the form when the page is loaded
            window.addEventListener('load', function() {
                document.getElementById('myForm').reset();
            });

    document.getElementById('myForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        var form = this;

        // Use Fetch API or XMLHttpRequest to submit the form data
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value // Include CSRF token if necessary
            }
        }).then(response => response.json())
          .then(data => {
              console.log('Success:', data);
              form.reset(); // Reset the form fields
              $('#myModal').modal('hide'); // Hide the modal
               
          })
          .catch(error => {
              console.error('Error:', error);
          });
    });


    // JavaScript function to handle search
function search() {
    var form = $('#search_form')[0];
    var formData = new FormData(form);

    fetch(form.action + '?' + new URLSearchParams(formData), {
        method: 'GET',
        
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        
        // Update the table with new data
        var usersListContainer = document.getElementById('users-list-container');
        usersListContainer.innerHTML = ''; // Clear existing table rows

        data.forEach(user => {
            var row = `
                <tr>
                    <td>${user.id}</td>
                    <td>
                        ${user.image ? `<img src="${user.image}" alt="Image" style="width:100px;height:100px;">` : ''}
                    </td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <button class="btn btn-default">
                            <a href="${user.update_link}">Update</a></button>
                        
                        <form action="${user.delete_link}" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
            `;
            usersListContainer.innerHTML += row;
        });

        
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function fetchUsers() {
    fetch("{{ route('listUsers') }}")
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        
        // Update the table with new data
        var usersListContainer = document.getElementById('users-list-container');
        usersListContainer.innerHTML = ''; // Clear existing table rows

        data.forEach(user => {
            var row = `
                <tr>
                    <td>${user.id}</td>
                    <td>
                        ${user.image ? `<img src="storage/${user.image}" alt="Image" style="width:100px;height:100px;">` : ''}
                    </td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <button class="btn btn-default">
                            <a href="{{ url('update_view') }}/${user.id}">Update</a></button>
                        
                        <form action="{{ url('delete_user') }}/${user.email}" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
            `;
            usersListContainer.innerHTML += row;
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

</script>

</html>
