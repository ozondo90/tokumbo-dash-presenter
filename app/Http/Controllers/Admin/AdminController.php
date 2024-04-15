<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    /**
     * Access admin dashboard
     *
     */
    public function dashboard(){
        Session::put('page','dashbord');
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.dashboard')->with(compact('adminDetails'));
    }


    /**
     * Login admin user
     *
     */
    public function login(Request $request){

        if($request->isMethod('post')){
            $rules = [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|max:20|min:8'
            ];

            $customMessages = [
                'email.required' => "Email est requit",
                'email.email' => "Email invalide",
                'email.max' => "Email aux maximun 225 caracteres",
                'password.required' => "Mot de passe est requit",
                'password.string' => "Mot de passe doit etre une chaine de caracteres",
                'password.max' => "Mot de passe aux maximun 20 caracteres",
                'password.min' => "Mot de passe au minimum 8 caracteres",
            ];

            $this->validate($request,$rules, $customMessages);

            if(Auth::guard('admin')->attempt(
                [
                'email'=>$request->input('email'),
                'password'=>$request->input('password'),
                'status'=>1
                ]))
                {
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message', 'Invalide email or password');
            }
        }
        return view('admin.login');
    }

    /**
     * logout admin user
     *
     */
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    /**
     * update admin password
     *
     */
    public function updatePassword(Request $request){
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();

        if($request->isMethod('post')){
            $datas = $request->all();

            if(!Hash::check($datas['currentPassword'], Auth::guard('admin')->user()->password)){
                return redirect()->back()->with('current_password_error', 'Nouveau mot de passe incorrect');
            }

            $rules = [
                'password' => 'required|string|min:8|max:20|confirmed',
            ];

            $customMessage = [
                'password.required' => 'Nouveau mot de passe est requis',
                'password.string' => 'Nouveau mot de passe doit etre une chaine de caractere',
                'password.min' => 'Nouveau mot de passe doit etre 8 caractere minimum',
                'password.max' => 'Nouveau mot de passe doit etre 20 caractere maximum',
                'password.confirmed' => 'Nouveau et confirmation mot de passe ne sont pas identique',
            ];

            $this->validate($request, $rules, $customMessage, ['currentPassword','newPassword','confirmPassword']);

            try{
                Admin::find(Auth::guard('admin')->user()->id)->update(['password' => Hash::make($datas['password'])]);
                return redirect()->back()->with('password_update_success', 'Mot de passe mise à jour avec success');
            }catch(Exception $e){
                return redirect()->back()->with('password_update_failed', 'Echec de la mise à jour du mot de passe');
            }


        }

        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    /**
     * update admin details
     *
     */
    public function updateDetails(Request $request){
        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::find($id);
        if($request->isMethod('post')){

            $rules = [
                'email' => [
                    'sometimes',
                    'bail',
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('admins', 'email')->ignore($admin->id),
                ],
                'username' => 'sometimes|bail|required|regex:/^[\pL\s\-]+$/u|min:3|max:20',
                'mobile' => 'sometimes|bail|required|regex:/^[0-9]{1,15}$/',
                'imageProfil' => 'nullable|image|mimes:png,jpg,webp,jpeg|max:2048',
            ];

            $customMessages = [
                'email.unique' => 'Email existe dejà',
                'email.max' => 'Email doit faire au plus 255 caracetre',
                'username.min' => "Nom d'utilisateur minimum caractere 3",
                'username.max' => "Nom d'utilisateur maximum caractere 20",
                'mobile.regex' => 'Mobile doit etre du numerique avec 15 carateres maximum',
                'imageProfil.mimes' => 'Photo de Profil doit etre une image(jpg,png)',
                'imageProfil.max' => 'Photo de Profil doit etre maximun 2048KB',

            ];

            $this->validate($request, $rules, $customMessages);
            $datas = $request->all();
            $imageName = '';
            // upload admin profil image
            if($request->hasFile('imageProfil')){
                $imageTemp = $request->file('imageProfil');
                if($imageTemp->isValid()){
                    // Get image extension
                    $extension = $imageTemp->getClientOriginalExtension();
                    // generate new name
                    $imageName = time() . '_' . uniqid() . '.' . $extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    // upload image to the photos folder
                    Image::make($imageTemp)->save($imagePath);
                }
            }elseif( empty($datas['imageProfil']) ){
                $imageName = $datas['adminCurrentImage'];
            }else{
                $imageName = '';
            }

            try{
                Admin::find(Auth::guard('admin')->user()->id)->first()->update([
                    'name' => $datas['username'],
                    'email' => $datas['email'],
                    'mobile' => $datas['mobile'],
                    'image' => $imageName,
                ]);
                return redirect()->back()->with('details_update_success', 'Information de compte mise à jour avec success');
            }catch(Exception $er){
                return redirect()->back()->with('details_update_failed', 'Echec de la mise à jour des informations de compte');

            }
        }

        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_details')->with(compact('adminDetails'));
    }

    /**
     * Check admin password
     *
     */
    public function checkAdminPassword(Request $request){
        $data = $request->all();

        if(Hash::check( $data['currentPassword'], Auth::guard('admin')->user()->password) ){
            return 'true';
        }else{
            return 'false';
        };
    }

    /**
     * Access admin user management interface
     *
     */
    public function adminsManagement($type=null){
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        $admins = Admin::query();
        if(!empty($type)){
            $admins = $admins->where('type', $type);
            $title = ucfirst($type);
        }else{
            $title = 'Tous les Super admin/administrateurs/vendeurs';
        }

        $admins = $admins->get()->toArray();

        return view('admin.admins.admins')->with(compact('admins','adminDetails','title'));
    }

    /**
     * Update vendor detail
     *
     */
     public function updateVendorDetails(Request $request, $slug ){
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        $vendorDetails = Vendor::find($adminDetails['vendor_id']);

        if($slug === 'personal'){
            if($request->isMethod('post')){

                $rules = [
                    'email' => ['sometimes','bail','required','email','max:255',Rule::unique('admins', 'email')->ignore( Auth::guard('admin')->user()->id)],
                    'vendorName' => 'sometimes|bail|required|regex:/^[\pL\s\-]+$/u|min:3|max:20',
                    'vendorAddress' => 'sometimes|bail|required|max:100',
                    'vendorCity' => 'sometimes|bail|required|string|max:50',
                    'vendorState' => 'sometimes|bail|required|string|max:50',
                    'vendorCountry' => 'sometimes|bail|required|string|max:50',
                    'pinCode' => 'sometimes|bail|required|numeric',
                    'mobile' => 'sometimes|bail|required|regex:/^[0-9]{1,15}$/',
                    'imageProfil' => 'nullable|image|mimes:png,jpg,webp,jpeg|max:2048',
                ];

                $customMessages = [
                    'email.unique' => 'Email existe dejà',
                    'email.max' => 'Email doit faire au plus 255 caracetre',
                    'username.min' => "Nom d'utilisateur minimum caractere 3",
                    'username.max' => "Nom d'utilisateur maximum caractere 20",
                    'mobile.regex' => 'Mobile doit etre du numerique avec 15 carateres maximum',
                    'imageProfil.mimes' => 'Photo de Profil doit etre une image(jpg,png)',
                    'imageProfil.max' => 'Photo de Profil doit etre maximun 2048KB',
                ];

                $this->validate($request, $rules, $customMessages);
                $datas = $request->all();
                $imageName = '';
                // upload admin profil image
                if($request->hasFile('imageProfil')){
                    $imageTemp = $request->file('imageProfil');
                    if($imageTemp->isValid()){
                        // Get image extension
                        $extension = $imageTemp->getClientOriginalExtension();
                        // generate new name
                        $imageName = time() . '_' . uniqid() . '.' . $extension;
                        $imagePath = 'admin/images/photos/'.$imageName;
                        // upload image to the photos folder
                        Image::make($imageTemp)->save($imagePath);
                    }
                }elseif(empty($datas['imageProfil'])){
                    $imageName = $datas['vendorCurrentImage'];
                }else{
                    $imageName = '';
                }

                try{

                   Admin::find(Auth::guard('admin')->user()->id)->update([
                        'name' => $datas['vendorName'],
                        'email' => $datas['email'],
                        'mobile' => $datas['mobile'],
                        'image' => $imageName,
                    ]);

                    Vendor::find(Auth::guard('admin')->user()->vendor_id)->first()->update([
                        'name' => $datas['vendorName'],
                        'email' => $datas['email'],
                        'mobile' => $datas['mobile'],
                        'address' => $datas['vendorAddress'],
                        'city' => $datas['vendorCity'],
                        'state' => $datas['vendorState'],
                        'country' => $datas['vendorCountry'],
                        'pin_code' => $datas['pinCode'],
                    ]);

                    return redirect()->back()->with('details_update_success', 'Information de compte mise à jour avec success');
                }catch(Exception $er){
                    return redirect()->back()->with('details_update_failed', 'Echec de la mise à jour des informations de compte');
                }
            }
        }elseif($slug === 'business'){
            $vendorDetails = $vendorDetails->vendorBusinessDetail;

            if($request->isMethod('post')){

                $rules = [
                    'shopName' => 'sometimes|bail|required|string|max:100',
                    'shopAdresse' => 'sometimes|bail|required|string|max:100',
                    'shopCity' => 'sometimes|bail|required|string|max:50',
                    'shopState' => 'sometimes|bail|required|string|max:50',
                    'shopCountry' => 'sometimes|bail|required|string|max:50',
                    'shopPinCode' => 'sometimes|bail|required|numeric',
                    'shopMobile' => 'sometimes|bail|required|regex:/^[0-9]{1,15}$/',
                    'shopWebsite' => 'sometimes|bail|required|url|max:50',
                    'businessLicenceNumber' => 'sometimes|bail|string|max:50',
                    'ifuNumer' => 'sometimes|bail|string|max:50',
                    'panNumber' => 'sometimes|bail|string|max:50',
                    'addressProof' => 'sometimes|bail|required|string|max:50',
                    'adddressProofImage' => 'nullable|image|mimes:png,jpg,webp,jpeg|max:2048',
                ];

                $customMessages = [
                    'shopPinCode.numeric' => "Le code postal doit etre un nombre",
                    'shopMobile.regex' => 'Mobile doit etre du numerique avec 15 carateres maximum',
                    'adddressProofImage.mimes' => 'Photo de Profil doit etre une image(jpg,png)',
                    'adddressProofImage.max' => 'Photo de Profil doit etre maximun 2048KB',
                ];

                $this->validate($request, $rules, $customMessages);
                $datas = $request->all();
                $imageName = '';
                // upload admin profil image
                if($request->hasFile('adddressProofImage')){
                    $imageTemp = $request->file('adddressProofImage');
                    if($imageTemp->isValid()){
                        // Get image extension
                        $extension = $imageTemp->getClientOriginalExtension();
                        // generate new name
                        $imageName = time() . '_' . uniqid() . '.' . $extension;
                        $imagePath = 'admin/images/photos/'.$imageName;
                        // upload image to the photos folder
                        Image::make($imageTemp)->save($imagePath);
                    }
                }elseif(empty($datas['adddressProofImage'])){
                    $imageName = $datas['currentProofImage'];
                }else{
                    $imageName = '';
                }

                try{

                    VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->update([
                        'shop_name' => $datas['shopName'],
                        'shop_address' => $datas['shopAdresse'],
                        'shop_city' => $datas['shopCity'],
                        'shop_state' => $datas['shopState'],
                        'shop_country' => $datas['shopCountry'],
                        'shop_pinCode' => $datas['shopPinCode'],
                        'shop_mobile' => $datas['shopMobile'],
                        'shop_website' => $datas['shopWebsite'],
                        'address_proof' => $datas['addressProof'],
                        'business_licence_number' => $datas['businessLicenceNumber'],
                        'business_registration_number' => $datas['ifuNumer'],
                        'pan_number' => $datas['panNumber'],
                        'address_proof_image' =>  $imageName,
                    ]);

                    return redirect()->back()->with('details_update_success', 'Information de compte mise à jour avec success');
                }catch(Exception $er){
                    return redirect()->back()->with('details_update_failed', 'Echec de la mise à jour des informations de compte');

                }
            }
        }elseif($slug === 'bank'){
            $vendorDetails = $vendorDetails->vendorBankDetail;

            if($request->isMethod('post')){

                $rules = [
                    'bankName' => 'sometimes|bail|required|string|max:100',
                    'bankIfscCode' => 'sometimes|bail|required|string|max:100',
                    'AccountHolderName' => 'sometimes|bail|required|string|max:50',
                    'accountNumber' => 'sometimes|bail|required|numeric',
                ];

                $customMessages = [
                    'accountNumber.numeric' => "Le numero de compte est un nombre",
                    'bankIfscCode.string' => 'le code uban de la banque es une chaine de caractere',
                    'AccountHolderName.string' => 'Le nom du compte est une chaine de caractere',
                    'bankName.string' => 'le nom de la banque est une chaine de caractere',
                ];

                $this->validate($request, $rules, $customMessages);

                $datas = $request->all();
                try{

                    VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->update([
                        'bank_name' => $datas['bankName'],
                        'bank_ifsc_code' => $datas['bankIfscCode'],
                        'account_holder_name' => $datas['AccountHolderName'],
                        'account_number' => $datas['accountNumber'],
                    ]);

                    return redirect()->back()->with('details_update_success', 'Information de compte mise à jour avec success');
                }catch(Exception $er){
                    return redirect()->back()->with('details_update_failed', 'Echec de la mise à jour des informations de compte');

                }
            }
        }else{

        }

        $countries = Country::where('status', '1')->get()->toArray();

        return view('admin.settings.update_vendor_details')->with(compact('slug','vendorDetails','adminDetails','countries'));

     }

     /**
     * view vendor details
     *
     */
     public function viewVendorDetails($id){
        $adminDetails = Admin::find(Auth::guard('admin')->user()->id)->first();
        $vendorDetails = Admin::with('vendorPersonal','vendorBusiness','vendorBank')->where('id',$id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails), true);

        return view('admin.admins.view_vendor_details')->with(compact('adminDetails','vendorDetails'));
     }

     /**
     * view vendor details
     *
     */
    public function updateAdminStatus(Request $request){
        if($request->ajax()){
            $datas = $request->all();

            if($datas['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Admin::where('id', $datas['admin_id'])->update(['status' => $status]);
        }   return response()->json(['status' => $status, 'admin_id' => $datas['admin_id']]);
    }
}
