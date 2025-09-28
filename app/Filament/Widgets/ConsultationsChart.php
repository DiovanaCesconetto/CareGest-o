<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\ChartWidget;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ConsultationsChart extends ChartWidget
{
    protected static ?string $heading = 'Avanço de Consultas (Mensal)';
    protected static ?int $sort = 2; // aparece depois do filtro
protected static string $position = 'normal'; // garante que fica na linha de cima

    protected function getType(): string
    {
        return 'line';
    }

    public ?string $startDate = null;
    public ?string $endDate = null;

    #[On('filterApplied')]
    public function updateDates(?string $startDate, ?string $endDate): void
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    protected function getData(): array
    {
        $medico = auth()->user()->medico;

        if (!$medico) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $query = Consulta::query()->where('medico_id', $medico->id);

        if ($this->startDate && $this->endDate) {
        $query->whereRaw('SUBSTR(data, 1, 10) BETWEEN ? AND ?', [$this->startDate, $this->endDate]);
        }

        $data = $query
            ->selectRaw('DATE_FORMAT(SUBSTR(data, 1, 10), "%Y-%m") as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        return [
            'datasets' => [
                [
                    'label' => 'Total de Consultas',
                    'data' => $data->pluck('count'),
                ],
            ],
            'labels' => $data->pluck('month'),
        ];
    }
}