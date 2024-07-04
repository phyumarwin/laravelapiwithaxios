<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Api CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <style>
        body { 
            padding-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h5>Posts</h5>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h5>Create Posts</h5>
                <span id="successMsg"></span>
                <form name="myform">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
    {{-- Axios link --}}
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script>
        //READ
        axios.get('/api/posts')
             .then(response => {
                // console.log(response.data);
                var tableBody = document.getElementById('tableBody');
                response.data.forEach(item => {
                    tableBody.innerHTML += 
                    '<tr>'+
                        '<td>'+item.id+'</td>'+
                        '<td>'+item.title+'</td>'+
                        '<td>'+item.description+'</td>'+
                        '<td>'+
                            '<button class="btn btn-sm btn-success">Edit</button>'+
                            '<button class="btn btn-sm btn-danger" style="margin-left: 10px;">Delete</button>'+
                        '<td>'+
                    '</tr>';
                })
             })
             .catch(error => {
                console.log(error);
                if(error.response.status == 404) {
                    console.log(' "'+error.response.config.url+'" url is not found!');
                }
             } );
        //CREATE
        var myform = document.forms['myform'];
        var titleInput = myform['title'];
        var descriptionInput = myform['description'];

        myform.onsubmit = function(event) {
            event.preventDefault();
            axios.post('/api/posts', {
                    title: titleInput.value,
                    description: descriptionInput.value
                })
                 .then(response => {
                    console.log(response);
                    document.getElementById('successMsg').innerHTML = 
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                            '<strong>'+response.data.msg+'</strong>'
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">'+
                            '</button>'+
                        '</div>';
                 })
                 .catch(error => 
                    console.log(error.response)
                 );
        }
    </script>
</body>
</html></http:5>