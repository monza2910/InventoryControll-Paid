<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('masterGood')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Master Barang
                </a>
            </div>
            <div class="nav">
                <a class="nav-link" href="{{route('goodIn')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Barang Masuk 
                </a>
            </div>
            <div class="nav">
                <a class="nav-link" href="{{route('receipent')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Master Peminjam 
                </a>
            </div>
            <div class="nav">
                <a class="nav-link" href="{{route('borrowGood')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Barang Dipinjam
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            @if (Auth()->user())
            {{Auth()->user()->name}}
            @endif
        </div>
    </nav>
</div>