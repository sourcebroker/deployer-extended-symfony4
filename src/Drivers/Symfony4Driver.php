<?php

namespace SourceBroker\DeployerExtendedSymfony4\Drivers;

use \Symfony\Component\Dotenv\Dotenv;

/**
 * Class Symfony4Driver
 */
class Symfony4Driver
{
    /**
     * @param string $absolutePathWithEnvFile
     * @return array
     * @throws \Exception
     */
    public function getDatabaseConfig($absolutePathWithEnvFile = null)
    {
        if (null === $absolutePathWithEnvFile) {
            $absolutePathWithEnvFile = __DIR__ . '/../../../../../.env';
        }
        if (file_exists($absolutePathWithEnvFile)) {
            (new Dotenv())->loadEnv($absolutePathWithEnvFile);
            $data = parse_url($_ENV['DATABASE_URL']);
            $dbConfig = [
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'dbname' => ltrim('/', $data['path']),
                'user' => '',
                'password' => '',
                'charset' => 'utf8',
                'port' => isset($data['port']) ? $data['port'] : ''
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
            return $dbConfig;
        }

        throw new \Exception('Missing .env file with. Looking for file: "' . $absolutePathWithEnvFile . '"');
    }
}