<?php
declare(strict_types=1);

namespace Matt9mg\Concrete5\Symfony\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SitemapType extends AbstractType
{
    public const SITEMAP_TYPE_SELECT_PAGE = 'SELECT_PAGE';
    public const SITEMAP_TYPE_QUICK_SELECT = 'QUICK_SELECT';
    public const SITEMAP_TYPE_MULTIPLE_FROM_SITEMAP = 'MULTIPLE_SITEMAP';
    public const SITEMAP_TYPE_SELECT_FROM_SITEMAP = 'SELECT_FROM_SITEMAP';

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'compound' => false,
            'selector_type' => self::SITEMAP_TYPE_SELECT_PAGE,
        ]);

        $resolver->setAllowedValues('selector_type', [
            self::SITEMAP_TYPE_SELECT_PAGE,
            self::SITEMAP_TYPE_QUICK_SELECT,
            self::SITEMAP_TYPE_MULTIPLE_FROM_SITEMAP,
            self::SITEMAP_TYPE_SELECT_FROM_SITEMAP
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['selector_type'] = $options['selector_type'];

        parent::buildView($view, $form, $options);
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sitemap';
    }
}
