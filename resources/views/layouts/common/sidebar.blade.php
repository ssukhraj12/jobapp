<ul class="side-nav overflow-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
            <i class="mdi mdi-view-dashboard-outline"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a data-bs-toggle="collapse" href="#side1" aria-expanded="false" aria-controls="side1" class="nav-link">
            <i class="mdi mdi-format-list-bulleted"></i>
            <span>Jobs</span>
            <span class="menu-arrow">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <div class="collapse" id="side1">
            <ul class="side-nav-second-level">
                <li>
                    <a href="{{route('admin.jobs')}}">All Jobs</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a data-bs-toggle="collapse" href="#side2" aria-expanded="false" aria-controls="side2" class="nav-link">
            <i class="mdi mdi-map-marker-radius-outline"></i>
            <span>Locations</span>
            <span class="menu-arrow">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <div class="collapse" id="side2">
            <ul class="side-nav-second-level">
                <li>
                    <a href="{{route('list.countries')}}">Countries</a>
                </li>
                <li>
                    <a href="{{route('list.states')}}">States</a>
                </li>
                <li>
                    <a href="{{route('list.cities')}}">Cities</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a data-bs-toggle="collapse" href="#side3" aria-expanded="false" aria-controls="side3" class="nav-link">
            <i class="mdi mdi-format-list-checks"></i>
            <span>Job Type</span>
            <span class="menu-arrow">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <div class="collapse" id="side3">
            <ul class="side-nav-second-level">
                <li>
                    <a href="{{route('admin.jobtype')}}">Types</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a data-bs-toggle="collapse" href="#side4" aria-expanded="false" aria-controls="side4" class="nav-link">
            <i class="mdi mdi-format-list-text"></i>
            <span>Job Categories</span>
            <span class="menu-arrow">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <div class="collapse" id="side4">
            <ul class="side-nav-second-level">
                <li>
                    <a href="{{route('admin.jobcats')}}">Categories</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a data-bs-toggle="collapse" href="#side5" aria-expanded="false" aria-controls="side5" class="nav-link">
            <i class="mdi mdi-account-group"></i>
            <span>Users</span>
            <span class="menu-arrow">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <div class="collapse" id="side5">
            <ul class="side-nav-second-level">
                <li>
                    <a href="#">Users</a>
                </li>
                <li>
                    <a href="#">Companies</a>
                </li>
            </ul>
        </div>
    </li>
</ul>
