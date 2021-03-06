<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link text-capitalize" href="{{ url('dashboard') }}/{{ session('id_role') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard {{ session('role_name') }}</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    hak akses
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#peranAktif" aria-expanded="true" aria-controls="peranAktif">
        <i class="fas fa-fw fa-cog"></i>
        <span>Peran</span>
    </a>
    <div id="peranAktif" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Aktif:</h6>
            @foreach($rolesPengguna as $item)
            @if(session('id_role')==$item['id_role'])
            <a class="collapse-item active text-uppercase" href="{{ url('dashboard') }}/{{ $item['id_role'] }}">{{ $item['nama_role'] }}</a>
            @else
            <a class="collapse-item text-uppercase" href="{{ url('dashboard') }}/{{ $item['id_role'] }}">{{ $item['nama_role'] }}</a>
            @endif
            @endforeach
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading Menu -->
<div class="sidebar-heading">
    Menu
</div>

<!-- Nav Item - Pages Collapse Menu -->
@foreach($groupMenu as $item)
<li class="nav-item">
    <a class="nav-link collapsed text-capitalize" href="#" data-toggle="collapse" data-target="#collapse{{ $item->id_group }}" aria-expanded="true" aria-controls="collapse{{ $item->id_group }}">
        <i class="fas fa-fw {{ $item->icon }}"></i>
        <span>{{ $item->nama_group }}</span>
    </a>
    <div id="collapse{{ $item["id_group"] }}" class="collapse" aria-labelledby="{{ $item["id_group"] }}" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @foreach($menu[$item->id_group] as $itemChild)
            <a class="collapse-item" href="{{ url("$item->url_group/$itemChild->url_menu") }}">
                <button class="btn btn-light btn-icon-split w-auto">
                    <span class="icon text-gray-600"><i class="fas {{$itemChild->icon}}"></i></span>
                    <span class="text text-capitalize">{{ $itemChild->nama_menu }}</span>
                </button>
            </a>
            @endforeach
        </div>
    </div>
</li>
@endforeach

<hr class="sidebar-divider">

<!-- Logout Menu -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span></a>
</li>