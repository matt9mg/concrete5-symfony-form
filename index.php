<?php

require_once __DIR__ . '/vendor/autoload.php';

use Matt9mg\Concrete5\Symfony\Form\FileSystemLoader;
use Matt9mg\Concrete5\Symfony\Form\FormHelper;
use Matt9mg\Concrete5\Symfony\Form\TemplateNameParser;
use Matt9mg\Concrete5\Symfony\Form\TranslatorHelper;

require_once __DIR__ .'/Test.php';

use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Templating\TemplatingRendererEngine;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Templating\PhpEngine;


$loader = new FilesystemLoader(array());
$engine = new PhpEngine(new TemplateNameParser(), $loader);


$tre = new TemplatingRendererEngine($engine, array(
    __DIR__ . '/src/Resources/views/Form'
));
$renderer = new FormRenderer($tre);

$formHelper = new FormHelper($renderer);
$translator = new \Symfony\Component\Translation\Translator('en_US');
$translatorHelper = new TranslatorHelper($translator);

$engine->addHelpers(array($formHelper, $translatorHelper));

$session = new Session();
$csrfGenerator = new \Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator();
$csrfStorage = new \Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage($session);
$csrfManager = new \Symfony\Component\Security\Csrf\CsrfTokenManager($csrfGenerator, $csrfStorage);

$validator = \Symfony\Component\Validator\Validation::createValidator();

$factory = Forms::createFormFactoryBuilder()
    ->addExtension(new \Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension())
    ->addExtension(new \Symfony\Component\Form\Extension\Csrf\CsrfExtension($csrfManager))
    ->addExtension(new \Symfony\Component\Form\Extension\Validator\ValidatorExtension($validator))
    ->getFormFactory();

$test = new Test();

$builder = $factory->createBuilder(FormType::class, $test)
    ->setMethod('POST')
    ->add('name', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
        'label' => 'banana man',
        'choices' => [
            'banana' => 'banana',
            'cake' => 'cake'
        ]
    ])
    ->add('text', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
        'constraints' => [new \Symfony\Component\Validator\Constraints\Length(['min' => 4])]
    ])
    ->add('submit', SubmitType::class, ['label' => 'Hello world!']);

$form = $builder->getForm();
$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$form->handleRequest($request);

if ($form->isSubmitted() === true && $form->isValid() === true) {
    var_dump($test);
    die;
}

$view = $form->createView();


// Render the form view
echo $formHelper->start($view);
echo $formHelper->label($view->vars['form']['name']);
echo $formHelper->widget($view->vars['form']['name']);
echo $formHelper->errors($view->vars['form']['name']);
echo '<br />';
echo $formHelper->label($view->vars['form']['text']);
echo $formHelper->widget($view->vars['form']['text']);
echo $formHelper->errors($view->vars['form']['text']);
echo $formHelper->end($view);
