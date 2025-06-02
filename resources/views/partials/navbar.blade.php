<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Laravel Integration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar intégrée Laravel -->
<nav class="navbar navbar-expand-lg modern-navbar">
    <div class="container-fluid">
        <!-- Brand avec icône -->
        <a class="navbar-brand modern-brand" href="{{ route('dashboard') }}">
            <div class="brand-icon">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
            <span class="brand-text">Admin Panel</span>
        </a>

        <!-- Toggle button avec animation -->
        <button class="navbar-toggler modern-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-line"></span>
            <span class="toggler-line"></span>
            <span class="toggler-line"></span>
        </button>

        <!-- Menu de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link modern-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 nav-icon"></i>
                        <span>Dashboard</span>
                        <div class="nav-indicator"></div>
                    </a>
                </li>

                <!-- Matériels avec dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link modern-nav-link dropdown-toggle {{ request()->routeIs('materiels.*') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-hdd-network-fill nav-icon"></i>
                        <span>Matériels</span>
                        <div class="nav-indicator"></div>
                    </a>
                    <ul class="dropdown-menu modern-dropdown">
                        <li><a class="dropdown-item" href="{{ route('materiels.index') }}">
                            <i class="bi bi-list-ul"></i> Voir tous
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('materiels.create') }}">
                            <i class="bi bi-plus-circle"></i> Ajouter
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('materiels.index') }}?filter=active">
                            <i class="bi bi-check-circle"></i> Actifs
                        </a></li>
                    </ul>
                </li>

                <!-- Sociétés avec dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link modern-nav-link dropdown-toggle {{ request()->routeIs('societes.*') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-building nav-icon"></i>
                        <span>Sociétés</span>
                        <div class="nav-indicator"></div>
                    </a>
                    <ul class="dropdown-menu modern-dropdown">
                        <li><a class="dropdown-item" href="{{ route('societes.index') }}">
                            <i class="bi bi-list-ul"></i> Voir toutes
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('societes.create') }}">
                            <i class="bi bi-plus-circle"></i> Ajouter
                        </a></li>
                    </ul>
                </li>

                <!-- Affectations avec dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link modern-nav-link dropdown-toggle {{ request()->routeIs('affectations.*') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-badge-fill nav-icon"></i>
                        <span>Affectations</span>
                        <div class="nav-indicator"></div>
                    </a>
                    <ul class="dropdown-menu modern-dropdown">
                        <li><a class="dropdown-item" href="{{ route('affectations.index') }}">
                            <i class="bi bi-list-ul"></i> Voir toutes
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('affectations.create') }}">
                            <i class="bi bi-plus-circle"></i> Nouvelle affectation
                        </a></li>
                    </ul>
                </li>

                <!-- Contrats avec dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link modern-nav-link dropdown-toggle {{ request()->routeIs('contrats.*') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-file-earmark-text-fill nav-icon"></i>
                        <span>Contrats</span>
                        <div class="nav-indicator"></div>
                    </a>
                    <ul class="dropdown-menu modern-dropdown">
                        <li><a class="dropdown-item" href="{{ route('contrats.index') }}">
                            <i class="bi bi-list-ul"></i> Voir tous
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('contrats.create') }}">
                            <i class="bi bi-plus-circle"></i> Nouveau contrat
                        </a></li>
                    </ul>
                </li>

                <!-- Utilisateurs -->
                <li class="nav-item">
                    <a class="nav-link modern-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="bi bi-people-fill nav-icon"></i>
                        <span>Utilisateurs</span>
                        <div class="nav-indicator"></div>
                    </a>
                </li>

                <!-- Séparateur -->
                <li class="nav-item nav-divider"></li>





                 <li class="nav-item dropdown">
                    <a class="nav-link modern-nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle nav-icon"></i>
                        <span>{{ Auth::user()->name ?? 'Utilisateur' }}</span>
                    </a>
                    <ul class="dropdown-menu modern-dropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person-gear"></i> Profil
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link modern-nav-link dropdown-toggle position-relative" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false" id="notifDropdown">
                        <i class="bi bi-bell-fill nav-icon"></i>
                        <span>

                            @if(isset($materielsFaibleStock) && $materielsFaibleStock->count() > 0)
                                <span class="notification-count text-danger fw-bold">({{ $materielsFaibleStock->count() }})</span>
                            @endif
                        </span>
                        @if(isset($materielsFaibleStock) && $materielsFaibleStock->count() > 0)
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle badge rounded-pill">
                                {{ $materielsFaibleStock->count() }}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end modern-dropdown" aria-labelledby="notifDropdown" style="min-width: 300px;">
                        <li class="dropdown-header">Matériels en stock faible</li>
                        @if(isset($materielsFaibleStock) && $materielsFaibleStock->count() > 0)
                            @foreach($materielsFaibleStock as $materiel)
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('materiels.index') }}">
                                        <span>{{ $materiel->nom }} (Réf: {{ $materiel->reference }})</span>
                                        <span class="badge bg-danger rounded-pill">{{ $materiel->quantite }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><span class="dropdown-item-text text-muted">Aucun matériel en stock faible.</span></li>
                        @endif
                    </ul>
                </li>

                <!-- Profil -->

            </ul>
        </div>
    </div>
</nav>

<!-- Contenu principal pour démonstration -->
<main class="main-content">
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12">
                <div class="content-card">
                    <!-- Breadcrumb dynamique -->
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb modern-breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="bi bi-house-door"></i> Accueil
                                </a>
                            </li>
                            @if(request()->routeIs('materiels.*'))
                                <li class="breadcrumb-item active">Matériels</li>
                            @elseif(request()->routeIs('societes.*'))
                                <li class="breadcrumb-item active">Sociétés</li>
                            @elseif(request()->routeIs('affectations.*'))
                                <li class="breadcrumb-item active">Affectations</li>
                            @elseif(request()->routeIs('contrats.*'))
                                <li class="breadcrumb-item active">Contrats</li>
                            @else
                                <li class="breadcrumb-item active">Dashboard</li>
                            @endif
                        </ol>
                    </nav>

                    <h1 class="display-4 fw-bold text-gradient mb-4">
                        @if(request()->routeIs('materiels.*'))
                            Gestion des Matériels
                        @elseif(request()->routeIs('societes.*'))
                            Gestion des Sociétés
                        @elseif(request()->routeIs('affectations.*'))
                            Gestion des Affectations
                        @elseif(request()->routeIs('contrats.*'))
                            Gestion des Contrats
                        @else
                            Dashboard
                        @endif
                    </h1>

                    <p class="lead text-muted mb-5">
                        Bienvenue dans votre panneau d'administration moderne
                    </p>

                    <!-- Quick Actions -->
                    <div class="row g-3 mb-5">
                        <div class="col-md-3">
                            <a href="{{ route('materiels.create') }}" class="btn btn-primary btn-lg w-100 modern-action-btn">
                                <i class="bi bi-plus-circle me-2"></i>
                                Nouveau Matériel
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('societes.create') }}" class="btn btn-success btn-lg w-100 modern-action-btn">
                                <i class="bi bi-building me-2"></i>
                                Nouvelle Société
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('affectations.create') }}" class="btn btn-info btn-lg w-100 modern-action-btn">
                                <i class="bi bi-person-plus me-2"></i>
                                Nouvelle Affectation
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('contrats.create') }}" class="btn btn-warning btn-lg w-100 modern-action-btn">
                                <i class="bi bi-file-plus me-2"></i>
                                Nouveau Contrat
                            </a>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="stat-card">
                                <div class="stat-icon bg-primary">
                                    <i class="bi bi-hdd-network-fill"></i>
                                </div>
                                <div class="stat-content">
                                    <p class="stat-label">Matériels</p>
                                    <a href="{{ route('materiels.index') }}" class="stat-link">Voir tous <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="stat-card">
                                <div class="stat-icon bg-success">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div class="stat-content">
                                    <p class="stat-label">Sociétés</p>
                                    <a href="{{ route('societes.index') }}" class="stat-link">Voir toutes <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="stat-card">
                                <div class="stat-icon bg-info">
                                    <i class="bi bi-person-badge-fill"></i>
                                </div>
                                <div class="stat-content">
                                    <p class="stat-label">Affectations</p>
                                    <a href="{{ route('affectations.index') }}" class="stat-link">Voir toutes <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="stat-card">
                                <div class="stat-icon bg-warning">
                                    <i class="bi bi-file-earmark-text-fill"></i>
                                </div>
                                <div class="stat-content">
                                    <p class="stat-label">Contrats</p>
                                    <a href="{{ route('contrats.index') }}" class="stat-link">Voir tous <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Variables CSS */
:root {
    --navbar-height: 80px;
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --info-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --navbar-bg: rgba(15, 23, 42, 0.95);
    --navbar-border: rgba(148, 163, 184, 0.15);
    --nav-hover: rgba(255, 255, 255, 0.1);
    --nav-active: rgba(99, 102, 241, 0.15);
    --text-primary: #f8fafc;
    --text-secondary: #cbd5e1;
    --accent-color: #6366f1;
    --shadow-navbar: 0 8px 32px rgba(0, 0, 0, 0.12);
    --shadow-card: 0 4px 20px rgba(0, 0, 0, 0.08);
}

/* Reset et base */
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding-top: var(--navbar-height);
}

/* Navbar moderne */
.modern-navbar {
    background: var(--navbar-bg) !important;
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--navbar-border);
    box-shadow: var(--shadow-navbar);
    padding: 0.75rem 0;
    min-height: var(--navbar-height);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1030;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-navbar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--primary-gradient);
    opacity: 0.8;
}

/* Brand styling */
.modern-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-primary) !important;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.375rem;
    transition: all 0.3s ease;
    position: relative;
}

.brand-icon {
    width: 45px;
    height: 45px;
    background: var(--primary-gradient);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.brand-icon::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
    transform: rotate(45deg) translateX(-100%);
    transition: transform 0.6s ease;
}

.modern-brand:hover .brand-icon::before {
    transform: rotate(45deg) translateX(100%);
}

.modern-brand:hover .brand-icon {
    transform: scale(1.05) rotate(3deg);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.brand-text {
    background: linear-gradient(135deg, var(--text-primary), var(--accent-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Toggle button moderne */
.modern-toggler {
    border: none;
    padding: 0.5rem;
    background: transparent;
    display: flex;
    flex-direction: column;
    gap: 4px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.modern-toggler:focus {
    box-shadow: none;
    background: var(--nav-hover);
}

.toggler-line {
    width: 25px;
    height: 2px;
    background: var(--text-primary);
    border-radius: 2px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: center;
}

.modern-toggler[aria-expanded="true"] .toggler-line:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
}

.modern-toggler[aria-expanded="true"] .toggler-line:nth-child(2) {
    opacity: 0;
    transform: scale(0);
}

.modern-toggler[aria-expanded="true"] .toggler-line:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
}

/* Navigation links */
.modern-nav-link {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.75rem 1.25rem !important;
    color: var(--text-secondary) !important;
    font-weight: 500;
    font-size: 0.95rem;
    border-radius: 12px;
    margin: 0 0.25rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.modern-nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--nav-hover);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
    z-index: -1;
}

.modern-nav-link:hover::before,
.modern-nav-link.active::before {
    transform: scaleX(1);
}

.modern-nav-link:hover,
.modern-nav-link.active {
    color: var(--text-primary) !important;
    transform: translateY(-1px);
}

.nav-icon {
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.modern-nav-link:hover .nav-icon {
    transform: scale(1.1);
}

.nav-indicator {
    position: absolute;
    bottom: -2px;
    left: 50%;
    width: 0;
    height: 2px;
    background: var(--accent-color);
    border-radius: 2px;
    transform: translateX(-50%);
    transition: width 0.3s ease;
}

.modern-nav-link:hover .nav-indicator,
.modern-nav-link.active .nav-indicator {
    width: 70%;
}

/* Dropdown moderne */
.modern-dropdown {
    background: var(--navbar-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--navbar-border);
    border-radius: 16px;
    padding: 0.5rem;
    margin-top: 0.5rem;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    min-width: 200px;
}

.modern-dropdown .dropdown-item {
    color: var(--text-secondary);
    padding: 0.75rem 1rem;
    border-radius: 12px;
    margin-bottom: 0.25rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-dropdown .dropdown-item:hover {
    background: var(--nav-hover);
    color: var(--text-primary);
    transform: translateX(5px);
}

.modern-dropdown .dropdown-item.text-danger:hover {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.modern-dropdown .dropdown-divider {
    border-color: var(--navbar-border);
    margin: 0.5rem 0;
}

/* Séparateur */
.nav-divider {
    position: relative;
    margin: 0 1rem;
}

.nav-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 1px;
    height: 20px;
    background: var(--navbar-border);
    transform: translate(-50%, -50%);
}

/* Breadcrumb moderne */
.modern-breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.modern-breadcrumb .breadcrumb-item a {
    color: var(--accent-color);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.modern-breadcrumb .breadcrumb-item a:hover {
    color: #4338ca;
}

.modern-breadcrumb .breadcrumb-item.active {
    color: #64748b;
}

/* Boutons d'action modernes */
.modern-action-btn {
    border: none;
    border-radius: 16px;
    padding: 1rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.modern-action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.modern-action-btn:hover::before {
    left: 100%;
}

.modern-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Styles pour le contenu principal */
.main-content {
    background: transparent;
    min-height: calc(100vh - var(--navbar-height));
}

.content-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 3rem;
    box-shadow: var(--shadow-card);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.text-gradient {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Cartes de statistiques */
.stat-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: var(--shadow-card);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
}

.stat-card:hover::before {
    transform: scaleX(1);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    position: relative;
    overflow: hidden;
    align-self: flex-start;
}

.stat-icon.bg-primary { background: var(--primary-gradient); }
.stat-icon.bg-success { background: var(--success-gradient); }
.stat-icon.bg-info { background: var(--info-gradient); }
.stat-icon.bg-warning { background: var(--secondary-gradient); }

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.stat-label {
    color: #64748b;
    font-size: 0.95rem;
    margin-bottom: 0.75rem;
    font-weight: 500;
}

.stat-link {
    color: var(--accent-color);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.stat-link:hover {
    color: #4338ca;
    gap: 0.75rem;
}

/* Styles pour le compteur de notifications dans le texte */
.notification-count {
    font-size: 0.85em;
    color: #f8fafc;
    background: rgba(239, 68, 68, 0.2);
    padding: 0.15em 0.4em;
    border-radius: 50px;
    margin-left: 0.25rem;
    transition: all 0.3s ease;
}

.modern-nav-link:hover .notification-count {
    background: rgba(239, 68, 68, 0.3);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }

/* Responsive design */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background: var(--navbar-bg);
        margin-top: 1rem;
        padding: 1rem;
        border-radius: 16px;
        border: 1px solid var(--navbar-border);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    }

    .modern-nav-link {
        margin: 0.25rem 0;
        justify-content: flex-start;
    }

    .nav-divider::before {
        width: 100%;
        height: 1px;
        top: 0;
        left: 0;
        transform: none;
    }

    .content-card {
        padding: 2rem 1.5rem;
    }

    .stat-card {
        padding: 1.5rem;
    }
}

@media (max-width: 575.98px) {
    .brand-text {
        display: none;
    }

    .modern-nav-link span {
        font-size: 0.9rem;
    }

    .stat-card {
        text-align: center;
    }
}

/* Effet de scroll */
.navbar-scrolled {
    background: rgba(15, 23, 42, 0.98) !important;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

/* Animation d'apparition des éléments */
.modern-nav-link {
    opacity: 0;
    animation: fadeInDown 0.6s ease forwards;
}

.modern-nav-link:nth-child(1) { animation-delay: 0.1s; }
.modern-nav-link:nth-child(2) { animation-delay: 0.2s; }
.modern-nav-link:nth-child(3) { animation-delay: 0.3s; }
.modern-nav-link:nth-child(4) { animation-delay: 0.4s; }

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Focus states pour l'accessibilité */
.modern-nav-link:focus,
.modern-action-btn:focus {
    outline: 2px solid var(--accent-color);
    outline-offset: 2px;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

/* Styles pour les notifications */
.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ef4444;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

/* Styles pour les alertes contextuelles */
.context-alert {
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 2rem;
    color: #1e40af;
}

.context-alert i {
    margin-right: 0.5rem;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.modern-navbar');
    const navLinks = document.querySelectorAll('.modern-nav-link:not(.dropdown-toggle)');
    const dropdownLinks = document.querySelectorAll('.dropdown-toggle');

    // Effet de scroll sur la navbar
    window.addEventListener('scroll', function() {
        if (window.scrollY > 20) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // Gestion des liens actifs (pour les liens simples)
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Ne pas empêcher la navigation par défaut pour les vrais liens Laravel
            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault();
            }

            // Retirer la classe active de tous les liens simples
            navLinks.forEach(l => l.classList.remove('active'));
            // Retirer la classe active des dropdowns
            dropdownLinks.forEach(l => l.classList.remove('active'));

            // Ajouter la classe active au lien cliqué
            this.classList.add('active');

            // Fermer le menu mobile
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse && window.innerWidth < 992) {
                bsCollapse.hide();
            }
        });
    });

    // Gestion des dropdowns actifs
    dropdownLinks.forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            // Retirer la classe active de tous les autres dropdowns
            dropdownLinks.forEach(d => {
                if (d !== this) d.classList.remove('active');
            });
            // Retirer la classe active des liens simples
            navLinks.forEach(l => l.classList.remove('active'));
        });
    });

    // Gestion des liens dans les dropdowns
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            // Ne pas empêcher la navigation par défaut pour les vrais liens Laravel
            if (this.getAttribute('href') && this.getAttribute('href').startsWith('#')) {
                e.preventDefault();
            }

            // Fermer le menu mobile
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse && window.innerWidth < 992) {
                bsCollapse.hide();
            }
        });
    });

    // Animation d'entrée pour les cartes
    const cards = document.querySelectorAll('.stat-card');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    cards.forEach(card => {
        observer.observe(card);
    });

    // Effet de parallaxe léger pour le fond
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(function() {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                document.body.style.backgroundPosition = `center ${rate}px`;
                ticking = false;
            });
            ticking = true;
        }
    });

    // Amélioration de l'accessibilité
    document.querySelectorAll('.modern-nav-link, .modern-action-btn').forEach(element => {
        element.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Gestion des tooltips pour les éléments avec title
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Auto-fermeture des dropdowns au clic extérieur (amélioration mobile)
    document.addEventListener('click', function(e) {
        const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
        openDropdowns.forEach(dropdown => {
            if (!dropdown.contains(e.target) && !dropdown.previousElementSibling.contains(e.target)) {
                const bsDropdown = bootstrap.Dropdown.getInstance(dropdown.previousElementSibling);
                if (bsDropdown) {
                    bsDropdown.hide();
                }
            }
        });
    });
});

// Fonction utilitaire pour mettre à jour les notifications
function updateNotificationBadge(element, count) {
    const badge = element.querySelector('.notification-badge');
    const countText = element.querySelector('.notification-count');

    if (count > 0) {
        // Mise à jour du badge
        if (!badge) {
            const newBadge = document.createElement('span');
            newBadge.className = 'notification-badge';
            newBadge.textContent = count > 99 ? '99+' : count;
            element.style.position = 'relative';
            element.appendChild(newBadge);
        } else {
            badge.textContent = count > 99 ? '99+' : count;
        }

        // Mise à jour du compteur dans le texte
        if (!countText) {
            const span = element.querySelector('span');
            const newCountText = document.createElement('span');
            newCountText.className = 'notification-count';
            newCountText.textContent = `(${count > 99 ? '99+' : count})`;
            span.appendChild(newCountText);
        } else {
            countText.textContent = `(${count > 99 ? '99+' : count})`;
        }
    } else {
        // Suppression des indicateurs si pas de notifications
        if (badge) badge.remove();
        if (countText) countText.remove();
    }
}
</script>

</body>
</html>
