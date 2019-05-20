<?php
    session_start();
    ob_start();
?>

        <div class="main_nav">
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
                $date = strstr($img, ':');
                $date = substr($date, 1);
                $date = strtok($date, '.');
                date_default_timezone_set('Europe/Paris');
            ?>

            <div class="picture_view">
            
                <?php
                    echo '<img class="single-picture" src="pictures/snaps/'.$img.'"/>';
                ?>

                <p><strong>by </strong><?= $picture_author ?></p>
                <p><strong>on </strong><?= date('m/d/Y H:i:s', $date) ?></p>

                <?php
                    if($picture_was_taken_by == $loggued_user_id)
                    {
                        echo '<p> <a href="index.php?action=deletePicture&id='.$picture_id.'" onclick="return confirm(\'Do you really want to delete that picture?\')"> (Delete picture) </a> </p>';
                    }

                    if ($likes_nb < 2)
                    {
                        echo '<p> '.$likes_nb.' like</p>';
                    } else {
                        echo '<p> '.$likes_nb.' likes</p>';
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
            </div>
       
            <?php
                if ($_SESSION['loggued_on_user'] != '')
                {
            ?>
            <div class="comment_view">
                <form class="add_comment_form" action="index.php?action=addComment&picture_id=<?= $picture_id ?>&user_id=<?= $loggued_user_id ?>" method="post">
                    <div class="add_comment">
                        <label for="comment">Add a comment</label><br />
                        <textarea class="comment_area" name="comment"></textarea><br />
                        <input type="submit" />
                    </div>
                </form>
                <br>
                <?php
                    }
                    for ($i = 0; $comment[$i]; $i++)
                    {
                        if ($comment[$i]['picture_id'] == $picture_id)
                        {
                            $j++;
                        }
                    }
                    if ($j > 0)
                    {
                ?>
        
                <section class="comments_section">
                    <?php
                        for ($i = 0; $comment[$i]; $i++)
                        {
                            $i++;
                        }
                        while ($i-- > 0)
                        {
                            if ($comment[$i]['picture_id'] == $picture_id)
                            {
                    ?>
                    
                        <div class='single_comment' style="overflow: hidden">
                            <p><strong><?= htmlspecialchars($picture_author) ?></strong> on <?= $comment[$i]['comment_date_fr'] ?>
                            <p><?= nl2br(htmlspecialchars($comment[$i]['comment'])) ?></p>
                            <?php
                                if($comment[$i]['user_id'] == $loggued_user_id)
                                {
                            ?>
                                    <p><a href="index.php?view=updateCommentView&comment_id=<?= $comment[$i]['id'] ?>&picture_id=<?= $picture_id ?>">(Edit)</a></p>
                                    <p><a href="index.php?action=deleteComment&comment_id=<?= $comment[$i]['id'] ?>&picture_id=<?= $picture_id ?>" onclick="return confirm('Do you really want to remove your comment?')">(Delete)</a></p>
                            <?php
                                }
                            ?>
                            
                        </div>
                        <hr>
            
                    <?php
                            }
                        }
                    ?>
                </section>
                <?php
                    }
                    else {
                        echo '<p> No comment yet </p>';
                    }
                ?>
            </div>

        </div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>