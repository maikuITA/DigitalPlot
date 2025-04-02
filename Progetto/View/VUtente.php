<?php

use Start\StartSmarty;

class VUtente {
    private $smarty;

    public function __construct() {
		$this->smarty = StartSmarty::configuration();
	}

    public function mostraHome() {
        $this->smarty->assign('saluto', 'SI CAZZO FUNZIONA! Lino gay');
        $this->smarty->assign('giorno', date('l'));
        $this->smarty->display('home.tpl');
    }
}

?>