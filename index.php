<?php

$loader = require __DIR__ . '/vendor/autoload.php';
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$loader, 'loadClass']);

require_once __DIR__ . '/Test.php';

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

$test = new Test();

$factory = (new \Matt9mg\Concrete5\Symfony\Form\FormFactory())->createFormFactory();

$builder = $factory->createBuilder(FormType::class, $test)
    ->setMethod('POST')
    ->add('name', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
        'label' => 'banana man',
        'choices' => [
            'banana' => 'banana',
            'cake' => 'cake'
        ]
    ])
    ->add('text', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
    ->add('submit', SubmitType::class, ['label' => 'Hello world!']);

$form = $builder->getForm();
$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$form->handleRequest($request);

if ($form->isSubmitted() === true && $form->isValid() === true) {
    var_dump($test);
    die;
}

$view = $form->createView();

$formHelper = (new \Matt9mg\Concrete5\Symfony\Form\FormRenderer())->build()->getFormHelper();

// Render the form view
echo $formHelper->start($view);
echo $formHelper->label($view->vars['form']['name']);
echo $formHelper->widget($view->vars['form']['name']);
echo $formHelper->errors($view->vars['form']['name']);
echo '<br />';
echo $formHelper->label($view->vars['form']['text']);
echo $formHelper->widget($view->vars['form']['text'], ['attr' => ['style' => 'border: 10px']]);
echo $formHelper->errors($view->vars['form']['text']);
echo $formHelper->end($view);
