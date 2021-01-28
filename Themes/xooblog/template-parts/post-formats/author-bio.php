<!-- Fehler aus Prüfschritt 1.3.1a behoben H4 wird nun, falls Inhalt folgt als H2 ausgegebn ansonsten nur als Link. Zusätzlich Screen-Reader-Text zum besseren Verständnis hinzugefügt. -->
<div class="xooblog_author">
    <?php echo  get_avatar(get_the_author_meta('ID')); ?>
    <div class="xooblog_author__content"> 
    <?php 
    if(get_the_author_meta('description') == ""){
              echo "<div class='xooblog_author__name'><a href='". esc_url(get_author_posts_url(get_the_author_meta('ID'))) ."'><span class='screen-reader-text'>Written by Author </span>".get_the_author_meta('display_name')."</a></div>";
            } 
            else{
            echo "<h2 class='xooblog_author__name'><a href='". esc_url(get_author_posts_url(get_the_author_meta('ID'))) ."'><span class='screen-reader-text'>About the Author </span>".get_the_author_meta('display_name')."</a></h2><p>". get_the_author_meta('description') ."</p>";
              }
      ?>
    </div>
</div>