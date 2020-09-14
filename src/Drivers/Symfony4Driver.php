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
            $dbConfig = [
                'driver' => 'pdo_mysql',
                'charset' => 'utf8',
            ];
            if ($databaseUrl = getenv('DATABASE_URL')) {
                $data = parse_url($databaseUrl);
                $dbConfig['dbname'] = ltrim('/', $data['path']);
                $dbConfig['host'] = $data['host'];
                $dbConfig['user'] = $data['user'];
                $dbConfig['password'] = $data['pass'];
                $dbConfig['port'] = $data['port'] ?? 3306;
            } else {
                $dbConfig['dbname'] = getenv('DATABASE_NAME');
                $dbConfig['host'] = getenv('DATABASE_HOST');
                $dbConfig['user'] = getenv('DATABASE_USER');
                $dbConfig['password'] = getenv('DATABASE_PASSWORD');
                $dbConfig['port'] = getenv('DATABASE_PORT') ?: 3306;
            }
            if (empty($dbConfig['host'])) {
                throw new \Exception('Unable to read database host in file: "' . $absolutePathWithEnvFile . '"');
            }
            if (empty($dbConfig['dbname'])) {
                throw new \Exception('Unable to read database name in file: "' . $absolutePathWithEnvFile . '"');
            }
            if (empty($dbConfig['user'])) {
                throw new \Exception('Unable to read database user in file: "' . $absolutePathWithEnvFile . '"');
            }
            if (empty($dbConfig['password'])) {
                throw new \Exception('Unable to read database password in file: "' . $absolutePathWithEnvFile . '"');
            }
            return $dbConfig;
        }

        throw new \Exception('Missing .env file with. Looking for file: "' . $absolutePathWithEnvFile . '"');
    }
}
