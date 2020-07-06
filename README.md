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
This is a generic example using doctrine entities, but can be used as a raw form or other class.


```php
use Matt9mg\Concrete5\Symfony\Form\FormFactory;

public function view()
{

    $factory = (new FormFactory(
        $this->app->make('session')
    ))->createFormFactory();

    $em = $this->app->make(EntityManagerInterace::class);
    $entity = $em->getRepostiory(MyEntity:class);

    $form = $factory->create(MyForm::class, $entity);
    $form->handleRequest($this->request);

    if ($form->isSubmitted() === true && $form->isValid() === true) {
        $em->persist($entity);
        $em->flush();
    
        //...
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

### How to use the C5 Specific form extensions
There are two new Types ```FileManagerType::class``` and ```SitemapType::class```.

The below new config options have public constants for these options.

##### Configuration Options for FileManagerType::class
In the normal symfony way when declare the field type array the below options are available for this field type.

file_manager_type => 'APP' or 'AUDIO' or 'DOC' or 'FILE' or 'IMAGE' or 'TEXT' or 'VIDEO'

file_manager_args => []

Example within a form class

```php
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        // ...
        ->add('relatedImage', FileManagerType::class, [
            'file_manager_type' => FileManagerType::FILE_MANAGER_TYPE_FILE,
        ])
    ;
}
```


##### Configuration Options for SitemapType::class
In the normal symfony way when declare the field type array the below options are available for this field type.

selector_type => 'SELECT_PAGE' or 'QUICK_SELECT' or 'MULTIPLE_SITEMAP' or 'SELECT_FROM_SITEMAP'

selector_type_args => []

selector_type_starting_point => 'HOME_CID'

```php
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        // ...
        ->add('relatedPage', SitemapType::class, [
            'selector_type' => SitemapType::SITEMAP_TYPE_SELECT_PAGE,
        ])
    ;
}
```

### Feedback

Feedback is always welcome, want to add some features please raise a PR, I hope this helps you :)
