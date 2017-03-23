<?php 

	namespace App\Http\Controllers;
	use App\Repositories\CategoryRepo as repo;
	use App\Validation\PostValidator;
	 
	class CategoryController extends Controller
	{
		private $repo;
	 
		public function __construct(repo $repo)
		{
			$this->repo = $repo;
		}
	 
		public function edit($id=NULL){
			return View('category.index')->with(['data' => $this->repo->categoryOfId($id)]);
		}
	 
		public function editPost()
		{
			$all = Input::all();
			
//			$validate = PostValidator::validate($all);
//			if (!$validate->passes()) {
//				return redirect()->back()->withInput()->withErrors($validate);
//			}

			$Id = $this->repo->CategoryOfId($all['id']);
			if (!is_null($Id)) {
				$this->repo->update($Id, $all);
				Session::flash('msg', 'edit success');
			} else {
				$this->repo->create($this->repo->perpare_data($all));
				Session::flash('msg', 'add success');
			}
			return redirect()->back();
		}
	 
		public function retrieve(){
			return View('admin.index')->with(['Data' => $this->repo->retrieve()]);
		}
	 
		public function delete(){
			$id = Input::get('id');
			$data = $this->repo->CategoryOfId($id);
			if (!is_null($data)) {
				$this->repo->delete($data);
				Session::flash('msg', 'operation Success');
				return redirect()->back();
			} else {
				return redirect()->back()->withErrors('operationFails');
			}
		}
	}