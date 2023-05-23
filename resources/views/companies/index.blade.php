<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 9 CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 2rem;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            margin-left: auto;
            margin-right: 10px;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active,
        .btn-primary.active,
        .open .dropdown-toggle.btn-primary {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
            margin-right: 10px;
        }

        .btn-success:hover,
        .btn-success:focus,
        .btn-success:active,
        .btn-success.active,
        .open .dropdown-toggle.btn-success {
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }

        .card {
            border-radius: 8px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            padding: 1rem 0;
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 1.5rem;
            background-color: #fff;
        }

        .table {
            background-color: #fff;
            font-size: 14px;
        }
        
        @media (max-width: 576px) {
            .btn-primary,
            .btn-success {
                margin: 0;
                margin-bottom: 10px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Laravel 9 CRUD Project</h2>
                    @guest
                        <a class="btn btn-primary" href="{{ route('login') }}"><i class="bi bi-person-circle"></i> Login</a>
                    @else
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf                            
                            <a class="btn btn-success" href="{{ route('companies.create') }}"><i class="bi bi-plus-square"></i> Create</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    @endguest
                </div>
                @guest
                    <div class="mt-3">
                        <p>Please login or register to access the CRUD functionality.</p>
                    </div>
                @else
                    <p>Welcome, {{ Auth::user()->name }}</p>
                @endguest
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>S.No</th>
                        <th>Company Name</th>
                        <th>Company Email</th>
                        <th>Company Address</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->address }}</td>
                            <td>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('companies.edit', $company->id) }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
    
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $companies->links() !!}
    </div>
</body>
</html>
