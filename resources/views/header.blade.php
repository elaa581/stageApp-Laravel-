<style>
/* ===== Header ===== */
.main-header {
    background: #ffffff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* ===== Navbar ===== */
.nav-bar {
    max-width: 1300px;
    margin: auto;
    padding: 14px 30px;
    display: flex;
    justify-content: flex-end; /* tout à droite */
    align-items: center;
}

/* ===== Menu ===== */
.nav-menu {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 18px;
    margin: 0;
    padding: 0;
}

/* ===== Liens ===== */
.nav-menu li a {
    text-decoration: none;
    color: #1e293b;
    font-weight: 600;
    padding: 10px 14px;
    border-radius: 12px;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Hover */
.nav-menu li a:hover {
    background: #dc2626;
    color: #ffffff;
    transform: translateY(-2px);
}

/* Lien actif (optionnel) */
.nav-menu li a.active {
    background: #fee2e2;
    color: #dc2626;
}

/* ===== Logout ===== */
.nav-menu .logout form button {
    background: #dc2626;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
}

/* Hover logout */
.nav-menu .logout form button:hover {
    background: #b91c1c;
    transform: translateY(-2px);
}

/* ===== Responsive ===== */
@media (max-width: 900px) {
    .nav-bar {
        justify-content: center;
    }

    .nav-menu {
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
    }

    .nav-menu li a,
    .nav-menu .logout form button {
        padding: 8px 12px;
        font-size: 14px;
    }
}

</style>
<header class="main-header">
    <nav class="nav-bar">
        <ul class="nav-menu">

            @if(Auth::check())
                @if(Auth::user()->role === 'etudiant')
                    <li><a href="{{ route('etudiant.offres') }}">📢 Offres</a></li>
                    <li><a href="{{ route('etudiant.candidatures') }}">📩 Candidatures</a></li>
                    <li><a href="{{ route('etudiant.cvlibre.store') }}">📄 Déposer CV</a></li>
                    <li><a href="{{ route('etudiant.profil') }}">👤 Profil</a></li>

                @elseif(Auth::user()->role === 'entreprise')
                    <li><a href="{{ route('entreprise.offres') }}">Offres</a></li>
                    <li><a href="{{ route('entreprise.candidatures') }}">Candidatures</a></li>
                    <li><a href="{{ route('entreprise.cvs.libres') }}">CVs</a></li>
                    <li><a href="{{ route('entreprise.offres.create') }}">➕ Offre</a></li>
                    <li><a href="{{ route('entreprise.profil') }}">👤 Profil</a></li>

                @elseif(Auth::user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.allEntreprises') }}">Entreprises</a></li>
                     <li><a href="{{ route('admin.cvs.libres') }}">CVs</a></li>
                    <li><a href="{{ route('admin.offres') }}">Offres</a></li>
                    <li><a href="{{ route('admin.profil') }}">👤 Profil</a></li>
                @endif

                <li class="logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register_choice') }}">Register</a></li>
            @endif

        </ul>
    </nav>
</header>
