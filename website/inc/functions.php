<?php
    function Clamp($value, $min, $max) {
        return min($max, max($min, $value));
    }
?>