@forelse ($members as $member)
    <tr>
        <td>{{ $member->name }}</td>
        <td>{{ $member->email }}</td>
        @role('project-leader')
        <td>
            <a href="{{ route('member.edit', $member) }}" class="btn btn-sm btn-default">
                <i class="fas fa-edit"></i>
            </a>
            <form method="POST" action="{{ route('member.destroy', $member) }}" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
        @endrole
    </tr>
@empty
    <tr>
        <td colspan="3">Members not found.
            <a href="{{ route('member.create') }}" class="mx-1">Add member</a>
        </td>
    </tr>
@endforelse

<tr>
    <td colspan="3">
        {{ $members->links() }}
    </td>
</tr>
