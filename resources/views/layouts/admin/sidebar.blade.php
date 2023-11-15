<nav id="sidebar" class="sidebar js-sidebar collapsed">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/home">
            <span class="align-middle">Helpdesk WA</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main Menu
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.home')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.ticket.index')}}">
                    <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Ticket</span>
                </a>
            </li>


            <li class="sidebar-header">
                Settings
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.configuration.index')}}">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Configuration</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.user.index')}}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">User</span>
                </a>
            </li>

        </ul>
    </div>
</nav>