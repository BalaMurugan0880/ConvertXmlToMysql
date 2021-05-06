<?php
$conn = mysqli_connect("localhost", "root", "", "blognews");

$affectedRow = 0;

$xml = simplexml_load_file("goodnewsimage.xml") or die("Error: Cannot create object");


foreach ($xml->xpath('//item') as $item) {

    $thumbnail = $item->guid;
    $post_id = $item->post_parent;

     $sqlupdatepost =  "UPDATE posts SET thumbnail='".$thumbnail."' WHERE id='".$post_id."'";

     $result4 = mysqli_query($conn, $sqlupdatepost);
    
    // $convertContent = addslashes($item->content);

    // if ($item->status == 'publish') {
    //     $is_published = 1;
    // }else{
    //     $is_published = 0;
    // }

    // $sqlgetid =  "SELECT id FROM users WHERE name = '".$item->creator."'";

    // $get_id = $conn->query($sqlgetid);
    // $rowcount=mysqli_num_rows($get_id);
    // $result_assoc = $get_id->fetch_assoc();

    
    // foreach ($result_assoc as $user_id) {

    //     $title = $item->title;
    //     $post_type = $item->post_type;
    //     $post_id = $item->post_id;
    //     $link = $item->link;
    //     $pubDate = $item->pubDate;
    //     $user_id =   $user_id;
    //     $content =  $convertContent;
    //     $is_published1 =  $is_published;
    //     $slug = $item->post_name;
    //     $mainModule_id = 1;//goodnews = 1, bac360 = 2
    //     $category_name = $item->category['nicename'];


    
    //     // $sql = "INSERT INTO posts(id,mainModule_id,title,slug,created_at,user_id,details,post_type,is_published) VALUES ('" . $post_id . "','" . $mainModule_id . "','" . $title . "','" . $slug . "','" . $pubDate . "','" . $user_id . "','" . $content . "','" . $post_type . "','" . $is_published1 . "')"; 

    //     // $sql2 = "INSERT INTO categories(mainmodule_id,category_name,category_slug,is_published,user_id) VALUES ('" . $mainModule_id ."','" . $category_name ."','" . $category_name ."','" . $is_published1 ."','" . $user_id ."')";

    //     $sqlgetcategoryid =  "SELECT id FROM categories WHERE category_name = '".$category_name."'";

    //     $get_categoryid = $conn->query($sqlgetcategoryid);
    //     $rowcount2=mysqli_num_rows($get_categoryid);
    //     $result_assoc2 = $get_categoryid->fetch_assoc();

    //     foreach ($result_assoc2 as $category_id) {

    //         $cat_id = $category_id;

    //          $sql3 = "INSERT INTO category_posts(category_id,post_id) VALUES ('" . $cat_id ."','" . $post_id ."')";

    //          $result3 = mysqli_query($conn, $sql3);

    //     }

       


        
    //     // $result = mysqli_query($conn, $sql);
    //     // $result2 = mysqli_query($conn, $sql2);




        
        if (! empty($result4)) {
            $affectedRow ++;
        } else {
            $error_message = mysqli_error($conn) . "\n";
        }
       
    // }

  

   

   // print_r($test33);


   
}



foreach ($xml->xpath('//author') as $author) {


      // echo $child ."\n";
   //   $author_id = $author->author_id;
   //  $author_name = $author->author_login;
   //  $author_email = $author->author_email;
   //  $author_pass = password_hash("bac@2021", PASSWORD_DEFAULT);
   //  $author_role = 'Editor';




   // $sql2 = "INSERT INTO users(id,name,email,password,role) VALUES ('" . $author_id . "','" . $author_name . "','" . $author_email . "','" . $author_pass . "','" . $author_role . "')"; 
    
   //  $result2 = mysqli_query($conn, $sql2);


    
   //  if (! empty($result2)) {
   //      $affectedRow ++;
   //  } else {
   //      $error_message = mysqli_error($conn) . "\n";
   //  }



   
}
?>
<h2>Insert XML Data to MySql Table Output </h2>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
} else {
    $message = "No records inserted";
}

?>
<style>
body {  
    max-width:550px;
    font-family: Arial;
}
.affected-row {
	background: #cae4ca;
	padding: 10px;
	margin-bottom: 20px;
	border: #bdd6bd 1px solid;
	border-radius: 2px;
    color: #6e716e;
}
.error-message {
    background: #eac0c0;
    padding: 10px;
    margin-bottom: 20px;
    border: #dab2b2 1px solid;
    border-radius: 2px;
    color: #5d5b5b;
}
</style>
<div class="affected-row"><?php  echo $message; ?></div>
<?php if (! empty($error_message)) { ?>
<div class="error-message"><?php echo nl2br($error_message); ?></div>
<?php } ?>