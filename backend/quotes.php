    
    
    
    <div id="post">
        <div>
            
            <img src="<?php echo $user_info['profile_image'] ?>" style="width: 50px; margin-right: 4px;">
        </div>
        <div>
            <div style="font-weight:bold;color: #6633CC;"><?php echo $user_info['username'] ?></div>
            <?php echo $ROW['quote'] ?>    
            
            <br/><br/>
            <a href="like.php?type=quote&id=<?php echo $ROW['quote_id'] ?>">Like(<?php echo $ROW['likes'] ?>)</a>  
            <span style="color :#999;">
                <?php echo $ROW['date'] ?>
            </span>
        </div>
                        
    </div>