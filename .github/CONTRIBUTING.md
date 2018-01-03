# How to contribute

Thanks for contributing to skeleton! Just follow these single guidelines:

* You __MUST__ follow the PSR-2 coding standard. Please see [PSR-2](http://www.php-fig.org/psr/psr-2/) for more details.
    * Please run `composer format-preview` to see which codes should be fixed.
    * Please run `composer format` to fix coding style, before sending pull requests.
* You __MUST__ pass all unit tests in your local environment.
    * Please run `composer test`.
    * Please run `docker-compose up` if you can. This will run unit tests against multiple PHP versions.
* You __MUST__ use [feature / topic branches](https://git-scm.com/book/en/v2/Git-Branching-Branching-Workflows) to ease the merge of contributions.
* You __MUST__ use the provided [commit message template](../.gitmessage), which follows the [rules](http://chris.beams.io/posts/git-commit/) described by Chris Beams. It can be configured via `composer configure-commit-template` prior to committing.
