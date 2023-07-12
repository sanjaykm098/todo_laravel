<!doctype html>
<html lang="en">
{{-- {{dd($data)}} --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<style>
    tr,
    td,
    th {
        background: transparent !important
    }
</style>

<body>
    <div class="vh-100 conatiner-fluid bg-light text-dark">
        {{-- Header  --}}
        <div class="container">
            <header class="pt-3 text-center">
                <a class="text-decoration-none text-dark" href="/"><h3>{{config('app.name')}}</h3></a>
            </header>
            {{-- Content --}}
            <div class="row">
                <div class="col-12">
                    <div class="col-3"></div>
                    <div class="col-6">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>Success !!</strong> {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="col-sm-5">
                    <div class="p-5">
                        <form action="/insert" method="post">
                            @csrf
                            <div>
                                <label class="text-dark" for="task">Add Task:</label>
                                <input type="text" name="task" value="{{ old('task') }}" id="task"
                                    placeholder="Add Task Here...." class="form-control">
                                @if ($errors->has('task'))
                                    <span class="text-danger">{{ $errors->first('task') }}</span>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label class="text-dark" for="task">Add description:</label>
                                <input name="info" value="{{ old('info') }}" id="task"
                                    placeholder="Add Task Here...." class="form-control" />
                                @if ($errors->has('info'))
                                    <span class="text-danger">{{ $errors->first('info') }}</span>
                                @endif
                            </div>
                            <input type="submit" value="Add Task" class="btn btn-danger mt-5">
                        </form>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="p-5">
                        @if (count($data) === 0)
                            <b>No Task Found</b>
                        @else
                            <table class="table table-borderless bg-transparent">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @php($count = 1)
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>
                                                <a type="button" class="text-decoration-none text-dark"
                                                    data-bs-toggle="modal" data-bs-target="#{{ $data->id }}">
                                                    {{ $data->task }}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($data->status == 0)
                                                    in Process
                                                @else
                                                    Completed
                                                @endif
                                            </td>

                                            <td class="d-flex">

                                                @if ($data->status == 1)
                                                    <input disabled type="submit" value="Already Completed"
                                                        class="btn mx-1 btn-online-success btn-sm">
                                                @else
                                                    <form class="mx-1" action="todo/{{ $data->id }}/done"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="submit" value="Completed"
                                                            class="btn btn-success btn-sm">
                                                    </form>
                                                @endif
                                                <form action="todo/{{ $data->id }}/delete" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                                </form>
                                            </td>
                                        </tr>
                                        @php($count++)
                                        <div class="modal fade" id="{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $data->task }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Description:</strong>
                                                        <p class="mt-2 mx-1 text-capitalize">{{ $data->info }}</p>
                                                        <strong>Status:</strong>
                                                        <p class="mt-2 mx-1 text-capitalize">
                                                            @if ($data->status == 0)
                                                                in Process
                                                            @else
                                                                Completed
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form class="mx-1" action="todo/{{ $data->id }}/done"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="submit" value="Completed"
                                                                class="btn btn-success">
                                                        </form>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                        {{ config('app.name') }}
                    </a>
                    <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
                </div>

                <div class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    Project By <a class="mx-2" href="//sanjaykm.me"> Sanjay K M</a>
                </div>
            </footer>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

</html>
