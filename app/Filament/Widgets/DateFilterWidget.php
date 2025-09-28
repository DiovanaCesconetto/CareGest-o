<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;
use Filament\Forms\Form;
use Filament\Forms\Components\Actions\Action;

class DateFilterWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.date-filter-widget';
protected static ?int $sort = 2; // aparece antes dos outros widgets na mesma linha
protected static string $position = 'normal'; // garante que fica na linha de cima

public ?array $data = [];

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('start_date')
                ->label('De')
                ->default(now()->startOfMonth()->toDateString()),
            DatePicker::make('end_date')
                ->label('Até')
                ->default(now()->endOfMonth()->toDateString()),
        ];
    }
    
    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function filterData(): void
    {
        $startDate = $this->data['start_date'] ?? null;
        $endDate = $this->data['end_date'] ?? null;
        
        $this->dispatch('filterApplied', startDate: $startDate, endDate: $endDate);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('filter')
                ->label('Pesquisar')
                ->action('filterData')
                ->color('primary')
        ];
    }
}