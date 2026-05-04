<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Whoosh Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 font-sans antialiased flex">

    {{-- Left Side: Branding --}}
    <div class="hidden lg:flex w-1/2 bg-[#1a1a2e] flex-col justify-between p-12 relative overflow-hidden">
        {{-- Decorative Pattern --}}
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-red-600 mb-6">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18M5 17h14m-12-8h10M7 5h6a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z" />
                </svg>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tight mb-2">WHOOSH</h1>
            <p class="text-lg text-gray-400 max-w-md leading-relaxed">High Speed Train Management System. Streamline your operations with our professional dashboard.</p>
        </div>

        <div class="relative z-10">
            <p class="text-sm text-gray-500 font-medium uppercase tracking-widest">&copy; 2026 Whoosh Enterprise</p>
        </div>
    </div>

    {{-- Right Side: Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12">
        <div class="w-full max-w-md">
            {{-- Mobile Logo --}}
            <div class="lg:hidden mb-8 text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-red-600 mb-4">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18M5 17h14m-12-8h10M7 5h6a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">WHOOSH</h1>
            </div>

            <div class="mb-10">
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Welcome Back</h2>
                <p class="text-gray-500">Please enter your credentials to access the panel.</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-100 text-red-600 text-sm font-medium">
                    <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-slate-900 placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors"
                        placeholder="admin@whoosh.id">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-slate-900 placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors"
                        placeholder="••••••••">
                </div>

                <button type="submit" class="w-full py-3.5 px-6 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors duration-200 shadow-sm">
                    Sign In to Dashboard
                </button>
            </form>

            <!-- <div class="mt-10 pt-8 border-t border-gray-200">
                <p class="text-sm font-semibold text-slate-700 mb-4">Demo Credentials</p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-lg bg-gray-50 border border-gray-100">
                        <p class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-1">Admin</p>
                        <p class="text-sm text-gray-600">admin@whoossh.id</p>
                        <p class="text-sm font-mono text-gray-500 mt-1">admin123</p>
                    </div>
                    <div class="p-4 rounded-lg bg-gray-50 border border-gray-100">
                        <p class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-1">Manager</p>
                        <p class="text-sm text-gray-600">manager@whoossh.id</p>
                        <p class="text-sm font-mono text-gray-500 mt-1">manager123</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</body>
</html>
