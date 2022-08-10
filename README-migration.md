# Migration
## 1 - Pour la migration il faut installer doctrine-migrations-extra-bundle
>composer require sylius-labs/doctrine-migrations-extra-bundle

## 2 - configurer config/packages/doctrine_migrations.yaml
```
doctrine_migrations:
    storage:
        table_storage:
            table_name: sylius_migrations
    migrations_paths:
        'App\Migrations': "%kernel.project_dir%/src/Migrations"
    services:
        'Doctrine\Migrations\Version\MigrationFactory': 'SyliusLabs\DoctrineMigrationsExtraBundle\Factory\ContainerAwareVersionFactory'
        'Doctrine\Migrations\Version\Comparator': 'SyliusLabs\DoctrineMigrationsExtraBundle\Comparator\TopologicalVersionComparator'
```

## Création migration
>php bin/console doctrine:migrations:diff

## Migration upp
>php bin/console doctrine:migrations:execute --up App\Migrations\VersionNumber

## Migration down
>php bin/console doctrine:migrations:execute --down App\Migrations\VersionNumber
