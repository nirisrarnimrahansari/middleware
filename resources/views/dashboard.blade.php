<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   <title>Document</title>
</head>
<body>
<!-- @if(session::has('loginRole') == 'admin' ) -->
@php print_r(session::has('loginRole'));
 @endphp
<div class="content">
   <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12">
                @if(session('fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{session('fail')}}
                </div>
                @endif
                <h1  class="text-center">welcome to Admin dashboard</h1>
            </div>
            <div class="offset-md-2 col-md-8">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email-ID</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td scope="row">{{$data->id}}</td>
                        <td scope="row">{{$data->name}}</td>
                        <td scope="row">{{$data->email}}</td>
                        <td scope="row">{{$data->role}}</td>
                        <td scope="row"><a href="/logout">Logout</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
           
            <div class="offset-md-2 col-md-8">
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email-ID</th>
                        <th scope="col">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($users))
                            @foreach($users as $user)
                            <tr>
                            <td scope="row">{{$user->id}}</td>
                            <td scope="row">{{$user->name}}</td>
                            <td scope="row">{{$user->email}}</td>
                            <td scope="row">{{$user->role}}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="offset-md-2 col-md-8">
                <input type="text" class="" id="search" name="search"></input>
                <input type="button" class="btn btn-primary" id="fetch" value="search"></input>
                <div class="row"> 
                    <table id="userdata" class="table table-hover">
                        <thead> 
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#fetch').click(function(){
            var user_id = $('#search').val();
            console.log(user_id); 
            $.ajax({
                type : 'post',
                url : '{{route('search')}}',
                data:{'_token':"{{csrf_token()}}", user_id:user_id},
                dataType:'json',
                success:function(response){
                    console.log(response);
                    createRows(response);
                }
            });
        })
    });
    function createRows(response){
      var len = 0;
      $('#userdata tbody').empty(); // Empty <tbody>
      if(response['data'] != null){
         len = response['data'].length;
      }
      if(len > 0){
        for(var i=0; i<len; i++){
           var id = response['data'][i].id;
           var name = response['data'][i].name;
           var email_id = response['data'][i].email;
           var role = response['data'][i].role;
           var tr_str = "<tr>" +
             "<td align=''>" + id + "</td>" +
             "<td align=''>" + name + "</td>" +
             "<td align=''>" + email_id + "</td>" +
             "<td align=''>" + role + "</td>" +
             "</td>" +
           "</tr>";
         $("#userdata tbody").append(tr_str);

        }
      }else{
         var tr_str = "<tr>" +
           "<td align='center' colspan='4'>No record found.</td>" +
         "</tr>";
         $("#userdata tbody").append(tr_str);
      }
    } 

</script>
<!-- @else -->
<!-- <div class="content">
   <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    You don't have to access view this page
                </div>
            </div>
        </div>
    </div>
</div>
@endif -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>