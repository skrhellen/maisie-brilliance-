<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Joias;
class JoiasValorChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $joias = Joias::orderBy('valor','desc')->get();

        $valores = [];
        $nomes = [];

        foreach($joias as $item){
            $valores[]= $item->valor;
            $nomes[]= $item->nome;
        }

        return $this->chart
            ->pieChart()
            ->setTitle('Valores Joias')
            //->setColors(['#FFC107', '#D32F2F'])
            ->addData($valores)
           // ->addData("Joias", $valores)
            ->setLabels($nomes);
    }
}