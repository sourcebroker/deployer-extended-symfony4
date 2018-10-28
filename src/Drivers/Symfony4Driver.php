<?php

namespace SourceBroker\DeployerExtendedSymfony3\Drivers;

/**
 * Class Symfony4Driver
 * @package SourceBroker\DeployerExtended\Drivers
 */
class Symfony4Driver
{
    /**
     * @param null $absolutePathWithConfig
     * @return array
     * @throws \Exception
     */
    public function getDatabaseConfig($absolutePathWithEnvFile = null)
    {
        if (null == $absolutePathWithEnvFile) {
            $absolutePathWithEnvFile = __DIR__ . '/../../../../../.env';
        }
        if (file_exists($absolutePathWithEnvFile)) {
            (new \Symfony\Component\Dotenv\Dotenv())->load($absolutePathWithEnvFile);
            $data = parse_url(getenv('DATABASE_URL'));
            $dbConfig = [
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'dbname' => ltrim('/', $data['path']),
                'user' => '',
                'password' => '',
                'charset' => 'utf8',
            ];
            if (!empty($data['host'])) {
                $dbConfig['host'] = $data['host'];
            } else {
                throw new \Exception('Unable to read host in file: "' . $absolutePathWithEnvFile . '"');
            }
            if (!empty(ltrim($data['path'], '/'))) {
                $dbConfig['dbname'] = ltrim($data['path'], '/');
            } else {
                throw new \Exception('Unable to read database name in file: "' . $absolutePathWithEnvFile . '"');
            }
            if (!empty($data['user'])) {
                $dbConfig['user'] = $data['user'];
            } else {
                throw new \Exception('Unable to read database user in file: "' . $absolutePathWithEnvFile . '"');
            }
            if (!empty($data['pass'])) {
                $dbConfig['password'] = $data['pass'];
            } else {
                throw new \Exception('Unable to read database password in file: "' . $absolutePathWithEnvFile . '"');
            }
            if (!empty($data['port'])) {
                $dbConfig['port'] = $data['port'];
            }
            return $dbConfig;
        } else {
            throw new \Exception('Missing .env file with. Looking for file: "' . $absolutePathWithEnvFile . '"');
        }

    }

    /**
     * @param null $absolutePathWithConfig
     * @return string
     * @throws \Exception
     */
    public function getInstanceName($absolutePathWithEnvFile = null)
    {
        if (null == $absolutePathWithEnvFile) {
            $absolutePathWithEnvFile = __DIR__ . '/../../../../../.env';
        }
        if (file_exists($absolutePathWithEnvFile)) {
            (new \Symfony\Component\Dotenv\Dotenv())->load($absolutePathWithEnvFile);
            if (!class_exists(\Symfony\Component\Yaml\Yaml::class)) {
                throw new \RuntimeException('Unable to read yaml as the Symfony Yaml Component is not installed.');
            } else {
                $instanceName = null;
                if (!empty(getenv('INSTANCE'))) {
                    $instanceName = getenv('INSTANCE');
                } else {
                    throw new \Exception('Missing "INSTANCE" variable in file: "' . $absolutePathWithEnvFile . '"');
                }
                return $instanceName;
            }
        } else {
            throw new \Exception('Missing file with instance name. Looking for file: "' . $absolutePathWithEnvFile . '"');
        }
    }
}