<?php
    session_start();
    ob_start();
?>

    <div class="product">
        <div class="main-nav">
            <?php
                // Save PDO objects as arrays using fetchAll()
                $user = $users->fetchAll();
                $comment = $comments->fetchAll();
                $like = $likes->fetchAll();
                $pictures = $gallery->fetchAll();

                $likes_nb = 0;

                for ($i = 0; $pictures[$i]; $i++)
                {
                    if ($pictures[$i]['picture_id'] == $picture_id)
                    {
                        $img = $pictures[$i]['content'];
                        $picture_was_taken_by = $pictures[$i]['user_id'];
                    }
                }
                for ($i = 0; $user[$i]; $i++)
                {
                    if ($picture_was_taken_by == $user[$i]['user_id'])
                    {
                        $picture_author = $user[$i]['user_name'];
                    }   
                    if ($user[$i]['user_name'] == $_SESSION['loggued_on_user'])
                    {
                        $loggued_user_id = $user[$i]['user_id'];
                    }
                }
                for ($i = 0; $like[$i]; $i++)
                {
                    if ($like[$i]['picture_id'] == $picture_id)
                    {
                        $likes_nb++;
                    }
                    if ($like[$i]['picture_id'] == $picture_id && $like[$i]['user_id'] == $loggued_user_id)
                    {
                        $user_has_liked = 1;
                    }
                }
            ?>
            <div id='full_product'>
                <div id='single_product'>
                    <?php
                        echo '<img class="gallery_picture" src="pictures/snaps/'.$img.'"/>';
                    ?>
                </div>
            </div>
            <?php
                if ($_SESSION['loggued_on_user'] != '')
                {
            ?>
            <form action="index.php?action=addComment&picture_id=<?= $picture_id ?>&user_id=<?= $loggued_user_id ?>" method="post">
                <div>
                    <label for="comment">Comment</label><br />
                    <textarea id="comment" name="comment"></textarea>
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>
            <?php
                }
            ?>
            <?php
                for ($i = 0; $comment[$i]; $i++)
                {
                    if ($comment[$i]['picture_id'] == $picture_id)
                    {
            ?>
            <div id='full_product'>
                <div id='single_product'>
                    <p><strong><?= htmlspecialchars($picture_author) ?></strong> le <?= $comment[$i]['comment_date_fr'] ?>
                    <?php
                        if($comment[$i]['user_id'] == $loggued_user_id)
                        {
                    ?>
                            <p><a href="index.php?view=updateCommentView&comment_id=<?= $comment[$i]['id'] ?>&picture_id=<?= $picture_id ?>">(Edit)</a></p>
                            <p><a href="index.php?action=deleteComment&comment_id=<?= $comment[$i]['id'] ?>&picture_id=<?= $picture_id ?>">(Delete)</a></p>
                    <?php
                        }
                    ?>
                    <p><?= nl2br(htmlspecialchars($comment[$i]['comment'])) ?></p>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            </div>
                <?php
                    echo '<p> '.$likes_nb.' likes</p>';
                    if($picture_was_taken_by == $loggued_user_id)
                    {
                        echo '<p> <a href="index.php?action=deletePicture&id='.$picture_id.' ">(Delete picture) </a> </p>';
                    }
                    if ($user_has_liked == 1)
                    {
                        echo '<p><a href="index.php?action=unlike&picture_id='.$picture_id.'&user_id='.$loggued_user_id.'">(Unlike)</a></p>';
                    }
                    else if ($loggued_user_id)
                    {
                        echo '<p><a href="index.php?action=like&picture_id='.$picture_id.'&user_id='.$loggued_user_id.'">(Like)</a></p>';
                    }
                ?>
            <div>
        </div>
    </div>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>