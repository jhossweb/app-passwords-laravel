<div class="p-4 sm:p-6 lg:p-8">
    <x-action-section>
        <x-slot name="content">
            <!-- Botón para abrir el modal -->
            <x-button wire:click="openModal" class="w-full sm:w-auto">
                Nuevo
            </x-button>

            <!-- Mensajes de sesión -->
            @if (session()->has('message'))
                <div id="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 mt-4">
                    {{ session('message') }}
                    <button onclick="closeMessage('successMessage')" class="absolute top-0 right-0 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mt-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Título de la sección -->
            <h2 class="text-xl text-center font-semibold mb-4 mt-6">Contraseñas Guardadas</h2>

            <!-- Lista de contraseñas -->
            <div class="space-y-4">
                @foreach($passwords as $pass)
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                            <!-- Información del sitio -->
                            <div class="mb-2 md:mb-0">
                                <h3 class="font-semibold">{{ $pass->title_site }}</h3>
                                <p class="text-sm text-gray-600">{{ $pass->site_url }}</p>
                            </div>

                            <!-- Controles (copiar y eliminar) -->
                            <div class="flex items-center space-x-2">
                                <input 
                                    data-password-input="{{ $pass->id }}" 
                                    type="password" 
                                    value="{{ $pass->gen_password }}" 
                                    class="w-full md:w-auto p-1 border border-gray-300 rounded-lg mr-2" 
                                    readonly
                                >
                                <button 
                                    data-copy-button="{{ $pass->id }}"
                                    class="p-1 text-blue-500 hover:text-blue-600" 
                                    title="Copiar contraseña"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                    </svg>
                                </button>
                                <button 
                                    class="p-1 text-red-500 hover:text-red-600" 
                                    wire:click="delete({{ $pass->id }})" 
                                    wire:confirm="¿Estás seguro que quieres eliminar la contraseña de {{ $pass->title_site }}?"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-slot>
    </x-action-section>

    <!-- Modal para agregar nueva contraseña -->
    <form wire:submit="save">
        <x-dialog-modal wire:model="vissible">
            <x-slot name="title">Nueva Contraseña</x-slot>

            <x-slot name="content">
                <div class="grid gap-4">
                    <!-- Campo: Nombre del sitio -->
                    <div class="mb-5">
                        <x-label for="title_site">Nombre del Sitio</x-label>
                        <x-input type="text" class="w-full" placeholder="Nombre del Sitio" wire:model="passwordForm.title_site" />
                        <span class="text-red-400">@error('passwordForm.title_site') {{ $message }} @enderror</span>
                    </div>

                    <!-- Campo: URL -->
                    <div class="mb-5">
                        <x-label for="site_url">URL:</x-label>
                        <x-input type="text" class="w-full" placeholder="Url" wire:model="passwordForm.site_url" />
                        <span class="text-red-400">@error('passwordForm.site_url') {{ $message }} @enderror</span>
                    </div>

                    <!-- Campo: Contraseña -->
                    <div class="mb-5">
                        <x-label for="gen_password">Contraseña</x-label>
                        <x-input type="text" readonly class="w-full" value="{{ $this->passwordForm->gen_password }}" wire:model="passwordForm.gen_password" />
                        <span class="text-red-400">@error('passwordForm.gen_password') {{ $message }} @enderror</span>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button type="submit">Guardar</x-button>
                <x-danger-button wire:click="$set('vissible', false)">Cancelar</x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>

<script>
    
    // Función para cerrar el mensaje
    function closeMessage(elementId) {
        const messageElement = document.getElementById(elementId);
        if (messageElement) {
            messageElement.style.display = 'none'; // Oculta el mensaje
        }
    }
</script>