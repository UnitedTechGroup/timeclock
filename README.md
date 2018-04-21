
PHP Timeclock
=============

It is a simple yet effective web-based timeclock system. It allows you to
track all employee time as well as upcoming vacations and more, and it can
replace manual sign-in/sign-out sheets.

An administration piece is included which allows an administrator to add or
delete users, change a user's time or password (if using passwords is
enabled), and hide the reports from your users where only an admin or a
reports user has access to them. These reports can be run to show daily
activitiy or for a range of dates, and can be run for all users, or
individually for each user.

This product is distributed under the GPL. This program is free software;
you can redistribute it and/or modify it under the terms of the GNU General
Public License version 2, as published by the Free Software Foundation.


This repository is a fork of the original code which has not been updated
in many years. I am not affiliated with the original projects in any way
and this fork has not been endorsed by original authors.


## Requirements

- Tested with PHP 5.4 – 7.0
- MySQL or MariaDB
- Webserver

See [install documentation](docs/INSTALL.md) for more information and a
list of tested configurations.


## PHP Timeclock source credits

This source distribution is the result of combining two separate projects,
and the contributions of [various other fine people](docs/CREDITS).

### Timeclock - http://timeclock.sf.net/

Originally written by Ken Papizan <pappyzan_at_users.sourceforge.net>.

### Punchclock - http://www.acmebase.org/punchclock/

By Mack Pexton <mack@acmebase.org>


## Project goals and intentions

I am maintaining this code because we use it at my place of work. I intend
to keep it updated to run in modern environments, fix security issues, and
reduce code duplication as I find time. New features will be added as we
need them, but I don't expect too many to come up.

As I make changes, I will try to preserve existing functionality, even for
things we do not use, though testing of such features will be limited.
Patches and bug reports on anything that breaks are welcome.
