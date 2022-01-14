<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Core as co;
use \Cmatrix\Kernel\Exception as ex;

class Admin extends CommonLogin {
    public function getData(){
        
        return arrayMergeReplace(parent::getData(),[
            'blocks' => $this->getMyBlocks(),
        ]);
    }
    
    // --- --- --- --- ---
    private function getMyBlocks(){
        return [
            [
                'enable' => true,
                'visible' => co\Sysuser::instance()->isMyGroups('coAdmins','coSupervisors'),
                'code' => 'data',
                'name' => 'Данные (Data managment)',
                'icon' => 'fab fa-elementor',
                'info' => 'Управление данными, учитываемыми системой',
                'url' => CM_WHOME.'/admin/data',
            ],
            [
                'enable' => true,
                'visible' => co\Sysuser::instance()->isMyGroups('coAdmins','coSupervisors'),
                'code' => 'tool',
                'name' => 'Инструменты',
                'icon' => 'fal fa-tools',
                'info' => 'Инструменты, утилиты, отчёты',
                'url' => CM_WHOME.'/admin/tool',
            ],
            [
                'enable' => false,
                'visible' => co\Sysuser::instance()->isMyGroups('coProjects','coSupervisors','coProjects'),
                'code' => 'project',
                'name' => 'Проекты',
                'icon' => 'fal fa-user-friends',
                'info' => 'Управление проектами, группами пользователей с локальнымы чатом и заданиями',
                'url' => CM_WHOME.'/admin/messages',
            ],
            [
                'enable' => false,
                'visible' => true,
                'code' => 'task',
                'name' => 'Задания',
                'icon' => 'fal fa-tasks',
                'info' => 'Управление заданиями',
                'url' => CM_WHOME.'/admin/tasks',
            ],
            [
                'enable' => false,
                'visible' => true,
                'code' => 'message',
                'name' => 'Сообщения',
                'icon' => 'fal fa-comments',
                'info' => 'Управление чатами и сообщениями',
                'url' => CM_WHOME.'/admin/messages',
            ],
            [
                'enable' => false,
                'visible' => true,
                'code' => 'table',
                'name' => 'Мои таблицы',
                'icon' => 'fal fa-table',
                'info' => 'Пользовательские таблицы',
                'url' => CM_WHOME.'/admin/tables',
            ],
            [
                'enable' => false,
                'visible' => true,
                'code' => 'file',
                'name' => 'Мои файлы',
                'icon' => 'fal fa-copy',
                'info' => 'Управление файлами',
                'url' => CM_WHOME.'/admin/files',
            ],
            [
                'enable' => false,
                'visible' => co\Sysuser::instance()->isMyGroups('coAdmins','coSupervisors'),
                'code' => 'sysuser',
                'name' => 'Пользователи',
                'icon' => 'fal fa-user',
                'info' => 'Управление пользователями и группами',
                'url' => CM_WHOME.'/admin/data',
            ],
            [
                'enable' => false,
                'visible' => co\Sysuser::instance()->isMyGroups('coAdmins','coSupervisors'),
                'code' => 'sysrole',
                'name' => 'Роли пользователей',
                'icon' => 'fal fa-user-tag',
                'info' => 'Управление ролями пользователей',
                'url' => CM_WHOME.'/admin/data',
            ],
            [
                'enable' => true,
                'visible' => true,
                'code' => 'module',
                'name' => 'Модули',
                'icon' => 'fal fa-object-ungroup',
                'info' => 'Управление модулями системы',
                'url' => CM_WHOME.'/admin/modules',
            ],
            [
                'enable' => false,
                'visible' => true,
                'code' => 'setup',
                'name' => 'Настройки',
                'icon' => 'fal fa-cogs',
                'info' => 'Пользовательские настройки системы',
                'url' => CM_WHOME.'/admin/setup',
            ],
            /*[
                'code' => 'setup',
                'name' => 'Настройки',
                'icon' => 'fas fa-cogs',
                'info' => 'Пользовательские настройки системы',
                'url' => CM_WHOME.'/admin/setup',
            ],
            [
                'code' => 'setup',
                'name' => 'Настройки',
                'icon' => 'fas fa-cogs',
                'info' => 'Пользовательские настройки системы',
                'url' => CM_WHOME.'/admin/setup',
            ],
            [
                'code' => 'setup',
                'name' => 'Настройки',
                'icon' => 'fas fa-cogs',
                'info' => 'цуйцуйцуйцу йцуйцу йцжд ойцой    лоцудуццрукро цоукрлцуркуц клдоцу лоуцклрцуркуцр лоцу клрцлку rthrthrh rthrthreherherhth rerth rth h',
                'url' => CM_WHOME.'/admin/setup',
            ]*/
        ];
    }
}
?>