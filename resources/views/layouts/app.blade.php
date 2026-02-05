<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Project Management') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #5B7FFF;
            --primary-dark: #4567E8;
            --primary-light: #E8EEFF;
            --sidebar-bg: #1A1F36;
            --sidebar-hover: #252B44;
            --text-dark: #1E293B;
            --text-light: #64748B;
            --text-lighter: #94A3B8;
            --bg-main: #F8FAFC;
            --white: #FFFFFF;
            --border: #E2E8F0;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --purple: #8B5CF6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-main);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* App Container */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #141829 100%);
            color: var(--white);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.closed {
            transform: translateX(-280px);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        /* Logo Section */
        .sidebar-logo {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--purple) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(91, 127, 255, 0.3);
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--white) 0%, #A8B8FF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* User Profile */
        .sidebar-profile {
            padding: 1.5rem;
            margin: 1rem;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .profile-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--purple) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(91, 127, 255, 0.3);
        }

        .profile-details h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
            color: var(--white);
        }

        .profile-role {
            display: inline-block;
            font-size: 0.75rem;
            color: var(--primary);
            background: rgba(91, 127, 255, 0.2);
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-weight: 600;
        }

        /* Navigation Menu */
        .sidebar-nav {
            padding: 1.5rem 1rem;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-lighter);
            font-weight: 600;
            padding: 0 0.75rem;
            margin-bottom: 0.75rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 0.3rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 0.75rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--white);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--purple) 100%);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(91, 127, 255, 0.3);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: var(--white);
            border-radius: 0 4px 4px 0;
        }

        .nav-icon {
            font-size: 1.3rem;
            width: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--danger);
            color: var(--white);
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
            border-radius: 8px;
            font-weight: 600;
        }

        /* Logout Button */
        .sidebar-footer {
            padding: 1.5rem;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 0.75rem;
            background: rgba(239, 68, 68, 0.15);
            color: #FCA5A5;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.95rem;
            border: 1px solid rgba(239, 68, 68, 0.3);
            width: 100%;
        }

        .logout-btn:hover {
            background: var(--danger);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--purple) 100%);
            border-radius: 50%;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(91, 127, 255, 0.4);
            z-index: 999;
            transition: all 0.3s ease;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle:hover {
            transform: scale(1.1);
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-280px);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: flex;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                max-width: 280px;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Logo -->
            <div class="sidebar-logo">
                <div class="logo-text" style="text-align: center;">Manajemen System</div>
            </div>

            <!-- User Profile -->
            <div class="sidebar-profile">
                <div class="profile-info">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="profile-details">
                        <h4>{{ auth()->user()->name }}</h4>
                        <span class="profile-role">
                            @role('Admin')
                                Admin
                            @endrole
                            @role('Project Manager')
                                Project Manager
                            @endrole
                            @role('Member')
                                Member
                            @endrole
                        </span>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <!-- Admin Navigation -->
                @role('Admin')
                <div class="nav-section">
                    <div class="nav-section-title">Menu</div>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <span class="nav-icon"></span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                <span class="nav-icon"></span>
                                <span>Manajemen User</span>
                            </a>
                        </li>

                    </ul>
                </div>
                @endrole

                <!-- Project Manager Navigation -->
                @role('Project Manager')
                <div class="nav-section">
                    <div class="nav-section-title">Menu</div>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <span class="nav-icon"></span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                                <span class="nav-icon"></span>
                                <span>Proyek</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                                <span class="nav-icon"></span>
                                <span>Tugas</span>
                            </a>
                        </li>
                    </ul>
                </div>
                @endrole

                <!-- Member Navigation -->
                @role('Member')
                <div class="nav-section">
                    <div class="nav-section-title">Menu</div>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <span class="nav-icon"></span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                                <span class="nav-icon"></span>
                                <span>Tugas Saya</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                                <span class="nav-icon"></span>
                                <span>Projek Saya</span>
                            </a>
                        </li>
                    </ul>
                </div>
                @endrole

            <!-- Logout -->
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <span class="nav-icon"></span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            @yield('content')
        </main>

        <!-- Mobile Menu Toggle -->
        <button class="menu-toggle" id="menuToggle">☰</button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.getElementById('mainContent');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('active');
        });

        // Close sidebar when clicking a link on mobile
        if (window.innerWidth <= 1024) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    sidebar.classList.remove('open');
                    sidebarOverlay.classList.remove('active');
                });
            });
        }
    </script>
</body>
</html>