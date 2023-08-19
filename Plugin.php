<?php
/**
 * Typecho 站点维护插件
 *
 * @package SiteMaintenance
 * @author Fence
 * @version 1.0.0
 * @link https://github.com/lengyandong
 */

class SiteMaintenance_Plugin implements Typecho_Plugin_Interface
{
    //激活插件方法，添加设置项
    public static function activate()
    {
        //注册启用插件的回调方法
        Typecho_Plugin::factory('Widget_Archive')->beforeRender = array('SiteMaintenance_Plugin', 'checkMaintenanceMode');
    }

    //禁用插件方法，删除设置项
    public static function deactivate()
    {
        return "SiteMaintenance 插件禁用成功！";
    }

    //初始化方法，检查是否启用了站点维护模式
    public static function checkMaintenanceMode()
    {
        $options = Helper::options();

        // 检查是否启用了站点维护模式
        if ($options->plugin('SiteMaintenance')->maintenanceMode) {
            //可以在下方编写维护模式下的处理逻辑，例如显示自定义维护页面或跳转到其他页面
            echo "网站正在维护中，请稍后再访问。";
            exit;
        }
    }

    //插件配置方法
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $maintenanceMode = new Typecho_Widget_Helper_Form_Element_Radio(
            'maintenanceMode',
            array('0' => '关闭', '1' => '开启'),
            '0',
            _t('站点维护模式'),
            _t('是否启用站点维护模式')
        );
        $form->addInput($maintenanceMode);
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }
}