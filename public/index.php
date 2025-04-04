<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.all.js"></script>
    <script>
        $(document).ready(function() {
            $('#user-form').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        let message = '<b>ID:</b> ' + response.id + '<br>' +
                            '<b>Name:</b> ' + response.name + '<br>' +
                            '<b>Email:</b> ' + response.email + '<br><br>' +
                            response.event;
                        swal({
                            showConfirmButton: false,
                            timer: 15000,
                            title: 'User created successfully',
                            html: message,
                            type: 'success',
                            showCancelButton: true,
                            cancelButtonColor: '#d9534f',
                            cancelButtonText: 'Close'
                        });
                    },
                    error: function(xhr) {
                        swal({
                            showConfirmButton: false,
                            timer: 15000,
                            title: 'Error creating user',
                            html: JSON.stringify(xhr.responseJSON.error, null, 2),
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonColor: '#d9534f',
                            cancelButtonText: 'Close'
                        });
                    }
                });
            });
        });

    </script>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Register User</h1>
    <form action="register.php" method="post" class="mt-4" id="user-form" name="user-form">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>
