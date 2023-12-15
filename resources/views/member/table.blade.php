<table class="table table-striped text-nowrap">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            @role('project-leader')
            <th>action</th>
            @endrole
        </tr>
    </thead>
    <tbody>
       @include('member.search')
    </tbody>
</table>
<input type="hidden" id="page_hidden" value="1" />