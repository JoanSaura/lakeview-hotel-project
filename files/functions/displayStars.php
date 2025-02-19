<?php
function displayStars($rating) {
    $html = '';
    $rating = max(1, min(5, intval($rating)));
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $html .= '<i class="fa fa-star gold"></i>';
        } else {
            $html .= '<i class="fa fa-star-o"></i>';
        }
    }
    return $html;
}

?>