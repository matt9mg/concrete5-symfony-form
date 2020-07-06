<?php

namespace Matt9mg\Concrete5\Symfony\Form;

use Symfony\Component\Templating\Helper\Helper;
use Concrete\Core\Localization\Translator\TranslatorAdapterInterface;

/**
 * Class TranslatorHelper
 * @package Matt9mg\Concrete5\Symfony\Form
 */
class TranslatorHelper extends Helper
{
    /**
     * @var TranslatorAdapterInterface
     */
    protected $translator;

    /**
     * @param TranslatorAdapterInterface|null $translator
     */
    public function __construct(TranslatorAdapterInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @see TranslatorInterface::trans()
     */
    public function trans($id, array $parameters = [], $domain = 'messages', $locale = null): string
    {
        return $this->translator->translate($id);
    }

    /**
     * @see TranslatorInterface::transChoice()
     * @deprecated since Symfony 4.2, use the trans() method instead with a %count% parameter
     */
    public function transChoice($id, $number, array $parameters = [], $domain = 'messages', $locale = null): string
    {
        return t($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'translator';
    }
}
