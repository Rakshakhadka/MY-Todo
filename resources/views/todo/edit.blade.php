<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/todo/" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="card-body">
                        @if (session('message'))
                        <div class="my-2">
                            <div class="alert alert-success">{{ session('message') }}</div>
                        </div>
                         @endif
                        <form action="/todo/{{ $todo->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="d-flex flex-row align-items-center">
                             <input type="text" class="form-control form-control-md" name="title" value="{{$todo->title}}"
                            placeholder="title">
                            <input type="date" class="form-control form-control" name="date" value="{{$todo->date}}"
                            placeholder="date">
                            <input type="text" class="form-control form-control" name="description" value="{{$todo->description}}"
                            placeholder="description">
                            <input type="file" class="form-control form-control" name="photo">
                            <select class="form-select" aria-label="Default select example" name="reaction" value="{{$todo->reaction}}">
                                <option selected value="">Open this select menu</option>
                                <option value="happy">Happy</option>
                                <option value="sad">Sad</option>
                                <option value="angry">Angry</option>
                              </select>

                          <a href="#!" data-mdb-toggle="tooltip" title="Set due date"><i
                              class="fas fa-calendar-alt fa-lg me-3"></i></a>
                          <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
