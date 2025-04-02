<?php

namespace Controller;

use View\VAreaUtente;

class CAreaUtente {

    public function showAreaUtente(): void {
        VAreaUtente::display();
    }

}

?>