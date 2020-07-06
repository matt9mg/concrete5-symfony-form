<?php

use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Support\Facade\Application;
use Matt9mg\Concrete5\Symfony\Form\FileManagerType;

/**
 * @var FileManager $fm
 */
$fm = Application::getFacadeApplication()->make(FileManager::class);

switch ($file_manager_type) {
    case FileManagerType::FILE_MANAGER_TYPE_APP:
        echo $fm->app($view->escape($id), $view->escape($full_name), $choose_text, $value, $file_manager_args);
        break;

    case FileManagerType::FILE_MANAGER_TYPE_AUDIO:
        echo $fm->audio($view->escape($id), $view->escape($full_name), $choose_text, $value, $file_manager_args);
        break;

    case FileManagerType::FILE_MANAGER_TYPE_DOC:
        echo $fm->doc($view->escape($id), $view->escape($full_name), $choose_text, $value, $file_manager_args);
        break;

    case FileManagerType::FILE_MANAGER_TYPE_FILE:
        echo $fm->file($view->escape($id), $view->escape($full_name), $choose_text, $value, $file_manager_args);
        break;

    case FileManagerType::FILE_MANAGER_TYPE_IMAGE:
        echo $fm->image($view->escape($id), $view->escape($full_name), $choose_text, $value, $file_manager_args);
        break;

    case FileManagerType::FILE_MANAGER_TYPE_TEXT:
        echo $fm->text($view->escape($id), $view->escape($full_name), $choose_text, $value, $file_manager_args);
        break;

    case FileManagerType::FILE_MANAGER_TYPE_VIDEO:
        echo $fm->video($view->escape($id), $view->escape($full_name), $choose_text, $value, $file_manager_args);
        break;
}







