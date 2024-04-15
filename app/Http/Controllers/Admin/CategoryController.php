<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * categories list
     *
     */
    public function index(){
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $adminDetails = json_decode(json_encode($adminDetails ),true);
        $categories = Category::with('section','categoryParent')->get()->toArray();
        return view('admin.categories.category')->with(compact('categories','adminDetails'));
    }

    /**
     * update category status
     *
     */
    public function updateCategoryStatus(Request $request){

        if($request->ajax()){
            $datas = $request->all();

            if($datas['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Category::where('id', $datas['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $datas['category_id']]);
        }
    }

    /**
     * delete category
     *
     */
    public function deleteCategory($id){

        $category = Category::where('id',$id)->first();
        if($category){
            $categoryName = $category->category_name;
            $category->update(['status'=> 0]);
            $category->delete();
            $message = 'Category '.$categoryName.' supprimer avec succes';
            return redirect()->back()->with('success_message',$message);
        }
    }


    /**
     * Create or edit category
     *
     */
    public function editCategory(Request $request,$id = null){
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $adminDetails = json_decode(json_encode($adminDetails ),true);
        $parentCategories = Category::where('parent_id', 0)->get()->toArray();
        $sections = Section::all()->toArray();

        if($id == ""){
            $title = "Ajouter une categorie";
            $category = new Category;
            $message = "Categorie ajoutée avec success";
        }else{
            $category = Category::where('id',$id)->first();
            $title = "Editez la categorie";
            $message = "Categorie ajoutée avec success";
        }

        if($request->isMethod('post')){

            $rules = [
                'category_name' => [
                    'required',
                    'regex:/^[\pL\s\-]+$/u',
                    'min:3',
                    'max:50',
                ],
                'description' => 'nullable|regex:/^[\pL\s\-]+$/u|min:3|max:255',
                'status' => 'required|integer',
                'category_icon' => 'nullable|image|mimes:png,jpg,webp,jpeg|max:2048',
                'parent_category' => 'required|integer',
                'section' => 'required|integer',
                'category_discount' => 'nullable|numeric|min:0|max:100',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string|max:255',
            ];

            $customMessages = [
                'category_name.required' => 'Le champ nom est requis.',
                'category_name.regex' => 'Le champ nom doit contenir uniquement des lettres, espaces et tirets.',
                'category_name.min' => 'Le champ nom doit contenir au moins :min caractères.',
                'category_name.max' => 'Le champ nom ne peut pas dépasser :max caractères.',
                'category_name.unique' => 'Ce nom de catégorie est déjà utilisé.',
                'description.regex' => 'Le champ description doit contenir uniquement des lettres, espaces et tirets.',
                'description.min' => 'Le champ description doit contenir au moins :min caractères.',
                'description.max' => 'Le champ description ne peut pas dépasser :max caractères.',
                'status.required' => 'Le champ statut est requis.',
                'category_icon.image' => 'Le fichier doit être une image.',
                'category_icon.mimes' => 'Le fichier doit être de type :values.',
                'category_icon.max' => 'Le fichier ne peut pas dépasser :max kilo-octets.',
                'parent_id.required' => 'Le champ parent_id est requis.',
                'parent_id.integer' => 'Le champ parent_id doit être un entier.',
                'section_id.required' => 'Le champ section_id est requis.',
                'section_id.integer' => 'Le champ section_id doit être un entier.',
                'category_discount.numeric' => 'Le champ category_discount doit être numérique.',
                'category_discount.min' => 'Le champ category_discount ne peut pas être inférieur à :min.',
                'category_discount.max' => 'Le champ category_discount ne peut pas être supérieur à :max.',
                'meta_title.max' => 'Le champ meta_title ne peut pas dépasser :max caractères.',
                'meta_description.max' => 'Le champ meta_description ne peut pas dépasser :max caractères.',
                'meta_keywords.max' => 'Le champ meta_keywords ne peut pas dépasser :max caractères.',
            ];

            $id = $request->input('categoryid');

            if ($id !== null) {
                $rules['category_name'][] = Rule::unique('categories', 'category_name')->ignore($id);
            }else{
                $rules['category_name'][] = Rule::unique('categories', 'category_name');
            }

            $this->validate($request, $rules, $customMessages);
            $datas = $request->all();
            $imageName = '';

            // dd($datas);

            // upload admin profil image
            if($request->hasFile('category_icon')){
                $imageTemp = $request->file('category_icon');
                if($imageTemp->isValid()){
                    // Get image extension
                    $extension = $imageTemp->getClientOriginalExtension();
                    // generate new name
                    $imageName = time() . '_' . uniqid() . '.' . $extension;
                    $imagePath = 'admin/images/icons/'.$imageName;
                    // upload image to the photos folder
                    Image::make($imageTemp)->save($imagePath);
                }
            }elseif(empty($datas['category_icon']) && isset($datas['current_category_icon'])){
                $imageName = $datas['current_category_icon'];
            }else{
                $imageName = '';
            }


            try{
                $category->category_name = $datas['category_name'];
                $category->description = $datas['description'];
                $category->status = $datas['status'];
                $category->parent_id = (int)$datas['parent_category'];
                $category->section_id = (int)$datas['section'];
                $category->category_discount = $datas['category_discount'];
                $category->url = Str::slug($datas['category_name'], '_', 'fr');
                $category->meta_title = $datas['meta_title'];
                $category->meta_description = $datas['meta_description'];
                $category->meta_keywords = $datas['meta_keywords'];
                $category->category_icon = $imageName;
                $category->save();
                return redirect()->back()->with('success_message', 'Information de categorie crée avec success');
             }catch(Exception $er){
                 return redirect()->back()->with('failed_message', 'Echec de creation des informations de categorie');
             }

        }

        return view('admin.categories.edit_category')->with(compact('title','category','adminDetails','parentCategories','sections'));
    }
}
