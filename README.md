# Concrete5 Symfony Form Component

The Form component allows you to easily create, process and reuse HTML forms using the Symfony Form Component within Concrete 5.

### Resources

- https://documentation.concrete5.org/
- https://symfony.com/doc/current/components/form.html
- https://github.com/matt9mg/concrete5-symfony-form/issues


### Installation

```
composer require matt9mg/concrete5-symfony-form
```

### Using the Form Component in a view

```php
use Matt9mg\Concrete5\Symfony\Form\FormFactory;

public function view()
{

    $factory = (new FormFactory(
        $this->app->make('session')
    ))->createFormFactory();

    $form = $factory->create(MyForm::class);
    $form->handleRequest($this->request);

    if ($form->isSubmitted() === true && $form->isValid() === true) {
        ...
    }

    $this->set('formView', $form->createView());
}
```

### Rendering a form
```php
use Matt9mg\Concrete5\Symfony\Form\FormRenderer;
$formHelper = (new FormRenderer())
        ->build()
        ->getFormHelper();

// Render the form view
echo $formHelper->start($formView);
echo $formHelper->label($formView->vars['form']['name']);
echo $formHelper->widget($formView->vars['form']['name']);
echo $formHelper->errors($formView->vars['form']['name']);
echo '<br />';
echo $formHelper->label($formView->vars['form']['text']);
echo $formHelper->widget($formView->vars['form']['text'], ['attr' => ['style' => 'border: 10px']]);
echo $formHelper->errors($formView->vars['form']['text']);
echo $formHelper->end($formView);
```

### Override supplied templates or add custom ones
```php
use Matt9mg\Concrete5\Symfony\Form\FormRenderer;
$formHelper = (new FormRenderer())
        ->addTemplatePath(__DIR__ . '/my/template/path')
        ->build()
        ->getFormHelper();

```

### Feedback

Feedback is always welcome, want to add some features please raise a PR, I hope this helps you :)
