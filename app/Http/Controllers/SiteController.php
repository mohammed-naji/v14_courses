<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\Models\Review;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function about()
    {
        return view('site.about');
    }

    public function courses()
    {
        $courses = Course::latest('id')->paginate(6);

        return view('site.courses', compact('courses'));
    }

    public function course($slug)
    {
        $course = Course::where('slug', '=', $slug)->firstOrFail();

        return view('site.course', compact('course'));
    }

    public function enroll($slug)
    {
        $course = Course::where('slug', '=', $slug)->firstOrFail();

        // Prepare the payment
        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=" . $course->price .
                    "&currency=USD" .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        // dd($responseData);
        // return $responseData['id'];
        // return $responseData->id;

        // $responseData = json_encode();
        $responseData = json_decode($responseData, true);

        $id = $responseData['id'];

        // dd($id);

        return view('site.enroll', compact('course', 'id'));
    }

    public function payment(Request $request, $slug)
    {
        // dd($request->all());

        $course = Course::where('slug', '=', $slug)->firstOrFail();

        $resourcePath = $request->resourcePath;

        $url = "https://eu-test.oppwa.com$resourcePath";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        // return $responseData;
        $responseData = json_decode($responseData, true);



        $code = $responseData['result']['code'];

        if($code == '000.100.110') {

            $payment_id = $responseData['id'];
            $amount = $responseData['amount'];

            DB::beginTransaction();

            try {

                Payment::create([
                    'payment_id' => $payment_id,
                    'amount' => $amount,
                    'user_id' => Auth::id(),
                    'course_id' => $course['id']
                ]);

                // Auth::user()->courses()->sync($course['id']);
                Auth::user()->courses()->attach($course['id']);
                // Auth::user()->courses()->detach($course['id']);

                DB::commit();

                return redirect()
                ->back()
                ->with('msg', 'Payment Done Successfully')
                ->with('type', 'success');

            }catch(Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }

        }else {
            return redirect()
            ->back()
            ->with('msg', 'Payment Failed')
            ->with('type', 'danger');
        }

    }

    public function review(Request $request)
    {
        $request->validate(['rating' => 'required']);

        Review::create([
            'star' => $request->rating,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'course_id' => $request->course_id
        ]);

        return redirect()->back();
    }

    public function our_team()
    {
        return view('site.team');
    }

    public function contact()
    {
        return view('site.contact');
    }

}
