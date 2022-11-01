<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/121e1a84b2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
 <!-- Button trigger modal -->

    <div class="row">
        <div class="col-md-12">
            <section class="vh-100">
                <div class="container py-5 h-100">
                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                      <div class="card" id="list1" style="border-radius: .75rem; background-color: #fff;">
                        <div class="card-body py-4 px-4 px-md-5">

                          <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                            <i class="fa fa-check-circle me-1" aria-hidden="true"></i>
                            <u>MY TODO-s</u>
                          </p>
                          @if (session('message'))
                          <div class="my-2">
                            <div class="alert alert-success">{{ session('message') }}</div>
                           </div>
                         @endif

                          <div class="pb-2">
                            <div class="card">
                              <div class="card-body row">
                                <div class="col-3"></div>
                                <form action="" class="col-6 ml-0">
                                    <div class="input-group mb-3">
                                        <input type="search" class="form-control" name="search" placeholder="Search by title, reaction and date" value="{{$search}}">
                                        <button class="btn btn-outline-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>

                                </form>

                                    {{-- <div class="form-group">
                                        <input type="search" name="search" class="form-control" placeholder="Search by title" value="{{$search}}">
                                    </div> --}}

                                    <div class="col-3 p-0 m-0">
                                        {{-- <button class="btn btn-primary btn-sm m-0">Search</button> --}}
                                        <a href="{{url('/todo')}}">
                                            <button class="btn btn-danger btn-md" type="button">Reset</button>
                                        </a>
                                    </div>




                                <form action="{{route('todo.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="title" placeholder="Title">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="datetime-local" class="form-control" name="date" placeholder="Date">
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="file" class="form-control" name="photo">
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-select" aria-label="Default select example" name="Reaction">
                                                <option selected value="">How you feel</option>
                                                <option value="happy">Happy</option>
                                                <option value="sad">Sad</option>
                                                <option value="angry">Angry</option>
                                            </select>
                                            <a href="#!" data-mdb-toggle="tooltip" title="Set due date"><i class="fas fa-calendar-alt fa-lg me-3"></i></a>
                                        </div>

                                        <div class="col-sm-12">
                                            <textarea name="description" class="form-control" cols="30" rows="7" placeholder="Description"></textarea>
                                        </div>

                                        <div class="col-sm-auto">
                                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                        </div>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>

                          <hr class="my-4">
                          <table class="table">

                            <thead>
                              <tr>
                                <th scope="col">S.N</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Reaction</th>
                                <th scope="col">Action</th>



                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $t)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td>{{$t->title}}</td>
                                    <td>{{ \Carbon\Carbon::parse($t->date)->format('Y,M,D h:i:s')}}</td>
                                    <td>{{$t->description}}</td>
                                    <td><img src="{{asset($t->image)}}" class="img-responsive" width="150px" height="150px"  alt=""></td>
                                    <td>
                                        @if ($t->reaction =="happy")
                                        <i class="fa fa-smile-o fa-3x" aria-hidden="true" style="color: green;"></i>
                                        @elseif ($t->reaction =="sad")
                                        <i class="fa fa-meh-o fa-3x" aria-hidden="true" style="color: rgb(255, 145, 0);"></i>
                                        @elseif ($t->reaction =="angry")
                                        <i class="fa fa-frown-o fa-3x" aria-hidden="true" style="color: red;"></i>
                                        @endif
                                    </td>
                                    <td>
                                    {{-- <a href="todo/{{$t->id}}/edit" class="btn-primary btn-sm"><i></i>Edit</a> --}}
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$t->id}}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                        <form action="{{route('todo.destroy',$t->id)}}" method="POST">
                                            {{method_field('DELETE')}}
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                           </form>
                                    </div>

                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{$t->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/todo/{{ $t->id }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="d-flex flex-row align-items-center">
                                                     <input type="text" class="form-control form-control-md" name="title" value="{{$t->title}}"
                                                    placeholder="title">
                                                    <input type="date" class="form-control form-control" name="date" value="{{$t->date}}"
                                                    placeholder="date">
                                                    <input type="text" class="form-control form-control" name="description" value="{{$t->description}}"
                                                    placeholder="description">
                                                    <input type="file" class="form-control form-control" name="photo">
                                                    <select class="form-select" aria-label="Default select example" name="reaction" value="{{$t->reaction}}">
                                                        <option selected value="">Open this select menu</option>
                                                        <option value="happy">Happy</option>
                                                        <option value="sad">Sad</option>
                                                        <option value="angry">Angry</option>
                                                      </select>

                                                  <a href="#!" data-mdb-toggle="tooltip" title="Set due date"><i
                                                      class="fas fa-calendar-alt fa-lg me-3"></i></a>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                  </div>
                                            </form>
                                            </div>


                                          </div>
                                        </div>
                                      </div>




                                    {{-- <a href="" class="btn-danger btn-sm"><i></i>Delete</a> --}}

                                    </td>

                                  </tr>
                                @endforeach

                            </tbody>
                          </table>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
    </div>
</body>
</html>
