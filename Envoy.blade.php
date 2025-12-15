@include('./vendor/autoload.php');

@setup
    $wd = dirname( __FILE__ );

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

    try {
        $dotenv->load();
        $dotenv->required(['DEPLOY_USER'])->notEmpty();
        $dotenv->required(['DEPLOY_HOST'])->notEmpty();
        $dotenv->required(['DEPLOY_REPOSITORY'])->notEmpty();
        $dotenv->required(['DEPLOY_APP_DIR'])->notEmpty();
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    define('DEPLOY_USER', $_ENV['DEPLOY_USER']);
    define('DEPLOY_HOST', $_ENV['DEPLOY_HOST']);

    $repository = $_ENV['DEPLOY_REPOSITORY'];
    $app_dir = $_ENV['DEPLOY_APP_DIR'];
    $branch = $_ENV['DEPLOY_BRANCH'] ?? 'main';

    function logMessage($message) {
        return "echo '\033[32m" . $message . "\033[0m';\n";
    }

    function logErrorMessage($message) {
        return "echo '\033[0;31m" . $message . "\033[0m';\n";
    }

    function errorMessage($message) {
        return "\033[0;31m" . $message . "\033[0m\n";
    }

    function toWorkingDirectory($app) {
        return dirname(__FILE__) . "/" . $app;
    }
@endsetup

@servers(['live' => DEPLOY_USER . '@' . DEPLOY_HOST])

@story('deploy', ['on' => 'live', 'confirm' => false])
    pull-repository
    run-composer
    run-node
@endstory

@task('pull-repository', ['on' => 'live'])
    {{ logMessage('Pulling latest code from repository') }}
    cd {{ $app_dir }}
    git fetch
    git pull
@endtask

@task('run-composer', ['on' => 'live'])
    echo "Starting deployment ({{ $branch }})"
    cd {{ $app_dir }}
    composer install --prefer-dist --no-scripts -q -o
    composer dump-autoload
    php artisan migrate --force
    php artisan optimize:clear
@endtask

@task('run-node', ['on' => 'live'])
    cd {{ $app_dir }}
    npm install
    npm run build
@endtask
