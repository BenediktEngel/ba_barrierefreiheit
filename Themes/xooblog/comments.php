<div class="comments-wrap">
    <div id="comments" >
        <div class="col-full">
                
                <!-- Fehler aus Prüfschritt 1.3.1a durch hinzufügen einer H2-Überschrift für Screen-Reader behoben -->
                <h2 class="screen-reader-text">Comments</h2>

                <?php

                // $xooblog_comment_num = get_comments_number();
                // if ($xooblog_comment_num <= 1) {
                //     echo esc_html($xooblog_comment_num) . __(' Comment', 'xooblog');
                // } else {
                //     echo esc_html($xooblog_comment_num) . __(' Comments', 'xooblog');
                // }
                ?>
            <!-- commentlist -->
            <ol class="xooblog_commentlist">
                <?php
                wp_list_comments();
                ?>

            </ol> <!-- end commentlist -->

            <div class="comments-pagination">
                <?php
                the_comments_pagination(array(
                    'screen_reader_text' => __('Comments navigation', 'xooblog'),
                ))
                ?>
            </div>
            <!-- respond
                    ================================================== -->
            <div class="respond">

                <!-- <h3 class="h2"><?php// _e('Add Comment', 'xooblog'); ?></h3> -->
                <?php
                    comment_form();
                ?>
            </div> <!-- end respond -->

        </div> <!-- end col-full -->

    </div> <!-- end row comments -->
</div> <!-- end comments-wrap -->