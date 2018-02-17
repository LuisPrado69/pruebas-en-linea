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
            while(($line = fgetcsv($csvFile,1000,";","/n")) !== FALSE){
                
                //check whether member already exists in database with same eid
                $prevQuery = "SELECT title FROM quiz WHERE eid = '".$line[0]."'";
                $prevResult = $db->query($prevQuery);
                if($prevResult->num_rows > 0)
                {
                    //update member data
                    $db->query("UPDATE quiz SET title = '".$line[1]."', sahi = '".$line[2]."', wrong = '".$line[3]."', total = '".$line[4]."', time = '".$line[5]."' , intro = '".$line[6]."' , tag = '".$line[6]."', date = '".$fecha."' WHERE eid = '".$line[0]."'");
                }
                else
                {
                    //insert member data into database
                    $db->query("INSERT INTO quiz (eid,title,sahi,wrong,total,time,intro,tag) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$line[5]."','".$line[6]."','".$line[6]."')");
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
header("Location: SubPruebas.php".$qstring);