
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KoperasiKu')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #343a40;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .brand {
            display: block;
            padding: 20px;
            color: white;
            text-decoration: none;
            font-size: 22px;
            font-weight: bold;
            border-bottom: 1px solid #4b545c;
        }

        .user-panel {
            padding: 20px;
            border-bottom: 1px solid #4b545c;
        }

        .sidebar a.menu-link {
            display: block;
            color: #c2c7d0;
            text-decoration: none;
            padding: 12px 20px;
            margin: 3px 10px;
            border-radius: 5px;
        }

        .sidebar a.menu-link:hover,
        .sidebar a.menu-link.active {
            background: #007bff;
            color: white;
        }

        .menu-title {
            color: #9da5ad;
            font-size: 11px;
            font-weight: bold;
            padding: 18px 20px 5px;
        }

        .main-area {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 60px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 25px;
            box-shadow: 0 1px 4px rgba(0,0,0,.1);
        }

        .content-area {
            padding: 25px;
        }

        .page-footer {
            padding: 20px;
            color: #6c757d;
            text-align: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 210px;
                transform: translateX(-100%);
                transition: .3s;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-area {
                margin-left: 0;
            }

            .content-area {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar" id="sidebar">

        <a href="{{ Route::has('dashboard') ? route('dashboard') : route('anggota.index') }}"
           class="brand">
            <i class="bi bi-bank me-2"></i>KoperasiKu
        </a>

        @auth
        <div class="user-panel">
            <div class="d-flex align-items-center">
                <i class="bi bi-person-circle fs-1 me-3"></i>
                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <div class="small">
                        {{ ucfirst(auth()->user()->role ?? 'Petugas') }}
                    </div>
                </div>
            </div>
        </div>
        @endauth

        <div class="menu-title">MENU UTAMA</div>

        @if(Route::has('dashboard'))
        <a href="{{ route('dashboard') }}"
           class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        @endif

        <div class="menu-title">MANAJEMEN KOPERASI</div>

        <a href="{{ route('anggota.index') }}"
           class="menu-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Data Anggota
        </a>

        @if(auth()->user()?->role === 'admin')
        @if(Route::has('users.index'))
        <a href="{{ route('users.index') }}"
           class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-person-gear me-2"></i> Manajemen User
        </a>
        @endif
        @endif

        <div class="menu-title">TRANSAKSI KOPERASI</div>

        <a href="{{ route('simpanan.index') }}"
           class="menu-link {{ request()->routeIs('simpanan.*') ? 'active' : '' }}">
            <i class="bi bi-wallet2 me-2"></i> Simpanan
        </a>

        @if(Route::has('pinjaman.index'))
        <a href="{{ route('pinjaman.index') }}"
           class="menu-link {{ request()->routeIs('pinjaman.*') ? 'active' : '' }}">
            <i class="bi bi-cash-stack me-2"></i> Pinjaman
        </a>
        @endif

        @if(Route::has('angsuran.index'))
        <a href="{{ route('angsuran.index') }}"
           class="menu-link {{ request()->routeIs('angsuran.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check me-2"></i> Angsuran
        </a>
        @endif

        @if(Route::has('laporan.index'))
        <div class="menu-title">LAPORAN</div>
        <a href="{{ route('laporan.index') }}"
           class="menu-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text me-2"></i> Laporan
        </a>
        @endif

    </aside>

    <div class="main-area">

        <nav class="topbar">
            <button class="btn btn-light d-md-none me-auto"
                    type="button"
                    onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-4"></i>
            </button>

            @auth
            <span class="me-3">
                <i class="bi bi-person-circle me-1"></i>
                {{ auth()->user()->name }}
                ({{ ucfirst(auth()->user()->role ?? 'Petugas') }})
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
            @endauth
        </nav>

        <main class="content-area">
            @yield('content')
        </main>

        <footer class="page-footer">
            <small>
                &copy; {{ date('Y') }} KoperasiKu.
                Sistem Informasi Koperasi Simpan Pinjam.
            </small>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
