<?php 

	namespace app\Validation;
	use Validator;
	 
	class CategoryValidator{
		public static function validate($input){
			$rules = [
				'title' => 'Required|Min:4|Max:80|alpha_spaces',
				'body' => 'Required',
			];
			return Validator::make($input, $rules);
		}
	}