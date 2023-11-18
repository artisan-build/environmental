<div class="h-screen flex">
    <div class="w-1/3">
        @foreach ($files as $env)
            <div class="mb-4">
                <a href="{{ route('environmental.edit', $env) }}" class="text-blue-600 hover:text-blue-800">{{ $env }}</a>
            </div>
        @endforeach

    </div>
    <div class="w-1/3">
        <section id="diff" class="space-y-4 text-sm">
            @foreach ($dirty as $key => $value)
                <div>
                    <div>
                        {{ $key }}: <span class="text-red-600">{{ data_get($value, 'original') }}</span>
                    </div>
                    <div>
                        {{ $key }}: <span class="text-green-600">{{ data_get($value, 'new') }}</span>
                    </div>
                </div>
            @endforeach
        </section>

        @if ($dirty !== [])
        <div class="mt-4">
            <x-primary-button wire:click="save">Save</x-primary-button>
        </div>
        @endif
    </div>

    <div class="w-1/3 overflow-auto my-4">
        <form wire:submit.prevent>
            {{ $this->form }}
        </form>
        <x-filament-actions::modals />
    </div>



</div>
