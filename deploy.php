<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'zcart');

// Project repository
set('repository', 'https://bitbucket.org/ahkmunna/incevioshop/src/feature/');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('incevio.com')
    ->user('deployer')
    ->identityFile('~/.ssh/deployerkey')    
    ->set('deploy_path', '/var/www/demo/zcart');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');

