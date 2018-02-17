<?php
//load the database configuration file
include 'conn.php';
date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d H:i');
if(isset($_POST['importSubmit'])){
    
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //skip first line
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
            while(($line = @fgetcsv($csvFile,1000,";","/n")) !== FALSE){
                //check whether member already exists in database with same eid                
                $prevQuery = "SELECT qns FROM questions WHERE qid = '".$line[1]."'";
                $prevResult = $db->query($prevQuery);
                if($prevResult->num_rows > 0)
                {
                    //update member data
                    $db->query("UPDATE questions SET eid = '".$line[0]."', qns = '".$line[2]."', sn = '".$line[3]."' WHERE qid = '".$line[1]."'");
                }else{
                    //insert member data into database
                    $db->query("INSERT INTO questions (eid,qid,qns,choice,sn) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','4','".$line[3]."')");
                }
            }
            
            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: SubPreguntas.php".$qstring);