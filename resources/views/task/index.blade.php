@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('message.tasks')}} of {{ $project ? $project->name : '' }} </h1>
            </div>
            @role('project-leader')
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <a href="{{ route('task.create', $project->id) }}" class="btn btnAdd">{{__('message.add')}}</a>
                </div>
            </div>
            @endrole

        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}.
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header col-md-12">
                        <div class="d-flex justify-content-between">

                            <div class="dropdown">
                                <i class="fa-solid fa-filter" style="color: #000505;"></i>
                                <button class="btn btn-sm mr-3 dropdown-toggle btnAddSelect" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{$project->name}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($projects as $project)
                                    <a class="dropdown-item project-link" href="#"
                                        data-id="{{$project->id}}">{{$project->name}}</a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- search -->
                            <div class="input-group input-group-sm col-md-3 p-0">
                                <input id="searchTask" type="text" class="form-control float-right"
                                    placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card-body table-responsive p-0 table-tasks">
                        @include('task.table')
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {

    var id;

    function fetch_data(page, search, id) {
        $.ajax({
            url: "/projects/" + id + "/tasks?page=" + page + '&searchTask=' + search,
            success: function(data) {
                $('tbody').html('');
                $('tbody').html(data);
            }
        });
    }

    $('body').on('click', '.pagination a', function(param) {
        param.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        var search = $('#searchTask').val();

        fetch_data(page, search, id);
    });

    $('body').on('keyup', '#searchTask', function() {
        var search = $('#searchTask').val();
        var page = $('#page_hidden').val();

        fetch_data(page, search, id);
    });

    $('.project-link').on('click', function(e) {
            e.preventDefault();

            var projectId = $(this).data('id');

            history.pushState(null, '', '/projects/' + projectId + '/tasks');

            $.ajax({
                type: 'GET',
                url: '/projects/' + projectId + '/tasks',
                success: function(data) {
                    $('.tasks-container').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    id = $('#id_project').val();
    fetch_data(1, '', id);
});
</script>

@endsection