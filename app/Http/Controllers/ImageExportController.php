<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf as LaravelPdf;

class ImageExportController extends Controller
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();

        if (request('images')) {
            $images = json_decode(request('images'));
        }

        $responseData = [];

        if ($images) {
            foreach ($images as $value) {
                $response = $client->request('GET', "https://dev.kpmglg.com/ords/ms/BASE64/GET_IMAGES/{$value}");

                $statusCode = $response->getStatusCode();

                if ($statusCode == 200) {
                    $content =  json_decode($response->getBody());
                    // create image using base64
                    Storage::disk('public_uploads')->put("{$value}.png", base64_decode($content->file_content));
                    if (Storage::disk('public_uploads')->exists("{$value}.png")) {
                        $responseData[] = public_path("uploads/{$value}.png");
                    }
                }
            }
        }

        $data['images'] = $responseData;

        // $data['images'] = [
        //     asset('/images/image4.jpeg'),
        //     asset('/images/image5.jpeg'),
        //     asset('/images/image6.jpeg'),
        // ];

        // return view('pdf/exportImage', $data);

        // $data['images'] = [
        //     public_path('/images/image4.jpeg'),
        //     public_path('/images/image5.jpeg'),
        //     public_path('/images/image6.jpeg'),
        // ];

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


        // delete images
        if ($images) {
            foreach ($images as $value) {
                Storage::disk('public_uploads')->delete("{$value}.png");
            }
        }

        return $pdf->stream('document.pdf');
    }

    public function sendMail(Request $request)
    {

        $APIKEY = $request->header('API_KEY');

        if ($APIKEY !== env('API_KEY')) {
            return response()->json(['message' => 'API KEY is not valid!'], 406);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) :
            return response()->json(['errors' => $validator->errors(), 'message' => 'Validation Error!'], 406);
        endif;
        $input = $request->all();


        Mail::send(new SendMail($input['email'], $input['subject'], $input['body']));

        if (Mail::failures()) {
            $message = 'Mail Sending Failed.';
            return response()->json(['message' => $message], 500);
        } else {
            $message = 'Mail Send Successfully.';
            return response()->json(['message' => $message], 200);
        }
    }
}
