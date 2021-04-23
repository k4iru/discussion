<?php
function format_date($date)
{
    $today = new DateTime();
    $diff = $today->diff($date);
    if ($diff->days == 0) {
        return "Today at " . date_format($date, 'g:iA');
    } else if ($diff->days == 1) {
        return 'Yesterday at ' . date_format($date, '\a\t g:iA');
    } else if ($diff->days < 6 && $diff->y == 0) {
        return date_format($date, 'D \a\t g:iA');
    } else {
        return date_format($date, 'M m,Y');
    }
}