<?php

function generateTicketNumber($id)
{
    $ticket_no = 'TN' . sprintf("%'.09d", time() . rand(0, 10));
    if (strlen($id) <= 5)
        $ticket_no = 'TN' . sprintf("%'.05d", $id);
    else if (strlen($id) > 5)
        $ticket_no = 'TN' . sprintf("%'.08d", $id);
    return $ticket_no;
}

?>