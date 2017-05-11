<?php
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\History;
use App\Utils\AbstractMongoFileSystem;
use MongoDB\Collection;

class FileRepo extends BaseRepo{
	
	/*** PARAM  userid,id,type,filename*/
	public function uploadFile($data){
		//dd($data->file);
		
		
		$file= $data['file'];
		
		$originalName = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);
		$filename = $this->sanitize($originalNameWithoutExt).".".$extension;
	
		$mongo_save_file =  [
			'code' => 200, 
			'status' => 'ok',
			'msg' => '',
			'filename' => $filename,
			'filename_with_path' => $data['file']
		];

		$mongo = new AbstractMongoFileSystem();
		$response = $mongo->saveFile($mongo_save_file);
		if($response['code']==200){
		
		 $record = [
                "userid"        => $data['userid'],
                "filename"      => $filename,
                "fileid"        => $response['mongo_response'],
				"type_id"       => $data['id'],
                "type"    		=> $data['type'],
                "status"   		=> 1,
                'createdon'     => new \MongoDB\BSON\UTCDateTime(time()* 1000),
                'updatedon'     => new \MongoDB\BSON\UTCDateTime(time()* 1000)

            ];
			 $result = $mongo->save(
                ['rows' => $record,
                    'table' => 'attachments']
            );
			
			/*History call*/
			if($data['type']=='issue'){
				$data['comment'] =  config(('messages.HISTORY'))['ATTACHMENT']['ADD'];
				$data['issue_id'] = $data['id'];
				$this->history 	= new HistoryRepo();
				$this->history->addHistory($data);
			}
			/*End of History */	
			
			dd($result);
		}
	}
	public function getFile($data){
		$mongo = new AbstractMongoFileSystem();
		
		 $filter = [
                      'type_id' => ['$eq' => $data['type_id']],
                      '$and' => [
                            ['type' => ['$eq' => $data["type"]]]
                        ],
						'$and' => [
                            ['status' => ['$eq' => 1]]
                        ]
                    ];
        $result = $mongo->Find([
            'table' => 'attachments',
            'filters' =>$filter,
            'options' => [
                'projection' => ['filename' => true,'fileid'=>true]
            ]]);
		return $result;
	}
	
	
	public function downloadFiles($fileid){
		$mongo = new AbstractMongoFileSystem();
		$_id =  $fileid;
		
		$filter = ['fileid' => ['$eq' => new \MongoDB\BSON\ObjectID($_id)]];
        $result = $mongo->Find([
            'table' => 'attachments',
            'filters' =>$filter,
            'options' => [
                'projection' => ['_id'=>true,'filename' => true,'fileid'=>true]
            ]]);		
	 
	 //if($result['code']==200){
		$filename = $result['rows'][0]['filename'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$_id = new \MongoDB\BSON\ObjectID($result['rows'][0]['_id']);
		
		$file_get = $mongo->getFileContent($fileid);
		
		//dd($user_simple_array);
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		//header("Cache-control: private");
		header("Content-type: csv");
		//header('Content-Type: application/octet-stream');
		//header("Content-transfer-encoding: binary\n");

		$out = fopen('php://output', 'w');
		fwrite($out, $file_get['contents']);
		fclose($out);
   // }
	exit();
 }
	public function deleteFiles($fileid){
		
		$mongo = new AbstractMongoFileSystem();
        try {
			
			$filter = ['fileid' => ['$eq' => new \MongoDB\BSON\ObjectID($fileid)]];
			$result = $mongo->Find([
				'table' => 'attachments',
				'filters' =>$filter,
				'options' => [
				'projection' => ['_id'=>true,'filename' => true,'fileid'=>true,'type'=>true,'type_id'=>true]
			]]);		

			if($result['code']==200){
				$_id = $result['rows'][0]['_id'];
				$mongo->removeGridFSFile(new \MongoDB\BSON\ObjectID($fileid));
				$mongo->delete(['table' => 'attachments','_id' => $_id]);
			}
		 }
        catch(\Exception $e)
        {
            return [
                'code' => 1000,
                'status' => 'cancel',
                'msg' => 'Something went wrong.'
            ];
        }

		/*History call*/
		if($result['rows'][0]['type']=='issue'){
			$data['comment'] =  config(('messages.HISTORY'))['ATTACHMENT']['DELETE'];
			$data['issue_id'] = $result['rows'][0]['type_id'];
			$this->history 	= new HistoryRepo();
			$this->history->addHistory($data);
		}
		/*End of History */	
        return  [
        'code' => 200,
        'status' => 'ok',
        'msg' => 'File deleted successfully.'
        ];

	}
	
	public function sanitize($string, $force_lowercase = true, $anal = false){
		$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
			"}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
			"â€”", "â€“", ",", "<", ".", ">", "/", "?");
		$clean = trim(str_replace($strip, "", strip_tags($string)));
		$clean = preg_replace('/\s+/', "-", $clean);
		$clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

		return ($force_lowercase) ?
			(function_exists('mb_strtolower')) ?
				mb_strtolower($clean, 'UTF-8') :
				strtolower($clean) :
			$clean;
	}
}


