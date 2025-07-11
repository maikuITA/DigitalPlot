<?php
// retrieves the object Smarty
$smarty = StartSmarty::configuration();

// Configure Smarty paths in order to clear the cache and compiled templates
// This is where cached output goes (if enabled)

// --- CLEARING THE CACHE ---

// Option 1: Clear all compiled templates and all cache files
// This is the most common and comprehensive way to clear everything.
$smarty->clearCompiledTemplate();

// Option 2: Clear cache for a specific template (if you use caching)
// $smarty->clearCache('home.tpl'); // Clears cache for home.tpl

// Option 3: Clear compiled template for a specific template
// $smarty->clearCompiledTemplate('home.tpl'); // Clears only the compiled version of home.tpl

ULogSys::toLog("Smarty cache and compiled templates cleared successfully!");
