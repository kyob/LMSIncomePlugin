<?php

/**
 * LMSIncomeSummaryPlugin
 * 
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class LMSIncomeSummaryPlugin extends LMSPlugin
{
    const PLUGIN_NAME = 'LMS Income Summary Plugin';
    const PLUGIN_DESCRIPTION = 'Show income per days in month and per months per year.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'LMSIncomeSummaryPlugin';

    public function registerHandlers()
    {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'IncomeSummaryHandler',
                'method' => 'menuIncomeSummary'
            ),
            'smarty_initialized' => array(
                'class' => 'IncomeSummaryHandler',
                'method' => 'smartyIncomeSummary'
            ),
            'modules_dir_initialized' => array(
                'class' => 'IncomeSummaryHandler',
                'method' => 'modulesDirIncomeSummary'
            ),
        );
    }
}
