<div>
    <button 
        wire:click="toggleStatus"
        type="button" 
        @class([
            'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
            'bg-green-500' => $isActive,
            'bg-gray-200' => !$isActive,
        ])
    >
        <span class="sr-only">Toggle status</span>
        <span 
            @class([
                'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                'translate-x-5' => $isActive,
                'translate-x-0' => !$isActive,
            ])
        ></span>
    </button>
</div>