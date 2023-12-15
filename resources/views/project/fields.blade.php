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
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ isset($project) ? 'Edit Project' : 'Add Project' }}</h3>
    </div>
    <form method="POST" action="{{ isset($project) ? route('project.update', $project->id) : route('project.store') }}">
        @csrf
        @if (isset($project))
        @method('PUT')
        @endif
        <div class="card-body">
            <div class="form-group mb-0">
                <label for="nom">Name</label>
                <input name="name" type="text" class="form-control" id="nom" placeholder="Enter name"
                    value="{{ old('name', isset($project) ? $project->name : '') }}">
            </div>
            @error('name')
            <div class="text-danger mb-0">{{ $message }}</div>
            @enderror
            <div class="form-group mt-2 mb-0">
                <label for="Description">Description</label>
                    <textarea name="description" id="inputDescription" class="form-control" 
                    oninput="setCustomValidity('')">{{ old('description', isset($project) ? $project->description : '') }}</textarea>
            </div>

           
            @error('description')
            <div class="text-danger ">{{ $message }}</div>
            @enderror
            <div class="form-group mt-3 ">
                <label for="date">Start Date</label>
                <input name="start_date" type="date" class="form-control" id="date"
                    value="{{ old('start_date', isset($project) ? $project->start_date : '') }}">
            </div>
            @error('start_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group ">
                <label for="date">End Date</label>
                <input name="end_date" type="date" class="form-control" id="date"
                    value="{{ old('end_date', isset($project) ? $project->end_date : '') }}">
            </div>
            @error('end_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="card-footer">
            <a href="{{ route('project.index') }}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary mx-2">{{ isset($project) ? 'Update' : 'Add' }}</button>
        </div>
    </form>
</div>