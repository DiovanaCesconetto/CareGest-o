<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Consulta;
use Livewire\Attributes\On;

class DashboardStats extends BaseWidget

{
//    protected static string $position = 'sidebar'; // ou 'normal'
    

    public ?string $startDate = null;
    public ?string $endDate = null;

    protected static ?int $sort = 1; // linha de cima
protected static string $position = 'normal'; // garante que fica na linha de cima


    #[On('filterApplied')]
    public function updateDates(?string $startDate, ?string $endDate): void
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    $this->dispatch('refresh'); // Use esta linha para forçar o recarregamento

    }

    protected function getStats(): array
{
    $user = auth()->user();
    $medicoId = $user->medico->id ?? null;

    if (!$medicoId) {
        return [
            Card::make('Total de Consultas', 0)->color('success'),
            Card::make('Valor Faturado', 'R$ 0,00')->color('primary'),
            Card::make('Consultas Canceladas', 0)->color('danger'),
        ];
    }

    // Base query com médico e período
    $query = Consulta::where('medico_id', $medicoId);

    if ($this->startDate && $this->endDate) {
        $query->whereBetween('data', [$this->startDate, $this->endDate]);
    }

    $totalConsultas = (clone $query)->count();
    $valorTotal = (clone $query)->sum('valor');
    $totalConsultasCanceladas = (clone $query)
        ->where('status', 'cancelada')
        ->count();

    return [
        Card::make('Total de Consultas', $totalConsultas)
            ->description('Consultas registradas por você')
            ->descriptionIcon('heroicon-m-clipboard-document-check')
            ->color('success'),

        Card::make('Valor Faturado', 'R$ ' . number_format($valorTotal, 2, ',', '.'))
            ->description('Soma de todas as suas consultas')
            ->descriptionIcon('heroicon-m-banknotes')
            ->color('primary'),

        Card::make('Consultas Canceladas', $totalConsultasCanceladas)
            ->description('Consultas canceladas por você')
            ->descriptionIcon('heroicon-m-clipboard-document-check')
            ->color('danger'),
    ];
}}