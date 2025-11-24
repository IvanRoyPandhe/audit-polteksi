<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-sm border-r border-gray-200">
            <div class="p-4">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-base text-gray-900">IPASS</h1>
                        <p class="text-xs text-gray-500">Dashboard</p>
                    </div>
                </div>
            </div>
            
            <nav class="mt-4">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-blue-600 bg-blue-50 border-r-2 border-blue-600 text-sm font-medium">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                    </svg>
                    Dashboard
                </a>
                
                @php
                    $userRole = auth()->user()->role_id;
                    // 1 = Admin, 2 = Auditor, 3 = Validator, 4 = Staff, 5 = Pimpinan
                @endphp
                
                <!-- ADMIN ONLY: Master Data -->
                @if(in_array($userRole, [1]))
                <div class="px-4 py-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Master Data</p>
                </div>
                
                <a href="{{ route('standar-mutu.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Standar Mutu
                </a>
                
                <a href="{{ route('indikator-kinerja.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Indikator Kinerja
                </a>
                
                <a href="{{ route('kriteria.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Kriteria
                </a>
                @endif
                
                <!-- STAFF: Data Kinerja & Tindak Lanjut -->
                @if(in_array($userRole, [1, 4]))
                <div class="px-4 py-2 mt-4">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Data Kinerja</p>
                </div>
                
                <a href="{{ route('data-kinerja.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                    </svg>
                    Input Data Kinerja
                </a>
                
                <a href="{{ route('tindak-lanjut.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.25-4.875c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0117.25 18.75h-8.5A2.25 2.25 0 016.5 16.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.124-.08M15 12.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Tindak Lanjut
                </a>
                @endif
                
                <!-- VALIDATOR: Validasi -->
                @if(in_array($userRole, [1, 3]))
                <div class="px-4 py-2 mt-4">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Validasi</p>
                </div>
                
                <a href="{{ route('validasi.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Validasi Data
                </a>
                @endif
                
                <!-- AUDITOR: Audit & Temuan -->
                @if(in_array($userRole, [1, 2]))
                <div class="px-4 py-2 mt-4">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Audit</p>
                </div>
                
                <a href="{{ route('audit.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Audit
                </a>
                
                <a href="{{ route('audit-temuan.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                    Temuan Audit
                </a>
                
                <a href="{{ route('laporan.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    Laporan
                </a>
                @endif
                
                <!-- PIMPINAN: View Only (Laporan & Audit Trail) -->
                @if(in_array($userRole, [1, 5]))
                <div class="px-4 py-2 mt-4">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Monitoring</p>
                </div>
                
                @if($userRole == 5)
                <a href="{{ route('laporan.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    Laporan
                </a>
                @endif
                
                <a href="{{ route('audit-trail.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 text-sm">
                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                    </svg>
                    Audit Trail
                </a>
                @endif
                
                <div class="mt-6 px-4">
                    @if(auth()->check() && auth()->user()->role_id == 1)
                        <a href="{{ route('admin.users.index') }}" class="flex items-center py-2.5 text-gray-600 hover:bg-gray-50 text-sm">
                            <svg class="w-4 h-4 mr-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                            </svg>
                            User Management
                        </a>
                    @endif
                    
                    <a href="{{ route('profile.show') }}" class="flex items-center py-2.5 text-gray-600 hover:bg-gray-50 text-sm">
                        <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                        </svg>
                        Profile
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full py-2.5 text-gray-600 hover:bg-gray-50 text-sm">
                            <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-3">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">Quality Audit Dashboard</h1>
                        <p class="text-sm text-gray-500">Monitor audit performance and compliance metrics</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{auth()->user()->email}}=3b82f6&color=fff" alt="Avatar">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{auth()->user()->email}}</p>
                            <p class="text-xs text-gray-500">{{auth()->user()->name}}</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-100">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>