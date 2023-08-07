<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponser;
use Laravel\Sanctum\PersonalAccessToken;
use App\Traits\UserTraits;
use App\Traits\AuthTraits;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use App\Mail\ForgetPasswordMail;

class AuthenticationController extends Controller
{
    use ApiResponser;
    use UserTraits;
    use AuthTraits;

    private function createToken($user)
    {
        return $user->createToken(
            'Login '. $user->username,
            ['*'],
            Carbon::now('Asia/Jakarta')->addHour()
        )->plainTextToken;
    }

    public function index(Request $request)
    {
        $login = $request->user_login;

        $response = [
            'id_user' => $login['id_user'],
            'name' => $login['name'],
            'username' => $login['username'],
            'role' => $login['role'],
            'features' => $login['features'],
        ];

        return $this->generalResponse(
            200,
            'Get Data User Login Success',
            $response
        );
    }

    public function login(Request $request)
    {
        try {
            $request->validate(
                [
                    'email' => ['required', 'string', 'max:100'],
                    'password' => ['required']
                ]
            );

            $loginEmail = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $loginUsername = Auth::attempt([
                'username' => $request->email,
                'password' => $request->password,
            ]);

            if (true == $loginEmail || true == $loginUsername) {
                $user = Auth::user();

                // *** Fiture agar tokken user tidak duplicate di DB *** //
                $aksesToken = PersonalAccessToken::where('tokenable_id', $user->id)
                ->get();

                if (null == $aksesToken) {
                    $token = self::createToken($user);
                } else {
                    PersonalAccessToken::where('tokenable_id', $user->id)
                    ->delete();
                    $token = self::createToken($user);
                }
                // *** END FITURE *** //

                return response()->json(
                    [
                        'token' => $token,
                        'token_type' => 'Bearer',
                        'expires_in' => 3600,
                        'result_code' => 200,
                        'result_message' => 'Login Success',
                    ]
                );
            } else {
                return $this->generalResponse(
                    500,
                    'Login Failed'
                );
            }
        } catch (ValidationException $th) {
            return $this->generalResponse(400, 'Invalid Data Validation', $th->validator->errors());
        }
    }

    public function show(Request $request)
    {
        // Validasi Data Mandatori
        try {
            $request->validate(['id' => ['required', 'numeric']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $id = $request->id;

        // Logic Get Data
        $data = $this->userGetData($id);

        // Response Not Found
        if (false == $data) :
            return $this->userNotFound();
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Get Profile User Success', $data);
        endif;
    }

    public function update(Request $request, $id)
    {
        // Validasi Data Mandatori
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email:rcf,dns'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $email = $request->email;
        $name = $request->name;

        // Logic Get Data
        $data = $this->cekUserById($id);

        // Response Not Found
        if (false == $data) :
            return $this->userNotFound();
        endif;

        // Logic Update Data
        $data->name = $name;
        $data->email = $email;
        $data->save();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Update Profile User Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Update Profile User Success');
        endif;
    }

    public function forgetMail(Request $request)
    {
        // Validasi Data Mandatori
        try {
            $request->validate(['email' => ['required', 'email:rfc,dns']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $email = $request->email;

        // Logic Get Data
        $data = $this->userByEmail($email);

        // Response Not Found
        if (false == $data) :
            return $this->generalResponse(404, 'User Email Not Found');
        endif;

        // Inisialisasi Create Field
        $field = [
            'email' => $email,
            'token' => Uuid::uuid4(),
        ];

        // Logic Send Mail
        $url = env('APP_URL', 'http://localhost:8236/'). 'auth/forget-password/'. $field['token'];

        $params = [
            'url' => $url,
        ];

        // Jalankan Fungsi Untuk Mengirim Email
        $sendMail = Mail::to($email)->send(new ForgetPasswordMail($params));

        // Response Gagal Send Mail
        if (!$sendMail) :
            return $this->failedResponse('Cannot Send forget Password Mail');
        endif;

        // Logic Create Data
        $bacaEmail = PasswordReset::where('email', $email)->first();

        // Tidak ditemukan email -> Buat Token Baru
        if (null == $bacaEmail) :
            $createToken = PasswordReset::create($field);

            if ($createToken) :
                return $this->generalResponse(200, 'Send Email Forget Password Success');
            endif;
        endif;

        // Terdapat email yang sama -> Update Token
        if (null != $bacaEmail) :
            $bacaEmail->token = $field['token'];
            $bacaEmail->save();

            if ($bacaEmail) :
                return $this->generalResponse(200, 'Send Email Forget Password Success');
            endif;
        endif;
    }

    public function forgetPassword(Request $request, $token)
    {
        // *** Validasi Data Mandatori ***
        $validate = [];

        // Validasi Length Token
        if (36 < strlen($token)) :
            $validate[] = ['token' => 'The token must not be greater than 36 characters.'];
            return $this->invalidValidation($validate);
        endif;

        // Validasi Data Mandatory
        try {
            $request->validate([
                'email' =>  ['required', 'email:rfc,dns'],
                'new_password' => ['required', 'string', 'max:60'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }
        // *** End Of Validasi Data Mandatori ***

        // Inisialisasi Variable
        $email = $request->email;
        $password = bcrypt($request->new_password);

        // Cek Data User By Email
        $data = $this->userByEmail($email);

        // Response Not Found
        if (false == $data) :
            return $this->responseNotFound('User Mail Not Found');
        endif;

        // Cek Data Token
        $cekToken = $this->authValidateToken($email, $token);
        if (false == $cekToken) :
            return $this->authInvalidToken();
        endif;

        // Logic Update Data
        $data->password = $password;
        $data->save();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Forget Password Failed');
        endif;

        // Response Success
        if ($data) :
            // Hapus email token di table reset password
            $data = $this->authEmailAll($email);
            $data->destroy($email);

            return $this->generalResponse(200, 'Forget Password Success');
        endif;
    }

    public function resetPassword(Request $request)
    {
        // Validasi Data Mandatory
        try {
            $request->validate(['new_password' => ['required', 'string', 'max:60']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $password = bcrypt($request->new_password);
        $idUser = $this->getIdUser();

        // Inisialisasi Variable
        $password = bcrypt($request->new_password);

        // Logic Get Data
        $data = $this->cekUserById($idUser);

        // Response User Not Found
        if (false == $data) :
            return $this->userNotFound();
        endif;

        // Logic Update Data
        $data->password = $password;
        $data->save();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Reset Password Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Reset Password Success');
        endif;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->generalResponse(200, 'Youre Logged Out');
    }
}
