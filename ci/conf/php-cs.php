<?php

declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_extra_blank_lines' => true,
        'no_unused_imports' => false,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => true,
        'backtick_to_shell_exec' => true,
        'declare_strict_types' => true,
        'no_superfluous_phpdoc_tags' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__.'/../..')
            ->exclude(['bin', 'var', 'vendor'])
    );
