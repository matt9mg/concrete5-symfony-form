<?php

use Matt9mg\Concrete5\Symfony\Form\SitemapType;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Page\Page;

/**
 * @var PageSelector $ps
 */
$ps = Application::getFacadeApplication()->make(PageSelector::class);



if (\is_array($value)) {
    $pageId = [];

    foreach ($value as $v) {
        $pageId[] = $value instanceof Page && !$value->error ? $value->getCollectionID() : $value;
    }
} else {
    $pageId = $value instanceof Page && !$value->error ? $value->getCollectionID() : $value;
}

switch ($selector_type) {
    case SitemapType::SITEMAP_TYPE_QUICK_SELECT:
        echo $ps->quickSelect($view->escape($full_name), $pageId, $selector_type_args);
        break;

    case SitemapType::SITEMAP_TYPE_SELECT_FROM_SITEMAP:
        echo $ps->selectFromSitemap($view->escape($full_name), $pageId, $selector_type_starting_point, $selector_type_args);
        break;

    case SitemapType::SITEMAP_TYPE_MULTIPLE_FROM_SITEMAP:
        echo $ps->selectMultipleFromSitemap($view->escape($full_name), $pageId, $selector_type_starting_point, $selector_type_args);
        break;

    default:
        echo $ps->selectPage($view->escape($full_name), $pageId);
}
