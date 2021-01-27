<div class="col-lg-4 col-md-12 ">
    <!-- Fehler in Prüfschritt 1.3.1a durch hinzufügen einer Überschrift für Screen-Reader behoben. -->
    <h2 class="screen-reader-text">Sidebar</h2>
    <!-- sidebar Here -->
    <div class="tecxoo-sidebar sidebar ">
        <?php

        if (is_active_sidebar('sidebar-1')) :
            dynamic_sidebar('sidebar-1');
        endif;
        ?>
    </div>
    <!-- sidebar Here -->
</div>