<?php

namespace App\Exports;

use App\Rate;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class RatesExport implements FromView,  WithEvents
{

    protected $rate;

    public function __construct(Rate $rate)
    {
        $this->rate = $rate;
    }

    public function view(): View
    {
        $rates = $this->rate->allLastUpdated();
        $date = $rates->max('created_at')->format('d-m-Y');
        return view('pdf.currency', compact('rates', 'date'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
            $event->sheet->getDelegate()->getStyle('A1:D1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('c2c2c2');
            $event->sheet->autoSize();
            },
        ];
    }
}
