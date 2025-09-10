<?php
// File PHP con conflitti
function test() {
    echo "Hello";
    echo " - BRANCH version";
    return "BRANCH";
}

function newFunction() {
    return "Added in branch";
}
