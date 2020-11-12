<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 10/07/2020
 * Time: 10:43 AM
 */

namespace App\Http\Services;


class ConfigurationServices
{
    public function initConfig()
    {
        switch ($_SESSION['role'])
        {
            case 'admin':
                return $config['sidebar'] = [
                    ['sidebar' => 'dashboard', 'label' => '<i class="fas fa-home" id="sidebar-icon"></i> Home', 'link' => '/dashboard'],
                    ['sidebar' => 'inventory', 'label' => '<i class="fas fa-users" id="sidebar-icon"></i> Inventory', 'link' => '/inventory/equipments'],
                    ['sidebar' => 'storage', 'label' => '<i class="fas fa-address-card" id="sidebar-icon"></i> Deliveries', 'link' => '/deliveries'],
                    ['sidebar' => 'library', 'label' => '<i class="fas fa-book" id="sidebar-icon"></i>  Library', 'link' => '/library'],
                    ['sidebar' => 'transactions', 'label' => '<i class="fas fa-handshake" id="sidebar-icon"></i> Requests', 'link' => '/transactions'],
                    ['sidebar' => 'twg', 'label' => '<i class="fas fa-edit" id="sidebar-icon"></i> TWG', 'link' => '/twg/members']
                ];
                break;
        }
    }
}
