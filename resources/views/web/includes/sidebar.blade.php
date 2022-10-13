<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> News<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('panel.news.index') }}">List</a>
                    </li>
                    <li>
                        <a href="{{ route('panel.news.create') }}">New</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
