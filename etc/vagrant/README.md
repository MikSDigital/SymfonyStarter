# Description
This configuration includes following software:

* Debian 8.1
* PHP 7.0
* MySQL 5.6 Percona Server
* Apache 2.2.22
* Composer
* Curl
* Vim
* Git

# Usage

First you need to create vagrant VM

```
$ cd etc/vagrant
$ vagrant up
```

While waiting for Vagrant to start up, you should add an entry into /etc/hosts file on the host machine.

```
10.0.0.200      app_name.dev
```

Setup your db password in parameters.yml

```
parameters:
    database_password: vagrant
```

From now you should be able to access your app_name project at [http://app_name.dev/app_dev.php](http://app_name.dev/app_dev.php)

Installing your assets manually

```
    vagrant ssh -c 'cd /var/www/app_name && ./node_modules/.bin/gulp'
```

# Troubleshooting

Using Symfony2 inside Vagrant can be slow due to synchronisation delay incurred by NFS. To avoid this, both locations have been moved to a shared memory segment under ``/dev/shm/app_name``.

To view the application logs, run the following commands:

```bash
$ tail -f /dev/shm/app_name/app/logs/prod.log
$ tail -f /dev/shm/app_name/app/logs/dev.log
```

To view the apache logs, run the following commands:

```bash
$ tail -f /var/log/apache2/app_name_error.log
$ tail -f /var/log/apache2/app_name_access.log
```