<section class="min-h-screen flex items-center justify-center bg-gray-100">

    <section class="grid grid-cols-2 gap-2">
        
        <div class="w-full max-w-md">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Contraseñas Seguras, <span class="text-blue-600">sin complicaciones</span>
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                Genera, guarda y administra tus contraseñas con total seguridad. Nunca más olvides una contraseña o
                comprometas tu seguridad online.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700/90 hover:cursor-pointer transition-colors font-medium">
                  Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="px-6 py-3 border border-gray-300 text-gray-700 hover:cursor-pointer rounded-md hover:bg-gray-50 transition-colors font-medium">
                  Registrarse
                </a>
            </div>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Generador de Contraseñas Seguras</h1>
    
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña Generada</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input 
                        id="password" 
                        type="{{ $showPassword ? 'text' : 'password' }}" 
                        value="{{ $password }}" 
                        readonly
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    >
                    <button 
                        wire:click="toggleShowPassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                    >
                        @if($showPassword)
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.053 0 2.062.18 3 .512v14.313zM15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        @endif
                    </button>
                </div>
            </div>
    
            <button 
                wire:click="generatePassword" 
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                {{ $attempts >= $maxAttempts ? 'disabled' : '' }}
            >
                Generar Nueva Contraseña
            </button>
    
            @if($attempts >= $maxAttempts)
                <p class="mt-4 text-sm text-red-600">Has alcanzado el límite de intentos.</p>
            @endif
        </div>
    </section>

</section>
