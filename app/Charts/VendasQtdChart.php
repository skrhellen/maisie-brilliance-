<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Vendas;
use Illuminate\Support\Facades\DB;

class VendasQtdChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        /*
            SELECT v.`data`, COUNT(v.id) AS count FROM venda v
            GROUP BY v.`data`
        */
        $venda = DB::table('venda')
                    ->selectRaw('count(1) as qtdVendas, data as data_venda')
                    ->groupBy('data')->get();

        $qtdVendas = [];
        $dataVenda = [];
        //dd($venda);

        foreach($venda as $item){
            $qtdVendas[]= $item->qtdVendas;
            $dataVenda[]= date("d/m/Y", strtotime($item->data_venda));
        }

        return $this->chart->donutChart()
            ->setTitle('Quantidade de vendas')
            ->addData($qtdVendas)
            ->setLabels($dataVenda);
    }
}