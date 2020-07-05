<?php

namespace Matt9mg\Concrete5\Symfony\Form;

use Symfony\Contracts\Translation\TranslatorTrait;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Translation\TranslatorBagInterface as LegacyTranslatorInterface;

/**
 * Class TranslatorHelper
 * @package Matt9mg\Concrete5\Symfony\Form
 */
class TranslatorHelper extends Helper
{
    use TranslatorTrait {
        getLocale as private;
        setLocale as private;
        trans as private doTrans;
    }

    protected $translator;

    /**
     * @param TranslatorInterface|null $translator
     */
    public function __construct($translator = null)
    {
        if (null !== $translator && !$translator instanceof LegacyTranslatorInterface && !$translator instanceof TranslatorInterface) {
            throw new \TypeError(sprintf('Argument 1 passed to "%s()" must be an instance of "%s", "%s" given.', __METHOD__, TranslatorInterface::class, \is_object($translator) ? \get_class($translator) : \gettype($translator)));
        }
        $this->translator = $translator;
    }

    /**
     * @see TranslatorInterface::trans()
     */
    public function trans($id, array $parameters = [], $domain = 'messages', $locale = null)
    {
        if (null === $this->translator) {
            return $this->doTrans($id, $parameters, $domain, $locale);
        }

        return $this->translator->trans($id, $parameters, $domain, $locale);
    }

    /**
     * @see TranslatorInterface::transChoice()
     * @deprecated since Symfony 4.2, use the trans() method instead with a %count% parameter
     */
    public function transChoice($id, $number, array $parameters = [], $domain = 'messages', $locale = null)
    {
        if (null === $this->translator) {
            return $this->doTrans($id, ['%count%' => $number] + $parameters, $domain, $locale);
        }
        if ($this->translator instanceof TranslatorInterface) {
            return $this->translator->trans($id, ['%count%' => $number] + $parameters, $domain, $locale);
        }

        return $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'translator';
    }
}
