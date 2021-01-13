<?php
namespace Yoan1005\Abonews\Controllers;

use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;

use Yoan1005\Abonews\AboTemplate as Template;
use Yoan1005\Abonews\AboHistory as History;
use Yoan1005\Abonews\AboSubscriber as Subscriber;

use Mail;

class AbonewsController extends Controller
{

  public function subscriber_list(Request $request){
    $datas = Subscriber::get();
    return response()->json(['status' => 200, 'datas' => $datas]);
  }

  public function subscriber_add(Request $request){
    $data = Subscriber::updateOrCreate(['email' => $request->email],  ['subscribe' => 1]);

    return response()->json(['status' => 200, 'datas' => $data]);
  }

  public function subscriber_rm(Request $request){
    $data = Subscriber::where('id', $request->id)->first();
    if ($data) {
      $data->subscribe = 0;
      $data->save();
    }
    return response()->json(['status' => 200, 'datas' => $data]);
  }

  // Email
  public function prepare_send(Request $request) {

    $email = Template::where('id', $request->email_id)->first();
    $users = Subscriber::where('subscribe', 1)->get();
    $html = $request->html;
    if ($users) {
      foreach ($users as $user) {

          History::create([
            'template_id'  => $email->id,
            'html'  => $email->merge_fields(['link' => 'https://residence.fr'], 'html'),
            'sended_at'  => NULL,
            'subject'  => $email->merge_fields(['residence' => 'la deymarde'], 'subject'),
            'from_email'  => ($email->from_email) ? $email->from_email : config('abonews.DEFAULT_FROM_EMAIL'),
            'from_name'  => ($email->from_name) ? $email->from_name : config('abonews.DEFAULT_FROM_NAME'),
            'to_email' => $user->email,
            'to_name' => ($user->nom) ? $user->nom : ''
          ]);
      }
    }
    return back()->with(['sucess', 'OK']);
  }

  public function task_send(Request $request) {
      $limit = ($request->limit) ? $request->limit : 10;
      $emails = History::whereNull('sended_at')->limit($limit)->get();


      foreach ($emails as $email) {
        if ($email->to_email && $email->html) {
          $email->sended_at = \Carbon\Carbon::now();
          $email->save();
          try {
            Mail::send([], [], function ($message) use ($email) {
                    $message->to($email->to_email)
                    ->subject($email->subject)
                    ->from($email->from_email, $email->from_name)
                    ->setBody($email->html, 'text/html');
            });
            $email->send_info = 'success';

          } catch (\Exception $e) {
            $email->send_info = 'fail : '. $e->getMessage();
          }

          $email->save();

          sleep(2);
        }
      }


  }

}
