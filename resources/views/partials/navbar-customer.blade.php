<header>
    <div class="nav-header">
        <img src="{{ asset('Images/CAKLEKER-STORE.png') }}" alt="Cakleker Store" class="logo-img">
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('produk.index') }}">Produk</a>
            <a href="{{ route('pembelian') }}">Pembelian</a>
            <a href="{{ route('tentang') }}">Tentang</a>
            <span class="user-name">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="nav-logout-btn">Logout</button>
            </form>
        </nav>
    </div>
</header>
