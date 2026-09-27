<?php

namespace App\Http\Controllers;

use App\Enums\CategorieEnum;
use App\Enums\StatutEnum;
use App\Models\Cours;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    public function index() {
        $cours = Cours::where('statut' , 'validé')->get();
        $articleController = new ArticleController();
        $articles = $articleController->getArticlesForUsers();
        return view('cours' , ['cours' => $cours , 'articles' => $articles]);

    }
    public function getCourseForAdmin($id)
    {

        $cours = Cours::findOrFail($id);
        // return Storage::url($cours->video);

        return view('admin/coursDetails', ['cours' => $cours]);
    }

    public function getCoursForHomePage()
    {
        $cours = Cours::all()->take(3);
        return $cours;
    }
    public function getCourseForUser($cours){
        $cours = Cours::findOrFail($cours);
        if(!$cours){
            return redirect()->back()->with('error' , 'ce cours n\'existe pas');
        }

        return view('showCours' , ['cours' => $cours]);
    }
    public function getCoursesForAdmin(Request $request)
    {


        if ($request->has('statut') && $request->statut) {
            $cours = Cours::where('statut', $request->statut)->get()->all();
            if (!$cours) {
                return redirect()->back()->with('error', 'il n y\'a pas des cours avec cet statut');
            }
            return view('admin/coursValidation', ['cours' => $cours]);
        }
        $cours = Cours::all();
        return view('admin/coursValidation', ['cours' => $cours]);
    }


    public function getCours($id)
    {
        $cours = Cours::findOrFail($id);
        // return Storage::url($cours->video);

        return view('imam/coursDetails', ['cours' => $cours]);
    }

    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'video' => 'required|file|mimes:mp4,avi,mov|max:102400', // max size in KB (100MB)
                'categorie' => 'required|string|max:255',
            ]);

            // Store video file
            if ($request->hasFile('video')) {
                $path = $request->file('video')->store('videos', 'public'); // store in 'storage/app/public/videos'
                $validatedData['video_path'] = $path;
            }

            
            // Create course with validated data
            // Adjust model attributes accordingly if you have a 'video_path' column
            $cours = new Cours();
            $cours->name = $validatedData['name'];
            $cours->description = $validatedData['description'];
            $cours->video = $path ?? null;
            $cours->categorie = CategorieEnum::from($validatedData['categorie']); // valeur de l'enum
            $cours->user()->associate(auth()->user()->id);
            $cours->save();
            
            return redirect()->back()->with('success', 'cours creer avec succes, attendez la validation d\'admin');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function changeCoursStatut(Request $request, $cours)
    {
        $cours = Cours::findOrFail($cours);

        $cours->statut = StatutEnum::from($request->statut);
        $cours->save();
        return redirect()->back()->with('success', 'statut a ete changee parfaitement');
    }
}
