@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}.
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('error') }}.
        </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('message.list')}}</h1>
            </div>
            @role('project-leader')
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <a href="{{ route('project.create') }}" class="btn btnAdd">{{__('message.add')}}</a>
                </div>
            </div>
            @endrole
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-md-flex justify-content-end">
                        <div class="input-group input-group-sm col-md-3 d-flex  justify-content-end">
                            <input id="searchProject" type="text" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        </div>                        
                    </div>
                    <div class="card-body table-responsive p-0 table-data">
                        {{-- @include('project.table') --}}
                        @include('project.table', ['projects' => $projects])
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    function fetch_data(page, search) {
        $.ajax({
            url: "projects/?page=" + page + "&searchProject=" + search,
            success: function(data) {
                $('tbody').html('');
                $('tbody').html(data);
            }
        });
    }

    $('body').on('click', '.pagination a', function(param) {
        param.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var search = $('#searchProject').val();
        fetch_data(page, search);
    });

    $('body').on('keyup', '#searchProject', function() {
        var search = $('#searchProject').val();
        var page = $('#page_hidden').val();
        fetch_data(page, search);
    });

    // $('body').on('change', '#projectSelect', function() {
    //     var search = $('#projectSelect').val();
    //     var page = $('#page_hidden').val();
    //     fetch_data(page, search);
    // });

    fetch_data(1, '');
});
</script>



@endsection