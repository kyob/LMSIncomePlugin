<?php

/**
 * IncomeHandler
 *
 */
class IncomeHandler
{

    public function menuIncome(array $hook_data = array())
    {
        $income_submenus = array(
            array(
                'name' => trans('Income'),
                'link' => '?m=income',
                'tip' => trans('Income'),
                'prio' => 140,
            ),
        );
        $hook_data['finances']['submenu'] = array_merge($hook_data['finances']['submenu'], $income_submenus);
        return $hook_data;
    }

    public function smartyIncome(Smarty $hook_data)
    {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSIncomePlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        array_unshift($template_dirs, $plugin_templates);
        $hook_data->setTemplateDir($template_dirs);
        return $hook_data;
    }

    public function modulesDirIncome(array $hook_data = array())
    {
        $plugin_modules = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSIncomePlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'modules';
        array_unshift($hook_data, $plugin_modules);
        return $hook_data;
    }


}
