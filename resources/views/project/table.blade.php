<table class="table table-striped text-nowrap">
    <thead>
        <tr>
            <th>{{__('message.name')}}</th>
            <th>{{__('message.description')}}</th>
            <th>{{__('message.startDate')}}</th>
            <th>{{__('message.endDate')}}</th>
            <th>{{__('message.action')}}</th>
        </tr>
    </thead>
    <tbody>
       @include('project.search')
    </tbody>
</table>
<input type="hidden" id="hidden_page" value="1">