<?php
function check_date ($date): string
{
    $date_now = date(date('Y-m-d H:i:s'));
    if ($date_now > $date) {
        return 'Closed';
    }else{
        return 'Active';
    }
}
