<?php

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */

if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='row'><div class='col-xs-8'><div class='dataTables_paginate paging_bootstrap'><ul class='pagination'>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'><a href='#'>First</a></li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive disabled'><a href='#'>First</a></li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'><a href='#'>Previous</a></li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive disabled'><a href='#'>Previous</a></li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'><a href='#'>{$i}</a></li>";
    else
        $msg .= "<li p='$i' class='active'><a href='#'>{$i}</a></li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'><a href='#'>Next</a></li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive disabled'><a href='#'>Next</a></li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'><a href='#'>Last</a></li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive disabled'><a href='#'>Last</a></li>";
}
/*$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go to'/>";*/
$total_string = "<div class='col-xs-4'><div class='dataTables_info' id='example2_info' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></div></div>";
$msg = $msg . "</ul></div></div>" . $goto . $total_string . "</div>";  // Content for pagination
