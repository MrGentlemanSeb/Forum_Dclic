<?php
require_once 'config.php';
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database is not connected");

//function for showing pages
function showPage($page,$data=""){
include("assets/pages/$page.php");
}



//for getting ids of chat users
function getActiveChatUserIds(){
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT from_user_id,to_user_id FROM messages WHERE to_user_id=$current_user_id || from_user_id=$current_user_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    $data =  mysqli_fetch_all($run,true);
    $ids=array();
    foreach($data as $ch){
    if($ch['from_user_id']!=$current_user_id && !in_array($ch['from_user_id'],$ids)){
       $ids[]=$ch['from_user_id'];
    }

    if($ch['to_user_id']!=$current_user_id && !in_array($ch['to_user_id'],$ids)){
        $ids[]=$ch['to_user_id'];
     }

    }

    return $ids;
}

function getMessages($user_id){
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM messages WHERE (to_user_id=$current_user_id && from_user_id=$user_id) || (from_user_id=$current_user_id && to_user_id=$user_id) ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return  mysqli_fetch_all($run,true);
}

function sendMessage($user_id,$msg){
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "INSERT INTO messages (from_user_id,to_user_id,msg) VALUES($current_user_id,$user_id,'$msg')";
    return mysqli_query($db,$query);

}

function newMsgCount(){
global $db;
$current_user_id = $_SESSION['userdata']['id'];
$query="SELECT COUNT(*) as usersCount FROM messages WHERE to_user_id=$current_user_id && read_status=0";
$run=mysqli_query($db,$query);
return mysqli_fetch_assoc($run)['usersCount'];
}

function updateMessageReadStatus($user_id){
    $cu_user_id = $_SESSION['userdata']['id'];
    global $db;
    $query="UPDATE messages SET read_status=1 WHERE to_user_id=$cu_user_id && from_user_id=$user_id";
    return mysqli_query($db,$query);
}

function gettime($date){
    return date('H:i - (F jS, Y )', strtotime($date));
}

function getAllMessages(){
    $active_chat_ids = getActiveChatUserIds();
    $conversation=array();
    foreach($active_chat_ids as $index=>$id){
        $conversation[$index]['user_id'] = $id;
        $conversation[$index]['messages'] = getMessages($id);
    }
    return $conversation;
}

//function for follow the user
function followUser($user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO follow_list(follower_id,user_id) VALUES($current_user,$user_id)";
  
    createNotification($cu['id'],$user_id,"à commencer a vous suivre !");
    return mysqli_query($db,$query);
    
}



//function for blocking the user
function blockUser($blocked_user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO block_list(user_id,blocked_user_id) VALUES($current_user,$blocked_user_id)";
  
    createNotification($cu['id'],$blocked_user_id,"vous à bloquez");
    $query2="DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$blocked_user_id";
    mysqli_query($db,$query2);
    $query3="DELETE FROM follow_list WHERE follower_id=$blocked_user_id && user_id=$current_user";
    mysqli_query($db,$query3);

   
    return mysqli_query($db,$query);
    
}

//for unblocking the user
function unblockUser($user_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM block_list WHERE user_id=$current_user && blocked_user_id=$user_id";
    createNotification($current_user,$user_id,"vous à débloquez !");
    return mysqli_query($db,$query);   
}

//function checkLikeStatus
function checkLikeStatus($post_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as usersCount FROM likes WHERE user_id=$current_user && post_id=$post_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['usersCount'];
}

//function for like the post
function like($post_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO likes(post_id,user_id) VALUES($post_id,$current_user)";
   $poster_id = getPosterId($post_id);
   
   if($poster_id!=$current_user){
    createNotification($current_user,$poster_id,"à aimé votre post !",$post_id);
   }
   

    return mysqli_query($db,$query);
    
}




//function for creating comments
function addComment($post_id,$comment){
    global $db;
 $comment = mysqli_real_escape_string($db,$comment);

    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO comments(user_id,post_id,comment) VALUES($current_user,$post_id,'$comment')";
    $poster_id = getPosterId($post_id);

    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"commented on your post",$post_id);
    }
   

    return mysqli_query($db,$query);
    
}


//function for creating comments
function createNotification($from_user_id,$to_user_id,$msg,$post_id=0){
    global $db;
    $query="INSERT INTO notifications(from_user_id,to_user_id,message,post_id) VALUES($from_user_id,$to_user_id,'$msg',$post_id)";
    mysqli_query($db,$query);    
}



//function for getting likes count
function getComments($post_id){
    global $db;
    $query="SELECT * FROM comments WHERE post_id=$post_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//get notifications

function getNotifications(){
  $cu_user_id = $_SESSION['userdata']['id'];

    global $db;
    $query="SELECT * FROM notifications WHERE to_user_id=$cu_user_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}



function getUnreadNotificationsCount(){
    $cu_user_id = $_SESSION['userdata']['id'];
  
      global $db;
      $query="SELECT count(*) as usersCount FROM notifications WHERE to_user_id=$cu_user_id && read_status=0 ORDER BY id DESC";
      $run = mysqli_query($db,$query);
      return mysqli_fetch_assoc($run)['usersCount'];
  }

  function show_time($time){
    return '<time style="font-size:small" class="timeago text-muted text-small" datetime="'.$time.'"></time>';
  }

  function setNotificationStatusAsRead(){
       $cu_user_id = $_SESSION['userdata']['id'];
      global $db;
      $query="UPDATE notifications SET read_status=1 WHERE to_user_id=$cu_user_id";
      return mysqli_query($db,$query);
  }



//function for getting likes count
function getLikes($post_id){
    global $db;
    $query="SELECT * FROM likes WHERE post_id=$post_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//function for unlike the post
function unlike($post_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM likes WHERE user_id=$current_user && post_id=$post_id";
    
    $poster_id = getPosterId($post_id);
    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"unliked your post !",$post_id);
    }
  
    return mysqli_query($db,$query);
}
function unfollowUser($user_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";

    createNotification($current_user,$user_id,"Unfollowed you !");
    return mysqli_query($db,$query);
 
    
}


//function for show errors
function showError($field){
if(isset($_SESSION['error'])){
    $error =$_SESSION['error'];
    if(isset($error['field']) && $field==$error['field']){
       ?>
<div class="alert alert-danger my-2" role="alert">
  <?=$error['msg']?>
</div>
       <?php
    }
}
}


//function for show prevformdata
function showFormData($field){
    if(isset($_SESSION['formdata'])){
        $formdata =$_SESSION['formdata'];
        return $formdata[$field];
    }
 
}


//for checking duplicate email
function isEmailRegistered($email){
    global $db;
    $query="SELECT count(*) as usersCount FROM users WHERE email='$email'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['usersCount'];
}

//for checking duplicate username
function isUsernameRegistered($username){
    global $db;
    $query="SELECT count(*) as usersCount FROM users WHERE username='$username'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['usersCount'];
}

//for checking duplicate username by other
function isUsernameRegisteredByOther($username){
    global $db;
    $user_id=$_SESSION['userdata']['id'];
    $query="SELECT count(*) as usersCount FROM users WHERE username='$username' && id!=$user_id";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['usersCount'];
}

//for validating the signup form
function validateSignupForm($form_data){
$response=array();
$response['status']=true;
  
    if(!$form_data['password']){
        $response['msg']="entrez votre mot de passe";
        $response['status']=false;
        $response['field']='password';
    }
   
    if(!$form_data['username']){
        $response['msg']="entrez votre nom d'utilisateur";
        $response['status']=false;
        $response['field']='username';
    }
    
    if(!$form_data['email']){
        $response['msg']="entrez votre email";
        $response['status']=false;
        $response['field']='email';
    }
    
    if(!$form_data['last_name']){
        $response['msg']="entrez votre nom ";
        $response['status']=false;
        $response['field']='last_name';
    }
    if(!$form_data['first_name']){
        $response['msg']="entrez votre prénom";
        $response['status']=false;
        $response['field']='first_name';
    }
    if(isEmailRegistered($form_data['email'])){
        $response['msg']="l'email est déjà enregistrer";
        $response['status']=false;
        $response['field']='email';
    }
    if(isUsernameRegistered($form_data['username'])){
        $response['msg']="nom d'utilisateur est déjà enregistrer";
        $response['status']=false;
        $response['field']='username';
    }
    if(isUsernameRegistered($form_data['current_job'])){
        $response['msg']="métier est déjà  est déjà enregistrer";
        $response['status']=false;
        $response['field']='current_job';
    }

    return $response;

}


//for validate the login form
function validateLoginForm($form_data){
    $response=array();
    $response['status']=true;
    $blank=false;
      
        if(!$form_data['password']){
            $response['msg']="password is not given";
            $response['status']=false;
            $response['field']='password';
            $blank=true;
        }
       
        if(!$form_data['username_email']){
            $response['msg']="username/email is not given";
            $response['status']=false;
            $response['field']='username_email';
            $blank=true;
        }

        if(!$blank && !checkUser($form_data)['status'] ){
            $response['msg']="something is incorrect, we can't find you";
            $response['status']=false;
            $response['field']='checkuser';
        }else{
            $response['user']=checkUser($form_data)['user'];
        }
        
      
       
       
    
    
        return $response;
    
    }


//for checking the user
function checkUser($login_data){
    global $db;
 $username_email = $login_data['username_email'];
 $password=md5($login_data['password']);

 $query = "SELECT * FROM users WHERE (email='$username_email' || username='$username_email') && password='$password'";
 $run = mysqli_query($db,$query);
 $data['user'] = mysqli_fetch_assoc($run)??array();
 if(count($data['user'])>0){
     $data['status']=true;
 }else{
    $data['status']=false;

 }

 return $data;
}


//for getting userdata by id
function getUser($user_id){
    global $db;
 $query = "SELECT * FROM users WHERE id=$user_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);

}


//for filtering the suggestion list
function filterFollowSuggestion(){
$list = getFollowSuggestions();
$filter_list  = array();
foreach($list as $user){
    if(!checkFollowStatus($user['id']) && !checkBS($user['id']) && count($filter_list)<5){
     $filter_list[]=$user;
    }
}

return $filter_list;
}

//for checking the user is followed by current user or not
function checkFollowStatus($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as usersCount FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['usersCount'];
}

//for checking the user is followed by current user or not
function checkBlockStatus($current_user,$user_id){
    global $db;
    
    $query="SELECT count(*) as usersCount FROM block_list WHERE user_id=$current_user && blocked_user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['usersCount'];
}


function checkBS($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as usersCount FROM block_list WHERE (user_id=$current_user && blocked_user_id=$user_id) || (user_id=$user_id && blocked_user_id=$current_user)";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['usersCount'];
}
//

//for getting users for follow suggestions
function getFollowSuggestions(){
    global $db;

    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM users WHERE id!=$current_user";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//get followers count
function getFollowers($user_id){
    global $db;
    $query = "SELECT * FROM follow_list WHERE user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//get followers count
function getFollowing($user_id){
    global $db;
    $query = "SELECT * FROM follow_list WHERE follower_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//for getting posts by id
function getPostById($user_id){
    global $db;
 $query = "SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_all($run,true);

}

//for getting post
function getPosterId($post_id){
    global $db;
 $query = "SELECT user_id FROM posts WHERE id=$post_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run)['user_id'];

}

//for searching the users
// function searchUser($keyword){
//     global $db;
//  $query = "SELECT * FROM users WHERE username LIKE '%".$keyword."%' || (first_name LIKE '%".$keyword."%' || last_name LIKE '%".$keyword."%') LIMIT 5";
//  $query = "SELECT * FROM users WHERE current_job LIKE '%".$keyword."%'  LIMIT 5";
//  $run = mysqli_query($db,$query);
//  return mysqli_fetch_all($run,true);

// }
function searchUser($keyword) {
    global $db;
    
    $queryByUsername = "SELECT * FROM users 
                        WHERE username LIKE '%$keyword%' 
                        OR name Like '%$keyword%'
                        OR first_name LIKE '%$keyword%' 
                        OR last_name LIKE '%$keyword%'
                        LIMIT 5";

    $queryByCurrentJob = "SELECT * FROM users 
                          WHERE current_job LIKE '%$keyword%'
                          LIMIT 5";

    $runByUsername = mysqli_query($db, $queryByUsername);
    $runByCurrentJob = mysqli_query($db, $queryByCurrentJob);
    
    if (!$runByUsername || !$runByCurrentJob) {
        // Gérer les erreurs de requête si nécessaire
        return ['pas de resultat'];
    }

    $resultsByUsername = mysqli_fetch_all($runByUsername, MYSQLI_ASSOC);
    $resultsByCurrentJob = mysqli_fetch_all($runByCurrentJob, MYSQLI_ASSOC);

    // Comparer les résultats et choisir le plus pertinent
    if (count($resultsByUsername) >= count($resultsByCurrentJob)) {
        return $resultsByUsername;
    } else {
        return $resultsByCurrentJob;
    }
}





//for getting userdata by username
function getUserByUsername($username){
    global $db;
 $query = "SELECT * FROM users WHERE username='$username'";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);
}

//for getting posts
function getPost(){
    global $db;
 $query = "SELECT users.id as uid,posts.id,posts.user_id,posts.post_img,posts.post_text,posts.created_at,users.first_name,users.last_name,users.username,users.profile_pic,users.current_job FROM posts JOIN users ON users.id=posts.user_id ORDER BY id DESC";

 $run = mysqli_query($db,$query);
 return mysqli_fetch_all($run,true);

}


function deletePost($post_id){
    global $db;
$user_id=$_SESSION['userdata']['id'];
    $dellike = "DELETE FROM likes WHERE post_id=$post_id && user_id=$user_id";
    mysqli_query($db,$dellike);
    $delcom = "DELETE FROM comments WHERE post_id=$post_id && user_id=$user_id";
    mysqli_query($db,$delcom);
    $not = "UPDATE notifications SET read_status=2 WHERE post_id=$post_id && to_user_id=$user_id";
mysqli_query($db,$not);


    $query = "DELETE FROM posts WHERE id=$post_id";
    return mysqli_query($db,$query);
}

//for getting posts dynamically
function filterPosts(){
    $list = getPost();
    $filter_list  = array();
    foreach($list as $post){
        if(checkFollowStatus($post['user_id']) || $post['user_id']==$_SESSION['userdata']['id']){
         $filter_list[]=$post;
        }
    }
    
    return $filter_list;
    }



//for creating new user
function createUser($data){
 global $db;
 $first_name = mysqli_real_escape_string($db,$data['first_name']);
 $last_name = mysqli_real_escape_string($db,$data['last_name']);
 $gender = $data['gender'];
 $email = mysqli_real_escape_string($db,$data['email']);
 $username = mysqli_real_escape_string($db,$data['username']);
 $password = mysqli_real_escape_string($db,$data['password']);
 $password = md5($password);
 $current_job = mysqli_real_escape_string($db,$data['current_job']);

 $query = "INSERT INTO users(first_name,last_name,gender,email,username,password,current_job) ";
 $query.="VALUES ('$first_name','$last_name',$gender,'$email','$username','$password','$current_job')"; 
 return mysqli_query($db,$query);
}

//function for verify email
function verifyEmail($email){
    global $db;
    $query="UPDATE users SET ac_status=1 WHERE email='$email'";
    return mysqli_query($db,$query);
}

//function for verify email
function resetPassword($email,$password){
    global $db;
    $password=md5($password);
    $query="UPDATE users SET password='$password' WHERE email='$email'";
    return mysqli_query($db,$query);
}

//for validating update form
function validateUpdateForm($form_data,$image_data){
    $response=array();
    $response['status']=true;
      

        if(!$form_data['username']){
            $response['msg']="entrez votre nom d'utilisateur";
            $response['status']=false;
            $response['field']='username';
        }
        
        if(!$form_data['last_name']){
            $response['msg']="entrez votre nom";
            $response['status']=false;
            $response['field']='last_name';
        }
        if(!$form_data['first_name']){
            $response['msg']="entrez votre nom";
            $response['status']=false;
            $response['field']='first_name';
        }
  
        if(isUsernameRegisteredByOther($form_data['username'])){
            $response['msg']=$form_data['username']." est déjà enregistrer";
            $response['status']=false;
            $response['field']='username';
        }
    
       if($image_data['name']){
           $image = basename($image_data['name']);
           $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
           $size = $image_data['size']/1000;

           if($type!='jpg' && $type!='jpeg' && $type!='png'){
            $response['msg']="seulement le format jpg,jpeg,png images est autorisé";
            $response['status']=false;
            $response['field']='profile_pic';
        }

        if($size>40000){
            $response['msg']="telecharger des images de moins de 40 mb";
            $response['status']=false;
            $response['field']='profile_pic';
        }
       }

        return $response;
    
    }
    

    //function for updating profile

    function updateProfile($data,$imagedata){
        global $db;
        $first_name = mysqli_real_escape_string($db,$data['first_name']);
        $last_name = mysqli_real_escape_string($db,$data['last_name']);
        $username = mysqli_real_escape_string($db,$data['username']);
        $password = mysqli_real_escape_string($db,$data['password']);
        $current_job= mysqli_real_escape_string($db,$data['current_job']);

if(!$data['password']){
$password = $_SESSION['userdata']['password'];
}else{
    $password = md5($password);
    $_SESSION['userdata']['password']=$password;
}

$profile_pic="";
if($imagedata['name']){
    $image_name = time().basename($imagedata['name']);
    $image_dir="../images/profile/$image_name";
    move_uploaded_file($imagedata['tmp_name'],$image_dir);
    $profile_pic=", profile_pic='$image_name'";
}
       
      
    
        $query = "UPDATE users SET first_name = '$first_name', last_name='$last_name',username='$username',password='$password' $profile_pic WHERE id=".$_SESSION['userdata']['id'];
return mysqli_query($db,$query);

    }


    //for validating add post form
function validatePostImage($image_data){
    $response=array();
    $response['status']=true;
      

        if(!$image_data['name']){
            $response['msg']="pas d'image selectionner";
            $response['status']=false;
            $response['field']='post_img';
        }
        
   
    
       if($image_data['name']){
           $image = basename($image_data['name']);
           $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
           $size = $image_data['size']/1000;

           if($type!='jpg' && $type!='jpeg' && $type!='png'){
            $response['msg']="seulement le format jpg,jpeg,png images est autorisé";
            $response['status']=false;
            $response['field']='post_img';
        }

        if($size>40000){
            $response['msg']="moins de 40Mo ";
            $response['status']=false;
            $response['field']='post_img';
        }
       }

        return $response;
    
    }

   // for getting posts
function createPost($text,$image){
    global $db;
    $post_text = mysqli_real_escape_string($db,$text['post_text']);
$user_id = $_SESSION['userdata']['id'];

        $image_name = time().basename($image['name']);
        $image_dir="../images/posts/$image_name";
        move_uploaded_file($image['tmp_name'],$image_dir);
    

    $query = "INSERT INTO posts(user_id,post_text,post_img)";
    $query.="VALUES ($user_id,'$post_text','$image_name')"; 
    return mysqli_query($db,$query);
   }

 

   
?>