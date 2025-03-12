<section class="min-h-screen flex items-center justify-center bg-gray-100 p-4 sm:p-6 lg:p-8">
    <!-- Contenedor principal con diseño responsive -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl w-full">
        <!-- Sección de texto -->
        <div class="w-full max-w-md mx-auto lg:mx-0 lg:max-w-full lg:pr-8">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                Contraseñas Seguras, <span class="text-blue-600">sin complicaciones</span>
            </h1>
            <p class="text-base sm:text-lg text-gray-600 mb-6 sm:mb-8">
                Genera, guarda y administra tus contraseñas con total seguridad. Nunca más olvides una contraseña o
                comprometas tu seguridad online.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700/90 hover:cursor-pointer transition-colors font-medium text-center">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="px-6 py-3 border border-gray-300 text-gray-700 hover:cursor-pointer rounded-md hover:bg-gray-50 transition-colors font-medium text-center">
                    Registrarse
                </a>
            </div>
        </div>

        <!-- Sección del generador de contraseñas -->
        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg w-full max-w-md mx-auto lg:mx-0">
            <h1 class="text-2xl font-bold mb-6 text-center">Generador de Contraseñas Seguras</h1>

            <!-- Contenedor del input de contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña Generada</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <!-- Input de contraseña -->
                    <div class="relative flex-grow">
                        <input 
                            data-password-input="home" 
                            type="{{ $showPassword ? 'text' : 'password' }}" 
                            value="{{ $password }}" 
                            readonly
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        <!-- Botón para mostrar/ocultar contraseña -->
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

                    <!-- Botón para copiar contraseña -->
                    <button 
                        data-copy-button="home"
                        class="ml-2 p-2 text-blue-500 hover:text-blue-600 rounded-md border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        title="Copiar contraseña"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                            <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Botón para generar contraseña -->
            <button 
                wire:click="generatePassword" 
                class="w-full bg-blue-600 text-white my-2 py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                {{ $attempts >= $maxAttempts ? 'disabled' : '' }}
            >
                Generar Nueva Contraseña
            </button>

            <!-- Mensaje de límite de intentos -->
            @if($attempts >= $maxAttempts)
                <p class="mt-4 text-sm text-red-600 text-center">Has alcanzado el límite de intentos.</p>
            @endif
        </div>
    </div>
</section>