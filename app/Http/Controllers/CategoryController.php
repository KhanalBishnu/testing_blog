<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\CommonController;
use App\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(CategoryRepositoryInterface $category) {
        $this->category= $category;
    }

    public function index(){
       $category= $this->category->all();
       return view('admin.category.index',compact('category'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $data=$request->all();
        $rules=[
            'name'=>'required |string ',
            'description'=>'required|string',
        ];
      $validate= $this->validate_data($data,$rules);
      if($validate){
          return back()->withErrors($validate);
      }
     else{
        $this->category->store($data);
        Alert::success('success','Category Added Successfully');
        return redirect()->route('category');
        Alert::error('error','Oops Something Went Wrong!');
        return back();
      }
     
    }

    public function edit($id){
       $category= $this->category->edit($id);
       return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request,$id){
        $data=$request->all();
        $rules=[
            'name'=>'required |string ',
            'description'=>'string',
        ];
        $validate= $this->validate_data($data,$rules);
        if($validate['response']){
                $this->category->update($data,$id);
                Alert::success('success','Category Updated Successfully');
                return redirect()->route('category');
        }
        else{
            Alert::error('error','Oops Something Went Wrong!');
            return back();
          }
    }

    public function delete($id){
        $this->category->delete($id);
        Alert::success('success','Category Deleted Successfully');
        return redirect()->route('category');
    }


    public function validate_data($data,$rules){
        $common_ctr=new CommonController();
        return $common_ctr->validator($data,$rules);
    }
}
