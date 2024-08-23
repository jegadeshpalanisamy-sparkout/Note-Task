<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            position: sticky;
            top: 0;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#">Dashboard</a>
        <a href="{{ route('dashboard') }}">Notes</a>
        
    </div>

    <!-- Page Content -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Notes</h2>
            <a href="{{ route('add-notes') }}" class="btn btn-primary " >Add Notes</a>
            <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
        </div>
        <hr>
        <div class="notes-section">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success success-message">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Notes Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($notes as $note)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $note->title }}</td>
                        <td>{{ $note->content }}</td>
                        <td>
                            <a href="{{ route('editNote', $note->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('deleteNote', $note->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    
</body>
</html>
