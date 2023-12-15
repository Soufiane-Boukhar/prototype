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
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List of members</h1>
            </div>
            @role('project-leader')
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <a href=" {{ route('member.create') }} " class="btn btnAdd">Add Memeber</a>
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
                    <div class="card-header col-md-12">
                        <div class="d-flex justify-content-end align-items-center  p-0">
                            <div class="input-group input-group-sm col-md-3 p-0">
                                <input id="searchMember" type="text" class="form-control float-right"
                                    placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0 table-member">
                        @include('member.table')
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
            url: "/members/?page=" + page + "&searchMember=" + search,
            success: function(data) {
                $('tbody').html('');
                $('tbody').html(data);
            }
        });
    }

    $('body').on('click', '.pagination a', function(param) {
        param.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var search = $('#searchMember').val();
        fetch_data(page, search);
    });

    $('body').on('keyup', '#searchMember', function() {
        var search = $('#searchMember').val();
        var page = $('#page_hidden').val();
        fetch_data(page, search);
    });

    fetch_data(1, '');
});


</script>
@endsection