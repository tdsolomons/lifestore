<?php header("Content-type: text/css; charset: UTF-8"); ?>


.rate_widget {
    border:     1px solid #CCC;
    overflow:   visible;
    padding:    10px;
    width:      180px;
    height:     32px;
}
.ratings_stars {
    background: url('<?php echo asset_url(); ?>img/star_empty.png') no-repeat;
    float:      left;
    height:     28px;
    padding:    2px;
    width:      32px;
}
.ratings_vote {
    background: url('<?php echo asset_url(); ?>img/star_full.png') no-repeat;
}
.ratings_over {
    background: url('<?php echo asset_url(); ?>img/star_highlight.png') no-repeat;
}

.total_votes {
    background: #eaeaea;
    top: 58px;
    left: 0;
    padding: 5px;
    
} 
.movie_choice {
    font: 10px verdana, sans-serif;
    margin: 0 auto 40px auto;
    width: 180px;
}