# GraphQL Mapper Bundle

### Work in progress.

Symfony bundle for [GraphQL Mapper](https://github.com/4rthem/graphql-mapper)

## Installation

This is installable via [Composer](https://getcomposer.org/) as [arthem/graphql-mapper](https://packagist.org/packages/arthem/graphql-mapper):

```bash
composer require arthem/graphql-mapper-bundle
```

## Setup / Configuration

Enable the bundle:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Arthem\Bundle\GraphQLBundle\ArthemGraphQLBundle(),
        );

        // ...
    }

    // ...
}
```

Create your schema:

```yaml
# app/config/graphql_schema.yml

# Your schema here
```

> See graphql-mapper [documentation](https://github.com/4rthem/graphql-mapper)

Then declare your mapping file in the bundle configuration:

```yaml
# app/config/config.yml

arthem_graphql:
    mapping:
        files:
            - %kernel.root_dir%/config/graphql_schema.yml
```

Setup routing:

```yaml
# app/config/routing.yml
arthem_graphql:
    resource: "@ArthemGraphQLBundle/Resources/config/routing.yml"
    prefix:   /api
```

## Usage

Just call `POST /app_dev.php/api/graphql` with a "query" parameter

## License

Released under the [MIT License](LICENSE).
