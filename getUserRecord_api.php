<?php
    $con = mysqli_connect("localhost","root","","studentdetails");
    $response = array();
    if($con){
        $sql = "select * from studtable";
        $result = mysqli_query($con,$sql);
        if($result){
            header("Content-type: JSON");
            $i=0;
            while($row=mysqli_fetch_assoc($result)){
                $response[$i]['idnumber'] = $row ['idnumber'];
                $response[$i]['bottlesCollected'] = $row ['bottlesCollected'];
                $response[$i]['cansCollected'] = $row ['cansCollected'];
                $response[$i]['rewardPts'] = $row ['rewardPts'];
                $i++;
            }
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }
    else{
        echo "Database Connection Failed";
    }
?>