<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Whoossh Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-[#0f0f23] via-[#1a1a2e] to-[#16213e] font-sans antialiased flex items-center justify-center p-4">

    {{-- Animated Background --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-red-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-red-600/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-red-500 to-red-700 shadow-2xl shadow-red-500/30 mb-4">
                <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h1 class="text-3xl font-black text-white tracking-tight">Whoossh</h1>
            <p class="text-gray-400 mt-1 text-sm">High Speed Train Management System</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-2xl">
            <h2 class="text-xl font-bold text-white mb-1">Welcome Back</h2>
            <p class="text-gray-400 text-sm mb-6">Sign in to access your dashboard</p>

            @if($errors->any())
                <div class="mb-5 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-300 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500/50 transition-all duration-200"
                            placeholder="admin@whoossh.id">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" name="password" required
                            class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500/50 transition-all duration-200"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 px-6 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-2xl shadow-lg shadow-red-500/30 hover:shadow-red-500/50 transition-all duration-300 active:scale-[0.98]">
                    Sign In
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-white/10 text-center space-y-2">
                <p class="text-gray-500 text-xs">Default Credentials</p>
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 rounded-xl bg-white/5 border border-white/5">
                        <p class="text-xs font-semibold text-red-400">Admin</p>
                        <p class="text-xs text-gray-400 mt-1">admin@whoossh.id</p>
                        <p class="text-xs text-gray-500">admin123</p>
                    </div>
                    <div class="p-3 rounded-xl bg-white/5 border border-white/5">
                        <p class="text-xs font-semibold text-orange-400">Manager</p>
                        <p class="text-xs text-gray-400 mt-1">manager@whoossh.id</p>
                        <p class="text-xs text-gray-500">manager123</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-center text-gray-600 text-xs mt-6">&copy; 2026 Whoossh. All rights reserved.</p>
    </div>
</body>
</html>
