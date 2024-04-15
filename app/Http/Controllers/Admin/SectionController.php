<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $adminDetails = json_decode(json_encode($adminDetails ),true);
        $sections = Section::all()->toArray();
        return view('admin.sections.section')->with(compact('sections','adminDetails'));
    }

    /**
     * Update section status
     */
    public function updateSectionStatus(Request $request){
        if($request->ajax()){
            $datas = $request->all();

            if($datas['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Section::where('id', $datas['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $datas['section_id']]);
        }
    }

    /**
     * Delete section
     */
    public function deleteSection($id){
        $section = Section::where('id',$id)->first();
        if($section){
            $sectionName = $section->name;
            $section->update(['status'=> 0]);
            $section->delete();
            $message = 'Section '.$sectionName.' supprimer avec succes';
            return redirect()->back()->with('success_message',$message);
        }
    }


    /**
     * Delete section
     */
    public function editSection(Request $request,$id = null){
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $adminDetails = json_decode(json_encode($adminDetails ),true);
        if($id == ""){
            $title = "Ajouter une section";
            $section = new Section;
            $message = "Section ajoutée avec success";
        }else{
            $section = Section::find($id);
            $title = "Editez la section";
            $message = "Section ajoutée avec success";
        }

        if($request->isMethod('post')){
            // dd(Section::find($request->input('id'))->first()->id);
            $rules = [
                'name' => [
                    'required',
                    'regex:/^[\pL\s\-]+$/u',
                    'min:3',
                    'max:50',
                ],
                'description' => 'nullable|regex:/^[\pL\s\-]+$/u|min:3|max:100',
                'status' => 'required|integer',
                'section_icon' => 'nullable|image|mimes:png,jpg,webp,jpeg|max:2048',
            ];

            $customMessages = [
                'name.required' => 'Le champ nom est requis.',
                'name.regex' => 'Le champ nom doit contenir uniquement des lettres, espaces et tirets.',
                'name.min' => 'Le champ nom doit contenir au moins :min caractères.',
                'name.max' => 'Le champ nom ne peut pas dépasser :max caractères.',
                'name.unique' => 'Ce nom de section est déjà utilisé.',
                'description.regex' => 'Le champ description doit contenir uniquement des lettres, espaces et tirets.',
                'description.min' => 'Le champ description doit contenir au moins :min caractères.',
                'description.max' => 'Le champ description ne peut pas dépasser :max caractères.',
                'status.required' => 'Le champ statut est requis.',
                'section_icon.image' => 'Le fichier doit être une image.',
                'section_icon.mimes' => 'Le fichier doit être de type :values.',
                'section_icon.max' => 'Le fichier ne peut pas dépasser :max kilo-octets.',
            ];

            $id = $request->input('id');

            if ($id !== null) {
                $rules['name'][] = Rule::unique('sections', 'name')->ignore($id);
            }else{
                $rules['name'][] = Rule::unique('sections', 'name');
            }

            $this->validate($request, $rules, $customMessages);
            $datas = $request->all();
            $imageName = '';
            // upload admin profil image
            if($request->hasFile('section_icon')){
                $imageTemp = $request->file('section_icon');
                if($imageTemp->isValid()){
                    // Get image extension
                    $extension = $imageTemp->getClientOriginalExtension();
                    // generate new name
                    $imageName = time() . '_' . uniqid() . '.' . $extension;
                    $imagePath = 'admin/images/icons/'.$imageName;
                    // upload image to the photos folder
                    Image::make($imageTemp)->save($imagePath);
                }
            }elseif(empty($datas['section_icon']) && isset($datas['current_section_icon'])){
                $imageName = $datas['current_section_icon'];
            }else{
                $imageName = '';
            }


            try{
                $section->name = $datas['name'];
                $section->description = $datas['description'];
                $section->status = $datas['status'];
                $section->section_icon = $imageName;
                $section->save();
                return redirect()->back()->with('success_message', 'Information de section crée avec success');
             }catch(Exception $er){
                 return redirect()->back()->with('failed_message', 'Echec de creation des informations de section');
             }

        }

        return view('admin.sections.edit_section')->with(compact('title','section','adminDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
