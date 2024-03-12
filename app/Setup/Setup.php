<?php

namespace App\Setup;

include 'Environment/Common.php';
include 'Environment/Development.php';
include 'Environment/Init.php';

use App\Setup\Environment\Common;
use App\Setup\Environment\Init;
use App\Setup\Environment\Development;

class Setup
{
    public function __construct()
    {
        $this->env_setup = ENV;
        $this->env = null;
        $this->common = null;
    }

    public function init()
    {
        $this->checkACFExists();
        $this->runCommonSettings();
        $this->setEnvironment();
    }

    private function checkACFExists()
    {
        if (!class_exists('acf')) {
            add_action('admin_notices', function () {
                global $tp_acf_notice_msg;
                $msg = 'Ta strona do prawidłowego działania wymaga zainstalowanej i aktywowanej wtyczki Advanced Custom Fields PRO';
                $tp_acf_notice_msg = __($msg, THEME_SLUG);
                echo '<div class="notice notice-error"><div class="notice-title">' . $tp_acf_notice_msg . '</div></div>';
            });
            return false;
        } else {
            return true;
        }
    }

    private function runCommonSettings()
    {
        $this->common = new Common();
        $this->common->init();
    }

    private function setEnvironment()
    {
        switch ($this->env_setup) {
            case 'development':
                $this->env = new Development();
                break;
            case 'init':
                $this->env = new Init();
                break;
            case 'production':
                break;
            default:
                return false;
        }

        if ($this->env) {
            $this->env->init();
        }
        return true;
    }
}

$theme_setup = new Setup();
$theme_setup->init();
