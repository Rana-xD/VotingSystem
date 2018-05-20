<div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item active ">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="{{ url('admin/meeting') }}">
                <i class="material-icons">content_paste</i>
                <p>Create Meeting</p>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="{{ url('admin/voter') }}">
                <i class="material-icons">person</i>
                <p>Shareholder/Nominee</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="material-icons">unarchive</i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>

