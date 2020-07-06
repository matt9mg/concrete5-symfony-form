<?php

use Matt9mg\Concrete5\Symfony\Form\SitemapType;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Form\Service\Widget\PageSelector;

/**
 * @var PageSelector $ps
 */
$ps = Application::getFacadeApplication()->make(PageSelector::class);

switch ($selector_type) {
    case SitemapType::SITEMAP_TYPE_QUICK_SELECT:
        echo $ps->quickSelect($view->escape($full_name), is_object($value) && !$value->error ? $value->getCollectionID() : null);
        break;

    case SitemapType::SITEMAP_TYPE_SELECT_FROM_SITEMAP:
        echo $ps->selectFromSitemap($view->escape($full_name), is_object($value) && !$value->error ? $value->getCollectionID() : null);
        break;

    case SitemapType::SITEMAP_TYPE_MULTIPLE_FROM_SITEMAP:
        echo $ps->selectMultipleFromSitemap($view->escape($full_name), is_object($value) && !$value->error ? $value->getCollectionID() : null);
        break;

    default:
        echo $ps->selectPage($view->escape($full_name), is_object($value) && !$value->error ? $value->getCollectionID() : null);
}
