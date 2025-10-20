<?php

namespace App\Traits;

trait ChartTrait
{
    function runChart($data)
    {
        $this->options($type = 'line', $data->getData(), $data->getLabels());
    }

    public function options($type = 'line', $data = [], $labels = [])
    {
        $this->options = [
            "type" => $type,
            "rtl" => true,
            "locale" => 'ar',
            // "options" => [
            //     "plugins" => [
            //         "title" => [
            //             "display" => true,
            //             // "text" =>  $this->chartTitle,
            //             "font" => [
            //                 "size" => 18,
            //                 "family" => 'effra',
            //                 "weight" => 'normal',
            //             ],
            //         ],
            //     ],
            // ],
            "data" => [
                "labels" => $labels,
                "datasets" => [[
                    "label" => $this->chartTitle,
                    "data" => $data,
                    "borderWidth" => 2,
                    "fill" => 'start',
                    "backgroundColor" => '#9FD1F5',
                    "borderColor" => '#36A2EB',
                    "tension" => '0.2',
                ]],
            ],
        ];
    }

    public function placeholder()
    {
        return loadingIcon();
    }
}
