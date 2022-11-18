<?php
 $array_message = [];
// $file_name = $_FILES['image']['name'];
// $file_size = $_FILES['image']['size'];
// $file_tmp = $_FILES['image']['tmp_name'];
// $file_type = $_FILES['image']['type'];
// $array_message['file'] = $file_name . " " . $file_size . " " . $file_tmp . " " . $file_type;


//$len = count($_FILES['image']);
//echo $_FILES['image']['tmp_name'][0];
// echo $_POST['action'];
// print_r($_FILES['image']['name']);
$array_message['message'] = $_FILES['files']['name'][0] . " and " . $_FILES['files']['tmp_name'][0];
// for($i = 0; $i < $len; $i++){
//     $src = $_FILES['image']['tmp_name'][$i];
//     $filename = $_FILES['image']['name'][$i];
//     $output_dir = "images/".$filename;
//     echo $filename;
//     // if(move_uploaded_file($src, $output_dir )){
//     //     echo "Success! Image uploaded! File: ".$filename;
//     // }else{
//     //     echo "Error! Image upload failed! File: ".$filename;
//     // };
//     // echo "\n<br>";
// }
echo json_encode($array_message);
