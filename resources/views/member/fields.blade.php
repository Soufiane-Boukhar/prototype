
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ isset($member) ? 'Edit Member' : 'Add Member'}}</h3>
    </div>
    <form method="POST" action="{{ isset($member) ? route('member.update', $member->id) : route('member.store') }}">
        @csrf
        @if (isset($member))
            @method('PUT')
        @endif
        <div class="card-body">
            <div class="form-group mb-0">
                <label for="name mb-0">Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Enter name"
                value="{{ old('name', isset($member) ? $member->name : '') }}">
            </div>
            @error('name')
                <div class="text-danger mb-0">{{ $message }}</div>
            @enderror
            <div class="form-group mb-0 mt-3">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="email"
                value="{{ old('email', isset($member) ? $member->email : '') }}">
            </div>
            @error('email')
                <div class="text-danger mb-0">{{ $message }}</div>
            @enderror

            <div class="form-group mb-0">
                <label for="role mb-0">Role</label>
                <input type="text" class="form-control" id="name" 
                value="{{ old('name', isset($member) ? $member->role : 'member') }}" disabled>

                <input name="role" type="hidden" class="form-control" id="name" 
                value="{{ old('name', isset($member) ? $member->role : 'member') }}">
            </div>

            @if(!isset($member))
            <div class="form-group mb-0 mt-3">
                <label for="Password">Password</label>
                <input name="password" type="Password" class="form-control" id="Password" placeholder="password"
                >
            </div>
            @error('password')
                <div class="text-danger mb-0">{{ $message }}</div>
            @enderror
            @endif
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ isset($member) ? 'Update' : 'Add' }}</button>
        </div>
    </form>
</div>