<?php
// File PHP con conflitti
function test() {
    echo "Hello";
<<<<<<< HEAD
    echo " - HEAD version";
    return "HEAD";
=======
    echo " - MERGE version";
    return "MERGE";
>>>>>>> feature-branch
}
