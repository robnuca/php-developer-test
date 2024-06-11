<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Users</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{ $user->avatar }}" alt="Avatar" class="img-thumbnail">
                        <!-- Check if the src of avatar is pulled from the avatar -->
                        <p>{{ $user -> avatar }}</p>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center w-100">
            {{ $users->links() }}
        </div>
    </div>
</body>
</html>
