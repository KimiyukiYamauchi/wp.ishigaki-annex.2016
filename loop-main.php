<?php
switch_to_blog(1); // ホテル技評リゾートに切り替える
$args = array(
    'posts_per_page' => 5, // 表示件数を指定
);
$the_query = new WP_Query($args);
if($the_query->have_posts()) :
    while($the_query->have_posts()) : $the_query->the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('news'); ?>>
    <div class="text">
        <div class="entryInfo">
            <div class="categories">
                <?php the_category(); ?>
            </div>
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日(l)'); ?></time>
        </div>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php the_excerpt(); ?>
        <p>[<a href="<?php the_permalink(); ?>">続きを読む</a>]</p>
    </div>
    <figure>
    <?php if(has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?>
    <?php else : ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/common/noimage_180x180.png" height="180" width="180" alt=""></a>
    <?php endif; ?>
    </figure>
</article><!-- /.news -->

<?php
    endwhile;
else : // 記事がなかった場合
?>
    <?php if(is_search()) : // 検索ページの場合 ?>
        <p>検索結果はありませんでした</p>
    <?php else : // 以外のページの場合 ?>
        <p>記事はありません。</p>
    <?php endif; ?>
<?php
endif;
restore_current_blog(); // 元のブログに戻す
?>

<?php
if(function_exists('wp_pagenavi')){
    wp_pagenavi(array('query' => $the_query));
}
?>