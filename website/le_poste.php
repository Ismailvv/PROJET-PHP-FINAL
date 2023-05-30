

<div <?php echo 'id="post'.$post_id.'" ';?> class="post_container">
    <div class="post_header">
        <div class="post_title">
    <?php echo $ligne_poste_bdd['username'].': '.$ligne_poste_bdd['title'];?>
</div> 
<?php 
    $tag_list=get_tags_list($con, $post_id);
    echo '<div>'.$tag_list.'</div>';
?>
    <div class="post_control">
            <?php 
                if ($is_admin||$ligne_poste_bdd['username']==$logged_user) //Ca permet de verifier si le username du post est le meme que celui connecte
                {     
                echo '<img class="post_control_icon" src="./image/hashtag.png" onClick="editer_hashtag('.$post_id.')">';
                echo '<img class="post_control_icon" src="./image/edit.png" onClick="modifier('.$post_id.')">';
                echo '<img class="post_control_icon" src="./image/delete.png" onClick="supprimer('.$post_id.')">';
                }
            ?>

        </div>
    </div>
    <div class="post_body">
        <?php echo $ligne_poste_bdd['body'];?>
    </div>
    <div class="post_footer">
    <?php
    include 'liste_commentaires.php';
    echo '<form action="ajouter_commentaire.php" method="post">';
    echo '<input class="comment_input" type="text" name="comment">';
    echo '<input type="hidden" name="post_id" value="'.$post_id.'">';
    echo '<input class="comment_button" type="submit" value="Ajouter commentaire"/>';
    echo "</form>";
    ?>
    </div>
</div>
