<?php
    /**
    * This class is under GPL Licencense Agreement
    * @author Juan Carlos Gonzalez Ulloa <jgonzalez@innox.com.mx>
    * Innovacion Inteligente S de RL de CV (Innox)
    * Av. Abraham Lincoln 28 B
    * Col. Vallarta Norte
    * Guadalajara, Jalisco. México.
    *
    * Class to read SHP files and modify the DBF related information
    * Just create the object and all the records will be saved in $shp->records
    * Each record has the "shp_data" and "dbf_data" arrays with the record information
    * You can modify the DBF information using the $shp_record->setDBFInformation($data)
    * The $data must be an array with the DBF's row data.
    *
    * Performance issues:
    * Because the class opens and fetches all the information (records/dbf info)
    * from the file, the loading time and memory amount neede may be way to much.
    * Example:
    *   15 seconds loading a 210907 points shape file
    *   60Mb memory limit needed
    *   Athlon XP 2200+
    *   Mandrake 10 OS
    *
    */
    use \dbf_class;
    // Configuration
    define("SHOW_ERRORS", true);
    define("DEBUG", false);
    
    
    // Constants
    define("XY_POINT_RECORD_LENGTH", 16);
    
    
    // Strings
    define("ERROR_FILE_NOT_FOUND", "SHP File not found [%s]");
    define("INEXISTENT_RECORD_CLASS", "Unable to determine shape record type [%i]");
    define("INEXISTENT_FUNCTION", "Unable to find reading function [%s]");
    define("INEXISTENT_DBF_FILE", "Unable to open (read/write) SHP's DBF file [%s]");
    define("INCORRECT_DBF_FILE", "Unable to read SHP's DBF file [%s]");
    define("UNABLE_TO_WRITE_DBF_FILE", "Unable to write DBF file [%s]");
    
    class ShapeFile extends \BaseController
    {
        var $file_name;
        var $fp;
        var $prueba;
        
        var $error_message = "";
        var $show_errors   = SHOW_ERRORS;
        
        var $shp_bounding_box = array();
        var $shp_type         = 0;
        
        var $records;
        var $dbf;
        
        function ShapeFile($file_name){
            $this->file_name = $file_name;
            _d("Opening [$file_name]");
            $this->prueba = 0;
            if(!is_readable($file_name)){
                $this->prueba = 1;
                return $this->setError( sprintf(ERROR_FILE_NOT_FOUND, $file_name) );
            }
            
            $this->fp = fopen($this->file_name, "rb");
            $this->_fetchShpBasicConfiguration();
            $this->getDBFHeader();
            $this->_fetchRecords();
        }
        
// Data fetchers
        function _fetchShpBasicConfiguration(){
            _d("Reading basic information");
            fseek($this->fp, 32, SEEK_SET);
        	$this->shp_type = readAndUnpack("i", fread($this->fp, 4));
        	_d("SHP type detected: ".$this->shp_type);
        	
        	$this->shp_bounding_box = readBoundingBox($this->fp);
        	//_d("SHP bounding box detected: miX=".$this->shp_bounding_box["xmin"]." miY=".$this->shp_bounding_box["ymin"]." maX=".$this->shp_bounding_box["xmax"]." maY=".$this->shp_bounding_box["ymax"]);
        }
        
        function _fetchRecords(){
            fseek($this->fp, 100);
            $recid=0;
            while(!feof($this->fp)){
                $shp_record = new ShapeRecord($this->fp, $this->file_name);
                if($shp_record->error_message != ""){
                    return false;
                }
                $this->records[] = $shp_record;
                break;
            }
        }

        function fetchNextRecord(){
            while(!feof($this->fp)){
                $shp_record = new ShapeRecord($this->fp, $this->file_name);
                if($shp_record->error_message != ""){
                    return false;
                }
                $this->records[] = $shp_record;
                break;
            }
        }

        function getDBFHeader(){
        	$dbf_filename = processDBFFileName($this->file_name);
        	
        	$dbf_data = array();
//        	if(is_readable($dbf_data)){
//mod mm        		$dbf = dbase_open($dbf_filename, 1);
                $this->dbf = new dbf_class($dbf_filename);
        		// solo en PHP5 $dbf_data = dbase_get_header_info($dbf);
        		
//        	}
        }
        
// General functions        
        function setError($error){
            $this->error_message = $error;
            if($this->show_errors){
                echo $error."\n";
            }
            return false;
        }
        
        function closeFile(){
            if($this->fp){
                fclose($this->fp);
            }
        }
        
        
    }
    
    
/**
* ShapeRecord
*
*/    
    class ShapeRecord{
        var $fp;
        var $dbf = null;
        
        var $record_number     = null;
        var $content_length    = null;
        var $record_shape_type = null;
        
        var $error_message     = "";
        
        var $shp_data = array();
        var $dbf_data = array();
        
        var $file_name = "";
        
        var $record_class = array(  0 => "RecordNull",
                                          1 => "RecordPoint",
                                          8 => "RecordMultiPoint",
                                          3 => "RecordPolyLine",
                                          5 => "RecordPolygon");
        
        function ShapeRecord(&$fp, $file_name){
            $this->fp = $fp;
            _d("Shape record created at byte ".ftell($fp));
            
            $this->_readHeader();

            $function_name = "read".$this->getRecordClass();
            _d("Calling reading function [$function_name] starting at byte ".ftell($fp));
            
            if(function_exists($function_name)){
                $this->shp_data = $function_name($this->fp);
            } else {
                $this->setError( sprintf(INEXISTENT_FUNCTION, $function_name) );
            }
            $this->file_name = processDBFFileName($file_name);

            $this->_fetchDBFInformation();
        }
        
        function _readHeader(){
            $this->record_number     = readAndUnpack("N", fread($this->fp, 4));
            $this->content_length    = readAndUnpack("N", fread($this->fp, 4));
            $this->record_shape_type = readAndUnpack("i", fread($this->fp, 4));
            
            _d("Shape Record ID=".$this->record_number." ContentLength=".$this->content_length." RecordShapeType=".$this->record_shape_type."\nEnding byte ".ftell($this->fp)."\n");
        }
        
        function getRecordClass(){
            if(!isset($this->record_class[$this->record_shape_type])){
                _d("Unable to find record class ($this->record_shape_type) [".getArray($this->record_class)."]");
                return $this->setError( sprintf(INEXISTENT_RECORD_CLASS, $this->record_shape_type) );
            }
            _d("Returning record class ($this->record_shape_type) ".$this->record_class[$this->record_shape_type]);
            return $this->record_class[$this->record_shape_type];
        }
        
        function setError($error){
            $this->error_message = $error;
            return false;
        }
        
        function getShpData(){
            return $this->shp_data;
        }
        
        function _openDBFFile($check_writeable = false){
            $dbffilename =$this->file_name;

            if(1==1){
//mm                $this->dbf = dbase_open($this->file_name, ($check_writeable ? 2 : 0));
                  $this->dbf = new dbf_class($dbffilename);

                if(!$this->dbf){
                    $this->setError( sprintf(INCORRECT_DBF_FILE, $this->file_name) );
                }
            } else {
                $this->setError( sprintf(INEXISTENT_DBF_FILE, $this->file_name) );
            }
        }
        
        function _closeDBFFile(){
            if($this->dbf){
//                dbase_close($this->dbf);
                $this->dbf = null;
            }
        }
        
        function _fetchDBFInformation(){
//            print_r(stream_context_get_options($this->fp));
            $this->_openDBFFile();
            if($this->dbf) {
//°°                $this->dbf_data = dbase_get_record_with_names($this->dbf, $this->record_number);
                 $this->dbf_data = $this->dbf->getRow($this->record_number);
            } else {
                $this->setError( sprintf(INCORRECT_DBF_FILE, $this->file_name) );
            }
            $this->_closeDBFFile();
        }
        
        function setDBFInformation($row_array){
            $this->_openDBFFile(true);
            if($this->dbf) {
                unset($row_array["deleted"]);

                if(!dbase_replace_record($this->dbf, array_values($row_array), $this->record_number)){
                    $this->setError( sprintf(UNABLE_TO_WRITE_DBF_FILE, $this->file_name) );
                } else {
                    $this->dbf_data = $row_array;
                }
            } else {
                $this->setError( sprintf(INCORRECT_DBF_FILE, $this->file_name) );
            }
            $this->_closeDBFFile();
        }
    }
    
    
/**
* Reading functions
*/    
    
    function readRecordNull(&$fp, $read_shape_type = false){
        $data = array();
        if($read_shape_type) $data += readShapeType($fp);
        _d("Returning Null shp_data array = ".getArray($data));
        return $data;
    }
    $point_count = 0;
    function readRecordPoint(&$fp, $create_object = false){
        global $point_count;
        $data = array();
        
        $data["x"] = readAndUnpack("d", fread($fp, 8));
        $data["y"] = readAndUnpack("d", fread($fp, 8));
        
        //_d("Returning Point shp_data array = ".getArray($data));
        $point_count++;
        return $data;
    }
    
    function readRecordMultiPoint(&$fp){
        $data = readBoundingBox($fp);
        $data["numpoints"] = readAndUnpack("i", fread($fp, 4));
        _d("MultiPoint numpoints = ".$data["numpoints"]);
        
        for($i = 0; $i <= $data["numpoints"]; $i++){
            $data["points"][] = readRecordPoint($fp);
        }
        
        _d("Returning MultiPoint shp_data array = ".getArray($data));
        return $data;
    }
    
    function readRecordPolyLine(&$fp){
        $data = readBoundingBox($fp);
        $data["numparts"]  = readAndUnpack("i", fread($fp, 4));
        $data["numpoints"] = readAndUnpack("i", fread($fp, 4));
        
        _d("PolyLine numparts = ".$data["numparts"]." numpoints = ".$data["numpoints"]);
        
        for($i=0; $i<$data["numparts"]; $i++){
            $data["parts"][$i] = readAndUnpack("i", fread($fp, 4));
            _d("PolyLine adding point index= ".$data["parts"][$i]);
        }
        
        $points_initial_index = ftell($fp);
        _d("Reading points; initial index = $points_initial_index");
        $points_read          = 0;
        foreach($data["parts"] as $part_index => $point_index){
            //fseek($fp, $points_initial_index + $point_index);
            _d("Seeking initial index point [".($points_initial_index + $point_index)."]");
            if(!isset($data["parts"][$part_index]["points"]) || !is_array($data["parts"][$part_index]["points"])){
                $data["parts"][$part_index] = array();
                $data["parts"][$part_index]["points"] = array();
            }
            while( ! in_array( $points_read, $data["parts"]) && $points_read < $data["numpoints"] && !feof($fp)){
                set_time_limit(160);
                $data["parts"][$part_index]["points"][] = readRecordPoint($fp, true);
                $points_read++;
            }
        }
        
        fseek($fp, $points_initial_index + ($points_read * XY_POINT_RECORD_LENGTH));
        _d("Seeking end of points section [".($points_initial_index + ($points_read * XY_POINT_RECORD_LENGTH))."]");
        return $data;
    }
    
    function readRecordPolygon(&$fp){
        _d("Polygon reading; applying readRecordPolyLine function");
        return readRecordPolyLine($fp);
    }
    
/**
* General functions
*/    
    function processDBFFileName($dbf_filename){
        _d("Received filename [$dbf_filename]");
        if(!strstr($dbf_filename, ".")){
            $dbf_filename .= ".dbf";
        }
        
        if(substr($dbf_filename, strlen($dbf_filename)-3, 3) != "dbf"){
            $dbf_filename = substr($dbf_filename, 0, strlen($dbf_filename)-3)."dbf";
        }
        _d("Ended up like [$dbf_filename]");

        return $dbf_filename;
    }
    
    function readBoundingBox(&$fp){
        $data = array();
        $data["xmin"] = readAndUnpack("d",fread($fp, 8));
    	$data["ymin"] = readAndUnpack("d",fread($fp, 8));
    	$data["xmax"] = readAndUnpack("d",fread($fp, 8));
    	$data["ymax"] = readAndUnpack("d",fread($fp, 8));
    	
    	_d("Bounding box read: miX=".$data["xmin"]." miY=".$data["ymin"]." maX=".$data["xmax"]." maY=".$data["ymax"]);
    	return $data;
    }
    
    function readAndUnpack($type, $data){
        if(!$data) return $data;
        return current(unpack($type, $data));
    }
    
    function _d($debug_text){
        if(DEBUG){
            echo $debug_text."\n";
        }
    }
    
    function getArray($array){
        ob_start();
        print_r($array);
        $contents = ob_get_contents();
        ob_get_clean();
        return $contents;
    }
?>
