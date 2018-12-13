Symfony Skeleton
==========
Symfony Skeleton is an extension for the official [Symfony Skeleton](https://github.com/symfony/skeleton)
(recommended way for starting new projects using [Symfony Flex](https://symfony.com/doc/current/setup/flex.html)).
It's main idea is to keep simplicity of official Skeleton, while adding must-have dependencies and default configs used
in Skeleton for developing majority of the projects.


Creating new project
==========

Creating new project with 4xxi Symfony Skeleton is as easy as running
```bash
composer create-project temafey/symfony-skeleton <project_name>
```
where `<project_name>` is the directory where you want to setup a new project. New project is ready for development
immediately after this step.

[![Build Status](https://travis-ci.org/temafey/symfony-skeleton.svg?branch=master)](https://travis-ci.org/temafey/symfony-skeleton)
[![Coverage Status](https://coveralls.io/repos/github/temafey/symfony-skeleton/badge.svg?branch=master)](https://coveralls.io/github/temafey/symfony-skeleton?branch=coverage)

## Implementations

- [x] Environment in Docker
- [x] Command Bus, Query Bus, Event Bus
- [x] Event Store
- [x] Read Model
- [x] Async Event subscribers
- [x] Rest API
- [x] Event Store Rest API

## Stack

- PHP 7.2
- Percona 5.7
- Elastic & Kibana 6.5
- RabbitMQ 3

## Project Setup

Up environment:

`make start`

Execute tests:

`make phpunit`

Static code analysis:

`make style`

Code style fixer:

`make cs`

Code style checker:

`make cs-check`

Enter in php container:

`make s=php sh`

Disable\Enable Xdebug:

`make xoff`

`make xon`

Build image to deploy

`make artifact`

Make release commit

`make rmt`

Make conventional commit,
read specs https://www.conventionalcommits.org/en/v1.0.0-beta.2

`make commit`

Watch containers logs

`make logs`

See all make commands

`make help`

Full test circle

`make test`
