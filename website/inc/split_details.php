<?php
    if (isset($details)) {
        $details = preg_split('/,(?=[^,]*?=)/', $details);

        $split_details = [];
        foreach ($details as $detail) {
            $split_detail = preg_split("/=/", $detail, 2);
            if (isset($split_detail[0]) && isset($split_detail[1])) {
                $split_details[$split_detail[0]] = $split_detail[1];
            }
        }
    }
?>