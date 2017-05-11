<?php
namespace App\Utils;
use Mockery\CountValidator\Exception;
use MongoDB\Collection;
use Request;

class AbstractMongoFileSystem
{
    private $manager;
    private $db;
    private $options;
    private $tables_mapping;

    public function __construct()
    {
        $this->manager = new \MongoDB\Driver\Manager('mongodb://' . env('MONGO_HOST') . ':' . env('MONGO_PORT'));
        $this->db = env('MONGO_DB');

        $this->checkMongoAvailability();

        $this->options = [
          'typeMap' => [
            'root' => 'array',
            'document' => 'array',
          ],
        ];

        $this->tables_mapping = [
          'FILTER_DATA_ACC_FILE' => 'accountfilters',
          'FILTER_DATA_UA_ACC_FILE' => 'accountfiltersua',
          'KW_REJECT_FILE' => 'kwrejected',
          'KW_UPLOADS_FILE' => 'kwuploads',
          'FILTER_DATA_FILE' => 'campaignfilters',
          'FILTER_DATA_UA_FILE' => 'campaignfiltersua',
          'GEO_DATA_FILE' => 'campaigngeofilters',
          'ADGROUP_KEYWORDS_FILE' => 'kwuploads',
          'SEQUENCE_FILE' => 'sequences',
        ];

        $this->bucket = new \MongoDB\GridFS\Bucket($this->manager, env('MONGO_DB'));
		
        //$this->collectionsWrapper = $this->bucket->getCollectionsWrapper();
		$this->chunksCollection = new Collection($this->manager, $this->db , 'fs.chunks');
        $this->filesCollection = new Collection($this->manager,  $this->db , 'fs.files');


    }



    public function Find($args)
    {
        $args['options'] = isset($args['options']) ? $args['options'] : [];
        $collection = new Collection($this->manager, $this->db, $args['table'], $this->options);
        //dd($args);
        try{
            //$result = $collection->find([], [ 'limit' => 2]);
            $result = $collection->find($args['filters'], $args['options']);

        }
        catch(\Exception $e)
        {
            echo "error";
             dd($e);
            return [
                'code' => 1000,
                'status' => 'cancel',
                'msg' => 'error while inserting'
            ];
        }
        //echo "ok..<br>";
       //dd($result);
        /*
       foreach($result as $document) {
        echo "<br>-><br>";
        print_r($document);
        print "<br><br>";
        }
        */

        //exit;
        $array = $result->toArray();

        if ($result) {



        $collection = new Collection($this->manager, $this->db, $args['table'], $this->options);
        //dd($args);
        try{
            //$result = $collection->find([], [ 'limit' => 2]);
            $result = $collection->find($args['filters'], $args['options']);

        }
        catch(\Exception $e)
        {
            echo "error";
             dd($e);
            return [
                'code' => 1000,
                'status' => 'cancel',
                'msg' => 'error while inserting'
            ];
        }
        //echo "ok..<br>";
       //dd($result);
        /*
       foreach($result as $document) {
        echo "<br>-><br>";
        print_r($document);
        print "<br><br>";
        }
        */

        //exit;
        $array = $result->toArray();

        if ($result) {

            return [
                'code' => 200,
                'status' => 'success',
                'rows' => $array
            ];
        }

        return [
            'code' => 1000,
            'status' => 'cancel',
            'msg' => 'DB Error'
        ];
       }
    }

    public function get($type, $file, $path)
    {
        $table = (isset($this->tables_mapping[$path]) ? $this->tables_mapping[$path] : $path);
        $collection = new Collection($this->manager, $this->db, $table, $this->options);
        $result = $collection->findOne(['_id' => $file]);
        if ($result) {
            return [
              'code' => 200,
              'status' => 'success',
              'rows' => $result['content']
            ];
        }

        return [
          'code' => 1000,
          'status' => 'error',
          'rows' => 'Content not found'
        ];


    }

    public function update($type, $file, $contents, $path)
    {
        $table = (isset($this->tables_mapping[$path]) ? $this->tables_mapping[$path] : $path);
        $collection = new Collection($this->manager, $this->db, $table, $this->options);

        if($contents == "") {
           $contents=file_get_contents(env($path).'/'.$file);
        }

        try {
            $result = $collection->InsertOne([
              '_id' => $file,
              'content' => $contents
            ]);
        }catch (\Exception $e){
            $result = $collection->updateOne(
              ['_id' => $file],
              ['$set'=>['content' => $contents]]
            );
        }

        if ($result) {
            return [
              'code' => 200,
              'status' => 'success',
              'rows' => $contents
            ];
        }

        return [
          'code' => 1000,
          'status' => 'error',
          'rows' => 'Content not updated'
        ];
    }

    public function save($args)// $type, $file, $contents, $path)
    {
        //$table = (isset($this->tables_mapping[$path]) ? $this->tables_mapping[$path] : $path);
        $options = isset($args['option']) ? $args['option'] : [];
        $collection = new Collection($this->manager, $this->db, $args['table'], $options);

        /*
        if($contents == "") {
            $contents=file_get_contents(env($path).'/'.$file);
        }
        */
        try{
            if(isset($args['_id']))
            {
                $result = $collection->updateOne(
                    ['_id' => $args['_id']],
                    //['$set'=>['content' => $contents]]
                    ['$set'=>$args['rows']]
                );

            }
            else
            {
                //dd('insert');

                $result = $collection->insertOne($args['rows']); // NOT TESTED FOR MORE THEN ONE ROWS
            }
        }
        catch(\Exception $e)
        {
            return [
                'code' => 1000,
                'status' => 'cancel',
                'msg' => 'error while inserting',
                'rows' => $args['rows']
            ];
        }

        if ($result) {
            return [
                'code' => 200,
                'status' => 'success',
                'rows' => $args['rows'],
                'result' => $result
            ];
        }


        return [
            'code' => 1000,
            'status' => 'error',
            'rows' => 'Content not updated'
        ];
    }


    /////
    public function delete($args)// $type, $file, $contents, $path)
    {
        //$table = (isset($this->tables_mapping[$path]) ? $this->tables_mapping[$path] : $path);
        $options = isset($args['option']) ? $args['option'] : [];
        $collection = new Collection($this->manager, $this->db, $args['table'], $options);

        /*
        if($contents == "") {
            $contents=file_get_contents(env($path).'/'.$file);
        }
        */
        try{
            if(isset($args['_id']))
            {
                $result = $collection->deleteOne(
                    ['_id' => $args['_id']]

                );
            }
            else
            {

                //$result = $collection->insertOne($args['rows']); // NOT TESTED FOR MORE THEN ONE ROWS
            }
        }
        catch(\Exception $e)
        {
            return [
                'code' => 1000,
                'status' => 'cancel',
                'msg' => 'error while deleting'
            ];
        }

        if ($result) {
            return [
                'code' => 200,
                'status' => 'success',

            ];
        }


        return [
            'code' => 1000,
            'status' => 'error',

            'rows' => 'Content not updated'

        ];
    }

    public function aggregate($args)
    {
        //echo "<pre>"; print_r($args['options']); echo "</pre>";
        //echo "<pre>"; print_r($args['table']); echo "</pre>";
        //echo "<pre>"; print_r($args['pipeline']); echo "</pre>";
        //exit();

        $args['options'] = isset($args['options']) ? $args['options'] : [];
        $collection = new Collection($this->manager, $this->db, $args['table'], $this->options);
        //dd($args);
        try{

            $result = $collection->aggregate($args['pipeline'], $args['options']);

        }
        catch(\Exception $e)
        {
            echo "error";
            dd($e);
            return [
                'code' => 1000,
                'status' => 'cancel',
                'msg' => 'error while inserting'
            ];
        }

        $array = $result->toArray();

        if ($result) {

            return [
                'code' => 200,
                'status' => 'success',
                'rows' => $array
            ];
        }

        return [
            'code' => 1000,
            'status' => 'cancel',
            'msg' => 'DB Error'
        ];

    }


    public function saveFile($args)// $type, $file, $contents, $path)
    {


        /*
        if($contents == "") {
            $contents=file_get_contents(env($path).'/'.$file);
        }
        */
        try{
            if(isset($args['_id']))
            {
                /*
                $result = $collection->updateOne(
                    ['_id' => $args['_id']],
                    //['$set'=>['content' => $contents]]
                    ['$set'=>$args['rows']]
                );
                */
                dd('Please write update code here');

            }
            else
            {
                //dd('insert');

                $result = $this->bucket->uploadFromStream($args['filename'], fopen($args['filename_with_path'],'r')); // NOT TESTED FOR MORE THEN ONE ROWS
            }
        }
        catch(\Exception $e)
        {
		dd($e);
            return [
                'code' => 1000,
                'status' => 'cancel',
                'msg' => 'error while inserting'
            ];
        }

        if ($result) {
            return [
                'code' => 200,
                'status' => 'success',
                'mongo_response' => $result

            ];
        }


        return [
            'code' => 1000,
            'status' => 'error',
            'rows' => 'Content not updated'
        ];
    }

    public function getFileContent($_id)
    {
		
		
		$destination = $this->createStream();
        $this->bucket->downloadToStream( new \MongoDB\BSON\ObjectID($_id), $destination);
        rewind($destination);
		$contents = stream_get_contents($destination);
		 return [
            'code' => 200,
            'msg' => 'ok',
            'contents' => $contents
        ];

       /*$this->assertStreamContents($input, $destination);
		
        $file = $this->bucket->findOne(["_id"=>  new \MongoDB\BSON\ObjectID( $_id )], ['typeMap' => ['root' => 'stdClass']]);
		dd($file);
        

        $download = new \MongoDB\GridFS\GridFSDownload($this->collectionsWrapper, $file);
        $stream = fopen('php://temp', 'w+');
        $download->downloadToStream($stream);
        rewind($stream);
        $contents = stream_get_contents($stream);

        fclose($stream);

        return [
            'code' => 200,
            'msg' => 'ok',
            'rows' => [ $file ],
            'contents' => $contents
        ];*/
    }


    public function Count($args)
    {
        $args['options'] = isset($args['options']) ? $args['options'] : [];
        $collection = new Collection($this->manager, $this->db, $args['table'], $this->options);
        //dd($args);
        try{
            $result = $collection->count($args['filters'], $args['options']);

        }
        catch(\Exception $e)
        {
            return [
              'code' => 1000,
              'status' => 'cancel',
              'msg' => $e->getMessage()
            ];
        }

        return [
          'code' => 200,
          'status' => 'success',
          'rows' => $result
        ];


    }

    public function checkMongoAvailability()
    {
        $command_success = false;
        $first_timestamp = 0;
        do {
            $first_timestamp = $first_timestamp == 0 ? time() : $first_timestamp; // just record once in first time.
            try {
                $command = new \MongoDB\Driver\Command(['ping' => 1]);
                $result = $this->manager->executeCommand('admin', $command);
                $command_success = true;
            } catch (\Exception $e) {
                //if ($e instanceof \MongoDB\Driver\Exception\ConnectionTimeoutException) {

                //}
                sleep(5);

            }
        }while($command_success == false && (time() - $first_timestamp < 20)); // only if command is unseccessfull AND wait no more than 5 seconds

        if($command_success == false) // if mongo is down . hence show PROPER (error_exception.blade.php) error page (if in 'production' (see 'APP_ENV' constant in .env file ) else will be plain exception page)
        {
            if(Request::ajax())
            {
                print json_encode(['code' => 1000, 'status' => 'cancel', 'msg' => 'File server is down. Please try again later.']);
                exit;
            }

            // we were unable to make error exception working like throw new \ErrorException(403).
            // so a workaround was done like below. Also, the name 'Handler' passed to \App\Exceptions\Handler has no meaning. it is just ramdomly selected name
            $abc = new \App\Exceptions\Handler(new \Monolog\Logger("Handler"));
            $view = $abc->render(Request::instance(), new \ErrorException("Connection Time Out Exception For Mongo"));
            print $view->content();
            exit;
        }
    }

    public function removeGridFSFile($file_id){
        return $this->bucket->delete($file_id);
    }

    public function deleteByFilters($args)
    {
        $options = isset($args['option']) ? $args['option'] : [];
        $collection = new Collection($this->manager, $this->db, $args['table'], $options);
        try{
            $result = $collection->deleteOne($args['filters']);
        }
        catch(\Exception $e)
        {
            return [
              'code' => 1000,
              'status' => 'cancel',
              'msg' => 'error while deleting'.$e->getMessage().$e->getLine()
            ];
        }
        if ($result) {
            return [
              'code' => 200,
              'status' => 'success',
            ];
        }
        return [
          'code' => 1000,
          'status' => 'error',
          'rows' => 'Content not deleted'
        ];
    }

    public function bulkWrite($args){
        try {
            $operation = new \MongoDB\Operation\BulkWrite($this->db, $args['collection'], $args['data']);
            $result = $operation->execute($this->manager->selectServer(new \MongoDB\Driver\ReadPreference(\MongoDB\Driver\ReadPreference::RP_PRIMARY)));
            return $result;
        }catch(\Exception $e){
            return [
                'code'=>1000,
                'status'=>'error',
                'msg'=>$e->getMessage().$e->getFile().$e->getLine(),
            ];
        }
    }

    public function updateMany($args)// $type, $file, $contents, $path)
    {
        $options = isset($args['option']) ? $args['option'] : [];
        $collection = new Collection($this->manager, $this->db, $args['table'], $options);

        try{
                $result = $collection->updateMany(
                    $args['find'],
                    ['$set'=>$args['rows']]
                );

        }
        catch(\Exception $e)
        {
            return [
                'code' => 1000,
                'status' => 'cancel',
                'msg' => 'error while inserting',
                'rows' => $args['rows']
            ];
        }

        if ($result) {
            return [
                'code' => 200,
                'status' => 'success',
                'rows' => $args['rows'],
                'result' => $result
            ];
        }


        return [
            'code' => 1000,
            'status' => 'error',
            'rows' => 'Content not updated'
        ];
    }
	
	 /**
     * Creates an in-memory stream with the given data.
     *
     * @param string $data
     * @return resource
     */
    protected function createStream($data = '')
    {
        $stream = fopen('php://temp', 'w+b');
        fwrite($stream, $data);
        rewind($stream);

        return $stream;
    }
 /**
     * Asserts that a variable is a stream containing the expected data.
     *
     * Note: this will seek to the beginning of the stream before reading.
     *
     * @param string   $expectedContents
     * @param resource $stream
     */
    protected function assertStreamContents($expectedContents, $stream)
    {
        $this->assertInternalType('resource', $stream);
        $this->assertSame('stream', get_resource_type($stream));
        $this->assertEquals($expectedContents, stream_get_contents($stream));
    }
	
}
