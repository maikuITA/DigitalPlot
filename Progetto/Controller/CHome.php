<?php

namespace Controller;

use View\VHome;

class CHome {

    public function display(): void {
        // Debug error_log("### SONO IN CHome ###");
        VHome::display();
    }

}

?>