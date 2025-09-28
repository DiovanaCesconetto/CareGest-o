<x-filament-widgets::widget>
    <x-filament::card>
        <form wire:submit.prevent="filterData">
            <div class="grid gap-4 sm:grid-cols-2">
                {{ $this->form }}
            </div>

            <div class="mt-4">
                <x-filament::button type="submit" class="w-full">
                    Pesquisar
                </x-filament::button>
            </div>
        </form>
    </x-filament::card>
</x-filament-widgets::widget>