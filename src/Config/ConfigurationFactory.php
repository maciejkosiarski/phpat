<?php

namespace PhpAT\Config;

use PhpAT\App\Configuration;
use Symfony\Component\Yaml\Yaml;

class ConfigurationFactory
{
    private array $defaults = [
        'verbosity' => 0,
        'php-version' => null,
        'ignore-docblocks' => false,
        'ignore-php-extensions' => true,
        'composer' => ['main' => ['json' => 'composer.json', 'lock' => 'composer.lock']]
    ];

    public function create(string $configFilePath, array $commandOptions): Configuration
    {
        $config = Yaml::parse(file_get_contents($configFilePath));
        $config['options'] = array_merge($config['options'] ?? [], array_filter($commandOptions));

        return new Configuration(
            $config['src']['path'] ?? '',
            $config['src']['include'] ?? [],
            $config['src']['exclude'] ?? [],
            $config['composer'] ?? $this->defaults['composer'],
            $config['tests']['path'] ?? '',
            $this->decideVerbosity($commandOptions, $config),
            $config['options']['php-version'] ?? $this->defaults['php-version'],
            (bool) ($config['options']['ignore-docblocks']
                ?? $this->defaults['ignore-docblocks']),
            (bool) ($config['options']['ignore-php-extensions']
                ?? $this->defaults['ignore-php-extensions'])
        );
    }

    private function decideVerbosity(array $commandOptions, $config): int
    {
        if ($commandOptions['quiet'] === true) {
            return 0;
        }

        return ($config['options']['verbosity'] ?? $this->defaults['verbosity']);
    }
}