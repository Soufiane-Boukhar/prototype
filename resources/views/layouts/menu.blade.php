

<li class="nav-item">
    <a href="{{ route('project.index') }}" class="nav-link {{ Request::is('project.index') ? 'active' : '' }}">
      <i class="nav-icon fas fa-table"></i>
      <p>{{__('message.projects')}}</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('task.index', ['id' => 1]) }}" class="nav-link {{ Request::is('task.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-plus"></i>
        <p>{{__('message.tasks')}}</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('member.index') }}" class="nav-link {{ Request::is('member.index') ? 'active' : '' }}">
      <i class="fa-solid fa-users pl-1 pr-1"></i>
      <p>{{__('message.members')}}</p>
    </a>
</li>


