<?php


function find_contact_by_id($contact_id, $mysqli) {

    $safe_contact_id = mysqli_real_escape_string($mysqli, $contact_id);

    $query = "SELECT * FROM `contact_data` WHERE id = {$safe_contact_id}";

    $contact_set = mysqli_query($mysqli, $query);
    if($contact = mysqli_fetch_assoc($contact_set)) {
        return $contact;
    } else {
        return null;
    }
}

