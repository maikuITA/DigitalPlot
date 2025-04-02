<?php

namespace Controller;

use View\VProdotti;

class CProdotti {

    public function display(): void {
        // Debug error_log("### SONO IN CHome ###");
        VProdotti::display();
    }

}

?>