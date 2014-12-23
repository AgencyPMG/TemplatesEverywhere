# Templates Everywhere

Give your custom post types custom templates.

## Usage

Add the `pmg:templates` support to your post type. This can be done during
post type registration or after the fact.


```php
// during registration
add_action('init', function () {
    register_post_type('some_type', array(
        // ...
        'supports' => array(
            'title',
            'editor',
            'pmg:templates',
        ),
    ));
});

// after registration
add_action('init', function () {
    add_post_type_support('some_type', 'pmg:templates');
}, 100);
```

Then create some template files in your theme! These are normal PHP files but
they have a header in the format *{post_type} template: {template name}*.

```php
<?php
/**
 * some-template.php
 *
 * some_type template: this is a custom template
 */
```

With those two things in place, Templates Everywhere will show your new custom
templates in an admin area meta box.

![The Meta Box](https://github.com/AgencyPMG/TemplatesEverywhere/blob/master/screenshot1.png)

![The Meta Box](https://github.com/AgencyPMG/TemplatesEverywhere/blob/master/screenshot2.png)

## FAQs

#### I enabled template support but I don't see a meta box to select a template, what gives?

If no templates are found in the theme for a given post type the template
dropdown will not be displayed.

#### My templates are not updating promptly when I add a new one. Why?

Caching. By default Templates Everywhere uses [WordPress object caching API](http://codex.wordpress.org/Class_Reference/WP_Object_Cache).
If your install has a persistent cache, this will impact the templates dropdown.
You can wait it out, or...

```php
wp_cache_delete('some_type', 'pmg:templates');
```
