<h2><?php echo $title ?></h2>

<?php foreach ($search as $news_item): ?>

        <h3><?php echo $news_item['title'] ?></h3>
        <div class="main">
                <?php echo $news_item['description'] ?>
        </div>
        <p><a href="news/<?php echo $news_item['price'] ?>">View more</a></p>

<?php endforeach ?>