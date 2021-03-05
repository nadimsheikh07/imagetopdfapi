<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as LaravelPdf;

class ImageExportController extends Controller
{
    public function index()
    {
        $data['images'] = [
            public_path('/images/image4.jpeg'),
            public_path('/images/image5.jpeg'),
            public_path('/images/image6.jpeg'),
        ];

        $pdf = LaravelPdf::loadView("pdf/exportImage", $data, [], [
            'mode'             => 'utf-8',
            'format'           => 'A4',
            'author'           => '',
            'subject'          => '',
            'keywords'         => '',
            'creator'          => '',
            'display_mode'     => 'fullpage',
            // 'font_path' => base_path('fonts/'),
            // 'font_data' => [
            //     'suisse' => [
            //         'R' => public_path('/fonts/SuisseIntl-Regular.ttf'),
            //         'B' => public_path('/fonts/SuisseIntl-Bold.ttf'),
            //         'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            //         'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
            //     ],
            // ],
        ]);

        return $pdf->stream('document.pdf');
    }
}
