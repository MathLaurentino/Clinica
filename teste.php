<?php

capitalLetter("matheus laurentinO");

function capitalLetter($name)
{

    $name = ucwords(strtolower($name));
    echo $name;
}