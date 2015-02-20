INSTALLATION

clone the project from the repository at url: https://github.com/mauipipe/social-graph-api

DEPENDENCIES

run composer to install the dependencies

TEST

1) Phpspec

run bin/phpspec run or vendor/bin/phpspec run in the case that the executable is missing from bin folder

2) Behat

run php bin/behat or vendor/bin/behat run in the case that the executable is missing from bin folder

USAGE

run from console:

php bin/run.php <query_name> <id>

possible queries:

query_name:
    - friends
    - friend-of-friend
    - suggested-friend

