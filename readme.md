# How-to setup #

- PHP 7.4
- database.sql to import data and structure
- bootstrap.php contains settings for MySQL connection (host, user / pass, db name), change those if necessary
- Otherwise just put it in the Apache public :)
- There are already created 4 accounts: user, admin, mod, combo (all passwords same as usernames)

# Commentary #

- I probably took it too deep and from wrong angle :/
- First step when dealing with no framework is to create a framework
- So just basic requirement tok around 5h :/
- [So yeah...](https://www.youtube.com/watch?v=Wm2h0cbvsw8)
- No editing sadly (unless directly through phpMyAdmin or something), just login, see what's visible for the particular account, logout :/

## Musings on architecture ##

I tried mimicking the architecture we used in my previous job, though majority of it wasn't needed here (or I didn't get to that part yet).
And due to time constraints it got pretty messy in the end.

In theory (when I started several hours ago) it had to be OOP, but somehow everything fitted neatly into static methods.
So apart from mysqli object everything is static in this case.

- Repositories in theory should be separate one for each database table (or document collection, or anything), though we also had some specific ones for example just for transmuting old data to new format, or doing some specific calculations by collecting stuff from all over the place.
  - Main idea is that they separate data storage from usage.
  - We had some data migrate from MySQL to Mongo to JSON file cache to Redis, all with just changing the repository class. Models / controllers / etc doesn't care where or how the data is stored.
- Very _smol_ bootloader / config class
- Tried implementing something similar to Twig, just to keep separation between front and back. But it's pretty crude.

# In summary #

Got bogged down in details and sacrificed speed for that :)
Thanks for opportunity though, at first the task looked primitive, but trying create *air-quotes* framework *unquote* is kinda fun :)
