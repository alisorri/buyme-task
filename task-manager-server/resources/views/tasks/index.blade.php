@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->


        <!-- New Task Form -->
        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Task Name -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>
    <table>
        @foreach($tasks as $task)
            <tr>
                <td>{{$task->name}}</td>
                <td>
                    <form action="{{ url('/task/'.$task->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('delete') }}
                        <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                            <i class="fa fa-btn fa-trash"></i>Delete
                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{url('/task/'.$task->id) }}" method="post">
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        <input type="text" name="name" value="Alllllllllllli">
                        <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                            <i class="fa fa-btn fa-update"></i>update
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <!-- TODO: Current Tasks -->
@endsection