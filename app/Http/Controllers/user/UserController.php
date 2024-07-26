<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^([789]\d{9})$/',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('home-page')->with('success', 'User Added Successfully.');
    }

    public function editUser($id)
    {
        $user = User::find(base64_decode($id));
        return view('pages.edit', compact('user'));
    }

    public function postEditUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^([1789]\d{11})$/',
        ]);

        if ($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
        
        $user = User::where('id', $id)->first();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('home-page')->with('success', 'User updated successfully.');

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('home')->with('success', 'User deleted successfully.');
    }

    public function whatsappNotification($phone)
    {
//------------------------------------------------------------------------DEVELOPER FACEBOOK----------------------------------------------------------------------------
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://graph.facebook.com/v15.0/382001664993456/messages',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => '',
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => 'POST',
        // CURLOPT_POSTFIELDS =>'{
        //     "messaging_product": "whatsapp",
        //     "to": '. $phone.',
        //     "type": "template",
        //     "template": {
        //         "name": "hello_world",
        //         "language": {
        //             "code": "en_US"
        //         }
        //     }
        // }',
        // CURLOPT_HTTPHEADER => array(
        //     'Authorization: Bearer EAAHO9ZCBdbRIBO4d8Te1ZB6NKSFxLfeZCeyhty2S03x7KAAuKWOJClwZCNetlCZCoBw7NG6ClAwqpeQDSx47XOGsQ0ULsPhiRM9jMCG1qa7r6KiHaszaUfSCwvlmXlJjfngM5nzxze6oyJhCrISnVnuzADTuRUqoW5ZBYZCoS5vZBZCCxMruSLhBy0DR9b0skUBEuO2crZChVPNyJmCtlUh4YZD',
        //     'Content-Type: application/json'
        // ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);

        // echo $response;
//------------------------------------------------------------------------DEVELOPER FACEBOOK----------------------------------------------------------------------------
//-----------------------------------------------------------------------------TWILIO----------------------------------------------------------------------------






    }

   

}
