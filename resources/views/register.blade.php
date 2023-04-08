<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   <title>Document</title>
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success fade show">
        <button class="close" data-dissmiss="alert">X</button>
        {{session('success')}}
    </div>
    @endif
<div class="content">
   <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12">
                <form  method="post" enctype="multipart/form-data" action="{{route('register.store')}}"> 
                        @csrf
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __(' Register Form') }}</h4>
                            </div>
                            <div class="card-body">
                            <div class="row g-3">
                                <div class="col-lg-12 m-2">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 m-2">
                                    <label for="email" class="form-label">Email ID</label>
                                    <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-12 m-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 m-2">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" name="role">
                                        <option disabled selected>--Select Role--</option>
                                        <option value="admin">admin</option>
                                        <option value="user">user</option>
                                        </select>
                                    @error('role')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 m-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <a href="/login">Login</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>