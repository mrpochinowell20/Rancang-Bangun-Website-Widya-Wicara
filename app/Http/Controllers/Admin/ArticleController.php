<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use function Symfony\Component\String\b;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.article.index', ['article'=>Article::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'category' => 'required',
            'content' => 'required',
            'banner' => 'required',
            'status' => 'required'
        ]);
        $file = $request->file('banner');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_story = 'data_file';
        $file->move($tujuan_story, $nama_file);

        $isDraft = $request->status == 'Save as Draft' ? 1 : 0;
 
        Article::create([
            'banner' => $nama_file,
            'title' => $request->title,
            'slug' => $request->slug,
            'category' => $request->category,
            'content' => $request->content,
            'is_draft' => $isDraft
        ]);
        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::find($id);
        return view('admin.pages.article.edit', ['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'category' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        $article = Article::find($id);
        $isDraft = $request->status == 'Save as Draft' ? 1 : 0;

        $image = !empty($article->banner) ? true : false;
        if ($request->banner) {
            $tujuan_story = 'data_file';
            if ($image) {
                File::delete($tujuan_story . '/' . $article->banner);
            }

            $file = $request->file('banner');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move($tujuan_story, $nama_file);

            $article->update([
                'banner' => $nama_file,
            ]);
        }

        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'category' => $request->category,
            'content' => $request->content,
            'is_draft' => $isDraft
        ]);

        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect()->route('article.index');
    }
    public function uplod($id)
    {
        $article = Article::find($id);
        $article->uplod();

        return redirect()->route('article.index');
    }

    public function getArticle(Request $request)
    {
        if (!$request->ajax()) {
            return '';
        }

        $data = Article::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="' . route('article.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>';
                $deleteBtn = '<a href="' . route('article.destroy', $row) . '/delete" onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash">Delete</a>';
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getArticlePublish(Request $request)
    {
        if (!$request->ajax()) {
            return '';
        }

        $data = Article::where('is_draft', '=', 0)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="' . route('article.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>';
                $deleteBtn = '<a href="' . route('article.destroy', $row) . '/delete" onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash">Delete</a>';
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getArticleDraft(Request $request)
    {
        if (!$request->ajax()) {
            return '';
        }

        $data = Article::where('is_draft', '=', 1)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="' . route('article.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>';
                $deleteBtn = '<a href="' . route('article.destroy', $row) . '/delete" onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash">Delete</a>';
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function checkSlug(request $request)
    {
        $slug = SlugService::checkSlug(Article::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
