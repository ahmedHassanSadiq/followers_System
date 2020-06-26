<?php

require_once '../app/init.php';

$id = $_SESSION["user"]["id"];
$posts = $index->showFollowerdPosts($id,$id);
if(isset($posts)) {
    foreach ($posts as $post) {
    $user_det = $index->getUserDetails($post["user_id"]);
    $postDate = date('l jS \of F Y h:i:s A',$post["post_date"]);
    echo '                <div class="post_">
                            <div class="image_"><img src="libs/photos/'.$user_det["profile_image"].'" style="width:100%;height:100%;"></div>
                            <div class="post_detail_">
                                <h5>@'.$user_det["username"].' <p style="font-size:15px;color:#CCC"> at '.$postDate.'</p></h5>
                                <p>'.$post["post_content"].'</p>
                            </div>
                          </div>';
}
}else{
    echo "لا توجد منشورات";
}
