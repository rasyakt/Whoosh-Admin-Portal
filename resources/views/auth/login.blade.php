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
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/whoosh_train_bg.png') }}" alt="Whoosh Train" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-tr from-[#1a1a2e] via-[#1a1a2e]/40 to-transparent"></div>
        </div>
        
        <div class="relative z-10">
            <img src="{{ asset('img/logo_white.png') }}" alt="Whoosh Logo" class="h-20 w-auto object-contain mb-5 transition-all hover:scale-105 duration-300">
            
            <div class="max-w-md">
                <!-- <h1 class="text-5xl font-black text-white tracking-tighter leading-[0.95] mb-6 drop-shadow-2xl">
                    ADVANCED <br>
                    <span class="text-red-600">RAIL CONTROL</span>
                </h1> -->
                
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-1 w-10 bg-red-600 rounded-full"></div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-[0.3em]">Operational Excellence</span>
                </div>

                <p class="text-lg text-gray-300 leading-relaxed font-medium opacity-90">
                    Empowering Indonesia's high-speed rail with precision management and real-time analytics.
                </p>
            </div>
        </div>

        <div class="relative z-10">
            <div class="flex items-center gap-4 text-gray-500">
                <span class="text-xs font-bold uppercase tracking-widest">&copy; 2026 Whoosh Enterprise</span>
                <span class="h-1 w-1 rounded-full bg-gray-700"></span>
                <span class="text-xs font-medium">v2.4.0</span>
            </div>
        </div>
    </div>

    {{-- Right Side: Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12">
        <div class="w-full max-w-md">
            {{-- Mobile Logo --}}
            <div class="lg:hidden mb-8 text-center">
                <img src="{{ asset('img/logo_whoosh.png') }}" alt="Whoosh Logo" class="h-16 w-auto object-contain mx-auto mb-4">
            </div>

            <div class="mb-10">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Welcome Back</h2>
                <p class="text-slate-500 font-medium opacity-80">Please enter your credentials to access the panel.</p>
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

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700 ml-1">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-red-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-red-600 focus:ring-4 focus:ring-red-600/5 focus:bg-white transition-all"
                            placeholder="admin@whoosh.id">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between ml-1">
                        <label class="block text-sm font-bold text-slate-700">Password</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-red-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" required
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-red-600 focus:ring-4 focus:ring-red-600/5 focus:bg-white transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-red-600 border-slate-300 rounded focus:ring-red-500">
                    <label for="remember_me" class="ml-2 block text-sm text-slate-600 font-medium select-none">Stay signed in for 30 days</label>
                </div>

                <button type="submit" class="w-full group relative flex justify-center py-4 px-6 border border-transparent text-sm font-bold rounded-xl text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all active:scale-[0.98] shadow-lg shadow-red-600/20">
                    <!-- <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-red-500 group-hover:text-red-400 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span> -->
                    Login
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
