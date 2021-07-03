# WP Option v1.0

![](https://oberonlai.blog/wp-content/uploads/wordpress-and-composer/wordpress-and-composer-10.jpg)

> Simple WordPress class for settings api modifed from [boo-settings-helper](https://github.com/boospot/boo-settings-helper) 

## Requirements

* PHP >=7.2
* [Composer](https://getcomposer.org/)
* [WordPress](https://wordpress.org) >=5.4

## Installation

#### Install with composer

Run the following in your terminal to install with [Composer](https://getcomposer.org/).

```
$ composer require oberonlai/wp-option
```

WP Option [PSR-4](https://www.php-fig.org/psr/psr-4/) autoloading and can be used with the Composer's autoloader. Below is a basic example of getting started, though your setup may be different depending on how you are using Composer.

```php
require __DIR__ . '/vendor/autoload.php';

use ODS\Option;

$prefix = 'plugin-prefix';

$books = new Option( $prefix );

```

See Composer's [basic usage](https://getcomposer.org/doc/01-basic-usage.md#autoloading) guide for details on working with Composer and autoloading.

## Basic Usage

Below is a basic example of setting up a simple option page.

```php
// Require the Composer autoloader.
require __DIR__ . '/vendor/autoload.php';

// Import PostTypes.
use ODS\Option;

$config = new Option( 'plugin-prefix' );
$config->addMenu();
$config->addTab();
$config->addText();
$config->register(); // Don't forget this.
```

## Usage

To create a option, first instantiate an instance of `Option`.  The class takes one argument, which is an plugin prefix. All of the options' name will add this prefix.

```php
$config = new Option( 'plugin-prefix' );
```

After instantiating the above option, you have to add settings menu and tab.

### Menu

Firstly, we need to add admin menu to our option page. 

```php
$config->addMenu(
	array(
		'page_title' => __( 'Plugin Name Settings', 'plugin-name' ),
		'menu_title' => __( 'Plugin Name', 'plugin-name' ),
		'capability' => 'manage_options',
		'slug'       => 'plugin-name',
		'icon'       => 'dashicons-performance',
		'position'   => 10,
		'submenu'    => true,
		'parent'     => 'edit.php?post_type=event',
	)
);
```

### Tab

You have to add one tab at least. The fields are placed in tab.

```php
$config->addTab(
	array(
		array(
			'id'    => 'general_section',
			'title' => __( 'General Settings', 'plugin-name' ),
			'desc'  => __( 'These are general settings for Plugin Name', 'plugin-name' ),
		),
		array(
			'id'    => 'advance_section',
			'title' => __( 'Advanced Settings', 'plugin-name' ),
			'desc'  => __( 'These are advance settings for Plugin Name', 'plugin-name' )
		)
	)
);
```

## Avaiable fields

Fields list

- Text
- URL
- Number
- Color
- Textarea
- Radio Button
- Select
- HTML
- Checkbox
- Multi Select
- Related
- Password
- File
- Media Upload

Common params of fields:

- id - (string) Field ID. Use get_option( $plugin-prefix. 'field_id' ) to get value.
- label - (string) Field name.
- desc - (string) Field description.
- placeholder - (string) Field placeholder.
- default - (string) Select, checkbox, radio default option.
- options - (array) Select, radio, multicheck options.
- callback - (callback) Function name to be used to render field.
- sanitize_callback (callback) Function name to be used for sanitization
- show_in_rest - (Boolean) Show in REST API.
- class - (string) - Field css class name. Separate more classes with space.
- size - (string) - Field size. Options for small, regular, and large.

```php
array(
	'id'                => 'text_field_id',
	'label'             => __( 'Text Field', 'plugin-name' ), 
	'desc'              => __( 'Some description of my field', 'plugin-name' ),
	'placeholder'       => 'This is Placeholder',
	'default'           => '', 
	'options'           => array(),
	'callback'          => '',
	'sanitize_callback' => '',
	'show_in_rest'      => true,
	'class'             => 'my_custom_css_class',
	'size'              => 'regular',
),
```


### Text

There are three arguments. First is the tab ID, second is text field params, and last is callback function of render field.

```php
$config->addText(
	'general_section',
	array(
		'id'                => 'text_field_id',
		'label'             => __( 'Hello World', 'plugin-name' ),
		'desc'              => __( 'Some description of my field', 'plugin-name' ),
		'placeholder'       => 'This is Placeholder',
		'show_in_rest'      => true,
		'class'             => 'my_custom_css_class',
		'size'              => 'regular',
	),
);
```

With render callback function:

```php
$config->addText(
	'general_section',
	array(
		'id'    => 'text_field_id',
		'label' => __( 'Hello World', 'plugin-name' ),
	),
	function( $args ) {
		$html  = sprintf(
			'<input 
				class="regular-text"
				type="%1$s"
				name="%2$s"
				value="%3$s"
				placeholder="%4$s"
            	style="border: 3px solid red;"
			/>',
			$args['type'],
			$args['name'],
			$args['value'],
			'Placeholder from callback'
		);
		$html .= '<br/><small>This field is generated with callback parameter</small>';
		echo $html;
		unset( $html );
	}
);
```

### URL

```php
$config->addUrl(
	'general_section',
	array(
		'id'    => 'url_field_id',
		'label' => __( 'URL Field', 'plugin-name' ),
	),
);
```

### Number
```php
$config->addNumber(
	'general_section',
	array(
		'id'          => 'number_field_id',
		'label'       => __( 'Number Input', 'plugin-name' ),
		'placeholder' => __( 'Your Age here', 'plugin-name' ),
		'options'     => array(
			'min'  => 0,
			'max'  => 99,
			'step' => '1',
		),
	),
);
```

### Color
```php
$config->addColor(
	'general_section',
	array(
		'id'    => 'color_field_id',
		'label' => __( 'Color Field', 'plugin-name' ),
	),
);
```

### Textarea
```php
$config->addTextarea(
	'general_section',
	array(
		'id'          => 'textarea_field_id',
		'label'       => __( 'Textarea Input', 'plugin-name' ),
		'desc'        => __( 'Textarea description', 'plugin-name' ),
		'placeholder' => __( 'Textarea placeholder', 'plugin-name' ),
	),
);
```

### Radio Button
```php
$config->addRadio(
	'general_section',
	array(
		'id'      => 'radio_field_id',
		'label'   => __( 'Radio Button', 'plugin-name' ),
		'desc'    => __( 'A radio button', 'plugin-name' ),
		'options' => array(
			'radio_1' => 'Radio 1',
			'radio_2' => 'Radio 2',
			'radio_3' => 'Radio 3',
		),
		'default' => 'radio_2',
	),
);
```

### Select
```php
$config->addSelect(
	'general_section',
	array(
		'id'      => 'select_field_id',
		'label'   => __( 'A Dropdown Select', 'plugin-name' ),
		'desc'    => __( 'Dropdown description', 'plugin-name' ),
		'default' => 'option_2',
		'options' => array(
			'option_1' => 'Option 1',
			'option_2' => 'Option 2',
			'option_3' => 'Option 3',
		),
		'default' => 'option_3',
	),
);
```

### HTML

Add static html in table row.

```php
$config->addHtml(
	'general_section',
	array(
		'id'    => 'html',
		'label' => 'HTML',
		'desc'  => __( 'HTML area description. You can use any <strong>bold</strong> or other HTML elements.', 'plugin-name' ),
	),
);
```

### Checkbox
```php
$config->addCheckbox(
	'general_section',
	array(
		'id'    => 'checkbox_field_id',
		'label' => __( 'Checkbox', 'plugin-name' ),
		'desc'  => __( 'A Checkbox', 'plugin-name' ),
	),
);
```

### Checkboxes
```php
$config->addCheckboxes(
	'general_section',
	array(
		'id'      => 'multi_field_id',
		'label'   => __( 'Checkboxes', 'plugin-name' ),
		'desc'    => __( 'A checkboxes', 'plugin-name' ),
		'options' => array(
			'multi_1' => 'Multi 1',
			'multi_2' => 'Multi 2',
			'multi_3' => 'Multi 3',
		),
		'default' => array(
			'multi_1' => 'multi_1',
			'multi_3' => 'multi_3',
		),
	),
);
```

### Posts

Add specific post type. The third params is the name of custom post type.

```php
$config->addPost(
	'general_section',
	array(
		'id'      => 'pages_field_id',
		'label'   => __( 'Pages Field Type', 'plugin-name' ),
		'desc'    => __( 'List of Pages', 'plugin-name' ),
	),
	'page' // post type
);
```

### Password

```php
$config->addPassword(
	'general_section',
	array(
		'id'          => 'password_field_id',
		'label'       => __( 'Password Field', 'plugin-name' ),
		'desc'        => __( 'Password description', 'plugin-name' ),
		'placeholder' => __( 'Textarea placeholder', 'plugin-name' ),
	),
);
```

### File Uploader

```php
$config->addFile(
	'general_section',
	array(
		'id'      => 'file_field_id',
		'label'   => __( 'File', 'plugin-name' ),
		'desc'    => __( 'File description', 'plugin-name' ),
		'options' => array(
			'btn' => 'Get it', // upload button text
		),
	),
);
```

### Media Uploader

```php
$config->addMedia(
	'general_section',
	array(
		'id'      => 'media_field_id',
		'label'   => __( 'Media', 'plugin-name' ),
		'desc'    => __( 'Media', 'plugin-name' ),
		'type'    => 'media',
		'options' => array(
			'btn'       => __( 'Get the image', 'plugin-name' ),
			'width'     => 150,
			'max_width' => 150,
		),
	),
);
```




## Render field

You can use callback function when add field to render the field.

```php
$config->addText(
	'general_section',
	array(
		'id'    => 'text_field_id',
		'label' => __( 'Hello World', 'plugin-name' ),
	),
	function( $args ) {
		$html  = sprintf(
			'<input 
				class="regular-text"
				type="%1$s"
				name="%2$s"
				value="%3$s"
				placeholder="%4$s"
            	style="border: 3px solid red;"
			/>',
			$args['type'],
			$args['name'],
			$args['value'],
			'Placeholder from callback'
		);
		$html .= '<br/><small>This field is generated with callback parameter</small>';
		echo $html;
		unset( $html );
	}
);
```

## Add links in plugins list

You can add links below the plugin name in list.

![](https://oberonlai.blog/wp-content/uploads/wordpress-and-composer/wordpress-and-composer-09.jpg)

```php
$config->addLink(
	'my-plugin',  // Your plugin's folder and main file name.
	array(
		array(
			'type' => 'default',
			'text' => __( 'Configure', 'plugin-name' ),
		),
		array(
			'type' => 'internal',
			'text' => __( 'Gravity Forms', 'plugin-name' ),
			'url'  => 'admin.php?page=gf_edit_forms',
		),
		array(
			'type' => 'external',
			'text' => __( 'Github Repo', 'plugin-name' ),
			'url'  => 'https://github.com/boospot/boo-settings-helper',
		),
	)
);
```

### Retrive field's value

You can use WordPress get_option() to get value. Don't forget the prefix name of field id. For example::

```php
use ODS\Option;

$config = new Option( 'hello-world-' );
$config->addMenu();
$config->addTab();
$config->addText(
	'general_section',
	array(
		'id'                => 'my_text_field',
		'label'             => __( 'Hello World', 'plugin-name' ),
		'desc'              => __( 'Some description of my field', 'plugin-name' ),
		'placeholder'       => 'This is Placeholder',
		'show_in_rest'      => true,
		'class'             => 'my_custom_css_class',
		'size'              => 'regular',
	),
);
```

If you want to retrive field value of 'my_text_field', use code below:

```php
$my_text_field_value = get_option( 'hello-world-my_text_field' );
```