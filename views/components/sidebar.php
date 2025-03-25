<?php
function render($links) {
    echo '<nav class="col-md-3 col-lg-2 sidebar">
            <ul class="list-group">';
    foreach ($links as $link) {
        echo '<li class="list-group-item">
                <a href="#" id="' . $link['id'] . '" class="text-decoration-none option" data-page="' . $link['href'] . '">' . $link['label'] . '</a>
              </li><br>';
    }
    echo '</ul></nav>';
}
?>
