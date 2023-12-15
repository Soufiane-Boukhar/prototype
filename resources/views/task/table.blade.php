<table class="table table-striped text-nowrap">
    <thead>
        <tr>
            <th>{{__('message.name')}}</th>
            <th>{{__('message.project')}}</th>
            <th>{{__('message.startDate')}} Date</th>
            <th>{{__('message.endDate')}}</th>
            @role('project-leader')
            <th>{{__('message.action')}}</th>
            @endrole
        </tr>
    </thead>
    <tbody class="tasks-container">
       @include('task.search')
    </tbody>
</table>
<input type="hidden" id="page_hidden" value="1">
